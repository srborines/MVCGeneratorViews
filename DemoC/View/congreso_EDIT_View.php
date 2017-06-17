<?php

class congreso_EDIT{

  private $valores;

  function __construct($valores){
  			$this->valores = $valores;
  			$this->render();
  		}

  		function render(){

  			include '../Locates/Strings_SPANISH.php';
  			include '../View/Header.php';


  	?>

    <h1><?php echo $strings['Insertar'] . ' congreso' ?></h1>
    <a href="./congreso_Controller.php?action=SHOWALL">Back</a>
    <form action="./congreso_Controller.php?action=EDIT" method="POST">
			CodigoC :<input type='number' name='CodigoC' min ='' max='' value = '<?= $this->valores['CodigoC'] ?>' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			NombreC :<input type='text' name='NombreC' size = '100' value = '<?= $this->valores['NombreC'] ?>' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			AcronimoC :<input type='text' name='AcronimoC' size = '20' value = '<?= $this->valores['AcronimoC'] ?>' onblur='esVacio(this)  && comprobarText(this,20)' ><br>
Field unrecognized: AnhoC			LugarC :<input type='text' name='LugarC' size = '20' value = '<?= $this->valores['LugarC'] ?>' onblur='esVacio(this)  && comprobarText(this,20)' ><br>

      <input type='submit' name='action' value='EDIT'>
    </form>
    <a href='../Controller/congreso_Controller.php'><?php echo $strings['Volver']; ?> </a>

<?php
  include '../View/Footer.php';
  } // fin del metodo render
} // fin de la clase
?>
