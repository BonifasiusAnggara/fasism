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
        <li class="active">Edit</li>
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
              <h3 class="box-title col-xs-12">Edit Pegawai</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->

            <!-- Form Start -->
            <form role="form" method="post" action="<?=set_url('Pegawai/update/'.md5($pegawai->peg_id));?>" enctype="multipart/form-data">
            <!-- box-body -->
              <div class="box-body">
                <div class="form-group">
                  <label for="nama_depan">Nama Depan</label>
                  <?php echo form_error('nama_depan');?>
                  <input type="text" class="form-control" name="nama_depan" value="<?=$pegawai->nama_depan?>" required pattern="[a-zA-Z]{3,}" title="Aplhabet Only, 3 or more" autofocus>
                </div>

                <div class="form-group">
                  <label for="nama_belakang">Nama Belakang</label>
                  <?php echo form_error('nama_belakang');?>
                  <input type="text" class="form-control" name="nama_belakang" value="<?=$pegawai->nama_belakang?>">
                </div>

                <div class="form-group">
                  <label for="NIK">NIK</label>
                  <?php echo form_error('NIK');?>
                  <input type="text" class="form-control" value="<?=$pegawai->NIK?>" disabled>
                </div>

                <div class="form-group">
                  <label>Direktorat</label>
                  <?php echo form_error('direktorat');?>
                  <select class="form-control select2" name="direktorat" required>
                    <option value="<?=$peg_detail->dir_id?>"><?=$peg_detail->dir_name?></option>
                    <?php foreach ($direktorat as $key => $value) { ?>
                      <option value="<?php echo $value->dir_id ?>"><?php echo $value->dir_name ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="jabatan">Jabatan</label>
                  <?php echo form_error('jabatan');?>
                  <input type="text" class="form-control"  name="jabatan" value="<?=$pegawai->jabatan?>" required pattern="[a-z A-Z]{3,}" title="Aplhabet Only">
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label><br>
                    <label class="radio-inline">                    
                      <input type="radio" name="jenis_kelamin" class="flat-red" value="Pria" <?php if($pegawai->jenis_kelamin == 'Pria') { ?> checked <?php } ?>>
                      &nbsp;<i class="fa fa-male"></i>&nbsp;<b>Pria</b> 
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="jenis_kelamin" class="flat-red" value="Wanita" <?php if($pegawai->jenis_kelamin == 'Wanita') { ?> checked <?php } ?>>
                      &nbsp;<i class="fa fa-female"></i>&nbsp;<b>Wanita</b>
                    </label>
                </div>

                <div class="form-group">
                  <label for="tempat_lahir">Tempat Lahir</label>
                  <?php echo form_error('tempat_lahir');?>
                  <input type="text" class="form-control" name="tempat_lahir" value="<?=$pegawai->tempat_lahir?>" required pattern="[a-zA-Z]{3,}" title="Aplhabet Only">
                </div>

                <div class="form-group">
                  <label for="tanggal_lahir">Tanggal Lahir</label>
                  <?php echo form_error('tanggal_lahir');?>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right" name="tanggal_lahir" value="<?=$pegawai->tanggal_lahir?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="handphone">No. Handphone</label>
                  <?php echo form_error('handphone');?>
                  <input type="text" class="form-control"  name="handphone" value="<?=$pegawai->handphone?>" required pattern="[0-9]{11,}" title="Number Only, 11 or more">
                </div>

                <div class="form-group">
                  <?php echo form_error('alamat');?>
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" rows="3" required><?=$pegawai->alamat?></textarea>
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

    //Date picker
    $('.tanggal_lahir').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="radio"].flat-red').iCheck({
      radioClass: 'iradio_flat-green'
    });
  });
</script>