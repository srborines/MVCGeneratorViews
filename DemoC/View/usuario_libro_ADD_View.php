<?php

class usuario_libro_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'usuario_libro' ?></h1>
    <form name = 'Form' action='../Controller/usuario_libro_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
			CodigoL :<input type='number' name='CodigoL' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '' onblur='esVacio(this)  && comprobarText(this,15)' ><br>

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/usuario_libro_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
