<?php

class articulo_SEARCH{

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
			CodigoA :<input type='number' name='CodigoA' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			AutoresA :<input type='text' name='AutoresA' size = '200' value = '' onblur='esVacio(this)  && comprobarText(this,200)' ><br>
			TituloA :<input type='text' name='TituloA' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			TituloR :<input type='text' name='TituloR' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			ISSN :<input type='text' name='ISSN' size = '13' value = '' onblur='esVacio(this)  && comprobarText(this,13)' ><br>
			VolumenR :<input type='text' name='VolumenR' size = '4' value = '' onblur='esVacio(this)  && comprobarText(this,4)' ><br>
			PagIniA :<input type='number' name='PagIniA' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,4)' ><br>
			PagFinA :<input type='number' name='PagFinA' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,4)' ><br>
			FechaPublicacionR :<input type='date' name='FechaPublicacionR' size = '4' value = '' onblur='esVacio(this)' ><br>
			EstadoA :<select name='EstadoA'>
				<option value='Enviado'>Enviado</option>
				<option value='Revision'>Revision</option>
				<option value='Publicado'>Publicado</option>
			</select><br>

				<input type='submit' name='action' value='SEARCH'><br>
			</form>
      <a href='../Controller/articulo_Controller.php'>Volver</a>
<?php
		include '../View/Footer.php';
	}

}
?>
