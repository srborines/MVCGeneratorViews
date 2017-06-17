<?php

class usuario_articulo_EDIT{

  private $valores;

  function __construct($valores){
  			$this->valores = $valores;
  			$this->render();
  		}

  		function render(){

  			include '../Locates/Strings_SPANISH.php';
  			include '../View/Header.php';


  	?>

    <h1><?php echo $strings['Insertar'] . ' usuario_articulo' ?></h1>
    <a href="./usuario_articulo_Controller.php?action=SHOWALL">Back</a>
    <form action="./usuario_articulo_Controller.php?action=EDIT" method="POST">
			CodigoA :<input type='number' name='CodigoA' min ='' max='' value = '<?= $this->valores['CodigoA'] ?>' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)' ><br>

      <input type='submit' name='action' value='EDIT'>
    </form>
    <a href='../Controller/usuario_articulo_Controller.php'><?php echo $strings['Volver']; ?> </a>

<?php
  include '../View/Footer.php';
  } // fin del metodo render
} // fin de la clase
?>
