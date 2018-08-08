<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="<?=set_url('User') ?>" style="color: #222D32">User</a>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=set_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?=set_url('User') ?>">User</a></li>
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
              <h3 class="box-title col-xs-12">Tambah User</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->

            <!-- Form Start -->
            <form role="form" action="<?=set_url('User/insert');?>" method="post" enctype="multipart/form-data">
            <!-- box-body -->
              <div class="box-body">
                <div class="form-group">
                  <label>Nama Pegawai</label>
                  <?php echo form_error('peg_id');?>
                  <select class="form-control select2" name="peg_id" required>
                    <option>:: Pilih Pegawai ::</option>
                    <?php foreach ($pegawai as $key => $value) { ?>
                      <option value="<?php echo $value->peg_id ?>"><?php echo $value->nama_depan.' '.$value->nama_belakang ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="username">Username</label>
                  <?php echo form_error('username');?>
                  <input type="text" class="form-control" name="username" placeholder="Enter Username" required pattern="[a-z0-9._A-Z]{3,}" title="Boleh mengandung huruf, angka, titik dan underscore, minimal 3 karakter">
                </div>                

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-group">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                </div>

                <div class="form-group">
                  <label for="email">Email address</label>
                  <?php echo form_error('email');?>
                  <input type="email" class="form-control" name="email" placeholder="Enter email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                </div>

                <div class="form-group">
                  <label>Title</label>
                  <select class="form-control select2" name="title" id="title" required>
                    <option value="">:: Pilih User Title ::</option>
                    <option value="User">User</option>
                    <option value="Admin">Admin</option>
                    <option value="Super Admin">Super Admin</option>
                  </select>
                </div>

                <div class="form-group">
                  <input type="hidden" class="form-control" name="akses" id="akses">
                </div>

                <div class="form-group">
                  <label for="photo">User Photo</label>
                  <input type="file" class="filestyle" name="photo" accept="image/jpeg,image/png">
                  <p class="help-block">Input Your photo here...<sup>(max. file size: 3MB)</sup></p>
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

<!-- script for validate password  -->
<script type="text/javascript">
  var password = document.getElementById("password"),
      confirm_password = document.getElementById("confirm_password");

  function validatePassword(){
    if(password.value != confirm_password.value) {
      confirm_password.setCustomValidity("your password do not match!");
    } else {
      confirm_password.setCustomValidity('');
    }
  }

  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;
</script>
<!-- script for validate password  -->

<!-- script for User akses  -->
<script type="text/javascript">
  var title = document.getElementById("title"),
      akses = document.getElementById("akses");

      function selectAkses(){
        if (title.value == 'User'){
          akses.value = '1';
        } else if (title.value == 'Admin'){
          akses.value = '2';
        } else if (title.value == 'Super Admin'){
          akses.value = '99';
        }
      }

  title.onchange = selectAkses;
</script>
<!-- script for User akses  -->