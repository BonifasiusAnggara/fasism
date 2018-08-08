<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="<?=set_url('RegisterRetur') ?>" style="color: #222D32">Register Retur NKA</a>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=set_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?=set_url('RegisterRetur') ?>">Register Retur NKA</a></li>
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
          <div class="box box-warning">
            <!-- box-header -->
            <div class="box-header with-border">
              <h3 class="box-title col-xs-12">Input Register Retur</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->

            <!-- Form Start -->
            <form role="form" method="post" action="<?=set_url('RegisterRetur/insert');?>">
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
                  <label for="nama_belakang">Nama Driver</label>
                  <input type="text" class="form-control" name="nama_driver" placeholder="Enter Driver Name" required pattern="[a-z .A-Z]{3,}" title="Alphabet only">
                </div>

                <div class="form-group">
                  <label for="tanggal_retur">Tanggal Retur</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" disabled value="<?php echo tgl_indo(date('Y-m-d')); ?>">
                  </div>
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
  $(function(){
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>