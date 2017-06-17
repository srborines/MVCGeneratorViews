<?php

class ponencia_SEARCH{

		function __construct(){
			$this->render();
		}

		function render(){
	?>

	<?php
			include '../Locates/Strings_SPANISH.php';

			include '../View/Header.php';
	?>
			<h1><?php echo $strings['Buscar'] . ' ponencia' ?></h1>
			<form name = 'Form' action='../Controller/ponencia_Controller.php' method='post' onsubmit = 'comprobar()'>
			CodigoP :<input type='number' name='CodigoP' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			AutoresP :<input type='text' name='AutoresP' size = '200' value = '' onblur='esVacio(this)  && comprobarText(this,200)' ><br>
			TituloP :<input type='text' name='TituloP' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			CongresoP :<input type='text' name='CongresoP' size = '40' value = '' onblur='esVacio(this)  && comprobarText(this,40)' ><br>
			FechaIniCP :<input type='date' name='FechaIniCP' size = '40' value = '' onblur='esVacio(this)' ><br>
			FechaFinCP :<input type='date' name='FechaFinCP' size = '40' value = '' onblur='esVacio(this)' ><br>
			LugarCP :<input type='text' name='LugarCP' size = '20' value = '' onblur='esVacio(this)  && comprobarText(this,20)' ><br>
			PaisCP :<input type='text' name='PaisCP' size = '20' value = '' onblur='esVacio(this)  && comprobarText(this,20)' ><br>

				<input type='submit' name='action' value='SEARCH'><br>
			</form>
      <a href='../Controller/ponencia_Controller.php'>Volver</a>
<?php
		include '../View/Footer.php';
	}

}
?>
