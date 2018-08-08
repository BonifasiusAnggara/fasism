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
        <li class="active">User</li>
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
          <div class="box box-success">
          	<!-- box-header -->
            <div class="box-header with-border">
              <h3 class="box-title col-xs-12">Master Data User</h3>
              <label class="label label-danger" style="margin-left: 15px;">
			            <?php echo " Total data " . number_format($jmldata) . " - Ditampilkan dalam " . $this->benchmark->elapsed_time() ." Detik"; ?>
			        </label>
              
              <div class="box-tools">
                <div class="pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
              </div>
            </div>
            <!-- /.box-header -->

            <!-- box-body -->
            <div class="box-body table-responsive">   
              <table id="table1" class="table table-striped table-bordered table-hover responsive nowrap">
				        <thead>
				          <tr>
				          	<th>Username</th>
				          	<th>Title</th>
				            <th>Nama Lengkap</th>
				            <th>Jenis Kelamin</th>
				            <th>Jabatan</th>				            
				            <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>		            
				          </tr>
				        </thead>
				        <tbody>
				        <?php
				        	$a1 = new ArrayIterator($data);
									$Iterator = new MultipleIterator;
									$Iterator->attachIterator($a1);
									foreach ($Iterator as $pack) {
										$data = $pack[0]; ?>
                  <tr>
                    <td><?=$data->username?></td>
                    <td><?=$data->title?></td>
                    <td><?=$data->nama_depan." ".$data->nama_belakang?></td>
                    <td><?=$data->jenis_kelamin?></td>
                    <td><?=$data->jabatan?></td>
                    <td><?=$data->email?></td>
                    <?php if($data->active == '0') { ?>
                    <td>INACTIVE</td>
                    <?php } elseif ($data->active == '1') { ?>
                    <td>ACTIVE</td>
                    <?php } ?>
                    <td>
                      <div class="btn-group">
                        <?php if($data->active == '0') { ?>
                          <a type="button" class="btn btn-warning" href="<?=set_url('User/activate/'.md5($data->user_id))?>" data-toggle="tooltip" title="ACTIVATE!" onclick="return confirm('Anda yakin ingin mengaktifkan User <?=$data->username?> ??')"><i class="fa fa-user-plus"></i></a>
                        <?php } elseif ($data->active == '1') { ?>
                          <a type="button" class="btn btn-info" href="<?=set_url('User/deactivate/'.md5($data->user_id))?>" data-toggle="tooltip" title="DEACTIVATE!" onclick="return confirm('Anda yakin ingin menonaktifkan User <?=$data->username?> ??')"><i class="fa fa-user-times"></i></a>
                        <?php }  ?>
                        <a type="button" class="btn btn-danger" href="<?=set_url('User/delete/'.base64_encode($data->user_id))?>" onclick="return confirm('Anda yakin ingin menghapus User <?=$data->username?> ??')" data-toggle="tooltip" title="DELETE!"><i class="fa fa-trash-o"></i></a>
                        <a type="button" class="btn btn-warning" href="<?=set_url('User/edit/'.md5($data->user_id))?>" data-toggle="tooltip" title="EDIT!"><i class="fa fa-edit"></i></a>
                      </div>
                    </td>
                  </tr>
								<?php	} ?>
				        </tbody>
				      </table>  
            </div>
            <!-- /.box-body -->
            <div class="box-footer" align="right">
				      <a href="<?=set_url('User/add');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
				    </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    var $ = jQuery.noConflict();
	  $(function () {
      $('#table1').DataTable({
        "order": [[ 0, "desc" ]],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true
      });
    });
    
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
	</script>