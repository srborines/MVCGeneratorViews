<?php

class usuario_proyecto_EDIT{

  private $valores;

  function __construct($valores){
  			$this->valores = $valores;
  			$this->render();
  		}

  		function render(){

  			include '../Locates/Strings_SPANISH.php';
  			include '../View/Header.php';


  	?>

    <h1><?php echo $strings['Insertar'] . ' usuario_proyecto' ?></h1>
    <a href="./usuario_proyecto_Controller.php?action=SHOWALL">Back</a>
    <form action="./usuario_proyecto_Controller.php?action=EDIT" method="POST">
			CodigoProy :<input type='number' name='CodigoProy' min ='' max='' value = '<?= $this->valores['CodigoProy'] ?>' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			LoginU :<input type='text' name='LoginU' size = '15' value = '<?= $this->valores['LoginU'] ?>' onblur='esVacio(this)  && comprobarText(this,15)' ><br>
			TipoParticipacionProy :<select name='TipoParticipacionProy'>
				<option value='Investigador' <?php if($this->valores['TipoParticipacionProy'] == 'Investigador') echo 'selected'; ?>>Investigador</option>
				<option value='Investigador Principal' <?php if($this->valores['TipoParticipacionProy'] == 'Investigador Principal') echo 'selected'; ?>>Investigador Principal</option>
			</select><br>

      <input type='submit' name='action' value='EDIT'>
    </form>
    <a href='../Controller/usuario_proyecto_Controller.php'><?php echo $strings['Volver']; ?> </a>

<?php
  include '../View/Footer.php';
  } // fin del metodo render
} // fin de la clase
?>
