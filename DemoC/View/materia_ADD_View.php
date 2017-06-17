<?php

class materia_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'materia' ?></h1>
    <form name = 'Form' action='../Controller/materia_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
			CodigoM :<input type='number' name='CodigoM' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			TipoM :<select name='TipoM'>
				<option value='Grado'>Grado</option>
				<option value='Tercer Ciclo'>Tercer Ciclo</option>
				<option value='Curso'>Curso</option>
				<option value='Master'>Master</option>
				<option value='Postgrado'>Postgrado</option>
			</select><br>
			TipoParticipacionM :<select name='TipoParticipacionM'>
				<option value='Docente'>Docente</option>
				<option value='Director'>Director</option>
			</select><br>
			DenominacionM :<input type='text' name='DenominacionM' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			TitulacionM :<input type='text' name='TitulacionM' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			AnhoAcademicoM :<input type='text' name='AnhoAcademicoM' size = '11' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			CuatrimestreM :<select name='CuatrimestreM'>
				<option value='Primero'>Primero</option>
				<option value='Segundo'>Segundo</option>
				<option value='Anual'>Anual</option>
			</select><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '' onblur='esVacio(this)  && comprobarText(this,15)' ><br>

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/materia_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
