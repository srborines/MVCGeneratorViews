<?php

class estancia_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'estancia' ?></h1>
    <form name = 'Form' action='../Controller/estancia_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
			CodigoE :<input type='number' name='CodigoE' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			CentroE :<input type='text' name='CentroE' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			UniversidadE :<input type='text' name='UniversidadE' size = '40' value = '' onblur='esVacio(this)  && comprobarText(this,40)' ><br>
			PaisE :<input type='text' name='PaisE' size = '20' value = '' onblur='esVacio(this)  && comprobarText(this,20)' ><br>
			FechaInicioE :<input type='date' name='FechaInicioE' size = '' value = '' onblur='esVacio(this)' ><br>
			FechaFinE :<input type='date' name='FechaFinE' size = '' value = '' onblur='esVacio(this)' ><br>
			TipoE :<select name='TipoE'>
				<option value='Investigacion'>Investigacion</option>
				<option value='Doctorado'>Doctorado</option>
				<option value='Invitado'>Invitado</option>
			</select><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '' onblur='esVacio(this)  && comprobarText(this,15)' ><br>

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/estancia_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
