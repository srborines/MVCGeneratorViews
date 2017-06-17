<?php

class ponencia_EDIT{

  private $valores;

  function __construct($valores){
  			$this->valores = $valores;
  			$this->render();
  		}

  		function render(){

  			include '../Locates/Strings_SPANISH.php';
  			include '../View/Header.php';


  	?>

    <h1><?php echo $strings['Insertar'] . ' ponencia' ?></h1>
    <a href="./ponencia_Controller.php?action=SHOWALL">Back</a>
    <form action="./ponencia_Controller.php?action=EDIT" method="POST">
			CodigoP :<input type='number' name='CodigoP' min ='' max='' value = '<?= $this->valores['CodigoP'] ?>' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			AutoresP :<input type='text' name='AutoresP' size = '200' value = '<?= $this->valores['AutoresP'] ?>' onblur='esVacio(this)  && comprobarText(this,200)' ><br>
			TituloP :<input type='text' name='TituloP' size = '100' value = '<?= $this->valores['TituloP'] ?>' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			CongresoP :<input type='text' name='CongresoP' size = '40' value = '<?= $this->valores['CongresoP'] ?>' onblur='esVacio(this)  && comprobarText(this,40)' ><br>
			FechaIniCP :<input type='date' name='FechaIniCP' size = '40' value = '<?= $this->valores['FechaIniCP'] ?>' onblur='esVacio(this)' ><br>
			FechaFinCP :<input type='date' name='FechaFinCP' size = '40' value = '<?= $this->valores['FechaFinCP'] ?>' onblur='esVacio(this)' ><br>
			LugarCP :<input type='text' name='LugarCP' size = '20' value = '<?= $this->valores['LugarCP'] ?>' onblur='esVacio(this)  && comprobarText(this,20)' ><br>
			PaisCP :<input type='text' name='PaisCP' size = '20' value = '<?= $this->valores['PaisCP'] ?>' onblur='esVacio(this)  && comprobarText(this,20)' ><br>

      <input type='submit' name='action' value='EDIT'>
    </form>
    <a href='../Controller/ponencia_Controller.php'><?php echo $strings['Volver']; ?> </a>

<?php
  include '../View/Footer.php';
  } // fin del metodo render
} // fin de la clase
?>
