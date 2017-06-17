<?php
  //ONLY DEVELOP
  $field_list = ["login","password","NombreU","ApellidosU","TituloAcademicoU","TipoContratoU","CentroU","DepartamentoU","UniversidadU","TipoU"];
  $values_list = [["login" => "admin","password" => "admin","NombreU" => "Administrador","ApellidosU" => "", "TituloAcademicoU" => "","TipoContratoU" => "","CentroU" => "","DepartamentoU" => "","UniversidadU" => "","TipoU" => "A"]];
 ?>
 <a href="./index_Controller.php">Back</a>
<table id="USUARIOS-SHOWALL" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
              <?php
                foreach ($field_list as $field) {
                  echo "<th>".$field."</th>";
                }
               ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
              <?php
                foreach ($field_list as $field) {
                  echo "<th>".$field."</th>";
                }
               ?>
            </tr>
        </tfoot>
        <tbody>
          <?php
            foreach ($values_list as $values) {
              echo "<tr>";
              foreach ($field_list as $field) {
                echo "<td>".$values[$field]."</td>";
              }
              echo "<td><a href='USUARIOS_Controller.php?action=SHOWCURRENT'>View</a> <a href='USUARIOS_Controller.php?action=EDIT'>Edit</a> <a href='USUARIOS_Controller.php?action=DELETE'>Delete</a></td>";
              echo "</tr>";
            }
           ?>
        </tbody>
    </table>

<script type="text/javascript">
$(document).ready(function() {
  $('#USUARIOS-SHOWALL').DataTable();
} );
</script>
