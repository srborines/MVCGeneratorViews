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
$lang_array = get_language_variable($lang);


//Exec step function
$function_name = "step_".$step;
if(function_exists($function_name)){
  $function_name();
}else{
  render_view("error",['error' => "Undexpected step."]);
}



function step_1(){
  render_view("index",[]);
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
      $conn = get_mysqli_connection($server, $user, $password);


      if($conn){
        $databses = get_DBs($conn);
        render_view("index-2",['databases' => $databses]);
        //close connection
        close_mysqli_connection($conn);
      }else{
        render_view("index",['error' =>"credentials_error"]);
      }
    }else{
      render_view("index",['error' =>"post_error"]);
    }
  }else{
    render_view("index",['error' =>"post_error"]);
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
      $conn = get_mysqli_connection($server, $user, $password);

      if($conn){
        $entities = get_tables_DB($conn,$databsename);
        render_view("index-3",['entities' => $entities]);
        //Close Mysql connection
        close_mysqli_connection($conn);
      }else{
        render_view("index",['error' =>"credentials_error"]);
      }
    }else{
      render_view("index",['error' =>"post_error"]);
    }
  }else{
    render_view("index",['error' =>"post_error"]);
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
      $conn = get_mysqli_connection($server, $user, $password);
      //Check connection
      if($conn){
        //Create database user
        create_database_user($conn, $databasename, $new_user, $new_password);

        //Select the unique database to use
        $conn->select_db($databasename);

        //Get assoc array with entities and fields especifications
        $skelDB = get_assoc_with_entities_and_fileds($conn,$databasename);

        //Create folders and files
        generate_folders_and_files_MVC($skelDB,$install_directory);

        render_view("index-4",['directory' => $install_directory]);
        //Close Mysql connection
        closeMysqliConnection($conn);
      }else{
        render_view("index",['error' =>"credentials_error"]);
      }
    }else{
      render_view("index",['error' =>"post_error"]);
    }
  }else{
    render_view("index",['error' =>"post_error"]);
  }
}


function generate_folders_and_files_MVC($skelDB,$install_directory){
  //Create install directory if doesn't exist
  create_path_if_doesnt_exist($install_directory);

  //Create directory 'View' if doesn't exist
  $path_views = $install_directory."/View/";
  create_path_if_doesnt_exist($path_views);

  //Create message View
  create_message_view_file($path_views);

  //Create menu file view
  create_menu_file_view($skelDB,$path_views);

  //Generate entities views_model
  generate_entities_views($skelDB,$path_views);

  //Create directory 'Locates' if doesn't exist
  $path_locates = $install_directory."/Locates/";
  create_path_if_doesnt_exist($path_locates);

//ONLY DEVELOP
die();
  //Create language files
  create_languages_files($skelDB,$path_locates,['ENGLISH','SPANISH']);

  //Create directory 'View/js' if doesn't exist
  $path_view_js = $install_directory."/View/js/";
  create_path_if_doesnt_exist($path_view_js);

  //Create comprobar js script
  create_comprobar_js($skelDB,$path_view_js);

  //Copy static scripts
  copy_static_scripts($path_view_js);

  //Create directory 'View/css' if doesn't exist
  $path_view_css = $install_directory."/View/css/";
  create_path_if_doesnt_exist($path_view_css);

  //Copy static css
  copy_static_css($path_view_css);

  //Create directory 'View/Icons' if doesn't exist
  $path_view_icons = $install_directory."/View/Icons/";
  create_path_if_doesnt_exist($path_view_icons);

  //Copy static icons
  copy_static_icons($path_view_icons);

  //Create directory 'View/img' if doesn't exist
  $path_view_img = $install_directory."/View/img/";
  create_path_if_doesnt_exist($path_view_img);

  //Copy static images
  copy_static_images($path_view_img);

}

function generate_entities_views($skelDB,$path_views){
  global $views_available;
  foreach ($skelDB as $entity => $fields_skel) {
    foreach ($views_available as $action) {
      $view_file = $path_views.$entity."_".$action."_View.php";
      create_every_view($action,$view_file,$entity,$fields_skel);
    }
  }
}
function create_every_view($action,$view_file,$entity,$fields_skel){
  $file = $view_file;
  $function_content = "generate_".$action."_view";
  $content = $function_content($entity,$fields_skel);
  create_file($file, $content);
}

//Generate contents of views
function generate_ADD_view($entity,$fields_skel){
  $template = file_get_contents("./resources/views_model/ADD.template");

  $show_values = false;
  $disabled = false;
  $required = false;
  $validation = true;
  $inputs = generate_inputs_from_fields($entity,$fields_skel,$show_values,$disabled,$required,$validation);

  $html = str_replace("**!!ENTITY!!**", $entity, $template);
  $html = str_replace("**!!INPUTS!!**", $inputs, $html);

  return $html;
}
function generate_DELETE_view($entity,$fields_skel){
    $template = file_get_contents("./resources/views_model/DELETE.template");

    $show_values = true;
    $disabled = true;
    $required = true;
    $validation = false;
    $inputs = generate_inputs_from_fields($entity,$fields_skel,$show_values,$disabled,$required,$validation);

    $html = str_replace("**!!ENTITY!!**", $entity, $template);
    $html = str_replace("**!!INPUTS!!**", $inputs, $html);

    return $html;
}
function generate_EDIT_view($entity,$fields_skel){
  $template = file_get_contents("./resources/views_model/EDIT.template");

  $show_values = true;
  $disabled = false;
  $required = false;
  $validation = true;
  $inputs = generate_inputs_from_fields($entity,$fields_skel,$show_values,$disabled,$required,$validation);

  $html = str_replace("**!!ENTITY!!**", $entity, $template);
  $html = str_replace("**!!INPUTS!!**", $inputs, $html);

  return $html;
}
function generate_SEARCH_view($entity,$fields_skel){
    $template = file_get_contents("./resources/views_model/SEARCH.template");

    $show_values = false;
    $disabled = false;
    $required = false;
    $validation = false;
    $inputs = generate_inputs_from_fields($entity,$fields_skel,$show_values,$disabled,$required,$validation);

    $html = str_replace("**!!ENTITY!!**", $entity, $template);
    $html = str_replace("**!!INPUTS!!**", $inputs, $html);

    return $html;
}
function generate_SHOWALL_view($entity,$fields_skel){
    $template = file_get_contents("./resources/views_model/SHOWALL.template");

    $key = get_mysql_key_from_field($fields_skel);

    $html = str_replace("**!!ENTITY!!**", $entity, $template);
    $html = str_replace("**!!KEYURL!!**", $key, $html);

    return $html;
}
function generate_SHOWCURRENT_view($entity,$fields_skel){
    $template = file_get_contents("./resources/views_model/SHOWCURRENT.template");

    $show_values = true;
    $disabled = true;
    $required = true;
    $validation = false;
    $inputs = generate_inputs_from_fields($entity,$fields_skel,$show_values,$disabled,$required,$validation);

    $html = str_replace("**!!ENTITY!!**", $entity, $template);
    $html = str_replace("**!!INPUTS!!**", $inputs, $html);

    return $html;
}

function generate_inputs_from_fields($entity,$fields_skel,$show_values,$disabled,$required,$validation){
  $inputs = "";
  foreach ($fields_skel as $filed_name => $fieldSkel) {
    $type_raw = $fieldSkel['Type'];
    $type = get_mysql_field_type($type_raw);

    $esVacio = $fieldSkel['Null'] == 'YES' ? "" : "&& esVacio(this)";

    switch ($type) {
      case 'int':
        $long = get_mysql_long_from_field($type_raw);
        $inputs .= "\t\t\t".$filed_name." :<input type='number' name='".$filed_name."' size='".$long."' ";
        if($show_values) $inputs .= " value = '<?= \$this->valores['".$filed_name."'] ?>' ";
        if($show_values) $inputs .= " onblur='true ".$esVacio."  && comprobarInt(this,".$long.")' ";
        if($disabled) $inputs .= " disabled ";
        if($required) $inputs .= " required ";
        $inputs .= "><br>\n";
        break;
      case 'varchar':
        $long = get_mysql_long_from_field($type_raw);
        $inputs .= "\t\t\t".$filed_name." :<input type='text' name='".$filed_name."' min =''max='' ";
        if($show_values) $inputs .= " value = '<?= \$this->valores['".$filed_name."'] ?>' ";
        if($show_values) $inputs .= " onblur='true ".$esVacio."  && comprobarInt(this,".$long.")' ";
        if($disabled) $inputs .= " disabled ";
        if($required) $inputs .= " required ";
        $inputs .= "><br>\n";
        break;
      case 'date':
        $long = get_mysql_long_from_field($type_raw);
        $inputs .= "\t\t\t".$filed_name." :<input type='date' name='".$filed_name."' size='".$long."' ";
        if($show_values) $inputs .= " value = '<?= \$this->valores['".$filed_name."'] ?>' ";
        if($show_values) $inputs .= " onblur='true ".$esVacio."  && comprobarInt(this,".$long.")' ";
        if($disabled) $inputs .= " disabled ";
        if($required) $inputs .= " required ";
        $inputs .= "><br>\n";
        break;
      case 'enum':
        $options = get_mysql_options_from_enum_field($type_raw);
        $inputs .= "\t\t\t".$filed_name." :<select name='".$filed_name."'>\n";
        foreach ($options as $option) {
          $inputs .= "\t\t\t\t<option ";
          if($show_values)$inputs .=" value='".$option."' <?php if(\$this->valores['".$filed_name."'] == '".$option."') echo 'selected'; ?> ";
          $inputs .= " >".$option."</option>\n";
        }
        $inputs .= "\t\t\t</select><br>\n";
        break;
      default:
        $inputs .= "View generator error: Input type unknown<br>\n";
        break;
    }

  }
}

//AUX file functions
function create_path_if_doesnt_exist($path){
  if(!is_dir("./".$path)) mkdir($path, 0777);
}
function create_file($file,$content){
  $file_open = fopen($file, "w");
  fwrite($file_open, $content);
  fclose($file_open);
  chmod($file,0777);
}
function copy_file($file_source,$file_destination){
  copy($file_source, $file_destination);
  chmod($file_destination,0777);
}

//AUX folder functions
function copy_all_directory_content($path_source,$path_destination){
  $cdir = scandir($source_path);
  foreach ($cdir as $file) {
    if (!in_array($file,array(".",".."))) copy_file($source_path.$file,$path_destination.$file);
  }
}

//AUX installer functions
function get_language_variable($lang){
  global $languages_path;

  $language_filename = $lang.".php";
  $languages_path = $languages_path;

  if(is_dir($languages_path)){
    $language_file = $languages_path.$language_filename;
    if(file_exists($language_file)){
      include_once($language_file);
      return $language_array;
    }else{
      render_view("error", ['error' => "File of language '".$language_file."' doesn't exist."]);
    }
  }else{
    render_view("error", ['error' => "The directory of views '".$languages_path."' doesn't exist."]);
    exit();
  }
}
function render_view($view_name, $parameters){
  global $views_path, $lang_array;;

  $views_path = $views_path;
  $view_filename = $view_name.".php";
  if(is_dir($views_path)){
    $view_file = $views_path.$view_filename;
    if(file_exists($view_file)){

      include_once($view_file);

    }else{
      render_view("error", ['error' => "File of view '".$view_file."' doesn't exist."]);
    }
  }else{
    echo "<span style='color:red'>Error: The directory of views '".$views_path."' doesn't exist.</span>";
  }

}

//Copy js static folder
function copy_static_scripts($path_view_js){
  $source_path = "./resources/resources_views_model/js/";
  copy_all_directory_content($source_path,$path_view_js);
}

//Copy css static folder
function copy_static_css($path_view_css){
  $source_path = "./resources/resources_views_model/css/";
  copy_all_directory_content($source_path,$path_view_css);
}

//Copy Icons static folder
function copy_static_icons($path_view_icon){
  $source_path = "./resources/resources_views_model/Icons/";
  copy_all_directory_content($source_path,$path_view_icon);
}

//Copy css static folder
function copy_static_images($path_view_img){
  $source_path = "./resources/resources_views_model/img/";
  copy_all_directory_content($source_path,$path_view_img);
}

//Menu file view functions
function create_menu_file_view($skelDB,$path_views){
  $file = $path_views."menuLateral.php";
  $content = generate_menu_view($skelDB);
  create_file($file, $content);
}
function generate_menu_view($skelDB){
  $html = "</nav>\n\t<ul>\n";
  foreach ($skelDB as $entity => $fields) {
    $html .= "\t\t<li>\n";
    $html .= "\t\t\t<a href='../Controller/".$entity."_Controller.php'><?= \$strings['".$entity." management'] ?></a>\n";
    $html .= "\t\t</li>\n";
  }
  $html .= "\t</ul>\n</nav>";

  return $html;
}

//Message file view functions
function create_message_view_file($path_views){
  $file = $path_views."MESSAGE_View.php";
  $content = generate_message_view_file();
  create_file($file, $content);
}
function generate_message_view_file(){
  $template_message_view = file_get_contents("./resources/views_model/MESSAGE.template");
  return $template_message_view;
}

//Language file functions TODO: caution with this because if the file exists is necessary only append the content
function create_languages_files($skelDB,$path_locates,$languages){
  foreach ($languages as $language) {
    $file = $path_locates."Strings_".$language.".php";
    create_languages_file($file);
  }
}
function create_languages_file($file,$language){
  $content = generate_content_language_file($language,$skelDB);
  create_file($file, $content);

}
function generate_content_language_file($language,$skelDB){
  //TODO: do that it works
  return false;
}

//Comprobar js file functions
function create_comprobar_js($skelDB,$path_view_js){
  $file = $path_view_js."comprobar.js";
  $content = generate_content_comprobar_js($skelDB);
  create_file($file, $content);
}
function generate_content_comprobar_js($skelDB){
  $rules_js = array();
  foreach ($skelDB as $entity) {
      foreach ($entity as $field_name => $field_skel) {
        if($field_skel['Null'] == 'NO') $rules_js[] = "esVacio(Form.".$field_name.")";
        $type = get_mysql_field_type($field_skel['Type']);
        if($type == "int"){
          $rules_js[] = "comprobarInt(Form.".$field['Field'].", ".$values.")";
        }else if($type == "varchar"){
          $rules_js[] = "comprobarText(Form.".$field['Field'].", ".$values.")";
        }
      }
  }
  $content_comprobar_js .= "function comprobar_".$entity."(){\nreturn(".implode(" && ", $rules_js).")\n}\n";
  return $content_comprobar_js;
}

//Database functions
function get_mysqli_connection($server, $username, $password){

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
function close_mysqli_connection($conn){
  $conn->close();
}
function get_DBs($conn){
  $databases = array();

  $sql = "SHOW DATABASES";
  $result = $conn->query($sql);
  while($databases[] = $result->fetch_array(MYSQLI_NUM));

  return $databases;
}
function get_tables_DB($conn,$databasename){
  $tables = array();
  $conn->select_db($databasename);
  $sql = "SHOW TABLES";
  $result = $conn->query($sql);
  while($tables[] = $result->fetch_array(MYSQLI_NUM)[0]);

  return array_filter($tables);
}
function create_database_user($conn, $databasename, $new_user, $new_password){

  $sql1 = "CREATE USER '".$new_user."'@'localhost' IDENTIFIED BY '".$new_password."'";
  $result1 = $conn->query($sql1);

  $sql2 = "GRANT ALL ON ".$databasename.".* TO '".$new_user."'@'localhost'";
  $result2 = $conn->query($sql2);
}
function get_assoc_with_entities_and_fileds($conn,$databasename){
  $skelDB = array();
  $tables = get_tables_DB($conn,$databasename);
  foreach ($tables as $table) {
    $result = $conn->query("SHOW FIELDS FROM ".$table);
    while($field_skel = $result->fetch_array(MYSQLI_ASSOC)){
      $skelDB[$table][$field_skel['Field']] = $field_skel;
    }
  }
  return $skelDB;
}
function get_mysql_field_type($type_raw_mysql){
  $type = $type_raw_mysql;
  if(strpos($type_raw_mysql, '(') !== false){
    $type = explode("(", $type_raw_mysql)[0];
  }
  return $type;
}
function get_mysql_long_from_field($type_raw_mysql){
  if( preg_match( '!\(([0-9]+)\)!', $type_raw_mysql, $match ) ){
    return $match[1];
  }else{
    return 0;
  }
}
function get_mysql_options_from_enum_field($type_raw_mysql){
  $options = array();
  if( preg_match( '!\(([^\)]+)\)!', $type_raw_mysql, $match ) ){
    $options_with_quotes = explode(",", $match[0]);
    foreach ($options_with_quotes as $option_quote) $options[] = trim($option_quote ,"'");
  }
  return $options;
}
function get_mysql_key_from_field($fields_skel){
  $key = array();
  foreach ($fields_skel as $filed_name => $fieldSkel) {
    if($fieldSkel['Key']) $key[] = $filed_name."=<?= \$datos['".$filed_name."'] ?>";
  }
  if(count($key) > 0) $key = implode("&", $key);

  return $key;
}
?>
