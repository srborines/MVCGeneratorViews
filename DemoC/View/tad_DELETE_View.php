

	<?php

	class tad_DELETE{


		function __construct(){
			$this->render();
		}

		function render(){
	?>

	<?php
			include '../Locates/Strings_SPANISH.php';

			include '../View/Header.php';
	?>
			<h1><?php echo $strings['Buscar'] . ' tad' ?></h1>
			<form name = 'Form' action='../Controller/tad_Controller.php' method='post' onsubmit = 'comprobar()'>
			CodigoTAD :<input type='text' name='CodigoTAD' size = '10' value = '<?= $this->valores['CodigoTAD'] ?>' onblur='esVacio(this)  && comprobarText(this,10)'  required  readonly ><br>
			TituloTAD :<input type='text' name='TituloTAD' size = '100' value = '<?= $this->valores['TituloTAD'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			AlumnoTAD :<input type='text' name='AlumnoTAD' size = '40' value = '<?= $this->valores['AlumnoTAD'] ?>' onblur='esVacio(this)  && comprobarText(this,40)'  required  readonly ><br>
			FechaLecturaTAD :<input type='date' name='FechaLecturaTAD' size = '40' value = '<?= $this->valores['FechaLecturaTAD'] ?>' onblur='esVacio(this)'  required  readonly ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)'  required  readonly ><br>

				<input type='submit' name='action' value='DELETE'><br>
			</form>
			<a href='../Controller/tad_Controller.php'><?= $strings['Volver'] ?></a>
<?php
		include '../View/Footer.php';
	}
}
?>
