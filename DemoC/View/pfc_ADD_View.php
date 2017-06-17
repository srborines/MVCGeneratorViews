<?php

class pfc_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'pfc' ?></h1>
    <form name = 'Form' action='../Controller/pfc_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
			CodigoPFC :<input type='text' name='CodigoPFC' size = '10' value = '' onblur='esVacio(this)  && comprobarText(this,10)' ><br>
			TituloPFC :<input type='text' name='TituloPFC' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			AlumnoPFC :<input type='text' name='AlumnoPFC' size = '40' value = '' onblur='esVacio(this)  && comprobarText(this,40)' ><br>
			FechaLecturaPFC :<input type='date' name='FechaLecturaPFC' size = '' value = '' onblur='esVacio(this)' ><br>
			CalificacionPFC :<select name='CalificacionPFC'>
				<option value='Aprobado'>Aprobado</option>
				<option value='Notable'>Notable</option>
				<option value='Sobresaliente'>Sobresaliente</option>
				<option value='Matricula'>Matricula</option>
			</select><br>

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/pfc_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
