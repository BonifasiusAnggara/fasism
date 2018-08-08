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
        <li class="active">Profile</li>
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
              <h3 class="box-title col-xs-12">User Profile</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->

            <!-- box-body -->
            <div class="box-body">
              <div class="col-xs-3">
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive" src="<?=base_url()?>uploads/users_pict/<?php echo $user->pp_pict_filename?>" alt="User profile picture">
                  </div>
                </div>
              </div>
              <div class="col-xs-9">
                <ul class="list-group list-group-unbordered col-md-6">
                  <li class="list-group-item">
                    <i class="fa fa-user"></i> <b>Nama Lengkap : </b> <?php echo $user_detail->nama_depan." ".$user_detail->nama_belakang ?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-bank"></i> <b>Direktorat : </b> <?php echo $user_detail->dir_name ?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-star"></i> <b>Jabatan : </b> <?php echo $user_detail->jabatan ?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-venus-mars"></i> <b>Jenis Kelamin : </b> 
                    <?php
                      if ($user_detail->jenis_kelamin == "Pria") { ?>
                      <i class="fa fa-mars"></i> Pria
                    <?php } else if ($user_detail->jenis_kelamin == "Wanita") { ?>
                      <i class="fa fa-venus"></i> Wanita
                    <?php } ?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-anchor"></i> <b>NIK : </b> <?php echo $user_detail->NIK ?>
                  </li>
                </ul>

                <ul class="list-group list-group-unbordered col-md-6">
                  <li class="list-group-item">
                    <i class="fa fa-mobile-phone"></i> <b>No Handphone : </b> <?php echo $user_detail->handphone ?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-laptop"></i> <b>Username : </b> <?php echo $user->username ?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-paw"></i> <b>Title : </b> <?php echo $user->title ?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-envelope-o"></i> <b>Email : </b> <?php echo $user->email ?>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
