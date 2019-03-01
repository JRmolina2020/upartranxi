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
            <a class="btn btn-success btn-md" onclick="registrarV()" data-toggle="modal" href='#modal'>Registrar
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
                <th>#pago</th>
                <th>Estado</th>
                <th>Doc</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Agente</th>
                <th>Placa</th>
                <th>Imagen</th>
                <th>Fecha</th>
                <th>Lugar</th>
                <th>Hora</th>
                <th>Reseña</th>
                <th>Subtotal</th>
                <th>$Grua</th>
                <th>Total</th>
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
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Registrar comparendo</h4>
      </div>
      <div class="modal-body">
      <form method="POST" id="formu" name="formu">
      <input type="hidden" id="id" name="id">
      <input type="hidden" id="idu" name="idu" value="<?php echo $_SESSION['id']?>">
      <div class="row">
      <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
      <div class="form-group">
          <label for="">Infractor</label>
        <select class="form-control selectpicker"  id="idp" name="idp" data-live-search="true">
        </select>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6" id="idvd" >
      <div class="form-group">
          <label for="">Vehiculo</label>
          <select class="form-control selectpicker"  id="idv" name="idv" data-live-search="true">
        </select>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
      <div class="form-group">
          <label for="">Observacion</label>
          <textarea class="form-control" id="observacion" name="observacion" rows="1"></textarea>
        </select>
        </div>
      </div>
      </div>
      <div class="row" id="cuadro">
      <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
      <div class="form-group">
          <label for="">Detalle</label>
          <select class="form-control selectpicker"  id="totdetalle" name="totdetalle" data-live-search="true">
        </select>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6" id="idvd" >
      <div class="form-group">
          <label for="">Impuesto de grua</label>
            <select class="form-control" name="totgrua" id="totgrua">
              <option value="10000">Moto</option>
              <option value="20000">Carro</option>
              <option value="30000">OTROS</option>
              <option></option>
            </select>
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
<script type="text/javascript" src="scripts/comparendo.js"></script>