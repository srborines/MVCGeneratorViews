

	<?php

	class proyecto_DELETE{


		function __construct(){
			$this->render();
		}

		function render(){
	?>

	<?php
			include '../Locates/Strings_SPANISH.php';

			include '../View/Header.php';
	?>
			<h1><?php echo $strings['Buscar'] . ' proyecto' ?></h1>
			<form name = 'Form' action='../Controller/proyecto_Controller.php' method='post' onsubmit = 'comprobar()'>
			CodigoProy :<input type='number' name='CodigoProy' min ='' max='' value = '<?= $this->valores['CodigoProy'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			TituloProy :<input type='text' name='TituloProy' size = '100' value = '<?= $this->valores['TituloProy'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			EntidadFinanciadora :<input type='text' name='EntidadFinanciadora' size = '40' value = '<?= $this->valores['EntidadFinanciadora'] ?>' onblur='esVacio(this)  && comprobarText(this,40)'  required  readonly ><br>
			AcronimoProy :<input type='text' name='AcronimoProy' size = '20' value = '<?= $this->valores['AcronimoProy'] ?>' onblur='esVacio(this)  && comprobarText(this,20)'  required  readonly ><br>
			Importe :<input type='number' name='Importe' min ='' max='' value = '<?= $this->valores['Importe'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>

				<input type='submit' name='action' value='DELETE'><br>
			</form>
			<a href='../Controller/proyecto_Controller.php'><?= $strings['Volver'] ?></a>
<?php
		include '../View/Footer.php';
	}
}
?>
