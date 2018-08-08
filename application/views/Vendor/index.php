	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header(Page Header) -->
		<section class="content-header">
			<h1>
				<a href="<?=set_url('Vendor')?>" style="color: #222D32">Vendor MHE</a>
				<small>Control Panel</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?=set_url('Dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Vendor MHE</li>
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
					<div class="box box-danger">
						<!--box Header -->
						<div class="box-header with-border">
							<h3 class="box-title col-xs-12">Master Data Vendor MHE</h3>
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
				          	<th>Nama Vendor</th>
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
										$data = $pack[0]; ?>
                  <tr>
				    				<td><?=$data->nama_vendor?></td>
                    <td><?=$data->alamat?></td>
                    <td>
                      <div class="btn-group">
                        <a type="button" class="btn btn-danger" href="<?=set_url('Vendor/delete/'.base64_encode($data->vdr_id))?>" onclick="return confirm('Anda yakin ingin menghapus Vendor <?=$data->nama_vendor?> ??')" data-toggle="tooltip" title="DELETE!"><i class="fa fa-trash-o"></i></a>
                        <a type="button" class="btn btn-warning edit_button" href="#editVendor" data-toggle="modal"
                          data-id="<?=$data->vdr_id?>"
                          data-name="<?=$data->nama_vendor?>"
                          data-alamat="<?=$data->alamat?>"><i class="fa fa-edit"></i></a>
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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addVendor"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
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
  <div class="modal modal-info fade" id="addVendor">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry Vendor</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('Vendor/insert');?>" method="post">
            <div class="form-group">
              <label>Nama Vendor</label>
              <input type="text" class="form-control" name="nama_vendor" autofocus placeholder="Enter Nama Vendor" required pattern="[a-z .A-Z]{5,}" title="Alphabet only, 5 characters minimum" style="text-transform:uppercase">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" name="alamat" rows="3" placeholder="Input Address..." required></textarea>
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

  <div class="modal modal-info fade" id="editVendor">
  	<!-- modal-dialog -->
    <div class="modal-dialog">
    	<!-- modal-content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Edit Vendor</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('Vendor/update');?>" method="post">
            <div class="form-group">
              <label for="no_kontrak">Nama Vendor</label>
              <input type="text" class="form-control nama_vendor" name="nama_vendor" autofocus required pattern="[a-z .A-Z]{5,}" title="Alphabet only, 5 characters minimum" style="text-transform:uppercase">
              <input type="hidden" name="vdr_id" class="form-control vdr_id">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control alamat" name="alamat" rows="3" required></textarea>
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
      var alamat = $(this).data('alamat');

      $(".vdr_id").val(id);
      $(".nama_vendor").val(name);
      $(".alamat").val(alamat);
  });
   </script>