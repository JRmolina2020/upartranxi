
<?php
if (!empty($_GET['id'])){$idp=$_GET["id"];}
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
                <th>Tipo</th>
                <th>placa</th>
                <th>marca</th>
                <th>modelo</th>
                <th>color</th>
                <th>imagen</th>
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
      <input type="hidden" value="<?php echo$idp?>" id="idp" name="idp">
      <div class="row">
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Tipo de vehiculo</label>
        <select class="form-control" id="idt" name="idt">
        </select>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Placa</label>
          <input type="text" class="form-control" name="placa" id="placa"
          placeholder="Ingrese la placa del vehiculo">
        </div>
      </div>
      </div>
      <div class="row">
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Marca</label>
        <select class="form-control" id="marca" name="marca">
          <option value="Yhundai">Yhundai</option>
          <option value="Honda">Honda</option>
          <option value="Zuzuky">Zuzuky</option>
        </select>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Modelo</label>
          <input type="text" class="form-control" name="modelo" id="modelo"  
          placeholder="Ingrese el modelo del vehiculo">
        </div>
      </div>
      </div>
      <div class="row">
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Color</label>
          <input type="color" class="form-control" id="color" name="color">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Imagen</label>
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
         <!-- end modal -->
        <?php
        require 'footer.php';
        ?>
<script type="text/javascript" src="scripts/vehiculo.js"></script>