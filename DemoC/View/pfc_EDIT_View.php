<?php

class pfc_EDIT{

  private $valores;

  function __construct($valores){
  			$this->valores = $valores;
  			$this->render();
  		}

  		function render(){

  			include '../Locates/Strings_SPANISH.php';
  			include '../View/Header.php';


  	?>

    <h1><?php echo $strings['Insertar'] . ' pfc' ?></h1>
    <a href="./pfc_Controller.php?action=SHOWALL">Back</a>
    <form action="./pfc_Controller.php?action=EDIT" method="POST">
			CodigoPFC :<input type='text' name='CodigoPFC' size = '10' value = '<?= $this->valores['CodigoPFC'] ?>' onblur='esVacio(this)  && comprobarText(this,10)' ><br>
			TituloPFC :<input type='text' name='TituloPFC' size = '100' value = '<?= $this->valores['TituloPFC'] ?>' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			AlumnoPFC :<input type='text' name='AlumnoPFC' size = '40' value = '<?= $this->valores['AlumnoPFC'] ?>' onblur='esVacio(this)  && comprobarText(this,40)' ><br>
			FechaLecturaPFC :<input type='date' name='FechaLecturaPFC' size = '40' value = '<?= $this->valores['FechaLecturaPFC'] ?>' onblur='esVacio(this)' ><br>
			CalificacionPFC :<select name='CalificacionPFC'>
				<option value='Aprobado' <?php if($this->valores['CalificacionPFC'] == 'Aprobado') echo 'selected'; ?>>Aprobado</option>
				<option value='Notable' <?php if($this->valores['CalificacionPFC'] == 'Notable') echo 'selected'; ?>>Notable</option>
				<option value='Sobresaliente' <?php if($this->valores['CalificacionPFC'] == 'Sobresaliente') echo 'selected'; ?>>Sobresaliente</option>
				<option value='Matricula' <?php if($this->valores['CalificacionPFC'] == 'Matricula') echo 'selected'; ?>>Matricula</option>
			</select><br>

      <input type='submit' name='action' value='EDIT'>
    </form>
    <a href='../Controller/pfc_Controller.php'><?php echo $strings['Volver']; ?> </a>

<?php
  include '../View/Footer.php';
  } // fin del metodo render
} // fin de la clase
?>
