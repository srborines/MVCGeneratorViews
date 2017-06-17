<?php

class usuario_technicalreport_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'usuario_technicalreport' ?></h1>
    <form name = 'Form' action='../Controller/usuario_technicalreport_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
			CodigoTR :<input type='number' name='CodigoTR' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '' onblur='esVacio(this)  && comprobarText(this,15)' ><br>

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/usuario_technicalreport_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
