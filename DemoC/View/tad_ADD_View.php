<?php

class tad_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'tad' ?></h1>
    <form name = 'Form' action='../Controller/tad_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
			CodigoTAD :<input type='text' name='CodigoTAD' size = '10' value = '' onblur='esVacio(this)  && comprobarText(this,10)' ><br>
			TituloTAD :<input type='text' name='TituloTAD' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			AlumnoTAD :<input type='text' name='AlumnoTAD' size = '40' value = '' onblur='esVacio(this)  && comprobarText(this,40)' ><br>
			FechaLecturaTAD :<input type='date' name='FechaLecturaTAD' size = '' value = '' onblur='esVacio(this)' ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '' onblur='esVacio(this)  && comprobarText(this,15)' ><br>

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/tad_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
