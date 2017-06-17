

	<?php

	class usuario_pfc_DELETE{


		function __construct(){
			$this->render();
		}

		function render(){
	?>

	<?php
			include '../Locates/Strings_SPANISH.php';

			include '../View/Header.php';
	?>
			<h1><?php echo $strings['Buscar'] . ' usuario_pfc' ?></h1>
			<form name = 'Form' action='../Controller/usuario_pfc_Controller.php' method='post' onsubmit = 'comprobar()'>
			CodigoPFC :<input type='text' name='CodigoPFC' size = '10' value = '<?= $this->valores['CodigoPFC'] ?>' onblur='esVacio(this)  && comprobarText(this,10)'  required  readonly ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)'  required  readonly ><br>

				<input type='submit' name='action' value='DELETE'><br>
			</form>
			<a href='../Controller/usuario_pfc_Controller.php'><?= $strings['Volver'] ?></a>
<?php
		include '../View/Footer.php';
	}
}
?>
