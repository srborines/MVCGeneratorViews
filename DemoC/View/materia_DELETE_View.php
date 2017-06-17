

	<?php

	class materia_DELETE{


		function __construct(){
			$this->render();
		}

		function render(){
	?>

	<?php
			include '../Locates/Strings_SPANISH.php';

			include '../View/Header.php';
	?>
			<h1><?php echo $strings['Buscar'] . ' materia' ?></h1>
			<form name = 'Form' action='../Controller/materia_Controller.php' method='post' onsubmit = 'comprobar()'>
			CodigoM :<input type='number' name='CodigoM' min ='' max='' value = '<?= $this->valores['CodigoM'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			TipoM :<select name='TipoM'>
				<option value='Grado' <?php if($this->valores['TipoM'] == 'Grado') echo 'selected'; ?>>Grado</option>
				<option value='Tercer Ciclo' <?php if($this->valores['TipoM'] == 'Tercer Ciclo') echo 'selected'; ?>>Tercer Ciclo</option>
				<option value='Curso' <?php if($this->valores['TipoM'] == 'Curso') echo 'selected'; ?>>Curso</option>
				<option value='Master' <?php if($this->valores['TipoM'] == 'Master') echo 'selected'; ?>>Master</option>
				<option value='Postgrado' <?php if($this->valores['TipoM'] == 'Postgrado') echo 'selected'; ?>>Postgrado</option>
			</select><br>
			TipoParticipacionM :<select name='TipoParticipacionM'>
				<option value='Docente' <?php if($this->valores['TipoParticipacionM'] == 'Docente') echo 'selected'; ?>>Docente</option>
				<option value='Director' <?php if($this->valores['TipoParticipacionM'] == 'Director') echo 'selected'; ?>>Director</option>
			</select><br>
			DenominacionM :<input type='text' name='DenominacionM' size = '100' value = '<?= $this->valores['DenominacionM'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			TitulacionM :<input type='text' name='TitulacionM' size = '100' value = '<?= $this->valores['TitulacionM'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			AnhoAcademicoM :<input type='text' name='AnhoAcademicoM' size = '11' value = '<?= $this->valores['AnhoAcademicoM'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			CuatrimestreM :<select name='CuatrimestreM'>
				<option value='Primero' <?php if($this->valores['CuatrimestreM'] == 'Primero') echo 'selected'; ?>>Primero</option>
				<option value='Segundo' <?php if($this->valores['CuatrimestreM'] == 'Segundo') echo 'selected'; ?>>Segundo</option>
				<option value='Anual' <?php if($this->valores['CuatrimestreM'] == 'Anual') echo 'selected'; ?>>Anual</option>
			</select><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)'  required  readonly ><br>

				<input type='submit' name='action' value='DELETE'><br>
			</form>
			<a href='../Controller/materia_Controller.php'><?= $strings['Volver'] ?></a>
<?php
		include '../View/Footer.php';
	}
}
?>
