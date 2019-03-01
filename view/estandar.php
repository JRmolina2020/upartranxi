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
                <th>SIGLAS</th>
                <th>Descripcion</th>
                <th>Valor</th>
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
        <h4 class="modal-title">Registrar tipo de estandar</h4>
      </div>
      <div class="modal-body">
      <form method="POST" id="formu" name="formu">
      <input type="hidden" id="id" name="id">
      <div class="row">
      <div class="col-lg-2 col-md-6 col-xs-6 col-sm-6">
      <div class="form-group">
          <label for="">SIGLAS</label>
          <input type="text" class="form-control" name="nombre" id="nombre"  
          placeholder="Ingrese el nombre" onkeyup="mayus(this);">
        </div>
      </div>
      <div class="col-lg-10 col-md-6 col-xs-6 col-sm-6">
      <div class="form-group">
          <label for="">Valor</label>
          <input type="number" class="form-control" name="valor" id="valor"  
          placeholder="Ingrese el valor">
        </div>
      </div>
      </div>
      <div class=col-12>
        <div class="form-group">
          <label for="">Descripcion</label>
          <textarea class="form-control" id="descrip" name="descrip" rows="3"></textarea>
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
<script type="text/javascript" src="scripts/Estandar.js"></script>