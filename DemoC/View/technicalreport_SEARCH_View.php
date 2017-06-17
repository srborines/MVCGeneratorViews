<?php

class technicalreport_SEARCH{

		function __construct(){
			$this->render();
		}

		function render(){
	?>

	<?php
			include '../Locates/Strings_SPANISH.php';

			include '../View/Header.php';
	?>
			<h1><?php echo $strings['Buscar'] . ' technicalreport' ?></h1>
			<form name = 'Form' action='../Controller/technicalreport_Controller.php' method='post' onsubmit = 'comprobar()'>
			CodigoTR :<input type='number' name='CodigoTR' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			AutoresTR :<input type='text' name='AutoresTR' size = '200' value = '' onblur='esVacio(this)  && comprobarText(this,200)' ><br>
			TituloTR :<input type='text' name='TituloTR' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			DepartamentoTR :<input type='text' name='DepartamentoTR' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			UniversidadTR :<input type='text' name='UniversidadTR' size = '40' value = '' onblur='esVacio(this)  && comprobarText(this,40)' ><br>
			FechaTR :<input type='date' name='FechaTR' size = '40' value = '' onblur='esVacio(this)' ><br>

				<input type='submit' name='action' value='SEARCH'><br>
			</form>
      <a href='../Controller/technicalreport_Controller.php'>Volver</a>
<?php
		include '../View/Footer.php';
	}

}
?>