<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="<?=set_url('Pegawai') ?>" style="color: #222D32">Pegawai</a>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=set_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?=set_url('Pegawai') ?>">Pegawai</a></li>
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
              <h3 class="box-title col-xs-12">Tambah Pegawai</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->

            <!-- Form Start -->
            <form role="form" method="post" action="<?=set_url('Pegawai/insert');?>" enctype="multipart/form-data">
            <!-- box-body -->
              <div class="box-body">
                <div class="form-group">
                  <label for="nama_depan">Nama Depan</label>
                  <?php echo form_error('nama_depan');?>
                  <input type="text" class="form-control" name="nama_depan" placeholder="Enter First Name" required pattern="[a-zA-Z]{3,}" title="Aplhabet Only, 3 or more" autofocus>
                </div>

                <div class="form-group">
                  <label for="nama_belakang">Nama Belakang</label>
                  <input type="text" class="form-control" name="nama_belakang" placeholder="Enter Last Name" pattern="[a-z .A-Z]{3,}">
                </div>

                <div class="form-group">
                  <label for="NIK">NIK</label>
                  <?php echo form_error('NIK');?>
                  <input type="text" class="form-control" name="NIK" placeholder="Nine Number only..." required pattern="[0-9]{9}" title="Number Only, excactly 9 number">
                </div>

                <div class="form-group">
                  <label>Direktorat</label>
                  <select class="form-control select2" name="direktorat" required>
                    <option value="">:: Pilih Direktorat ::</option>
                    <?php foreach ($direktorat as $key => $value) { ?>
                      <option value="<?php echo $value->dir_id ?>"><?php echo $value->dir_name ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="jabatan">Jabatan</label>
                  <input type="text" class="form-control"  name="jabatan" placeholder="Enter Job Title" required pattern="[a-z A-Z]{3,}" title="Aplhabet Only">
                </div>

                <div class="form-group">
                  <label for="jenis_kelamin">Jenis Kelamin</label><br>
                  <label class="radio-inline">                    
                    <input type="radio" name="jenis_kelamin" class="flat-red" value="Pria" checked>
                    &nbsp;<i class="fa fa-male"></i>&nbsp;<b>Pria</b> 
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="jenis_kelamin" class="flat-red" value="Wanita">
                    &nbsp;<i class="fa fa-female"></i>&nbsp;<b>Wanita</b>
                  </label>
                </div>

                <div class="form-group">
                  <label for="tempat_lahir">Tempat Lahir</label>
                  <input type="text" class="form-control" name="tempat_lahir" placeholder="Enter Birth Place" required pattern="[a-z A-Z]{3,}" title="Aplhabet Only">
                </div>

                <div class="form-group">
                  <label for="tanggal_lahir">Tanggal Lahir</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right" name="tanggal_lahir" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="handphone">No. Handphone</label>
                  <input type="text" class="form-control"  name="handphone" placeholder="Enter No. Handphone" required pattern="[0-9]{11,}" title="Number Only, 11 or more">
                </div>

                <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" rows="3" placeholder="Enter Address..." required></textarea>
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