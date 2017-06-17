<?php

class usuario_congreso_SEARCH{

		function __construct(){
			$this->render();
		}

		function render(){
	?>

	<?php
			include '../Locates/Strings_SPANISH.php';

			include '../View/Header.php';
	?>
			<h1><?php echo $strings['Buscar'] . ' usuario_congreso' ?></h1>
			<form name = 'Form' action='../Controller/usuario_congreso_Controller.php' method='post' onsubmit = 'comprobar()'>
			LoginU :<input type='text' name='LoginU' size = '15' value = '' onblur='esVacio(this)  && comprobarText(this,15)' ><br>
			CodigoC :<input type='number' name='CodigoC' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			TipoParticipacionC :<select name='TipoParticipacionC'>
				<option value='MCO'>MCO</option>
				<option value='MCC'>MCC</option>
				<option value='R'>R</option>
				<option value='C'>C</option>
				<option value='PCO'>PCO</option>
				<option value='PCC'>PCC</option>
			</select><br>

				<input type='submit' name='action' value='SEARCH'><br>
			</form>
      <a href='../Controller/usuario_congreso_Controller.php'>Volver</a>
<?php
		include '../View/Footer.php';
	}

}
?>
