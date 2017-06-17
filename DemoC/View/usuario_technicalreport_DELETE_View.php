

	<?php

	class usuario_technicalreport_DELETE{


		function __construct(){
			$this->render();
		}

		function render(){
	?>

	<?php
			include '../Locates/Strings_SPANISH.php';

			include '../View/Header.php';
	?>
			<h1><?php echo $strings['Buscar'] . ' usuario_technicalreport' ?></h1>
			<form name = 'Form' action='../Controller/usuario_technicalreport_Controller.php' method='post' onsubmit = 'comprobar()'>
			CodigoTR :<input type='number' name='CodigoTR' min ='' max='' value = '<?= $this->valores['CodigoTR'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)'  required  readonly ><br>

				<input type='submit' name='action' value='DELETE'><br>
			</form>
			<a href='../Controller/usuario_technicalreport_Controller.php'><?= $strings['Volver'] ?></a>
<?php
		include '../View/Footer.php';
	}
}
?>
