

	<?php

	class technicalreport_DELETE{


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
			CodigoTR :<input type='number' name='CodigoTR' min ='' max='' value = '<?= $this->valores['CodigoTR'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			AutoresTR :<input type='text' name='AutoresTR' size = '200' value = '<?= $this->valores['AutoresTR'] ?>' onblur='esVacio(this)  && comprobarText(this,200)'  required  readonly ><br>
			TituloTR :<input type='text' name='TituloTR' size = '100' value = '<?= $this->valores['TituloTR'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			DepartamentoTR :<input type='text' name='DepartamentoTR' size = '100' value = '<?= $this->valores['DepartamentoTR'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			UniversidadTR :<input type='text' name='UniversidadTR' size = '40' value = '<?= $this->valores['UniversidadTR'] ?>' onblur='esVacio(this)  && comprobarText(this,40)'  required  readonly ><br>
			FechaTR :<input type='date' name='FechaTR' size = '40' value = '<?= $this->valores['FechaTR'] ?>' onblur='esVacio(this)'  required  readonly ><br>

				<input type='submit' name='action' value='DELETE'><br>
			</form>
			<a href='../Controller/technicalreport_Controller.php'><?= $strings['Volver'] ?></a>
<?php
		include '../View/Footer.php';
	}
}
?>
