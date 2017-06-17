<?php

class libro_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'libro' ?></h1>
    <form name = 'Form' action='../Controller/libro_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
			CodigoL :<input type='number' name='CodigoL' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			AutoresL :<input type='text' name='AutoresL' size = '200' value = '' onblur='esVacio(this)  && comprobarText(this,200)' ><br>
			TituloL :<input type='text' name='TituloL' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			ISBN :<input type='text' name='ISBN' size = '13' value = '' onblur='esVacio(this)  && comprobarText(this,13)' ><br>
			PagIniL :<input type='text' name='PagIniL' size = '4' value = '' onblur='esVacio(this)  && comprobarText(this,4)' ><br>
			PagFinL :<input type='text' name='PagFinL' size = '4' value = '' onblur='esVacio(this)  && comprobarText(this,4)' ><br>
			VolumenL :<input type='text' name='VolumenL' size = '4' value = '' onblur='esVacio(this)  && comprobarText(this,4)' ><br>
			EditorialL :<input type='text' name='EditorialL' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			FechaPublicacionL :<input type='date' name='FechaPublicacionL' size = '' value = '' onblur='esVacio(this)' ><br>
			EditorL :<input type='text' name='EditorL' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			PaisEdicionL :<input type='text' name='PaisEdicionL' size = '20' value = '' onblur='esVacio(this)  && comprobarText(this,20)' ><br>

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/libro_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
