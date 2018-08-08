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
        <li class="active">Pegawai</li>
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
          <div class="box box-info">
          	<!-- box-header -->
            <div class="box-header with-border">
              <h3 class="box-title col-xs-12">Master Data Pegawai</h3>
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
				          	<th>NIK</th>
				            <th>Nama Lengkap</th>
				            <th>Jenis Kelamin</th>
                    <th>Direktorat</th>
				            <th>Jabatan</th>				            
				            <th>Tempat / Tgl. Lahir</th>
                    <th>Usia</th>
                    <th>No. Handphone</th>
                    <th>Alamat</th>  
                    <th>Action</th>                  
				          </tr>
				        </thead>
				        <tbody>
				        <?php
				        	$a1 = new ArrayIterator($data);
									$Iterator = new MultipleIterator;
									$Iterator->attachIterator($a1);
									foreach ($Iterator as $pack) {
										$data = $pack[0];
                    $birth = explode('-', $data->tanggal_lahir) ;
                    $age = date('Y') - $birth[0]; ?>
                  <tr>
                    <td><?=$data->NIK?></td>
				    				<td><?=$data->nama_depan." ".$data->nama_belakang?></td>
				            <td><?=$data->jenis_kelamin?></td>
                    <td><?=$data->dir_name?></td>
				            <td><?=$data->jabatan?></td>
				            <td><?=$data->tempat_lahir.", ".tgl_indo($data->tanggal_lahir)?></td>
                    <td><?=$age?></td>
                    <td><?=$data->handphone?></td>
                    <td><?=$data->alamat?></td>
                    <td>
                      <div class="btn-group">
                        <a type="button" class="btn btn-danger" href="<?=set_url('Pegawai/delete/'.base64_encode($data->peg_id))?>" onclick="return confirm('Anda yakin ingin menghapus Pegawai <?=$data->nama_depan.' '.$data->nama_belakang?> ??')" data-toggle="tooltip" title="DELETE!"><i class="fa fa-trash-o"></i></a>
                        <a type="button" class="btn btn-warning" href="<?=set_url('Pegawai/edit/'.md5($data->peg_id))?>" data-toggle="tooltip" title="EDIT!"><i class="fa fa-edit"></i></a>
                      </div>
                    </td>
				          </tr>
								<?php } ?>
				        </tbody>
				      </table>  
            </div>
            <!-- /.box-body -->
            <div class="box-footer" align="right">
				      <a href="<?=set_url('Pegawai/add');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
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