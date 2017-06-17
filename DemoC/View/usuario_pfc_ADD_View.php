<?php

class usuario_pfc_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'usuario_pfc' ?></h1>
    <form name = 'Form' action='../Controller/usuario_pfc_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
			CodigoPFC :<input type='text' name='CodigoPFC' size = '10' value = '' onblur='esVacio(this)  && comprobarText(this,10)' ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '' onblur='esVacio(this)  && comprobarText(this,15)' ><br>

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/usuario_pfc_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
