<?php

class usuario_articulo_SHOWCURRENT{

		private $valores;

	function __construct($valores){
		$this->valores = $valores;
		$this->render();
		}

		function render(){

			include '../Locates/Strings_SPANISH.php';
			include '../View/Header.php';


	?>
		<h1><?php echo $strings['Detalle'] . ' usuario_articulo' ?></h1>
		<form name='Form' action='usuario_articulo_Controller.php' method='post' onsubmit='comprobar()'>
			CodigoA :<input type='number' name='CodigoA' min ='' max='' value = '<?= $this->valores['CodigoA'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)'  required  readonly ><br>

		</form>
		<a href='../Controller/usuario_articulo_Controller.php'><?php echo $strings['Volver']; ?> </a>

	<?php
			include '../View/Footer.php';
		} // fin del metodo render
	} // fin de la clase
	?>
