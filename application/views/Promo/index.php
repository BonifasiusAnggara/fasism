	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="<?=set_url('Promo') ?>" style="color: #222D32">Faktur Sisa Promo</a>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=set_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Faktur Sisa Promo</li>
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
              <h3 class="box-title col-xs-12">Master Data Promo</h3>
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
				            <th>Nominal</th>
				            <th>No. Potongan Kwitansi</th>
                    <th>No. Koreksi Kwitansi</th>
                    <th>No. Payment</th>
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

                    <td><?=format_rupiah($data->nominal)?></td>
				            <td><?=$data->no_pot_kwit?></td>

                    <?php if(($data->no_kor_kwit == '') && (($user_detail->dir_id == 3) || ($user->akses == 99))) { ?>
                    <td align="center">
                      <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#NoKorKwit" data-id="<?=$data->promo_id?>">Entry Data</button>
                    </td>
                    <?php } else { ?>
                    <td><?=$data->no_kor_kwit?></td>
                    <?php } ?>

                    <?php if(($data->no_payment == '') && (($user_detail->dir_id == 3) || ($user->akses == 99))) { ?>
                    <td align="center">
                      <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#NoPayment" data-id="<?=$data->promo_id?>">Entry Data</button>
                    </td>
                    <?php } else { ?>
                    <td><?=$data->no_payment?></td>
                    <?php } ?>

                    <td>
                      <div class="btn-group">
                        <a type="button" class="btn btn-danger" href="<?=set_url('Promo/delete/'.base64_encode($data->promo_id))?>" onclick="return confirm('Anda yakin ingin menghapus No Faktur <?=$data->no_faktur?> ??')" data-toggle="tooltip" title="DELETE!" ><i class="fa fa-trash-o"></i></a>
                        <button type="button" class="btn btn-warning edit_promo" data-toggle="modal" title="EDIT!" data-target="#editPromo"
                        data-id="<?=$data->promo_id?>"
                        data-cust="<?=$data->cust_no?>"
                        data-no="<?=$data->no_faktur?>"
                        data-nilai="<?=$data->nominal?>"
                        data-pot="<?=$data->no_pot_kwit?>"><i class="fa fa-pencil"></i></button>
                        <?php if ($user->akses == 99) { ?>
                        <a type="button" class="btn btn-success" href="<?=set_url('Promo/reset/'.base64_encode($data->promo_id))?>" onclick="return confirm('Anda yakin ingin mereset Faktur <?=$data->no_faktur?> ??')" data-toggle="tooltip" title="RESET!" ><i class="fa fa-refresh"></i></a>
                        <?php } ?>
                        <?php if (($data->no_payment != '') && (($user_detail->dir_id == 3) || ($user->akses == 99))) { ?>
                        <a href="<?=set_url('Promo/done/'.base64_encode($data->promo_id));?>" class="btn bg-purple"><i class="fa fa-check-square"></i> Done</a>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPromo"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#sendmail"><i class="fa fa-envelope"></i> Send Mail</button>
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
  <div class="modal modal-info fade" id="tambahPromo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Tambah Faktur Sisa</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('Promo/insert');?>" method="post">
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
              <label>Nominal</label>
              <input type="number" class="form-control" name="nominal" required placeholder="Enter Nominal">
            </div>
            <div class="form-group">
              <label>No. Potongan Kwitansi</label>
              <input type="text" class="form-control" name="no_pot_kwit" required placeholder="Enter No. Potongan Kwitansi" required pattern="[[0-9a-zA-Z ./-]{3,}" title="0-9a-zA-Z ./- only">
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
          <form role="form" action="<?=set_url('Promo/send_mail');?>" method="post">
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

  <div class="modal modal-info fade" id="NoKorKwit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry No. Koreksi Kwitansi</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('Promo/no_kor_kwit');?>" method="post">
            <div class="form-group">
              <label>No. Koreksi Kwitansi</label>
              <input type="text" class="form-control" name="no_kor_kwit" placeholder="Enter No. Koreksi Kwitansi" required pattern="[0-9a-zA-Z ./-]{3,}" title="0-9a-zA-Z ./- only" autofocus>
              <input type="hidden" class="form-control promo_id" name="promo_id" required>
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

  <div class="modal modal-info fade" id="NoPayment">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry No. Payment</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('Promo/no_payment');?>" method="post">
            <div class="form-group">
              <label>No. Payment</label>
              <input type="text" class="form-control" name="no_payment" placeholder="Enter No. Payment" required pattern="[0-9a-zA-Z ./-]{3,}" title="0-9a-zA-Z ./- only" autofocus>
              <input type="hidden" class="form-control promo_id" name="promo_id" required>
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
  
  <div class="modal modal-info fade" id="editPromo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Edit Faktur Sisa</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('Promo/update');?>" method="post">
            <div class="form-group">
              <label>No. Faktur</label>
              <input type="number" class="form-control no_faktur" disabled>
              <input type="hidden" class="form-control promo_id" name="promo_id">
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
              <label>Nominal</label>
              <input type="number" class="form-control nominal" name="nominal" required>
            </div>
            <div class="form-group">
              <label>No. Potongan Kwitansi</label>
              <input type="text" class="form-control no_pot_kwit" name="no_pot_kwit" required>
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
      $(".promo_id").val(id);
    });

    $(document).on( "click", '.edit_promo',function(e) {
      var id = $(this).data('id');
      var cust = $(this).data('cust');
      var no = $(this).data('no');      
      var nilai = $(this).data('nilai');
      var pot = $(this).data('pot');

      $(".promo_id").val(id);
      $(".cust_no").val(cust);
      $(".no_faktur").val(no);
      $(".nominal").val(nilai);
      $(".no_pot_kwit").val(pot);
  });
	</script>