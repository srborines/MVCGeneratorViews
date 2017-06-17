<?php

class libro_EDIT{

  private $valores;

  function __construct($valores){
  			$this->valores = $valores;
  			$this->render();
  		}

  		function render(){

  			include '../Locates/Strings_SPANISH.php';
  			include '../View/Header.php';


  	?>

    <h1><?php echo $strings['Insertar'] . ' libro' ?></h1>
    <a href="./libro_Controller.php?action=SHOWALL">Back</a>
    <form action="./libro_Controller.php?action=EDIT" method="POST">
			CodigoL :<input type='number' name='CodigoL' min ='' max='' value = '<?= $this->valores['CodigoL'] ?>' onblur='esVacio(this)  && comprobarText(this,11)' ><br>
			AutoresL :<input type='text' name='AutoresL' size = '200' value = '<?= $this->valores['AutoresL'] ?>' onblur='esVacio(this)  && comprobarText(this,200)' ><br>
			TituloL :<input type='text' name='TituloL' size = '100' value = '<?= $this->valores['TituloL'] ?>' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			ISBN :<input type='text' name='ISBN' size = '13' value = '<?= $this->valores['ISBN'] ?>' onblur='esVacio(this)  && comprobarText(this,13)' ><br>
			PagIniL :<input type='text' name='PagIniL' size = '4' value = '<?= $this->valores['PagIniL'] ?>' onblur='esVacio(this)  && comprobarText(this,4)' ><br>
			PagFinL :<input type='text' name='PagFinL' size = '4' value = '<?= $this->valores['PagFinL'] ?>' onblur='esVacio(this)  && comprobarText(this,4)' ><br>
			VolumenL :<input type='text' name='VolumenL' size = '4' value = '<?= $this->valores['VolumenL'] ?>' onblur='esVacio(this)  && comprobarText(this,4)' ><br>
			EditorialL :<input type='text' name='EditorialL' size = '100' value = '<?= $this->valores['EditorialL'] ?>' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			FechaPublicacionL :<input type='date' name='FechaPublicacionL' size = '100' value = '<?= $this->valores['FechaPublicacionL'] ?>' onblur='esVacio(this)' ><br>
			EditorL :<input type='text' name='EditorL' size = '100' value = '<?= $this->valores['EditorL'] ?>' onblur='esVacio(this)  && comprobarText(this,100)' ><br>
			PaisEdicionL :<input type='text' name='PaisEdicionL' size = '20' value = '<?= $this->valores['PaisEdicionL'] ?>' onblur='esVacio(this)  && comprobarText(this,20)' ><br>

      <input type='submit' name='action' value='EDIT'>
    </form>
    <a href='../Controller/libro_Controller.php'><?php echo $strings['Volver']; ?> </a>

<?php
  include '../View/Footer.php';
  } // fin del metodo render
} // fin de la clase
?>
