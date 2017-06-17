<?php

class usuario_ponencia_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'usuario_ponencia' ?></h1>
    <form name = 'Form' action='../Controller/usuario_ponencia_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
			CodigoP :<input type='number' name='CodigoP' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '' onblur='esVacio(this)  && comprobarText(this,15)' ><br>

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/usuario_ponencia_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
