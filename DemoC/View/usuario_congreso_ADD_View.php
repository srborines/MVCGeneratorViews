<?php

class usuario_congreso_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'usuario_congreso' ?></h1>
    <form name = 'Form' action='../Controller/usuario_congreso_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
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

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/usuario_congreso_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
