<?php
$field_list = ["login","password","NombreU","ApellidosU","TituloAcademicoU","TipoContratoU","CentroU","DepartamentoU","UniversidadU","TipoU"];
$values_list = ["login" => "admin","password" => "admin","NombreU" => "Administrador","ApellidosU" => "", "TituloAcademicoU" => "","TipoContratoU" => "","CentroU" => "","DepartamentoU" => "","UniversidadU" => "","TipoU" => "A"];
 ?>


<a href="./USUARIOS_Controller.php?action=SHOWALL">Back</a>
<form action="./USUARIOS_Controller.php?action=ADD" method="POST">
  <div class="form-group">
    <label for="login">login:</label>
    <input type="text" class="form-control" id="login" value="<?= $values_list['login'] ?>">
  </div>
  <div class="form-group">
    <label for="password">password:</label>
    <input type="password" class="form-control" id="pwd">
  </div>
  <div class="form-group">
    <label for="NombreU">NombreU:</label>
    <input type="text" class="form-control" id="NombreU" value="<?= $values_list['NombreU'] ?>">
  </div>
  <div class="form-group">
    <label for="ApellidosU">ApellidosU:</label>
    <input type="text" class="form-control" id="ApellidosU" value="<?= $values_list['ApellidosU'] ?>">
  </div>
  <div class="form-group">
    <label for="TituloAcademicoU">TituloAcademicoU:</label>
    <input type="text" class="form-control" id="TituloAcademicoU" value="<?= $values_list['TituloAcademicoU'] ?>">
  </div>
  <div class="form-group">
    <label for="TipoContratoU">TipoContratoU:</label>
    <input type="text" class="form-control" id="TipoContratoU" value="<?= $values_list['TipoContratoU'] ?>">
  </div>
  <div class="form-group">
    <label for="CentroU">CentroU:</label>
    <input type="text" class="form-control" id="CentroU" value="<?= $values_list['CentroU'] ?>">
  </div>
  <div class="form-group">
    <label for="DepartamentoU">DepartamentoU:</label>
    <input type="text" class="form-control" id="DepartamentoU" value="<?= $values_list['DepartamentoU'] ?>">
  </div>
  <div class="form-group">
    <label for="UniversidadU">UniversidadU:</label>
    <input type="text" class="form-control" id="UniversidadU" value="<?= $values_list['UniversidadU'] ?>">
  </div>
  <div class="form-group">
    <label for="TipoU">TipoU:</label>
    <input type="text" class="form-control" id="TipoU" value="<?= $values_list['TipoU'] ?>">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
