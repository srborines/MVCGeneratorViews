<?php

class usuario_proyecto_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'usuario_proyecto' ?></h1>
    <form name = 'Form' action='../Controller/usuario_proyecto_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
			CodigoProy :<input type='number' name='CodigoProy' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '' onblur='esVacio(this)  && comprobarText(this,15)' ><br>
			TipoParticipacionProy :<select name='TipoParticipacionProy'>
				<option value='Investigador'>Investigador</option>
				<option value='Investigador Principal'>Investigador Principal</option>
			</select><br>

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/usuario_proyecto_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
