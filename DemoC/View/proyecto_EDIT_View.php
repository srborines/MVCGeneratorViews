<?php

class proyecto_EDIT{

  private $valores;

  function __construct($valores){
  			$this->valores = $valores;
  			$this->render();
  		}

  		function render(){

  			include '../Locates/Strings_SPANISH.php';
  			include '../View/Header.php';


  	?>

    <h1><?php echo $strings['Insertar'] . ' proyecto' ?></h1>
    <a href="./proyecto_Controller.php?action=SHOWALL">Back</a>
    <form action="./proyecto_Controller.php?action=EDIT" method="POST">
			CodigoProy :<input type='number' name='CodigoProy' min ='' max='' value = '<?= $this->valores['CodigoProy'] ?>' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			TituloProy :<input type='text' name='TituloProy' size = '100' value = '<?= $this->valores['TituloProy'] ?>' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			EntidadFinanciadora :<input type='text' name='EntidadFinanciadora' size = '40' value = '<?= $this->valores['EntidadFinanciadora'] ?>' onblur='esVacio(this)  && comprobarText(this,40)' ><br>
			AcronimoProy :<input type='text' name='AcronimoProy' size = '20' value = '<?= $this->valores['AcronimoProy'] ?>' onblur='esVacio(this)  && comprobarText(this,20)' ><br>
Field unrecognized: AnhoInicioProyField unrecognized: AnhoFinProy			Importe :<input type='number' name='Importe' min ='' max='' value = '<?= $this->valores['Importe'] ?>' onblur='esVacio(this)  && comprobarText(this,11)' ><br>

      <input type='submit' name='action' value='EDIT'>
    </form>
    <a href='../Controller/proyecto_Controller.php'><?php echo $strings['Volver']; ?> </a>

<?php
  include '../View/Footer.php';
  } // fin del metodo render
} // fin de la clase
?>
