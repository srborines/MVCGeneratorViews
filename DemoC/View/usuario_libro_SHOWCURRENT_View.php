<?php

class usuario_libro_SHOWCURRENT{

		private $valores;

	function __construct($valores){
		$this->valores = $valores;
		$this->render();
		}

		function render(){

			include '../Locates/Strings_SPANISH.php';
			include '../View/Header.php';


	?>
		<h1><?php echo $strings['Detalle'] . ' usuario_libro' ?></h1>
		<form name='Form' action='usuario_libro_Controller.php' method='post' onsubmit='comprobar()'>
			CodigoL :<input type='number' name='CodigoL' min ='' max='' value = '<?= $this->valores['CodigoL'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)'  required  readonly ><br>

		</form>
		<a href='../Controller/usuario_libro_Controller.php'><?php echo $strings['Volver']; ?> </a>

	<?php
			include '../View/Footer.php';
		} // fin del metodo render
	} // fin de la clase
	?>
