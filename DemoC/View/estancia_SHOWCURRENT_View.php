<?php

class estancia_SHOWCURRENT{

		private $valores;

	function __construct($valores){
		$this->valores = $valores;
		$this->render();
		}

		function render(){

			include '../Locates/Strings_SPANISH.php';
			include '../View/Header.php';


	?>
		<h1><?php echo $strings['Detalle'] . ' estancia' ?></h1>
		<form name='Form' action='estancia_Controller.php' method='post' onsubmit='comprobar()'>
			CodigoE :<input type='number' name='CodigoE' min ='' max='' value = '<?= $this->valores['CodigoE'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			CentroE :<input type='text' name='CentroE' size = '100' value = '<?= $this->valores['CentroE'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			UniversidadE :<input type='text' name='UniversidadE' size = '40' value = '<?= $this->valores['UniversidadE'] ?>' onblur='esVacio(this)  && comprobarText(this,40)'  required  readonly ><br>
			PaisE :<input type='text' name='PaisE' size = '20' value = '<?= $this->valores['PaisE'] ?>' onblur='esVacio(this)  && comprobarText(this,20)'  required  readonly ><br>
			FechaInicioE :<input type='date' name='FechaInicioE' size = '20' value = '<?= $this->valores['FechaInicioE'] ?>' onblur='esVacio(this)'  required  readonly ><br>
			FechaFinE :<input type='date' name='FechaFinE' size = '20' value = '<?= $this->valores['FechaFinE'] ?>' onblur='esVacio(this)'  required  readonly ><br>
			TipoE :<select name='TipoE' required  readonly>
				<option value='Investigacion' <?php if($this->valores['TipoE'] == 'Investigacion') echo 'selected'; ?>>Investigacion</option>
				<option value='Doctorado' <?php if($this->valores['TipoE'] == 'Doctorado') echo 'selected'; ?>>Doctorado</option>
				<option value='Invitado' <?php if($this->valores['TipoE'] == 'Invitado') echo 'selected'; ?>>Invitado</option>
			</select><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)'  required  readonly ><br>

		</form>
		<a href='../Controller/estancia_Controller.php'><?php echo $strings['Volver']; ?> </a>

	<?php
			include '../View/Footer.php';
		} // fin del metodo render
	} // fin de la clase
	?>
