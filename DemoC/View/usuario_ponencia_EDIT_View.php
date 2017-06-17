<?php

class usuario_ponencia_EDIT{

  private $valores;

  function __construct($valores){
  			$this->valores = $valores;
  			$this->render();
  		}

  		function render(){

  			include '../Locates/Strings_SPANISH.php';
  			include '../View/Header.php';


  	?>

    <h1><?php echo $strings['Insertar'] . ' usuario_ponencia' ?></h1>
    <a href="./usuario_ponencia_Controller.php?action=SHOWALL">Back</a>
    <form action="./usuario_ponencia_Controller.php?action=EDIT" method="POST">
			CodigoP :<input type='number' name='CodigoP' min ='' max='' value = '<?= $this->valores['CodigoP'] ?>' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)' ><br>

      <input type='submit' name='action' value='EDIT'>
    </form>
    <a href='../Controller/usuario_ponencia_Controller.php'><?php echo $strings['Volver']; ?> </a>

<?php
  include '../View/Footer.php';
  } // fin del metodo render
} // fin de la clase
?>
