<?php

class congreso_SEARCH{

		function __construct(){
			$this->render();
		}

		function render(){
	?>

	<?php
			include '../Locates/Strings_SPANISH.php';

			include '../View/Header.php';
	?>
			<h1><?php echo $strings['Buscar'] . ' congreso' ?></h1>
			<form name = 'Form' action='../Controller/congreso_Controller.php' method='post' onsubmit = 'comprobar()'>
			CodigoC :<input type='number' name='CodigoC' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			NombreC :<input type='text' name='NombreC' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			AcronimoC :<input type='text' name='AcronimoC' size = '20' value = '' onblur='esVacio(this)  && comprobarText(this,20)' ><br>
			LugarC :<input type='text' name='LugarC' size = '20' value = '' onblur='esVacio(this)  && comprobarText(this,20)' ><br>

				<input type='submit' name='action' value='SEARCH'><br>
			</form>
      <a href='../Controller/congreso_Controller.php'>Volver</a>
<?php
		include '../View/Footer.php';
	}

}
?>
