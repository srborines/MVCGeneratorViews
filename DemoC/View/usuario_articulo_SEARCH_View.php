<?php

class usuario_articulo_SEARCH{

		function __construct(){
			$this->render();
		}

		function render(){
	?>

	<?php
			include '../Locates/Strings_SPANISH.php';

			include '../View/Header.php';
	?>
			<h1><?php echo $strings['Buscar'] . ' usuario_articulo' ?></h1>
			<form name = 'Form' action='../Controller/usuario_articulo_Controller.php' method='post' onsubmit = 'comprobar()'>
			CodigoA :<input type='number' name='CodigoA' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '' onblur='esVacio(this)  && comprobarText(this,15)' ><br>

				<input type='submit' name='action' value='SEARCH'><br>
			</form>
      <a href='../Controller/usuario_articulo_Controller.php'>Volver</a>
<?php
		include '../View/Footer.php';
	}

}
?>
