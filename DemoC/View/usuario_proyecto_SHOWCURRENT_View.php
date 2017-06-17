<?php

class usuario_proyecto_SHOWCURRENT{

		private $valores;

	function __construct($valores){
		$this->valores = $valores;
		$this->render();
		}

		function render(){

			include '../Locates/Strings_SPANISH.php';
			include '../View/Header.php';


	?>
		<h1><?php echo $strings['Detalle'] . ' usuario_proyecto' ?></h1>
		<form name='Form' action='usuario_proyecto_Controller.php' method='post' onsubmit='comprobar()'>
			CodigoProy :<input type='number' name='CodigoProy' min ='' max='' value = '<?= $this->valores['CodigoProy'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)'  required  readonly ><br>
			TipoParticipacionProy :<select name='TipoParticipacionProy' required  readonly>
				<option value='Investigador' <?php if($this->valores['TipoParticipacionProy'] == 'Investigador') echo 'selected'; ?>>Investigador</option>
				<option value='Investigador Principal' <?php if($this->valores['TipoParticipacionProy'] == 'Investigador Principal') echo 'selected'; ?>>Investigador Principal</option>
			</select><br>

		</form>
		<a href='../Controller/usuario_proyecto_Controller.php'><?php echo $strings['Volver']; ?> </a>

	<?php
			include '../View/Footer.php';
		} // fin del metodo render
	} // fin de la clase
	?>
