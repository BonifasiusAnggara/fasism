<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="<?=set_url('ReturChainstore') ?>" style="color: #222D32">Retur Chainstore</a>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=set_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?=set_url('ReturChainstore') ?>">Retur Chainstore</a></li>
        <li class="active">Tambah</li>
      </ol>
    </section>
    <!-- ./Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <!-- row -->
      <div class="row">
        <!-- col -->
        <div class="col-xs-12">            
          <!-- box -->
          <div class="box box-primary">
            <!-- box-header -->
            <div class="box-header with-border">
              <h3 class="box-title col-xs-12">Tambah RTV</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->

            <!-- Form Start -->
            <form role="form" id="form-user" action="<?=set_url('ReturChainstore/insert');?>" method="post" enctype="multipart/form-data">
            <!-- box-body -->
              <div class="box-body">

                <div class="form-group">
                  <label for="no_rtv">No. RTV</label>
                  <?php echo form_error('no_rtv');?>
                  <input type="text" class="form-control" name="no_rtv" placeholder="Enter No. RTV" required pattern="[0-9a-zA-Z- /_]{5,}" title="Boleh mengandung huruf, angka, titik, strip dan underscore, minimal 5 karakter" autofocus>
                </div>    

                <div class="form-group">
                  <label>Nama Outlet</label><br>
                  <select class="select2" name="cust_no" required style="width: 100%;">
                    <option value="">:: Pilih Outlet ::</option>
                    <?php foreach ($cust as $key) { ?>
                      <option value="<?=$key->cust_no?>"><?=$key->cust_name?></option>
                    <?php } ?>
                  </select>
                </div>            

                <div class="form-group">
                  <label for="cabang_chs">Cabang Chainstore</label>
                  <input type="text" class="form-control" name="cabang_chs" placeholder="Enter DC of Chainstore" required pattern="[a-z. A-Z]{5,}" title="Alphabet Only">
                </div>

                <div class="form-group">
                  <label>Direktorat</label>
                  <select class="form-control select2" name="dir_id" required>
                    <option value="">:: Pilih Direktorat ::</option>
                    <?php foreach ($direktorat as $key => $value) { ?>
                      <option value="<?php echo $value->dir_id ?>"><?php echo $value->dir_slug ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="nominal">Nilai RTV</label>
                  <input type="text" class="form-control" name="nominal" placeholder="Enter Value of RTV" required pattern="[0-9]{3,}" title="Numerical Only">
                </div>

                <div class="form-group">
                  <label for="pdf_rtv">PDF RTV</label>
                  <input type="file" class="filestyle" name="pdf" accept="image/jpeg,image/png,pdf">
                  <p class="help-block">Input Your pdf here...<sup>(max. file size: 3MB)</sup></p>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Submit</button>
              </div>
            </form>
            <!-- Form End -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row --> 
    </section>
    <!-- End of Main content -->
  </div>
<!-- End of Content Wrapper. Contains page content -->

<script type="text/javascript">
    var $ = jQuery.noConflict();
    $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();
    });
  </script>