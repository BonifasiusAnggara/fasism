<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="<?=set_url('TUkarGuling') ?>" style="color: #222D32">Tukar Guling</a>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=set_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?=set_url('TUkarGuling') ?>">Tukar Guling</a></li>
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
              <h3 class="box-title col-xs-12">Tambah Tukar Guling</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->

            <!-- Form Start -->
            <form role="form" action="<?=set_url('TUkarGuling/insert');?>" method="post">
            <!-- box-body -->
              <div class="box-body">
                <div class="form-group">
                  <label>No. TTRB</label>
                  <input type="text" class="form-control" name="no_ttrb" placeholder="Enter No. TTRB" required pattern="[a-zA-Z ./-_0-9]{3,}" title="A-Z ./-_0-9 only" style="text-transform:uppercase" autofocus>
                </div>

                <div class="form-group">
                  <label>Outlet</label><br>
                  <select class="select2" name="cust_no" required style="width: 100%;">
                    <option value="">:: Pilih Outlet ::</option>
                    <?php foreach ($cust as $key) { ?>
                      <option value="<?=$key->cust_no?>"><?=$key->cust_name?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Tanggal Terima Barang</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right" name="tgl_trm_brg" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="jenis_kelamin">SP</label><br>
                  <label class="radio-inline">                    
                    <input type="radio" name="sp" class="flat-red" value="Ada" checked>
                    &nbsp;<i class="fa fa-check"></i>&nbsp;<b>Ada</b> 
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="sp" class="flat-red" value="Tidak ada">
                    &nbsp;<i class="fa fa-close"></i>&nbsp;<b>Tidak ada</b>
                  </label>
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control" name="keterangan" rows="3" placeholder="Enter Reason..." required></textarea>
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

    //iCheck for checkbox and radio inputs
    $('input[type="radio"].flat-red').iCheck({
      radioClass: 'iradio_flat-green'
    });
  });
</script>