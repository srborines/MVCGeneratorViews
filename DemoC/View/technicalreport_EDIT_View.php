<?php

class technicalreport_EDIT{

  private $valores;

  function __construct($valores){
  			$this->valores = $valores;
  			$this->render();
  		}

  		function render(){

  			include '../Locates/Strings_SPANISH.php';
  			include '../View/Header.php';


  	?>

    <h1><?php echo $strings['Insertar'] . ' technicalreport' ?></h1>
    <a href="./technicalreport_Controller.php?action=SHOWALL">Back</a>
    <form action="./technicalreport_Controller.php?action=EDIT" method="POST">
			CodigoTR :<input type='number' name='CodigoTR' min ='' max='' value = '<?= $this->valores['CodigoTR'] ?>' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			AutoresTR :<input type='text' name='AutoresTR' size = '200' value = '<?= $this->valores['AutoresTR'] ?>' onblur='esVacio(this)  && comprobarText(this,200)' ><br>
			TituloTR :<input type='text' name='TituloTR' size = '100' value = '<?= $this->valores['TituloTR'] ?>' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			DepartamentoTR :<input type='text' name='DepartamentoTR' size = '100' value = '<?= $this->valores['DepartamentoTR'] ?>' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			UniversidadTR :<input type='text' name='UniversidadTR' size = '40' value = '<?= $this->valores['UniversidadTR'] ?>' onblur='esVacio(this)  && comprobarText(this,40)' ><br>
			FechaTR :<input type='date' name='FechaTR' size = '40' value = '<?= $this->valores['FechaTR'] ?>' onblur='esVacio(this)' ><br>

      <input type='submit' name='action' value='EDIT'>
    </form>
    <a href='../Controller/technicalreport_Controller.php'><?php echo $strings['Volver']; ?> </a>

<?php
  include '../View/Footer.php';
  } // fin del metodo render
} // fin de la clase
?>
