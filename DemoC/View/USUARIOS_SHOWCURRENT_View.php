<?php

class USUARIOS_SHOWCURRENT{

		private $valores;

	function __construct($valores){
		$this->valores = $valores;
		$this->render();
		}

		function render(){

			include '../Locates/Strings_SPANISH.php';
			include '../View/Header.php';


	?>
		<h1><?php echo $strings['Detalle'] . ' USUARIOS' ?></h1>
		<form name='Form' action='USUARIOS_Controller.php' method='post' onsubmit='comprobar()'>
			login :<input type='text' name='login' size = '15' value = '<?= $this->valores['login'] ?>' onblur='esVacio(this)  && comprobarText(this,15)'  required  readonly ><br>
			password :<input type='text' name='password' size = '32' value = '<?= $this->valores['password'] ?>' onblur='esVacio(this)  && comprobarText(this,32)'  required  readonly ><br>
			NombreU :<input type='text' name='NombreU' size = '15' value = '<?= $this->valores['NombreU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)'  required  readonly ><br>
			ApellidosU :<input type='text' name='ApellidosU' size = '30' value = '<?= $this->valores['ApellidosU'] ?>' onblur='esVacio(this)  && comprobarText(this,30)'  required  readonly ><br>
			TituloAcademicoU :<input type='text' name='TituloAcademicoU' size = '100' value = '<?= $this->valores['TituloAcademicoU'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			TipoContratoU :<input type='text' name='TipoContratoU' size = '40' value = '<?= $this->valores['TipoContratoU'] ?>' onblur='esVacio(this)  && comprobarText(this,40)'  required  readonly ><br>
			CentroU :<input type='text' name='CentroU' size = '100' value = '<?= $this->valores['CentroU'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			DepartamentoU :<input type='text' name='DepartamentoU' size = '100' value = '<?= $this->valores['DepartamentoU'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			UniversidadU :<input type='text' name='UniversidadU' size = '40' value = '<?= $this->valores['UniversidadU'] ?>' onblur='esVacio(this)  && comprobarText(this,40)'  required  readonly ><br>
			TipoU :<select name='TipoU' required  readonly>
				<option value='A' <?php if($this->valores['TipoU'] == 'A') echo 'selected'; ?>>A</option>
				<option value='P' <?php if($this->valores['TipoU'] == 'P') echo 'selected'; ?>>P</option>
			</select><br>

		</form>
		<a href='../Controller/USUARIOS_Controller.php'><?php echo $strings['Volver']; ?> </a>

	<?php
			include '../View/Footer.php';
		} // fin del metodo render
	} // fin de la clase
	?>
