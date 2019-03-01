<?php
require 'header.php';
require '../controllers/HomeController.php';
?>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="panel-body table-responsive" id="divlistado">
            <!-- BODY -->
            <div class="row">
        <div class="col-lg-3 col-xs-6">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Agentes</span>
              <span class="info-box-number"><?php echo$total;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-lg-3 col-xs-6">
        <div class="info-box">
            <span class="info-box-icon  bg-yellow"><i class="fa fa fa-calendar-check-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Comparendos HOY</span>
              <span class="info-box-number"><?php echo$totalC;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-lg-3 col-xs-6">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">TOTAL FONDOS</span>
              <span class="info-box-number"><?php echo$toti;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-lg-3 col-xs-6">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa fa-road"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">C.GRUA</span>
              <span class="info-box-number"><?php echo$totu;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">AGENTES DESTACADOS</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
            <?php
           while ($rsmv=$rcom24->fetch_object()){

           $name = $rsmv->name;
           $imagen = $rsmv->imagen;
           $cantidad = $rsmv->cantidad;
           $total=number_format($rsmv->total, 0, '', '.');

           ?>
                <li class="item">
                  <div class="product-img">
                    <img <?php echo"<img src='../files/".$imagen."' width=30 heigth=30 >";?>
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title"><?php echo $name?>
                      <span class="label label-danger pull-right"><?php echo $total?></span></a>
                    <span class="product-description">
                        CANTIDAD DE INFRACCIONES EMITIDAD :<?php echo$cantidad?>
                        </span>
                  </div>
                </li>
           <?php }?>
              </ul>
            </div>
            <!-- /.box-body -->
            <!-- END BODY -->
            </div>
             </div>
              </div>
            </div>
          </section>
        </div>
        <?php
        require 'footer.php';
        ?>
<script type="text/javascript" src="scripts/Estandar.js"></script>