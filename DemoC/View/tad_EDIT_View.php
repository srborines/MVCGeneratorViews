<?php

class tad_EDIT{

  private $valores;

  function __construct($valores){
  			$this->valores = $valores;
  			$this->render();
  		}

  		function render(){

  			include '../Locates/Strings_SPANISH.php';
  			include '../View/Header.php';


  	?>

    <h1><?php echo $strings['Insertar'] . ' tad' ?></h1>
    <a href="./tad_Controller.php?action=SHOWALL">Back</a>
    <form action="./tad_Controller.php?action=EDIT" method="POST">
			CodigoTAD :<input type='text' name='CodigoTAD' size = '10' value = '<?= $this->valores['CodigoTAD'] ?>' onblur='esVacio(this)  && comprobarText(this,10)' ><br>
			TituloTAD :<input type='text' name='TituloTAD' size = '100' value = '<?= $this->valores['TituloTAD'] ?>' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			AlumnoTAD :<input type='text' name='AlumnoTAD' size = '40' value = '<?= $this->valores['AlumnoTAD'] ?>' onblur='esVacio(this)  && comprobarText(this,40)' ><br>
			FechaLecturaTAD :<input type='date' name='FechaLecturaTAD' size = '40' value = '<?= $this->valores['FechaLecturaTAD'] ?>' onblur='esVacio(this)' ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)' ><br>

      <input type='submit' name='action' value='EDIT'>
    </form>
    <a href='../Controller/tad_Controller.php'><?php echo $strings['Volver']; ?> </a>

<?php
  include '../View/Footer.php';
  } // fin del metodo render
} // fin de la clase
?>
