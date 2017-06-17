<?php

class proyecto_ADD{


  function __construct(){
    $this->render();
  }

  function render(){

    include '../View/Header.php';

  ?>
    <h1><?php echo $strings['Insertar'] . 'proyecto' ?></h1>
    <form name = 'Form' action='../Controller/proyecto_Controller.php' method='post' onsubmit='return comprobar_articulo()'>
			CodigoProy :<input type='number' name='CodigoProy' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			TituloProy :<input type='text' name='TituloProy' size = '100' value = '' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			EntidadFinanciadora :<input type='text' name='EntidadFinanciadora' size = '40' value = '' onblur='esVacio(this)  && comprobarText(this,40)' ><br>
			AcronimoProy :<input type='text' name='AcronimoProy' size = '20' value = '' onblur='esVacio(this)  && comprobarText(this,20)' ><br>
			Importe :<input type='number' name='Importe' min ='' max='' value = '' onblur='esVacio(this)  && comprobarText(this,11)' ><br>

      <input type='submit' name='action' value='ADD'>
    </form>
    <a href='../Controller/proyecto_Controller.php'>Volver </a>
<?php
  include '../View/Footer.php';
  }

}

?>
