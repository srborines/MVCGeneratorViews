<?php

class usuario_congreso_SHOWCURRENT{

		private $valores;

	function __construct($valores){
		$this->valores = $valores;
		$this->render();
		}

		function render(){

			include '../Locates/Strings_SPANISH.php';
			include '../View/Header.php';


	?>
		<h1><?php echo $strings['Detalle'] . ' usuario_congreso' ?></h1>
		<form name='Form' action='usuario_congreso_Controller.php' method='post' onsubmit='comprobar()'>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)'  required  readonly ><br>
			CodigoC :<input type='number' name='CodigoC' min ='' max='' value = '<?= $this->valores['CodigoC'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			TipoParticipacionC :<select name='TipoParticipacionC' required  readonly>
				<option value='MCO' <?php if($this->valores['TipoParticipacionC'] == 'MCO') echo 'selected'; ?>>MCO</option>
				<option value='MCC' <?php if($this->valores['TipoParticipacionC'] == 'MCC') echo 'selected'; ?>>MCC</option>
				<option value='R' <?php if($this->valores['TipoParticipacionC'] == 'R') echo 'selected'; ?>>R</option>
				<option value='C' <?php if($this->valores['TipoParticipacionC'] == 'C') echo 'selected'; ?>>C</option>
				<option value='PCO' <?php if($this->valores['TipoParticipacionC'] == 'PCO') echo 'selected'; ?>>PCO</option>
				<option value='PCC' <?php if($this->valores['TipoParticipacionC'] == 'PCC') echo 'selected'; ?>>PCC</option>
			</select><br>

		</form>
		<a href='../Controller/usuario_congreso_Controller.php'><?php echo $strings['Volver']; ?> </a>

	<?php
			include '../View/Footer.php';
		} // fin del metodo render
	} // fin de la clase
	?>
