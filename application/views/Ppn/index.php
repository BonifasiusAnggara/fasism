	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="<?=set_url('Ppn') ?>" style="color: #222D32">Faktur Sisa SSP</a>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=set_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Faktur Sisa SSP</li>
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
              <h3 class="box-title col-xs-12">Master Data SSP</h3>
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
				          	<th>No. Faktur</th>
                    <th>Nama Outlet</th>
                    <th>Status</th>
                    <th>Created on</th>
				            <th>Nilai Faktur</th>
				            <th>Ppn</th>
                    <th>Pph</th>
                    <th>No. NTPN</th>
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
                    <td><?=$data->no_faktur?></td>
                    <td><?=$data->cust_name?></td>

                    <td <?php
                      if ($data->status == 'Pending') { ?> style="color:#FF1493;" <?php }
                      else if ($data->status == 'Done') { ?> style="color:#00BFFF;" <?php } ?>>
                      <?=$data->status?>
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

                    <td><?=format_rupiah($data->nilai_faktur)?></td>
				            <td><?=format_rupiah($data->ppn)?></td>
                    <td><?=format_rupiah($data->pph)?></td>
                    
                    <?php if(($data->no_ntpn == '') && (($user_detail->dir_id == 6) || ($user->akses == 99))) { ?>
                    <td align="center">
                      <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#NoNTPN" data-id="<?=$data->ppn_id?>">Entry Data</button>
                    </td>
                    <?php } else { ?>
                    <td><?=$data->no_ntpn?></td>
                    <?php } ?>

                    <td>
                      <div class="btn-group">
                        <a type="button" class="btn btn-danger" href="<?=set_url('Ppn/delete/'.base64_encode($data->ppn_id))?>" onclick="return confirm('Anda yakin ingin menghapus No Faktur <?=$data->no_faktur?> ??')" data-toggle="tooltip" title="DELETE!" ><i class="fa fa-trash-o"></i></a>
                        <button type="button" class="btn btn-warning edit_ppn" data-toggle="modal" title="EDIT!" data-target="#editPPN"
                        data-id="<?=$data->ppn_id?>"
                        data-cust="<?=$data->cust_no?>"
                        data-no="<?=$data->no_faktur?>"
                        data-nilai="<?=$data->nilai_faktur?>"
                        data-ppn="<?=$data->ppn?>"
                        data-pph="<?=$data->pph?>"><i class="fa fa-pencil"></i></button>
                        <?php if ($user->akses == 99) { ?>
                        <a type="button" class="btn btn-success" href="<?=set_url('Ppn/reset/'.base64_encode($data->ppn_id))?>" onclick="return confirm('Anda yakin ingin mereset Faktur <?=$data->no_faktur?> ??')" data-toggle="tooltip" title="RESET!" ><i class="fa fa-refresh"></i></a>
                        <?php } ?>
                        <?php if (($data->no_ntpn != '') && (($user_detail->dir_id == 3) || ($user->akses == 99))) { ?>
                        <a href="<?=set_url('Ppn/done/'.base64_encode($data->ppn_id));?>" class="btn bg-purple"><i class="fa fa-check-square"></i> Done</a>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPPN"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#sendmail"><i class="fa fa-envelope"></i> Send Mail</button>
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
  <div class="modal modal-info fade" id="tambahPPN">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Tambah Faktur Sisa</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('Ppn/insert');?>" method="post">
            <div class="form-group">
              <label>No. Faktur</label>
              <input type="text" class="form-control" name="no_faktur" pattern="[0-9]{9}" title="Exactly 9 number" autofocus required>
            </div>
            <div class="form-group">
              <label>Nama Outlet</label><br>
              <select class="select2" name="cust_no" required style="width: 100%;">
                <option value="">:: Pilih Outlet ::</option>
                <?php foreach ($cust as $key) { ?>
                  <option value="<?=$key->cust_no?>"><?=$key->cust_name?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Nilai Faktur</label>
              <input type="number" class="form-control" name="nilai_faktur" required placeholder="Enter Nilai Faktur">
            </div>
            <div class="form-group">
              <label>Ppn</label>
              <input type="number" class="form-control" name="ppn" required placeholder="Enter Nilai Ppn">
            </div>
            <div class="form-group">
              <label>Pph</label>
              <input type="number" class="form-control" name="pph" required placeholder="Enter Nilai Pph">
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

  <div class="modal modal-info fade" id="sendmail">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry Email Address</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('Ppn/send_mail');?>" method="post">
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

  <div class="modal modal-info fade" id="NoNTPN">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry No. NTPN</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('Ppn/no_ntpn');?>" method="post">
            <div class="form-group">
              <label for="no_ntpn">No. NTPN</label>
              <input type="text" class="form-control" name="no_ntpn" placeholder="Enter No. NTPN" required pattern="[0-9 a-zA-Z.*_-/]{3,}" title="0-9 a-zA-Z.*_-/ only" autofocus>
              <input type="hidden" class="form-control ppn_id" name="ppn_id" required>
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
  
  <div class="modal modal-info fade" id="editPPN">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Edit Faktur Sisa</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('Ppn/update');?>" method="post">
            <div class="form-group">
              <label>No. Faktur</label>
              <input type="number" class="form-control no_faktur" disabled>
              <input type="hidden" class="form-control ppn_id" name="ppn_id">
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
              <label>Nilai Faktur</label>
              <input type="number" class="form-control nilai_faktur" name="nilai_faktur" required>
            </div>
            <div class="form-group">
              <label>Ppn</label>
              <input type="number" class="form-control ppn" name="ppn" required>
            </div>
            <div class="form-group">
              <label>Pph</label>
              <input type="number" class="form-control pph" name="pph" required>
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

    $(document).on( "click", '.bg-maroon',function(e) {
      var id = $(this).data('id');
      $(".ppn_id").val(id);
    });

    $(document).on( "click", '.edit_ppn',function(e) {
      var id = $(this).data('id');
      var cust = $(this).data('cust');
      var no = $(this).data('no');      
      var nilai = $(this).data('nilai');
      var ppn = $(this).data('ppn');
      var pph = $(this).data('pph');

      $(".ppn_id").val(id);
      $(".cust_no").val(cust);
      $(".no_faktur").val(no);
      $(".nilai_faktur").val(nilai);
      $(".ppn").val(ppn);
      $(".pph").val(pph);
  });
	</script>