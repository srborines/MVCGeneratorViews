<?php

class technicalreport_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'technicalreport' ?></h1>
    <form name = 'Form' action='../Controller/technicalreport_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
			CodigoTR :<input type='number' name='CodigoTR' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			AutoresTR :<input type='text' name='AutoresTR' size = '200' value = '' onblur='esVacio(this)  && comprobarText(this,200)' ><br>
			TituloTR :<input type='text' name='TituloTR' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			DepartamentoTR :<input type='text' name='DepartamentoTR' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			UniversidadTR :<input type='text' name='UniversidadTR' size = '40' value = '' onblur='esVacio(this)  && comprobarText(this,40)' ><br>
			FechaTR :<input type='date' name='FechaTR' size = '' value = '' onblur='esVacio(this)' ><br>

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/technicalreport_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
