

	<?php

	class congreso_DELETE{


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
			CodigoC :<input type='number' name='CodigoC' min ='' max='' value = '<?= $this->valores['CodigoC'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			NombreC :<input type='text' name='NombreC' size = '100' value = '<?= $this->valores['NombreC'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			AcronimoC :<input type='text' name='AcronimoC' size = '20' value = '<?= $this->valores['AcronimoC'] ?>' onblur='esVacio(this)  && comprobarText(this,20)'  required  readonly ><br>
			LugarC :<input type='text' name='LugarC' size = '20' value = '<?= $this->valores['LugarC'] ?>' onblur='esVacio(this)  && comprobarText(this,20)'  required  readonly ><br>

				<input type='submit' name='action' value='DELETE'><br>
			</form>
			<a href='../Controller/congreso_Controller.php'><?= $strings['Volver'] ?></a>
<?php
		include '../View/Footer.php';
	}
}
?>
