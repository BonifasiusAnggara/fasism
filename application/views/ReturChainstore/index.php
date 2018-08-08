	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="<?=set_url('ReturChainstore') ?>" style="color: #222D32">Retur Chainstore</a>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=set_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Retur Chainstore</li>
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
              <h3 class="box-title col-xs-12">Master Data RTV</h3>
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
				            <th>Value</th>
                    <th>Status RTV</th>
                    <th>Status Retur</th>
                    <th>Created on</th>
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
                    <td><a href="<?=set_url('uploads/pdf_rtv/'.$data->pdf_filename)?>"><?=$data->no_rtv?></a></td>
                    <td><?=$data->cust_name?></td>
				    				<td><?=$data->cabang_chs?></td>
                    <td><?=$data->dir_slug?></td>
				            <td><?=format_rupiah($data->nominal)?></td>

                    <td <?php
                      if ($data->status == 'Pending') { ?> class ="bg-maroon" <?php } ?>>
                      <?=$data->status?>
                    </td>

                    <td>
                    <?php
                      $query = $this->db->query("SELECT * FROm tbl_register WHERE no_rtv = '$data->no_rtv'");
                      $row = $query->row();
                      if ($row != NULL) {
                        echo "Sudah diretur";
                      }
                    ?>
                    </td>
                    
                    <?php
                      $tgl_buat = explode(' ',$data->created_on);
                      $selisih = strtotime(date('Y-m-d')) - strtotime($tgl_buat[0]);
                      $leadtime = $selisih/(60*60*24);
                      if ($leadtime == 0) { ?>
                      <td>This day</td>
                    <?php } elseif ($leadtime == 1) { ?>
                      <td>Yesterday</td>
                    <?php } else { ?>
                      <td><?=$leadtime.' days ago'?></td>
                    <?php } ?>                    

                    <td><?php if ($row != NULL) { echo $row->nama_driver.' / '.tgl_indo($row->tgl_retur); } ?></td>
                    <td><?php if ($row != NULL) { echo $row->pet_retur; if ($row->tgl_trm_gudang != '0000-00-00') { echo ' / '.tgl_indo($row->tgl_trm_gudang); } } ?></td>
                    
                    <td>
                      <div class="btn-group">
                        <?php if (($user->akses == 99) || ($user_detail->dir_id == 3)) { ?>
                        <a type="button" class="btn btn-danger" href="<?=set_url('ReturChainstore/delete/'.base64_encode($data->rtv_id))?>" onclick="return confirm('Anda yakin ingin menghapus RTV <?=$data->no_rtv?> ??')" data-toggle="tooltip" title="DELETE!" ><i class="fa fa-trash-o"></i></a>
                        <?php } ?>
                        <button type="button" class="btn btn-warning edit_rtv" data-toggle="modal" title="EDIT!" data-target="#editRTV"
                        data-id="<?=$data->rtv_id?>"
                        data-no="<?=$data->no_rtv?>"
                        data-cust="<?=$data->cust_no?>"
                        data-cbg="<?=$data->cabang_chs?>"
                        data-dir="<?=$data->dir_id?>"
                        data-nom="<?=$data->nominal?>"><i class="fa fa-pencil"></i></button>
                        <?php if (($user_detail->dir_id == 3 || $user->akses == 99) && $data->status == 'Pending') { ?>
                        <button type="button" class="btn bg-purple input_cn" data-toggle="modal" title="DONE!" data-target="#inputCN"
                        data-id="<?=$data->rtv_id?>"><i class="fa fa-check-square"></i> Done</button>
                      <?php } ?>
                      </div>                      
                    </td>
				          </tr>
								<?php } ?>
				        </tbody>
				      </table>  
            </div>
            <!-- /.box-body -->
            <?php if (($user_detail->dir_id == 3) || ($user->akses == 99)) { ?>
              <div class="box-footer" align="right">
                <a href="<?=set_url('ReturChainstore/add');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#sendmail1"><i class="fa fa-envelope"></i> Send Mail</button>
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

  <div class="modal modal-info fade" id="sendmail1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry Email Address</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('ReturChainstore/send_mail');?>" method="post">
            <div class="form-group">
              <label>Email Address</label>
              <input type="text" class="form-control" name="mail_to" placeholder="Enter Email Address" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please Enter a valid email format" autofocus>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline">Send mail</button>
        </div>
          </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
  <!-- modal -->
  <div class="modal modal-info fade" id="editRTV">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Edit RTV</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('ReturChainstore/edit_rtv');?>" method="post">
            <div class="form-group">
              <label>No. RTV</label>
              <input type="text" class="form-control no_rtv" disabled>
              <input type="hidden" class="form-control rtv_id" name="rtv_id">
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
              <label for="merk">Nominal</label>
              <input type="number" class="form-control nominal" name="nominal">
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
  <div class="modal modal-info fade" id="inputCN">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Input No. CN</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('ReturChainstore/input_cn');?>" method="post">
            <div class="form-group">
              <label>No. CN</label>
              <input type="text" class="form-control" name="no_cn" required placeholder="Input No. CN" pattern="[0-9]{9}" title="9 Number Only" autofocus>
              <input type="hidden" class="form-control rtv_id" name="rtv_id">
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
        "order": [[ 0, "asc" ]],
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
      var nom = $(this).data('nom');

      $(".rtv_id").val(id);
      $(".no_rtv").val(no);
      $(".cust_no").val(cust);
      $(".cabang_chs").val(cbg);
      $(".dir_id").val(dir);
      $(".nominal").val(nom);
    });

    $(document).on( "click", '.input_cn',function(e) {
      var id = $(this).data('id');

      $(".rtv_id").val(id);
    });
	</script>