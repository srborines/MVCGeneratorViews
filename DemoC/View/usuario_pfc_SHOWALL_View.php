<?php

class usuario_pfc_SHOWALL{

	private $datos;
	private $lista;
	private $volver;

	function __construct($lista, $array){
		$this->datos = $array;
		$this->lista = $lista;
		$this->render();
	}

	function render(){

		include 'Header.php';
?>
		<h1><?php echo $strings['Mostrar todos']. 'usuario_pfc'; ?></h1>
		<a href='./usuario_pfc_Controller.php?action=SEARCH'><img src='../View/Icons/search.png'></a></a>
		<a href='./usuario_pfc_Controller.php?action=ADD'><img src='../View/Icons/add.png'></a></br></br>
		<br><br>
		<table border = 1>
<?php

	echo "<tr>";
	foreach($this->lista as $titulo){
		//change translate
		echo	"<th>".$titulo."</th>";
	}
	echo "</tr>";

	foreach ($this->datos as $datos) {
		echo "<tr>";
		foreach($this->lista as $titulo){
			echo "<td>".$datos[$titulo]."</td>";
		}
		echo "<td>
					<a href='USUARIOS_Controller.php?LoginU=".$datos['LoginU']."&action=EDIT'><img src='../View/Icons/edit.png'></a>
					<a href='USUARIOS_Controller.php?LoginU=".$datos['LoginU']."&action=DELETE'><img src='../View/Icons/delete.png'></a>
					<a href='USUARIOS_Controller.php?LoginU=".$datos['LoginU']."&action=SHOWCURRENT'><img src='../View/Icons/detalle.png'></a>
				</td>";
		echo "</tr>";
	}
?>
		</table>

		<a href='../index.php'><img src='../View/Icons/salir.png'></a>


<?php
	include 'Footer.php';
	} //render method

} //main class