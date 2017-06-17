

	<?php

	class ponencia_DELETE{


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
			CodigoP :<input type='number' name='CodigoP' min ='' max='' value = '<?= $this->valores['CodigoP'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			AutoresP :<input type='text' name='AutoresP' size = '200' value = '<?= $this->valores['AutoresP'] ?>' onblur='esVacio(this)  && comprobarText(this,200)'  required  readonly ><br>
			TituloP :<input type='text' name='TituloP' size = '100' value = '<?= $this->valores['TituloP'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			CongresoP :<input type='text' name='CongresoP' size = '40' value = '<?= $this->valores['CongresoP'] ?>' onblur='esVacio(this)  && comprobarText(this,40)'  required  readonly ><br>
			FechaIniCP :<input type='date' name='FechaIniCP' size = '40' value = '<?= $this->valores['FechaIniCP'] ?>' onblur='esVacio(this)'  required  readonly ><br>
			FechaFinCP :<input type='date' name='FechaFinCP' size = '40' value = '<?= $this->valores['FechaFinCP'] ?>' onblur='esVacio(this)'  required  readonly ><br>
			LugarCP :<input type='text' name='LugarCP' size = '20' value = '<?= $this->valores['LugarCP'] ?>' onblur='esVacio(this)  && comprobarText(this,20)'  required  readonly ><br>
			PaisCP :<input type='text' name='PaisCP' size = '20' value = '<?= $this->valores['PaisCP'] ?>' onblur='esVacio(this)  && comprobarText(this,20)'  required  readonly ><br>

				<input type='submit' name='action' value='DELETE'><br>
			</form>
			<a href='../Controller/ponencia_Controller.php'><?= $strings['Volver'] ?></a>
<?php
		include '../View/Footer.php';
	}
}
?>
