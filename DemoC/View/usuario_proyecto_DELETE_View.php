

	<?php

	class usuario_proyecto_DELETE{


		function __construct(){
			$this->render();
		}

		function render(){
	?>

	<?php
			include '../Locates/Strings_SPANISH.php';

			include '../View/Header.php';
	?>
			<h1><?php echo $strings['Buscar'] . ' usuario_proyecto' ?></h1>
			<form name = 'Form' action='../Controller/usuario_proyecto_Controller.php' method='post' onsubmit = 'comprobar()'>
			CodigoProy :<input type='number' name='CodigoProy' min ='' max='' value = '<?= $this->valores['CodigoProy'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)'  required  readonly ><br>
			TipoParticipacionProy :<select name='TipoParticipacionProy'>
				<option value='Investigador' <?php if($this->valores['TipoParticipacionProy'] == 'Investigador') echo 'selected'; ?>>Investigador</option>
				<option value='Investigador Principal' <?php if($this->valores['TipoParticipacionProy'] == 'Investigador Principal') echo 'selected'; ?>>Investigador Principal</option>
			</select><br>

				<input type='submit' name='action' value='DELETE'><br>
			</form>
			<a href='../Controller/usuario_proyecto_Controller.php'><?= $strings['Volver'] ?></a>
<?php
		include '../View/Footer.php';
	}
}
?>
