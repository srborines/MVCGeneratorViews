<?php
  //ONLY DEVELOP
  $values_list = ["login" => "admin","password" => "admin","NombreU" => "Administrador","TituloAcademicoU" => "","TipoContratoU" => "","CentroU" => "","DepartamentoU" => "","UniversidadU" => "","TipoU" => "A"];
 ?>
 <a href="./USUARIOS_Controller.php?action=SHOWALL">Back</a>
<table id="USUARIOS-SHOWCURRENT" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
              <th>Attribute</th>
              <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($values_list as $field => $value) {
                  echo "<tr><td>".$field."</td><td>".$value."</td></tr>";
                }
             ?>
        </tbody>
    </table>

<script type="text/javascript">
$(document).ready(function() {
  $('#USUARIOS-SHOWCURRENT').DataTable();
} );
</script>
