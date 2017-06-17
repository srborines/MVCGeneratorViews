<?php
//Initialize session
session_start();

//Default value global configuration variables
$views_path = "./resources/setup_views/";
$languages_path = "./resources/setup_languages/";
$views_available = ["ADD","DELETE","EDIT","SEARCH","SHOWALL","SHOWCURRENT"];

//Default variables in first execution
$step = 1;
$lang = 'EN';

//Check get values and change value in session
if(isset($_GET['lang'])) $_SESSION['lang'] = $_GET['lang'];
if(isset($_GET['step'])) $_SESSION['step'] = $_GET['step'];

//Check session variables and change value
if(isset($_SESSION['step'])) $step = $_SESSION['step'];
if(isset($_SESSION['lang'])) $lang = $_SESSION['lang'];

//Include language variables
$lang_array = getLanguageVariable($lang);


//Exec step function
$function_name = "step_".$step;
if(function_exists($function_name)){
  $function_name();
}else{
  renderView("error",['error' => "Undexpected step."]);
}



function step_1(){
  renderView("index",[]);
}

function step_2(){
  //Check if was a POST request
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //Check post variables
    if(isset($_POST['inst_db_url']) && isset($_POST['inst_db_user']) && isset($_POST['inst_db_password'])){
      //obtain dabase credentials from post
      $server = $_POST['inst_db_url'];
      $user = $_POST['inst_db_user'];
      $password = $_POST['inst_db_password'];

      //Save credentials in session
      $_SESSION['db_server'] = $server;
      $_SESSION['db_user'] = $user;
      $_SESSION['db_password'] = $password;

      //check credentials
      $conn = getMysqliConnection($server, $user, $password);


      if($conn){
        $databses = getDBs($conn);
        renderView("index-2",['databases' => $databses]);
        //close connection
        closeMysqliConnection($conn);
      }else{
        renderView("index",['error' =>"credentials_error"]);
      }
    }else{
      renderView("index",['error' =>"post_error"]);
    }
  }else{
    renderView("index",['error' =>"post_error"]);
  }
}

function step_3(){
  //Check if was a POST request
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //Check post variables
    if(isset($_POST['inst_db_name'])){
      //obtain dabase credentials from sesion
      $server = $_SESSION['db_server'];
      $user = $_SESSION['db_user'];
      $password = $_SESSION['db_password'];

      //Obtain databasename from post
      $databsename = $_POST['inst_db_name'];

      //Save databasename in session
      $_SESSION['db_name'] = $databsename;

      //check credentials
      $conn = getMysqliConnection($server, $user, $password);

      if($conn){
        $entities = array_filter(getEntitiesDB($conn,$databsename));
        renderView("index-3",['entities' => $entities]);
        //Close Mysql connection
        closeMysqliConnection($conn);
      }else{
        renderView("index",['error' =>"credentials_error"]);
      }
    }else{
      renderView("index",['error' =>"post_error"]);
    }
  }else{
    renderView("index",['error' =>"post_error"]);
  }
}

function step_4(){
  //Check if was a POST request
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //Check post variables
    if(isset($_POST['new_db_user']) && isset($_POST['new_db_password']) && isset($_POST['install_directory'])){
      //obtain dabase credentials from sesion
      $server = $_SESSION['db_server'];
      $user = $_SESSION['db_user'];
      $password = $_SESSION['db_password'];
      $databasename = $_SESSION['db_name'];

      //Obtain databasename from post
      $new_user = $_POST['new_db_user'];
      $new_password = $_POST['new_db_password'];
      $install_directory = $_POST['install_directory'];

      //Create connection
      $conn = getMysqliConnection($server, $user, $password);
      //Check connection
      if($conn){
        //Create database user
        createDatabaseUser($conn, $databasename, $new_user, $new_password);

        //Create install directory if doesn't exist
        if(!is_dir("./".$install_directory)) mkdir($install_directory);

        //Get entities
        $entities = array_filter(getEntitiesDB($conn,$databasename));

        //Select the unique database to use
        $conn->select_db($databasename);

        //Create directory 'View' if doesn't exist
        $path_views = $install_directory."/View/";
        if(!is_dir("./".$path_views)) mkdir($path_views);

        //Create menu file view
        $path_menu_file = $path_views;
        $filename = "menuLateral.php";
        $file = $path_menu_file.$filename;
        $file_open = fopen($file, "w");
        fwrite($file_open, generate_menu_view($entities));
        fclose($file_open);


        //Create files
        global $views_available;
        foreach ($entities as $entity) {

          $field_list = array();

          $sql = "SHOW FIELDS FROM ".$databasename.".".$entity[0];
          $result = $conn->query($sql);

          while($field_list[] = $result->fetch_array(MYSQLI_ASSOC));

          $field_list = array_filter($field_list);

          foreach ($views_available as $action_view) {
            $filename = $entity[0]."_".$action_view."_View.php";
            $file = "./".$install_directory."/View/".$filename;

            try {
                $file_open = fopen($file, "w");
                $function_of_compose = "compose_".$action_view."_view";
                fwrite($file_open, $function_of_compose($field_list, $entity[0]));
                fclose($file_open);
            } catch (Exception $e) {
              die("Problem opening files");
            }
          }
          //ONLY DEVELOP
          //break;
        }


        renderView("index-4",[]);
        //Close Mysql connection
        closeMysqliConnection($conn);
      }else{
        renderView("index",['error' =>"credentials_error"]);
      }
    }else{
      renderView("index",['error' =>"post_error"]);
    }
  }else{
    renderView("index",['error' =>"post_error"]);
  }
}





function compose_ADD_view($field_list, $entity){
  $template = file_get_contents("./resources/views_model/ADD.template");

  $inputs = "";
  foreach ($field_list as $field) {

    if($field['Type'] == 'date'){
      $inputs .= "\t\t\t".$field['Field']." :<input type='date' name='".$field['Field']."' size = '' value = '' onblur='esVacio(this)' ><br>\n";
    }else{
      $aux = explode("(", $field['Type']);
      $type = $aux[0];
      if($type == 'enum'){
        $values = explode(")", $aux[1])[0];
        $values_arr = explode(",", $values);
        $inputs .= "\t\t\t".$field['Field']." :<select name='".$field['Field']."'>\n";
        foreach ($values_arr as $key => $value){
          $value_clean = trim($value ,"'");
          $inputs .= "\t\t\t\t<option value='".$value_clean."'>".$value_clean."</option>\n";
        }
        $inputs .= "\t\t\t</select><br>\n";
      }else{
        $long = explode(")", $aux[1])[0];
        if($type == 'int'){
          $inputs .= "\t\t\t".$field['Field']." :<input type='number' name='".$field['Field']."' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,".$long.")' ><br>\n";
        }else if($type == 'varchar'){
          $inputs .= "\t\t\t".$field['Field']." :<input type='text' name='".$field['Field']."' size = '".$long."' value = '' onblur='esVacio(this)  && comprobarText(this,".$long.")' ><br>\n";
        }
      }
    }
  }

  $html = str_replace("**!!ENTITY!!**", $entity, $template);
  $html = str_replace("**!!INPUTS!!**", $inputs, $html);

  return $html;
}
function compose_DELETE_view($field_list, $entity){
    $template = file_get_contents("./resources/views_model/DELETE.template");
    $inputs = "";
    foreach ($field_list as $field) {

      if($field['Type'] == 'date'){
        $inputs .= "\t\t\t".$field['Field']." :<input type='date' name='".$field['Field']."' size = '".$long."' value = '<?= \$this->valores['".$field['Field']."'] ?>' onblur='esVacio(this)'  required  readonly ><br>\n";
      }else{
        $aux = explode("(", $field['Type']);
        $type = $aux[0];
        if($type == 'enum'){
          $values = explode(")", $aux[1])[0];
          $values_arr = explode(",", $values);
          $inputs .= "\t\t\t".$field['Field']." :<select name='".$field['Field']."'>\n";
          foreach ($values_arr as $key => $value){
            $selected = "";
            $value_clean = trim($value ,"'");
            $inputs .= "\t\t\t\t<option value='".$value_clean."' <?php if(\$this->valores['".$field['Field']."'] == '".$value_clean."') echo 'selected'; ?>>".$value_clean."</option>\n";
          }
          $inputs .= "\t\t\t</select><br>\n";
        }else{
          $long = explode(")", $aux[1])[0];
          if($type == 'int'){
            $inputs .= "\t\t\t".$field['Field']." :<input type='number' name='".$field['Field']."' min ='' max='' value = '<?= \$this->valores['".$field['Field']."'] ?>' onblur='esVacio(this)  && comprobarText(this,".$long.")'  required  readonly ><br>\n";
          }else if($type == 'varchar'){
            $inputs .= "\t\t\t".$field['Field']." :<input type='text' name='".$field['Field']."' size = '".$long."' value = '<?= \$this->valores['".$field['Field']."'] ?>' onblur='esVacio(this)  && comprobarText(this,".$long.")'  required  readonly ><br>\n";
          }
        }
      }
    }

    $html = str_replace("**!!ENTITY!!**", $entity, $template);
    $html = str_replace("**!!INPUTS!!**", $inputs, $html);

    return $html;
}
function compose_EDIT_view($field_list, $entity){
  $template = file_get_contents("./resources/views_model/EDIT.template");

  $inputs = "";
  foreach ($field_list as $field) {
    if($field['Type'] == 'date'){
      $inputs .= "\t\t\t".$field['Field']." :<input type='date' name='".$field['Field']."' size = '".$long."' value = '<?= \$this->valores['".$field['Field']."'] ?>' onblur='esVacio(this)' ><br>\n";
    }else{
      $aux = explode("(", $field['Type']);
      $type = $aux[0];
      if($type == 'enum'){
        $values = explode(")", $aux[1])[0];
        $values_arr = explode(",", $values);
        $inputs .= "\t\t\t".$field['Field']." :<select name='".$field['Field']."'>\n";
        foreach ($values_arr as $key => $value){
          $selected = "";
          $value_clean = trim($value ,"'");
          $inputs .= "\t\t\t\t<option value='".$value_clean."' <?php if(\$this->valores['".$field['Field']."'] == '".$value_clean."') echo 'selected'; ?>>".$value_clean."</option>\n";
        }
        $inputs .= "\t\t\t</select><br>\n";
      }else{
        $long = explode(")", $aux[1])[0];
        if($type == 'int'){
          $inputs .= "\t\t\t".$field['Field']." :<input type='number' name='".$field['Field']."' min ='' max='' value = '<?= \$this->valores['".$field['Field']."'] ?>' onblur='esVacio(this)  && comprobarText(this,".$long.")' ><br>\n";
        }else if($type == 'varchar'){
          $inputs .= "\t\t\t".$field['Field']." :<input type='text' name='".$field['Field']."' size = '".$long."' value = '<?= \$this->valores['".$field['Field']."'] ?>' onblur='esVacio(this)  && comprobarText(this,".$long.")' ><br>\n";
        }else{
          $inputs .= "Field unrecognized: ".$field['Field'];
        }
      }
    }
  }

  $html = str_replace("**!!ENTITY!!**", $entity, $template);
  $html = str_replace("**!!INPUTS!!**", $inputs, $html);

  return $html;
}
function compose_SEARCH_view($field_list, $entity){
    $template = file_get_contents("./resources/views_model/SEARCH.template");
    $inputs = "";
    foreach ($field_list as $field) {
      if($field['Type'] == 'date'){
        $inputs .= "\t\t\t".$field['Field']." :<input type='date' name='".$field['Field']."' size = '".$long."' value = '' onblur='esVacio(this)' ><br>\n";
      }else{
        $aux = explode("(", $field['Type']);
        $type = $aux[0];
        if($type == 'enum'){
          $values = explode(")", $aux[1])[0];
          $values_arr = explode(",", $values);
          $inputs .= "\t\t\t".$field['Field']." :<select name='".$field['Field']."'>\n";
          foreach ($values_arr as $key => $value){
            $value_clean = trim($value ,"'");
            $inputs .= "\t\t\t\t<option value='".$value_clean."'>".$value_clean."</option>\n";
          }
          $inputs .= "\t\t\t</select><br>\n";
        }else{
          $long = explode(")", $aux[1])[0];
          if($type == 'int'){
            $inputs .= "\t\t\t".$field['Field']." :<input type='number' name='".$field['Field']."' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,".$long.")' ><br>\n";
          }else if($type == 'varchar'){
            $inputs .= "\t\t\t".$field['Field']." :<input type='text' name='".$field['Field']."' size = '".$long."' value = '' onblur='esVacio(this)  && comprobarText(this,".$long.")' ><br>\n";
          }
        }
      }
    }

    $html = str_replace("**!!ENTITY!!**", $entity, $template);
    $html = str_replace("**!!INPUTS!!**", $inputs, $html);
    return $html;
}
function compose_SHOWALL_view($field_list, $entity){
    $template = file_get_contents("./resources/views_model/SHOWALL.template");

    $key = "";
    foreach ($field_list as $field) {
      if($field['Key']) $key = $field['Field'];
    }

    $html = $template;
    $html = str_replace("**!!ENTITY!!**", $entity, $html);
    $html = str_replace("**!!KEY!!**", $key, $html);

    return $html;
}
function compose_SHOWCURRENT_view($field_list, $entity){
    $template = file_get_contents("./resources/views_model/SHOWCURRENT.template");
    $inputs = "";
    foreach ($field_list as $field) {

      if($field['Type'] == 'date'){
        $inputs .= "\t\t\t".$field['Field']." :<input type='date' name='".$field['Field']."' size = '".$long."' value = '<?= \$this->valores['".$field['Field']."'] ?>' onblur='esVacio(this)'  required  readonly ><br>\n";
      }else{
        $aux = explode("(", $field['Type']);
        $type = $aux[0];
        if($type == 'enum'){
          $values = explode(")", $aux[1])[0];
          $values_arr = explode(",", $values);
          $inputs .= "\t\t\t".$field['Field']." :<select name='".$field['Field']."' required  readonly>\n";
          foreach ($values_arr as $key => $value){
            $selected = "";
            $value_clean = trim($value ,"'");
            $inputs .= "\t\t\t\t<option value='".$value_clean."' <?php if(\$this->valores['".$field['Field']."'] == '".$value_clean."') echo 'selected'; ?>>".$value_clean."</option>\n";
          }
          $inputs .= "\t\t\t</select><br>\n";
        }else{
          $long = explode(")", $aux[1])[0];
          if($type == 'int'){
            $inputs .= "\t\t\t".$field['Field']." :<input type='number' name='".$field['Field']."' min ='' max='' value = '<?= \$this->valores['".$field['Field']."'] ?>' onblur='esVacio(this)  && comprobarText(this,".$long.")'  required  readonly ><br>\n";
          }else if($type == 'varchar'){
            $inputs .= "\t\t\t".$field['Field']." :<input type='text' name='".$field['Field']."' size = '".$long."' value = '<?= \$this->valores['".$field['Field']."'] ?>' onblur='esVacio(this)  && comprobarText(this,".$long.")'  required  readonly ><br>\n";
          }
        }
      }
    }

    $html = str_replace("**!!ENTITY!!**", $entity, $template);
    $html = str_replace("**!!INPUTS!!**", $inputs, $html);

    return $html;
}

function generate_menu_view($entities){
  $html = "</nav>\n\t<ul>";
  foreach ($entities as $entity) {
    $html .= "<li>";
    //TODO: translate it
    $html .= "<a href='../Controller/".$entity[0]."_Controller.php'>".$entity[0]."</a>";
    $html .= "</li>";
  }
  $html .= "\t</ul>\n</nav>";

  return $html;
}



function getLanguageVariable($lang){
  global $languages_path;

  $language_filename = $lang.".php";
  $languages_path = $languages_path;

  if(is_dir($languages_path)){
    $language_file = $languages_path.$language_filename;
    if(file_exists($language_file)){
      include_once($language_file);
      return $language_array;
    }else{
      renderView("error", ['error' => "File of language '".$language_file."' doesn't exist."]);
    }
  }else{
    renderView("error", ['error' => "The directory of views '".$languages_path."' doesn't exist."]);
    exit();
  }
}

function renderView($view_name, $parameters){
  global $views_path, $lang_array;;

  $views_path = $views_path;
  $view_filename = $view_name.".php";
  if(is_dir($views_path)){
    $view_file = $views_path.$view_filename;
    if(file_exists($view_file)){

      include_once($view_file);

    }else{
      renderView("error", ['error' => "File of view '".$view_file."' doesn't exist."]);
    }
  }else{
    echo "<span style='color:red'>Error: The directory of views '".$views_path."' doesn't exist.</span>";
  }

}

function getMysqliConnection($server, $username, $password){

  if($socket =@ fsockopen($server, 80, $errno, $errstr, 30)) {
    // Create connection
    $conn = new mysqli($server, $username, $password);
    // Check connection
    if ($conn->connect_error) {
      echo "Connection failed: " . $conn->connect_error;
      $conn = false;
    }
  }else{
    $conn = false;
  }
  return $conn;
}

function closeMysqliConnection($conn){
  $conn->close();
}

function getDBs($conn){
  $databases = array();

  $sql = "SHOW DATABASES";
  $result = $conn->query($sql);
  while($databases[] = $result->fetch_array(MYSQLI_NUM));

  return $databases;
}

function getEntitiesDB($conn,$databasename){
  $entities = array();
  $conn->select_db($databasename);
  $sql = "SHOW TABLES";
  $result = $conn->query($sql);
  while($entities[] = $result->fetch_array(MYSQLI_NUM));

  return $entities;
}

function createDatabaseUser($conn, $databasename, $new_user, $new_password){

  $sql1 = "CREATE USER '".$new_user."'@'localhost' IDENTIFIED BY '".$new_password."'";
  $result1 = $conn->query($sql1);

  $sql2 = "GRANT ALL ON ".$databasename.".* TO '".$new_user."'@'localhost'";
  $result2 = $conn->query($sql2);
}

 ?>
