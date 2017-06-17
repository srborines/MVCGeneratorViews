

	<?php

	class articulo_DELETE{


		function __construct(){
			$this->render();
		}

		function render(){
	?>

	<?php
			include '../Locates/Strings_SPANISH.php';

			include '../View/Header.php';
	?>
			<h1><?php echo $strings['Buscar'] . ' articulo' ?></h1>
			<form name = 'Form' action='../Controller/articulo_Controller.php' method='post' onsubmit = 'comprobar()'>
			CodigoA :<input type='number' name='CodigoA' min ='' max='' value = '<?= $this->valores['CodigoA'] ?>' onblur='esVacio(this)  && comprobarText(this,11)'  required  readonly ><br>
			AutoresA :<input type='text' name='AutoresA' size = '200' value = '<?= $this->valores['AutoresA'] ?>' onblur='esVacio(this)  && comprobarText(this,200)'  required  readonly ><br>
			TituloA :<input type='text' name='TituloA' size = '100' value = '<?= $this->valores['TituloA'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			TituloR :<input type='text' name='TituloR' size = '100' value = '<?= $this->valores['TituloR'] ?>' onblur='esVacio(this)  && comprobarText(this,100)'  required  readonly ><br>
			ISSN :<input type='text' name='ISSN' size = '13' value = '<?= $this->valores['ISSN'] ?>' onblur='esVacio(this)  && comprobarText(this,13)'  required  readonly ><br>
			VolumenR :<input type='text' name='VolumenR' size = '4' value = '<?= $this->valores['VolumenR'] ?>' onblur='esVacio(this)  && comprobarText(this,4)'  required  readonly ><br>
			PagIniA :<input type='number' name='PagIniA' min ='' max='' value = '<?= $this->valores['PagIniA'] ?>' onblur='esVacio(this)  && comprobarText(this,4)'  required  readonly ><br>
			PagFinA :<input type='number' name='PagFinA' min ='' max='' value = '<?= $this->valores['PagFinA'] ?>' onblur='esVacio(this)  && comprobarText(this,4)'  required  readonly ><br>
			FechaPublicacionR :<input type='date' name='FechaPublicacionR' size = '4' value = '<?= $this->valores['FechaPublicacionR'] ?>' onblur='esVacio(this)'  required  readonly ><br>
			EstadoA :<select name='EstadoA'>
				<option value='Enviado' <?php if($this->valores['EstadoA'] == 'Enviado') echo 'selected'; ?>>Enviado</option>
				<option value='Revision' <?php if($this->valores['EstadoA'] == 'Revision') echo 'selected'; ?>>Revision</option>
				<option value='Publicado' <?php if($this->valores['EstadoA'] == 'Publicado') echo 'selected'; ?>>Publicado</option>
			</select><br>

				<input type='submit' name='action' value='DELETE'><br>
			</form>
			<a href='../Controller/articulo_Controller.php'><?= $strings['Volver'] ?></a>
<?php
		include '../View/Footer.php';
	}
}
?>
