<?php

class pfc_SHOWCURRENT{

		private $valores;

	function __construct($valores){
		$this->valores = $valores;
		$this->render();
		}

		function render(){

			include '../Locates/Strings_SPANISH.php';
			include '../View/Header.php';


	?>
		<h1><?php echo $strings['Detalle'] . ' pfc' ?></h1>
		<form name='Form' action='pfc_Controller.php' method='post' onsubmit='comprobar()'>
			CodigoPFC :<input type='text' name='CodigoPFC' size = '10' value = '<?= $this->valores['CodigoPFC'] ?>' onblur='esVacio(this)  && comprobarText(this,10)'  required  readonly ><br>
			TituloPFC :<input type='text' name='TituloPFC' size = '100' value = '<?= $this->valores['TituloPFC'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			AlumnoPFC :<input type='text' name='AlumnoPFC' size = '40' value = '<?= $this->valores['AlumnoPFC'] ?>' onblur='esVacio(this)  && comprobarText(this,40)'  required  readonly ><br>
			FechaLecturaPFC :<input type='date' name='FechaLecturaPFC' size = '40' value = '<?= $this->valores['FechaLecturaPFC'] ?>' onblur='esVacio(this)'  required  readonly ><br>
			CalificacionPFC :<select name='CalificacionPFC' required  readonly>
				<option value='Aprobado' <?php if($this->valores['CalificacionPFC'] == 'Aprobado') echo 'selected'; ?>>Aprobado</option>
				<option value='Notable' <?php if($this->valores['CalificacionPFC'] == 'Notable') echo 'selected'; ?>>Notable</option>
				<option value='Sobresaliente' <?php if($this->valores['CalificacionPFC'] == 'Sobresaliente') echo 'selected'; ?>>Sobresaliente</option>
				<option value='Matricula' <?php if($this->valores['CalificacionPFC'] == 'Matricula') echo 'selected'; ?>>Matricula</option>
			</select><br>

		</form>
		<a href='../Controller/pfc_Controller.php'><?php echo $strings['Volver']; ?> </a>

	<?php
			include '../View/Footer.php';
		} // fin del metodo render
	} // fin de la clase
	?>
