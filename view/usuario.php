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
            <a class="btn btn-success btn-sm"  onclick="registrarV()" data-toggle="modal" href='#modal'>Registrar
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
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Tipo</th>
                <th>Estado</th>
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
      <form action="" id="formu" name="formu" method="POST" role="form">
          <input type="hidden" name="id" id="id">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="usr">Nombre</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
          <label for="">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Correo">
           </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
          <label for="">Password</label>
          <input type="text" class="form-control" id="password" name="password" placeholder="Password">
           </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
          <label for="">Nivel</label>
          <select name="level" id="level" class="form-control">
            <option value="Admin">Administrador</option>
            <option value="Agente">Agente</option>
          </select>
           </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
          <label for="">Imagen</label>
          <input type="file" class="form-control" id="image" name="image">
           </div>
            </div>
            <input type="hidden" name="imagenactual" id="imagenactual">   
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
<script type="text/javascript" src="scripts/User.js"></script>