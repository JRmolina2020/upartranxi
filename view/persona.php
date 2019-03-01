<?php
require 'header.php';
?>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
           <div class="box-header with-border">
            <a class="btn btn-success btn-sm" onclick="registrarV()" data-toggle="modal" href='#modal'>Registrar
              <i class="fa fa-plus"></i>
             </a>
            <div class="box-tools pull-right">
            </div>
          </div>
          <div class="panel-body table-responsive" id="divlistado">
            <!-- BODY -->
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <th>Opciones</th>
                <th>Tipo de documento</th>
                <th>Documento</th>
                <th>Nombre</th>
                 <th>Apellido</th>
                   <th>Ciudad</th>
                <th>Barrio</th>
                <th>Direccion</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Perfil</th>
              </thead>
              <tbody>
              </tbody>
            </table>
            <!-- END BODY -->
            </div>
             </div>
              </div>
            </div>
          </section>
        </div>
         <!-- modal -->
   <div id="modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Registrar personas</h4>
      </div>
      <div class="modal-body">
      <form method="POST" id="formu" name="formu">
      <input type="hidden" id="id" name="id">
      <div class="row">
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Tipo de documento</label>
        <select class="form-control" id="tdoc" name="tdoc">
          <option value="CC">CC</option>
          <option value="TI">TI</option>
          <option value="RUT">RUT</option>
          <option  value="OTRO">OTRO</option>
        </select>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Identificacion</label>
          <input type="text" class="form-control" name="identi" id="identi"  
          placeholder="Ingrese la identificacion">
        </div>
      </div>
      </div>
      <div class="row">
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Nombre completo</label>
          <input type="text" class="form-control" name="nombre" id="nombre"  
          placeholder="Ingrese el nombre ">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Apellido completo</label>
          <input type="text" class="form-control" name="apellido" id="apellido"  
          placeholder="Ingrese el apellido">
        </div>
      </div>
      </div>
      <div class="row">
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Ciudad</label>
          <select class="form-control" onchange="ciudadvalidate()" id="ciudad" name="ciudad">
          <option value="Valledupar">Valledupar</option>
          <option value="Medellin">Medellin</option>
          </select>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Barrio</label>
          <select id="barrio" name="barrio" class="form-control"></select>
        </div>
      </div>
      </div>
      <div class="row">
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Dirrecion</label>
          <input type="text" class="form-control" name="direccion" id="direccion"
          placeholder="Ingrese la direccion">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Correo</label>
          <input type="text" class="form-control" name="email" id="email"
          placeholder="Ingrese el correo electronico">
        </div>
      </div>
      </div>
      <div class="row">
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Telefono</label>
          <input type="text" class="form-control" name="telefono" id="telefono"
          placeholder="Ingrese el telefono">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Perfil</label>
          <input type="file" class="form-control" name="image" id="image">
          <input type="hidden" name="imagenactual" id="imagenactual">   
        </div>
      </div>
      </div>
      </div>
      <!-- footer -->
      <div class="modal-footer">
        <button type="submit" id="btnsave" name="btnsave" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">salir</button>
      </div>
      </form>
    </div>

  </div>
</div>
        <?php
        require 'footer.php';
        ?>
<script type="text/javascript" src="scripts/Persona.js"></script>