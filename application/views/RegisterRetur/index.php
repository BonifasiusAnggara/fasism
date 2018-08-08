	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="<?=set_url('RegisterRetur') ?>" style="color: #222D32">Register Retur NKA</a>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=set_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Register Retur NKA</li>
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
          <div class="box box-primary">
          	<!-- box-header -->
            <div class="box-header with-border">
              <h3 class="box-title col-xs-12">Master Data Retur</h3>
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
				          	<th>No. RTV</th>
                    <th>Nama Outlet</th>
				            <th>Cabang Chainstore</th>
                    <th>Direktorat</th>
                    <th>Nama Driver / Tgl. Retur</th>
                    <th>Pet. Retur / Tgl. Terima Gudang</th>
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
                    <td><?=$data->no_rtv?></td>
                    <td><?=$data->cust_name?></td>
				    				<td><?=$data->cabang_chs?></td>
                    <td><?=$data->dir_slug?></td>
                    <td><?=$data->nama_driver.' / '.tgl_indo($data->tgl_retur)?></td>
                    <td><?=$data->pet_retur; if ($data->tgl_trm_gudang != '0000-00-00') {
                            echo ' / '.tgl_indo($data->tgl_trm_gudang);
                    } ?></td>
                    
                    <td>
                      <div class="btn-group">
                        <?php if (($user->akses == 99) || ($user_detail->dir_id == 4) || ($user_detail->dir_id == 5)) { ?>
                        <a type="button" class="btn btn-danger" href="<?=set_url('RegisterRetur/delete/'.base64_encode($data->reg_id))?>" onclick="return confirm('Anda yakin ingin menghapus Retur <?=$data->no_rtv?> ??')" data-toggle="tooltip" title="DELETE!" ><i class="fa fa-trash-o"></i></a>
                        <?php } ?>
                        <button type="button" class="btn btn-warning edit_rtv" data-toggle="modal" title="EDIT!" data-target="#editRetur"
                        data-id="<?=$data->reg_id?>"
                        data-no="<?=$data->no_rtv?>"
                        data-cust="<?=$data->cust_no?>"
                        data-cbg="<?=$data->cabang_chs?>"
                        data-dir="<?=$data->dir_id?>"
                        data-driver="<?=$data->nama_driver?>"
                        data-petr="<?=$data->pet_retur?>"><i class="fa fa-pencil"></i></button>
                        <?php if (($user->akses == 99 || $user_detail->dir_id == 4) && ($data->pet_retur == '')) { ?>
                        <button type="button" class="btn bg-purple approve" data-toggle="modal" title="APPROVE!" data-target="#approve"
                        data-id="<?=$data->reg_id?>"><i class="fa fa-check-square"></i> Approve</button>
                        <?php } ?>
                      </div>                      
                    </td>
				          </tr>
								<?php } ?>
				        </tbody>
				      </table>  
            </div>
            <!-- /.box-body -->
            <?php if (($user_detail->dir_id == 5) || ($user->akses == 99)) { ?>
              <div class="box-footer" align="right">
                <a href="<?=set_url('RegisterRetur/add');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
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


  <div class="modal modal-info fade" id="editRetur">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Edit Retur</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('RegisterRetur/edit_retur');?>" method="post">
            <div class="form-group">
              <label>No. RTV</label>
              <input type="text" class="form-control no_rtv" disabled>
              <input type="hidden" class="form-control reg_id" name="reg_id">
            </div>
            <div class="form-group">
              <label>Nama Outlet</label><br>
              <select class="cust_no select2" name="cust_no" required style="width: 100%;">
                <option value="">:: Pilih Outlet ::</option>
                <?php foreach ($cust as $key) { ?>
                  <option value="<?=$key->cust_no?>"><?=$key->cust_name?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="jenis">Cabang Chainstore</label>
              <input type="text" class="form-control cabang_chs" name="cabang_chs" autofocus>
            </div>
            <div class="form-group">
              <label>Direktorat</label>
              <select class="dir_id form-control select2" name="dir_id" required style="width: 100%;">
                <option value="">:: Pilih Direktorat ::</option>
                <?php foreach ($direktorat as $key => $value) { ?>
                  <option value="<?php echo $value->dir_id ?>"><?php echo $value->dir_slug ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="nama_belakang">Nama Driver</label>
              <input type="text" class="form-control driver" name="nama_driver" placeholder="Enter Driver Name" required pattern="[a-z .A-Z]{3,}" title="Alphabet only">
            </div>

            <div class="form-group">
              <label for="nama_belakang">Petugas Retur</label>
              <input type="text" class="form-control pet_retur" name="pet_retur" placeholder="Enter Warehouseman Name" required pattern="[a-z .A-Z]{3,}">
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
  <!-- /.modal -->

  <!-- modal -->
  <div class="modal modal-info fade" id="approve">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Input Nama Penerima</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('RegisterRetur/approve');?>" method="post">
            <div class="form-group">
              <label>Pet. Retur</label>
              <input type="text" class="form-control" name="pet_retur" required placeholder="Input Nama Pet. Retur" pattern="[a-z. A-Z]{3,}" title="Alphabet only" autofocus>
              <input type="hidden" class="form-control reg_id" name="reg_id">
            </div>

            <div class="form-group">
              <label for="tanggal_retur">Tanggal Terima Gudang</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" disabled value="<?php echo tgl_indo(date('Y-m-d')); ?>">
              </div>
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
  <!-- /.modal -->

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

      //Initialize Select2 Elements
      $(".select2").select2();
    });

    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).on( "click", '.edit_rtv',function(e) {
      var id = $(this).data('id');
      var no = $(this).data('no');     
      var cust = $(this).data('cust');
      var cbg = $(this).data('cbg');
      var dir = $(this).data('dir');
      var driver = $(this).data('driver');
      var tgl = $(this).data('tgl');
      var petr = $(this).data('petr');

      $(".reg_id").val(id);
      $(".no_rtv").val(no);
      $(".cust_no").val(cust);
      $(".cabang_chs").val(cbg);
      $(".dir_id").val(dir);
      $(".driver").val(driver);
      $(".pet_retur").val(petr);
    });

    $(document).on( "click", '.approve',function(e) {
      var id = $(this).data('id');

      $(".reg_id").val(id);
    });
	</script>