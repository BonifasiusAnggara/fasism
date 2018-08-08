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
        <li class="active">MHE</li>
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
              <h3 class="box-title col-xs-12">Master Data MHE</h3>
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
				          	<th>Photo</th>
				            <th>Serial Number</th>
				            <th>Jenis MHE</th>
                    <th>Merk</th>			            
				            <th>Type</th>
                    <th>No. Kontrak</th>
                    <th>Tahun Pembuatan</th>
                    <th>Maintenance Record</th>
                    <th>Sparepart Record</th>
                    <th>Keterangan</th>  
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
                    <td><img height="150" src="<?=set_url('uploads/photo_mhe/'.$data->photo_filename)?>" alt="Photo"/></td>
				    				<td><?=$data->no_seri?></td>
                    <td><?=$data->jenis?></td>
				            <td><?=$data->merk?></td>
                    <td><?=$data->type?></td>
                    <?php if ($data->no_kontrak == '') { ?>
                    <td><button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#insertKontrak" data-id="<?=$data->mhe_id?>">Entry Kontrak</button></td>
                    <?php } else { ?>
                    <td><a href="<?=set_url('uploads/pdf_kontrak/'.$data->pdf_kontrak)?>"><?=$data->no_kontrak?></a></td>
                    <?php } ?>                    
                    <td><?=$data->thn_pembuatan?></td>
                    <td align="center"><a type="button" class="btn btn-block bg-maroon" href="<?=set_url('MHE/maintenance_record/'.base64_encode($data->mhe_id))?>" data-toggle="tooltip" title="View Detail!"><i class="fa fa-gears"></i></a></td>
                    <td align="center"><a type="button" class="btn btn-block bg-maroon" href="<?=set_url('MHE/sparepart_record/'.base64_encode($data->mhe_id))?>" data-toggle="tooltip" title="View Detail!"><i class="fa fa-shopping-cart"></i></a></td>
                    <td><?=$data->keterangan?></td>
                    <td>
                      <div class="btn-group">
                        <a type="button" class="btn btn-danger" href="<?=set_url('MHE/delete/'.base64_encode($data->mhe_id))?>" onclick="return confirm('Anda yakin ingin menghapus MHE <?=$data->no_seri?> ??')" data-toggle="tooltip" title="DELETE!"><i class="fa fa-trash-o"></i></a>
                        <a type="button" class="btn btn-warning" href="<?=set_url('MHE/edit/'.md5($data->mhe_id))?>" data-toggle="tooltip" title="EDIT!"><i class="fa fa-edit"></i></a>
                        <?php if ($data->no_kontrak != '') { ?>
                          <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#editKontrak"
                          data-id="<?=$data->mhe_id?>"
                          data-no="<?=$data->no_kontrak?>"><i class="glyphicon glyphicon-tags"></i></button>
                        <?php } ?>
                      </div>
                    </td>
				          </tr>
								<?php } ?>
				        </tbody>
				      </table>  
            </div>
            <!-- /.box-body -->
            <?php if (($user->akses == 99) || ($user_detail->dir_id == 4)) { ?>
            <div class="box-footer" align="right">
              <a href="<?=set_url('MHE/add');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
            </div>
            <?php } ?>
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

  <!-- Modal -->
  <div class="modal modal-info fade" id="insertKontrak">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry No. Kontrak</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('MHE/insert_kontrak');?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="no_kontrak">No. Kontrak</label>
              <input type="text" class="form-control" name="no_kontrak" placeholder="Enter No. Kontrak" required pattern="[0-9a-zA-Z-/_]{5,}" title="Alphabet, numerical, dash, space, slash and underscore only, 5 characters minimum" style="text-transform:uppercase" autofocus>
              <input type="hidden" class="form-control mhe_id" name="mhe_id">
            </div>
            <div class="form-group">
              <label for="pdf_kontrak">PDF Kontrak</label>
              <input type="file" class="filestyle" name="pdf" accept="image/jpeg,image/png,pdf">
              <p class="help-block">Input Your pdf here...<sup>(max. file size: 3MB)</sup></p>
            </div>
                    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline">Save changes</button>
        </div>
          </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal modal-info fade" id="editKontrak">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry No. Kontrak</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('MHE/insert_kontrak');?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="no_kontrak">No. Kontrak</label>
              <input type="text" class="form-control no_kontrak" name="no_kontrak" required pattern="[0-9a-zA-Z- /_]{3,}" title="Alphabet, numerical, dash, space and underscore only, 5 characters minimum" style="text-transform:uppercase" autofocus>
              <input type="hidden" class="form-control mhe_id" name="mhe_id">
            </div>
            <div class="form-group">
              <label for="pdf_kontrak">PDF Kontrak</label>
              <input type="file" class="filestyle" name="pdf" accept="image/jpeg,image/png,pdf">
              <p class="help-block">Input Your pdf here...<sup>(max. file size: 3MB)</sup></p>
            </div>
                    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline">Save changes</button>
        </div>
          </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

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

    $(document).on( "click", '.bg-maroon',function(e) {
      var id = $(this).data('id'),
          no = $(this).data('no');
      $(".mhe_id").val(id);
      $(".no_kontrak").val(no);
    });
	</script>