	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header(Page Header) -->
		<section class="content-header">
			<h1>
				<a href="<?=set_url('Sparepart_mhe')?>" style="color: #222D32">Sparepart MHE</a>
				<small>Control Panel</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?=set_url('Dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Sparepart MHE</li>
			</ol>
		</section>
		<!-- ./Content Header(Page Header) -->

		<!-- Main Content -->
		<section class="content">
			<!-- row -->
			<dov class="row">
				<!-- col -->
				<div class="col-xs-12">
					<!-- box -->
					<div class="box box-info">
						<!--box Header -->
						<div class="box-header with-border">
							<h3 class="box-title col-xs-12">Master Data Sparepart MHE</h3>
							<label class="label label-danger" style="margin-left: 15px">
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
						<!--./box Header -->

						<!-- box-body -->
            <div class="box-body table-responsive">   
              <table id="table1" class="table table-striped table-bordered table-hover responsive nowrap">
				        <thead>
				          <tr>
                    <th>Photo</th>
				          	<th>Nama Sparepart</th>
				            <th>Harga</th> 
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
                    <td><img height="120" <?php if($data->photo_filename == "") { ?> src="<?=set_url('uploads/photo_sprt_mhe/NO IMAGE AVAILABLE.png')?>" <?php } else { ?> src="<?=set_url('uploads/photo_sprt_mhe/'.$data->photo_filename)?>" <?php } ?> alt="Photo"/></td>
				    				<td><?=$data->nama_sprt?></td>
                    <td><?=format_rupiah($data->harga_sprt)?></td>
                    <td>
                      <div class="btn-group">
                        <a type="button" class="btn btn-danger" href="<?=set_url('Sparepart_mhe/delete/'.base64_encode($data->sprt_id))?>" onclick="return confirm('Anda yakin ingin menghapus Sparepart MHE <?=$data->nama_sprt?> ??')" data-toggle="tooltip" title="DELETE!"><i class="fa fa-trash-o"></i></a>
                        <a type="button" class="btn btn-warning edit_button" href="#editSparepart" data-toggle="modal"
                          data-id="<?=$data->sprt_id?>"
                          data-name="<?=$data->nama_sprt?>"
                          data-harga="<?=$data->harga_sprt?>"><i class="fa fa-edit"></i></a>
                      </div>
                    </td>
				          </tr>
								<?php } ?>
				        </tbody>
				      </table>  
            </div>
            <!-- /.box-body -->

            <!-- box footer -->
            <?php if (($user->akses == 99) || ($user_detail->dir_id == 4)) { ?>
            <div class="box-footer" align="right">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSparepart"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
            </div>
            <?php } ?>
            <!-- ./box footer -->
					</div>
					<!-- ./box -->
				</div>
				<!-- col -->
			</dov>
			<!-- ./row -->
		</section>
		<!-- ./Main Content -->
	</div>
  <!-- ./Content Wrapper. Contains page content -->

  <!-- Modal -->
  <div class="modal modal-info fade" id="addSparepart">
    <!-- modal-dialog -->
    <div class="modal-dialog">
      <!-- modal-content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry Sparepart</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('Sparepart_mhe/insert');?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Nama Sparepart</label>
              <input type="text" class="form-control" name="nama_sprt" placeholder="Enter Nama Sparepart" required pattern="[a-z -_A-Z]{5,}" title="Alphabet only, 5 characters minimum" autofocus>
            </div>
            <div class="form-group">
              <label>Harga Sparepart</label>
              <input type="number" class="form-control" name="harga_sprt" placeholder="Enter Harga Sparepart" required pattern="[0-9]{4,}" title="Number only, 4 characters minimum">
            </div>
            <div class="form-group">
              <label for="photo">Sparepart Photo</label>
              <input type="file" class="filestyle" name="photo" accept="image/jpeg,image/png">
              <p class="help-block">Input Sparepart photo here...<sup>(max. file size: 3MB)</sup></p>
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

  <div class="modal modal-info fade" id="editSparepart">
    <!-- modal-dialog -->
    <div class="modal-dialog">
      <!-- modal-content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Edit Sparepart</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('Sparepart_mhe/update');?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="no_kontrak">Nama Sparepart</label>
              <input type="text" class="form-control nama_sprt" name="nama_sprt" required pattern="[a-z -_A-Z]{5,}" title="Alphabet only, 5 characters minimum" autofocus>
              <input type="hidden" name="sprt_id" class="form-control sprt_id">
            </div>
            <div class="form-group">
              <label>Harga Sparepart</label>
              <input type="number" class="form-control harga_sprt" name="harga_sprt" required pattern="[0-9]{4,}" title="Number only, 4 characters minimum">
            </div>
            <div class="form-group">
              <label for="photo">Sparepart Photo</label>
              <input type="file" class="filestyle" name="photo" accept="image/jpeg,image/png">
              <p class="help-block">Input Sparepart photo here...<sup>(max. file size: 3MB)</sup></p>
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
  <!-- ./Modal -->

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

    $(document).on( "click", '.edit_button',function(e) {
      var id = $(this).data('id');
      var name = $(this).data('name');
      var harga = $(this).data('harga');

      $(".sprt_id").val(id);
      $(".nama_sprt").val(name);
      $(".harga_sprt").val(harga);
  });
   </script>