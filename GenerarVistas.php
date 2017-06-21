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


/********************************************//**
 *  Steps of the installer
 ***********************************************/

/** Render a static view to ask to the user about database manager credentials
*/
function step_1(){
  render_view("index",[]);
}
/** Check the credentials, save the credentials in session, show to the user all databases
*/
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
/** Save database in session, show the user all entities of the database selected,
* ask to the user a new database user and the install directory to the system
*/
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
/** Create user in database, obtain specification of the database,
* generate all the MVC system, show a static view to the user
*/
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



/********************************************//**
 *  Functions of generation of MVC System
 ***********************************************/

/** Create all the directories and files of the MVC system
* @param $skelDB Specifications of database provides by mysql
* @param $install_directory Path where will be instaled all the system
*/
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

  //Create footer view
  create_footer_file_view($path_views);

  //Create header view
  create_header_file_view($path_views);

  //Create entities views_model
  create_entities_views($skelDB,$path_views);

  //Create directory 'Locates' if doesn't exist
  $path_locates = $install_directory."/Locates/";
  create_path_if_doesnt_exist($path_locates);

  //Append variables/Create language files
  create_and_fill_languages_files($skelDB,$path_locates,['ENGLISH','SPANISH']);

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


/********************************************//**
 *  Functions of generation of the dinamic views
 ***********************************************/

/** Create all the views available to the entities in the database
* @param $skelDB Especifications of database provides by mysql
* @param $path_views Full path of the directory to create the files
*/
function create_entities_views($skelDB,$path_views){
  global $views_available;
  foreach ($skelDB as $entity => $fields_skel) {
    foreach ($views_available as $action) {
      $view_file = $path_views.$entity."_".$action."_View.php";
      create_every_view($action,$view_file,$entity,$fields_skel);
    }
  }
}
/** Create a view with the content of the action specified
* NOTE: (It execute a function or other to fill the file depends of the action)
* @param $action Name of the action of the view
* @param $view_file Full path of the view file
* @param $entity Name of a entity (table of database)
* @param $fields_skel Especifications of the fields from a database provides by mysql
*/
function create_every_view($action,$view_file,$entity,$fields_skel){
  $file = $view_file;
  $function_content = "generate_".$action."_view";
  $content = $function_content($entity,$fields_skel);
  create_file($file, $content);
}
/** Get the content of the ADD view to the current entity with its fields
* @param $entity Name of the current entity (table of database)
* @param $skelDB Especifications of database provides by mysql
*/
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
/** Get the content of the DELETE view to the current entity with its fields
* @param $entity Name of the current entity (table of database)
* @param $skelDB Especifications of database provides by mysql
*/
function generate_DELETE_view($entity,$fields_skel){
    $template = file_get_contents("./resources/views_model/DELETE.template");

    $show_values = true;
    $disabled = false;
    $required = false;
    $validation = false;
    $inputs = generate_inputs_from_fields($entity,$fields_skel,$show_values,$disabled,$required,$validation);

    $html = str_replace("**!!ENTITY!!**", $entity, $template);
    $html = str_replace("**!!INPUTS!!**", $inputs, $html);

    return $html;
}
/** Get the content of the EDIT view to the current entity with its fields
* @param $entity Name of the current entity (table of database)
* @param $skelDB Especifications of database provides by mysql
*/
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
/** Get the content of the SEARCH view to the current entity with its fields
* @param $entity Name of the current entity (table of database)
* @param $skelDB Especifications of database provides by mysql
*/
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
/** Get the content of the SHOWALL view to the current entity with its fields
* @param $entity Name of the current entity (table of database)
* @param $skelDB Especifications of database provides by mysql
*/
function generate_SHOWALL_view($entity,$fields_skel){
    $template = file_get_contents("./resources/views_model/SHOWALL.template");

    $key = get_mysql_key_from_field($fields_skel);
    $url_key = implode("&", $key);

    $html = str_replace("**!!ENTITY!!**", $entity, $template);
    $html = str_replace("**!!KEYURL!!**", $url_key, $html);

    return $html;
}
/** Get the content of the SHOWCURRENT view to the current entity with its fields
* @param $entity Name of the current entity (table of database)
* @param $skelDB Especifications of database provides by mysql
*/
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
/** Generate the content of a form depending of the fields and the options introduced to complete all the views
* @param $entity Name of the current entity (table of database)
* @param $fields_skel Especifications of database fields provides by mysql
* @param $show_values Flag to enable/disable show current values in the inputs
* @param $disabled Flag to enable/disable the tag disabled in the inputs
* @param $required Flag to enable/disable the tag required in the inputs
* @param $validation Flag to enable/disable the validation in the inputs
* @return $inputs String with the html of all inputs generated
*/
function generate_inputs_from_fields($entity,$fields_skel,$show_values,$disabled,$required,$validation){
  $inputs = "";
  foreach ($fields_skel as $filed_name => $fieldSkel) {
    $type_raw = $fieldSkel['Type'];
    $type = get_mysql_field_type($type_raw);

    $esVacio = $fieldSkel['Null'] == 'YES' ? "" : "&& esVacio(this)";

    switch ($type) {
      case 'int':
      case 'year':
        $long = get_mysql_long_from_field($type_raw);
        $inputs .= "\t\t\t".$filed_name." :<input type='number' name='".$filed_name."' size='".$long."' ";
        if($show_values) $inputs .= " value = '<?= \$this->valores['".$filed_name."'] ?>' ";
        if($validation) $inputs .= " onblur='true ".$esVacio."  && comprobarInt(this,".$long.")' ";
        if($disabled) $inputs .= " disabled ";
        if($required) $inputs .= " required ";
        $inputs .= "><br>\n";
        break;
      case 'varchar':
      case 'char':
        $long = get_mysql_long_from_field($type_raw);
        $inputs .= "\t\t\t".$filed_name." :<input type='text' name='".$filed_name."' min =''max='' ";
        if($show_values) $inputs .= " value = '<?= \$this->valores['".$filed_name."'] ?>' ";
        if($validation) $inputs .= " onblur='true ".$esVacio."  && comprobarText(this,".$long.")' ";
        if($disabled) $inputs .= " disabled ";
        if($required) $inputs .= " required ";
        $inputs .= "><br>\n";
        break;
      case 'date':
        $long = get_mysql_long_from_field($type_raw);
        $inputs .= "\t\t\t".$filed_name." :<input type='date' name='".$filed_name."' size='".$long."' ";
        if($show_values) $inputs .= " value = '<?= \$this->valores['".$filed_name."'] ?>' ";
        if($validation) $inputs .= " onblur='true ".$esVacio."'";
        if($disabled) $inputs .= " disabled ";
        if($required) $inputs .= " required ";
        $inputs .= "><br>\n";
        break;
      case 'enum':
        $options = get_mysql_options_from_enum_field($type_raw);
        $inputs .= "\t\t\t".$filed_name." :<select name='".$filed_name."'";
        if($disabled) $inputs .= " disabled ";
        if($required) $inputs .= " required ";
        $inputs .= ">\n";
        foreach ($options as $option) {
          $inputs .= "\t\t\t\t<option ";
          if($show_values) $inputs .=" value='".$option."' <?php if(\$this->valores['".$filed_name."'] == '".$option."') echo 'selected'; ?> ";
          $inputs .= " >".$option."</option>\n";
        }
        $inputs .= "\t\t\t</select><br>\n";
        break;
      default:
        $inputs .= "View generator error: Input type unknown<br>\n";
        break;
    }

  }
  return $inputs;
}


/********************************************//**
 *  Copy static files functions
 ***********************************************/

/** Copy all script files to a folder
* @param $path_view_js Full path of the directory to copy the estatic files
*/
function copy_static_scripts($path_view_js){
  $source_path = "./resources/resources_views_model/js/";
  copy_all_directory_content($source_path,$path_view_js);
}
/** Copy all css files to a folder
* @param $path_view_css Full path of the directory to copy the estatic files
*/
function copy_static_css($path_view_css){
  $source_path = "./resources/resources_views_model/css/";
  copy_all_directory_content($source_path,$path_view_css);
}
/** Copy all icons files to a folder
* @param $path_view_icon Full path of the directory to copy the estatic files
*/
function copy_static_icons($path_view_icon){
  $source_path = "./resources/resources_views_model/Icons/";
  copy_all_directory_content($source_path,$path_view_icon);
}
/** Copy all images files to a folder
* @param $path_view_img Full path of the directory to copy the estatic files
*/
function copy_static_images($path_view_img){
  $source_path = "./resources/resources_views_model/img/";
  copy_all_directory_content($source_path,$path_view_img);
}

/********************************************//**
 *  Functions of generation of menu file view
 ***********************************************/

/** Create the menu file view in a path with the anchors to all controlers of every entity
* @param $skelDB Especifications of database provides by mysql
* @param $path_views Full path of the directory to create the file
*/
function create_menu_file_view($skelDB,$path_views){
  $file = $path_views."menuLateral.php";
  $content = generate_menu_view($skelDB);
  create_file($file, $content);
}
/** Generate the content of the menu file view
* @param $skelDB Especifications of database provides by mysql
* @return $html String with the html of the menu file view
*/
function generate_menu_view($skelDB){
  $html = "<div class='span3' id='sidebar'>\n\t<ul class='nav nav-list bs-docs-sidenav nav-collapse collapse'>\n";
  foreach ($skelDB as $entity => $fields) {
    $html .= "\t\t<li>\n";
    $html .= "\t\t\t<a href='../Controller/".$entity."_Controller.php'><?= \$strings['".$entity." management'] ?></a>\n";
    $html .= "\t\t</li>\n";
  }
  $html .= "\t</ul>\n</div>";

  return $html;
}


/********************************************//**
 *  Functions of generation of message file view
 ***********************************************/

/** Create the message file view in a path
* @param $path_views Full path of the directory to create the file
*/
function create_message_view_file($path_views){
  $file = $path_views."MESSAGE_View.php";
  $content = generate_message_view_file();
  create_file($file, $content);
}
/** Create the message file view in a path with a static file
* @return $content Content of the static file
*/
function generate_message_view_file(){
  $content = file_get_contents("./resources/views_model/MESSAGE.template");
  return $content;
}

function create_header_file_view($path_views){
  $file = $path_views."Header.php";
  $content = generate_header_file_view();
  create_file($file, $content);
}
function generate_header_file_view(){
  $content = file_get_contents("./resources/views_model/HEADER.template");
  return $content;
}


function create_footer_file_view($path_views){
  $file = $path_views."Footer.php";
  $content = generate_footer_file_view();
  create_file($file, $content);
}
function generate_footer_file_view(){
  $content = file_get_contents("./resources/views_model/FOOTER.template");
  return $content;
}


/********************************************//**
 *  Functions of generation of language files
 ***********************************************/

/** Create the language files if don't exist and fill the content with the new language variables
* @param $skelDB Especifications of database provides by mysql
* @param $path_locates Full path where will be genereted or filled the files
* @param $languages Array with all the possible languages
*/
function create_and_fill_languages_files($skelDB,$path_locates,$languages){
  foreach ($languages as $language) {
    $file = $path_locates."Strings_".$language.".php";
    if(!file_exists($file)) create_languages_file($file);
    append_variables_language_file($file,$language,$skelDB);
  }
}
/** Create the language file in disc with the skel content
* @param $file Full path of file to be created
*/
function create_languages_file($file){
    $basic_content = generate_skel_content_language_file();
    create_file($file, $basic_content);
}
/** Generate the basic content of a language file
*/
function generate_skel_content_language_file(){
  return "<?php\n\$strings = \narray(\n)\n;\n ?>";
}
/** Append the new translations to the language files in disc
* @param $file Full path of the file to be appended the new translations
* @param $language Language of the current file that is been procesed
* @param $skelDB Especifications of database provides by mysql
*/
function append_variables_language_file($file,$language,$skelDB){
  require_once($file);

  $new_language_variables = generate_language_variables_of_views($language, $skelDB);
  $strings = array_merge($strings,$new_language_variables);
  $strings_to_php = array_assoc_to_string_php_format("strings",$strings);
  $file_to_php = "<?php\n".$strings_to_php."\n ?>";
  create_file($file, $file_to_php);
}
/** Get an array with al the translations generated from the database tables and fields
* @param $language Language of the current file that is been procesed
* @param $skelDB Especifications of database provides by mysql
* @return $lang_vars Assoc array with the new translations
*/
function generate_language_variables_of_views($language,$skelDB){
  //TODO: translate
  $lang_vars = array();
  foreach ($skelDB as $entity => $fields_skel) {
    $lang_vars[$entity] = $entity;
    $lang_vars[$entity." management"] = $entity." management";
    foreach ($fields_skel as $field_name => $field_skel) {
      $lang_vars[$field_name] = $field_name;
    }
  }
  return $lang_vars;
}


/********************************************//**
 *  Functions of generation of validation script
 ***********************************************/

/** Create the file comprobar.js in a specific directory with the content dinamic of the database specification
* @param $skelDB Especifications of database provides by mysql (this  function need access to the tables and fields)
* @param $path_view_js Full path of the directory where eill be created the file
*/
function create_comprobar_js($skelDB,$path_view_js){
  $file = $path_view_js."comprobar.js";
  $content = generate_content_comprobar_js($skelDB);
  create_file($file, $content);
}
/** Generate content of the file comprobar.js with the content dinamic of the database specification
* @param $skelDB Especifications of database provides by mysql (this  function need access to the tables and fields)
* @return $content Content of the script
*/
function generate_content_comprobar_js($skelDB){
  $content = "";
  foreach ($skelDB as $entity_name => $entity) {
      $rules_js = array();
      foreach ($entity as $field_name => $field_skel) {
        $max = get_mysql_long_from_field($field_skel['Type']);
        if($field_skel['Null'] == 'NO') $rules_js[] = "esVacio(Form.".$field_name.")";
        $type = get_mysql_field_type($field_skel['Type']);
        if($type == "int"){
          $rules_js[] = "comprobarInt(Form.".$field_name.", ".$max.")";
        }else if($type == "varchar"){
          $rules_js[] = "comprobarText(Form.".$field_name.", ".$max.")";
        }
      }
      $content .= "function comprobar_".$entity_name."(){\nreturn(".implode(" && ", $rules_js).")\n}\n";
  }
  return $content;
}

/********************************************//**
 *  Database functions
 ***********************************************/

/** Open and obtain a connection with database manager
* @param $server Remote machine with database manager
* @param $username Username  to connect with database manager
* @param $password Password to connect with database manager
* @return $conn Object mysqli_connect
*/
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
/** Close the connection with database manager
* @param $conn Object mysqli_connect
*/
function close_mysqli_connection($conn){
  $conn->close();
}
/** Get an array with the names of all databases in the database manager
* @param $conn Object mysqli_connect
* @return $databases Numeric array with all databases
*/
function get_DBs($conn){
  $databases = array();

  $sql = "SHOW DATABASES";
  $result = $conn->query($sql);
  while($databases[] = $result->fetch_array(MYSQLI_NUM));

  return $databases;
}
/** Get an array with the names of all tables from a database
* @param $conn Object mysqli_connect
* @param $databsename Name of database
* @return $tables Numeric array with all tables
*/
function get_tables_DB($conn,$databasename){
  $tables = array();
  $conn->select_db($databasename);
  $sql = "SHOW TABLES";
  $result = $conn->query($sql);
  while($tables[] = $result->fetch_array(MYSQLI_NUM)[0]);

  return array_filter($tables);
}
/** Create new user in database manager
* @param $conn Object mysqli_connect
* @param $databsename Name of database
* @param $new_user Username of the new user
* @param $new_password Password of the new user
*/
function create_database_user($conn, $databasename, $new_user, $new_password){

  $sql1 = "CREATE USER '".$new_user."'@'localhost' IDENTIFIED BY '".$new_password."'";
  $result1 = $conn->query($sql1);

  $sql2 = "GRANT ALL ON ".$databasename.".* TO '".$new_user."'@'localhost'";
  $result2 = $conn->query($sql2);
}
/** Get an array assoc with the names of all tables from a database and all the skel of their attributes
* @param $conn Object mysqli_connect
* @param $databsename Name of database
* @return $tables Assoc array with all the information about tables and attributes
*/
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
/** Get the clear type (like a string) of a specification of a database field, turning the raw way that the database provides it
* @param $type_raw_mysql Raw type of field provides by mysql
* @return $type String with the type of the variable like for example date, enum, varchar..
*/
function get_mysql_field_type($type_raw_mysql){
  $type = $type_raw_mysql;
  if(strpos($type_raw_mysql, '(') !== false){
    $type = explode("(", $type_raw_mysql)[0];
  }
  return $type;
}
/** Get the maximum length of mysql variable, turning the raw way that the database provides it
* @param $type_raw_mysql Raw type of field provides by mysql
* @return $length Maximum length of the mysql variable
*/
function get_mysql_long_from_field($type_raw_mysql){
  $length = 0;
  if( preg_match( '!\(([0-9]+)\)!', $type_raw_mysql, $match ) ){
    $length = $match[1];
  }
  return $length;
}
/** Get the values from a enum of mysql, turning the raw way that the database provides it
* @param $type_raw_mysql Raw type of field provides by mysql
* @return $options Possible values of the enum
*/
function get_mysql_options_from_enum_field($type_raw_mysql){
  $options = array();
  if( preg_match( '!(?:\()([^\)]+(?:)\))!', $type_raw_mysql, $match ) ){
    $aux = explode("(",$type_raw_mysql);
    $options_raw = explode(")",$aux[1])[0];
    $options_with_quotes = explode(",", $options_raw);
    foreach ($options_with_quotes as $option_quote) $options[] = trim($option_quote ,"'");
  }
  return $options;
}
/** Get an array with the keys of a table especification from mysql
* @param $fields_skel Skel of table provides by mysql
* @return $key Array enum with the individual keys of the table
*/
function get_mysql_key_from_field($fields_skel){
  $key = array();
  foreach ($fields_skel as $filed_name => $fieldSkel) {
    if($fieldSkel['Key']) $key[] = $filed_name."=<?= \$datos['".$filed_name."'] ?>";
  }
  return $key;
}

/********************************************//**
 *  AUX file functions
 ***********************************************/

/** Create directory in disc if doesn't exist
* @param $path Path of the directory to be created
*
*/
function create_path_if_doesnt_exist($path){
   if(!is_dir("./".$path)) mkdir($path, 0777);
 }
/** Create file in a directory in disc with a content
* @param $file Full path of the file to be created
* @param $content String with the content that the file will contain
*/
function create_file($file,$content){
   $file_open = fopen($file, "w");
   fwrite($file_open, $content);
   fclose($file_open);
   if(posix_getpwuid(fileowner($file)) == 'www-data') chmod($file,0777);
 }
/** Copy file from a directory to other
* @param $file_source Full path of the source file
* @param $file_destination Full path of the destination file
*/
function copy_file($file_source,$file_destination){
  copy($file_source, $file_destination);
   if(posix_getpwuid(fileowner($file_destination)) == 'www-data') chmod($file_destination,0777);
}


/********************************************//**
 *  AUX folder functions
 ***********************************************/

/** Copy all the content of one directory to other
* @param $source_path Path of the source directory
* @param $destination_path Path of the destination directory
*/
function copy_all_directory_content($source_path,$destination_path){
   $cdir = scandir($source_path);
   foreach ($cdir as $file) {
     if (!in_array($file,array(".",".."))) copy_file($source_path.$file,$destination_path.$file);
   }
 }


/********************************************//**
*  AUX array functions
***********************************************/

/** Transform an assoc array in a array to be readed by php (used to autogenerate php files)
* @param $array_name Name of the array to be generated
* @param $array Array assoc with the values to transform
*/
function array_assoc_to_string_php_format($array_name,$array){
 $toret = "\$".$array_name."= array(\n";
 foreach ($array as $key => $value) {
   $toret .= "\t'".$key."' => '".$value."',\n";
 }
 $toret .= ");\n";
 return $toret;
}


/********************************************//**
*  AUX installer functions
***********************************************/

/** Include the language file and return the array of language to the setup views
* IMPORTANT: this function can cut the execution of the script if doesn't exist the language file
* @param $lang Abreviature of the language to get the file
*/
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
/** Render a view to the client showing a file filled with parameters
* @param $view_name Name of the view to show
* @param $parameters Parameters to show in the view
*/
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
?>
