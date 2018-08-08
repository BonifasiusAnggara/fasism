<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="<?=set_url('MHE') ?>" style="color: #222D32">MHE</a>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=set_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?=set_url('MHE') ?>">MHE</a></li>
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
          <div class="box box-danger">
            <!-- box-header -->
            <div class="box-header with-border">
              <h3 class="box-title col-xs-12">Tambah MHE</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->

            <!-- Form Start -->
            <form role="form" action="<?=set_url('MHE/insert');?>" method="post" enctype="multipart/form-data">
            <!-- box-body -->
              <div class="box-body">
                <div class="form-group">
                  <label>Serial Number</label>
                  <input type="text" class="form-control" name="no_seri" placeholder="Enter Serial Number" required pattern="[0-9]{3,}" title="Numeric only" autofocus>
                </div>

                <div class="form-group">
                  <label>Jenis MHE</label>
                  <select class="form-control select2" name="jenis" required>
                    <option value="">:: Pilih Jenis MHE ::</option>
                    <option value="Stacker">Stacker</option>
                    <option value="Pallet Mover">Pallet Mover</option>
                    <option value="Reach Truck">Reach Truck</option>
                    <option value="Hand Pallet">Hand Pallet</option>
                    <option value="Counter Balance">Counter Balance</option>
                    <option value="Battery">Battery</option>
                    <option value="Charger">Charger</option>
                    <option value="Lain-lain">Lain-lain</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="merk">Merk</label>
                  <input type="text" class="form-control" name="merk" placeholder="Enter Brand" required pattern="[a-z A-Z]{3,}" title="Alphabet only">
                </div>                

                <div class="form-group">
                  <label for="type">Type</label>
                  <input type="text" class="form-control" name="type" placeholder="Enter Type" required pattern="[0-9a-z -_A-Z]{3,}" title="Alphabet, Uppercase & Numerical only" style="text-transform:uppercase">
                </div>

                <div class="form-group">
                  <label for="thn_pembuatan">Tahun Pembuatan</label>
                  <input type="number" class="form-control" name="thn_pembuatan" placeholder="Enter Year" required pattern="[0-9]{4}" title="Numerical & Four number only">
                </div>

                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control" name="keterangan" rows="3" placeholder="Some Note..." required></textarea>
                </div>

                <div class="form-group">
                  <label for="photo">MHE Photo</label>
                  <input type="file" class="filestyle" name="photo" accept="image/jpeg,image/png">
                  <p class="help-block">Input MHE photo here...<sup>(max. file size: 3MB)</sup></p>
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