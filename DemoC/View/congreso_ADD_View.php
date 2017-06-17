<?php

class congreso_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'congreso' ?></h1>
    <form name = 'Form' action='../Controller/congreso_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
			CodigoC :<input type='number' name='CodigoC' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			NombreC :<input type='text' name='NombreC' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			AcronimoC :<input type='text' name='AcronimoC' size = '20' value = '' onblur='esVacio(this)  && comprobarText(this,20)' ><br>
			LugarC :<input type='text' name='LugarC' size = '20' value = '' onblur='esVacio(this)  && comprobarText(this,20)' ><br>

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/congreso_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
