	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="<?=set_url('TukarGuling') ?>" style="color: #222D32">Tukar Guling</a>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=set_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tukar Guling</li>
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
              <h3 class="box-title col-xs-12">Master Data Tukar Guling</h3>
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
				          	<th>No. TTRB</th>
                    <th>No. Customer</th>
                    <th>Nama Customer</th>
                    <th>Status</th>                     
				            <th>Tgl. Terima Barang</th>
				            <th>Surat Pesanan</th>
                    <th>Keterangan</th>
                    <th>Item</th>
                    <th>No / Tgl. BPB</th>
                    <th>No / Tgl. BKB</th>
                    <th>Tgl. Ambil Dokumen</th>
                    <th>Nama Pengirim / Tgl. Kirim</th>
                    <th>Tgl. Kembali Dokumen</th>
                    <th>Lead Time</th>
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
                    <td><?=$data->no_ttrb?></td>
                    <td><?=$data->cust_no?></td>
                    <td><?=$data->cust_name?></td>

                    <td <?php
                      if ($data->status == 'RECEIVED') { ?> style="color:#FF1493;" <?php } 
                      else if ($data->status == 'PROCESSED') { ?> style="color:#6495ED;" <?php }
                      else if ($data->status == 'SHIPPED') { ?> style="color:   #DC143C;" <?php } 
                      else if ($data->status == 'DELIVERED') { ?> style="color:#00BFFF;" <?php } ?>>
                      <?=$data->status?>
                    </td>

                    <?php if ($data->tgl_trm_brg == '0000-00-00') { ?>
                    <td></td>
                    <?php } else { ?>
                    <td><?=tgl_indo($data->tgl_trm_brg)?></td>
                    <?php } ?>

                    <td><?=$data->sp?></td>
                    <td><?=$data->keterangan?></td>

                    <td align="center"><a type="button" class="btn btn-block bg-maroon" href="<?=set_url('TukarGuling/detail_item/'.sha1($data->tg_id))?>" data-toggle="tooltip" title="View Detail!"><i class="fa fa-shopping-cart"></i></a></td>

                    <?php if(($data->no_bpb == '') && (($user_detail->dir_id == 4) || ($user->akses == 99))) { ?>
                    <td align="center">
                      <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#dataBPB" data-id="<?=$data->tg_id?>">Entry Data</button>
                    </td>
                    <?php } else { 
                      if ($data->tgl_bpb == '0000-00-00') { ?>
                        <td><?=$data->no_bpb?></td>
                      <?php } else { ?> 
                        <td><?=$data->no_bpb.', '.tgl_indo($data->tgl_bpb)?></td>
                      <?php } ?>
                    <?php } ?>

                    <?php if(($data->no_bkb == '') && (($user_detail->dir_id == 4) || ($user->akses == 99))) { ?>
                    <td align="center">
                      <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#dataBKB" data-id="<?=$data->tg_id?>" <?php if ($data->no_bpb == '') { ?> disabled <?php } ?>>Entry Data</button>
                    </td>
                    <?php } else { 
                      if ($data->tgl_bkb == '0000-00-00') { ?>
                        <td><?=$data->no_bkb?></td>
                      <?php } else { ?> 
                        <td><?=$data->no_bkb.', '.tgl_indo($data->tgl_bkb)?></td>
                      <?php } ?>
                    <?php } ?>

                    <?php if(($data->tgl_abl_dok == '0000-00-00') && (($user_detail->dir_id == 4) || ($user->akses == 99))) { ?>
                    <td align="center"><button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#TglAblDok" data-id="<?=$data->tg_id?>" <?php if ($data->no_bkb == '') { ?> disabled <?php } ?>>Entry Data
                    </button></td>
                    <?php } else if ($data->tgl_abl_dok == '0000-00-00') { ?>
                    <td></td>
                    <?php } else { ?>
                    <td><?=tgl_indo($data->tgl_abl_dok)?></td>
                    <?php } ?>

                    <?php if(($data->nama_pengirim == '') && (($user_detail->dir_id == 4) || ($user->akses == 99))) { ?>
                    <td align="center">
                      <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#dataKirim" data-id="<?=$data->tg_id?>" <?php if ($data->tgl_abl_dok == '0000-00-00') { ?> disabled <?php } ?>>Entry Data</button>
                    </td>
                    <?php } else { 
                      if ($data->tgl_bkb == '0000-00-00') { ?>
                        <td><?=$data->nama_pengirim?></td>
                      <?php } else { ?> 
                        <td><?=$data->nama_pengirim.', '.tgl_indo($data->tgl_kirim)?></td>
                      <?php } ?>
                    <?php } ?>

                    <?php if(($data->tgl_kbl_dok == '0000-00-00') && (($user_detail->dir_id == 4) || ($user->akses == 99))) { ?>
                    <td align="center"><button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#TglKblDok" data-id="<?=$data->tg_id?>" <?php if ($data->nama_pengirim == '') { ?> disabled <?php } ?>>Entry Data
                    </button></td>
                    <?php } else if ($data->tgl_kbl_dok == '0000-00-00') { ?>
                    <td></td>
                    <?php } else { ?>
                    <td><?=tgl_indo($data->tgl_kbl_dok)?></td>
                    <?php } ?>

                    <?php if ($data->tgl_kbl_dok != '0000-00-00') { ?>
                    <td>
                      <?php 
                        $selisih = strtotime($data->tgl_kbl_dok) - strtotime($data->tgl_trm_brg);
                        $leadtime = $selisih/(60*60*24);
                        echo $leadtime.' Hari';
                      ?>
                    </td>
                    <?php } else { ?>
                    <td></td>
                    <?php } ?>
                    
                    <td>
                      <div class="btn-group">
                        <a type="button" class="btn btn-danger" href="<?=set_url('TukarGuling/delete/'.base64_encode($data->tg_id))?>" onclick="return confirm('Anda yakin ingin menghapus Tukar Guling <?=$data->no_ttrb?> ??')" data-toggle="tooltip" title="DELETE!" ><i class="fa fa-trash-o"></i></a>
                        <button type="button" class="btn btn-warning edit_tg" data-toggle="modal" title="EDIT!" data-target="#editTG"
                        data-id="<?=$data->tg_id?>"
                        data-no="<?=$data->no_ttrb?>"
                        data-cust="<?=$data->cust_no?>"
                        data-tgl="<?=$data->tgl_trm_brg?>"
                        data-sp="<?=$data->sp?>"
                        data-ket="<?=$data->keterangan?>"><i class="fa fa-pencil"></i></button>
                        <a type="button" class="btn btn-success" href="<?=set_url('TukarGuling/reset/'.base64_encode($data->tg_id))?>" onclick="return confirm('Anda yakin ingin mereset Tukar Guling <?=$data->no_ttrb?> ??')" data-toggle="tooltip" title="RESET!" ><i class="fa fa-refresh"></i></a>
                      </div>
                    </td>
				          </tr>
								<?php } ?>
				        </tbody>
				      </table>  
            </div>
            <!-- /.box-body -->
            <?php if (($user_detail->dir_id == 4) || ($user->akses == 99)) { ?>
              <div class="box-footer" align="right">
                <a href="<?=set_url('TukarGuling/add');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                <a href="<?=set_url('TukarGuling/send_mail');?>" class="btn btn-warning"><i class="fa fa-envelope"></i> Send Mail</a>
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
  <div class="modal modal-info fade" id="editTG">
    <!-- modal-dialog -->
    <div class="modal-dialog">
      <!-- modal-content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Edit Tukar Guling</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('TukarGuling/update');?>" method="post">
            <div class="form-group">
              <label>No. TTRB</label>
              <input type="text" class="form-control no_ttrb" name="no_ttrb" required pattern="[a-zA-Z ./-_0-9]{3,}" title="A-Z ./-_0-9 only" style="text-transform:uppercase" autofocus>
              <input type="hidden" class="form-control tg_id" name="tg_id">
            </div>
            <div class="form-group">
              <label>Outlet</label><br>
              <select class="cust_no select2" name="cust_no" required style="width: 100%;">
                <option value="">:: Pilih Outlet ::</option>
                <?php foreach ($cust as $key) { ?>
                  <option value="<?=$key->cust_no?>"><?=$key->cust_name?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Tanggal Terima Barang</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right tgl_trm_brg" name="tgl_trm_brg" required>
              </div>
            </div>
            <div class="form-group">
              <label>SP</label><br>
              <select class="sp select2" name="sp" required style="width: 100%;">
                <option value="">:: Ada / Tidak ada ::</option>
                <option value="Ada">Ada</option>
                <option value="Tidak ada">Tidak ada</option>
              </select>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control keterangan" name="keterangan" rows="3" placeholder="Enter Reason..." required></textarea>
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

  <div class="modal modal-info fade" id="dataBPB">
    <!-- modal-dialog -->
    <div class="modal-dialog">
      <!-- modal-content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry Data BPB</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('TukarGuling/data_BPB');?>" method="post">
            <div class="form-group">
              <label>No. BPB</label>
              <input type="text" class="form-control" name="no_bpb" placeholder="Enter No. BPB" required pattern="[a-z0-9/.- A-Z]{3,}" title="a-z0-9/.- A-Z Only" style="text-transform:uppercase" autofocus>
              <input type="hidden" class="form-control tg_id" name="tg_id" required>
            </div>
            <div class="form-group">
              <label>Tanggal BPB</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right" name="tgl_bpb" required>
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

  <div class="modal modal-info fade" id="dataBKB">
    <!-- modal-dialog -->
    <div class="modal-dialog">
      <!-- modal-content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry Data BKB</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('TukarGuling/data_BKB');?>" method="post">
            <div class="form-group">
              <label>No. BKB</label>
              <input type="text" class="form-control" name="no_bkb" placeholder="Enter No. BKB" required pattern="[a-z0-9/.- A-Z]{3,}" title="a-z0-9/.- A-Z Only" style="text-transform:uppercase" autofocus>
              <input type="hidden" class="form-control tg_id" name="tg_id" required>
            </div>
            <div class="form-group">
              <label>Tanggal BKB</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right" name="tgl_bkb" required>
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

  <div class="modal modal-info fade" id="TglAblDok">
    <!-- modal-dialog -->
    <div class="modal-dialog">
      <!-- modal-content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry Tgl. Ambil Dok.</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('TukarGuling/tgl_abl_dok');?>" method="post">
            <div class="form-group">
              <label>Tanggal Ambil Dokumen</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right" name="tgl_abl_dok" required>
                <input type="hidden" class="form-control tg_id" name="tg_id" required>
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

  <div class="modal modal-info fade" id="dataKirim">
    <!-- modal-dialog -->
    <div class="modal-dialog">
      <!-- modal-content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry Data Pengiriman</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('TukarGuling/data_pengiriman');?>" method="post">
            <div class="form-group">
              <label>Nama Pengirim</label>
              <input type="text" class="form-control" name="nama_pengirim" placeholder="Enter Nama Pengirim" required pattern="[a-z A-Z]{3,}" title="Alphabet Only" autofocus>
              <input type="hidden" class="form-control tg_id" name="tg_id" required>
            </div>
            <div class="form-group">
              <label for="tgl_penarikan">Tanggal Kirim</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right" name="tgl_kirim" required>
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

  <div class="modal modal-info fade" id="TglKblDok">
    <!-- modal-dialog -->
    <div class="modal-dialog">
      <!-- modal-content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry Tgl. Kembali Dok.</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('TukarGuling/tgl_kbl_dok');?>" method="post">
            <div class="form-group">
              <label>Tanggal Kembali Dokumen</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right" name="tgl_kbl_dok" required>
                <input type="hidden" class="form-control tg_id" name="tg_id" required>
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

      //iCheck for checkbox and radio inputs
      $('input[type="radio"].flat-red').iCheck({
        radioClass: 'iradio_flat-green'
      });
    });

    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).on( "click", '.bg-maroon',function(e) {
      var id = $(this).data('id');
      $(".tg_id").val(id);
    });

    $(document).on( "click", '.edit_tg',function(e) {
      var id = $(this).data('id');
      var no = $(this).data('no');      
      var cust = $(this).data('cust');
      var tgl = $(this).data('tgl');
      var sp = $(this).data('sp');
      var ket = $(this).data('ket');

      $(".tg_id").val(id);
      $(".no_ttrb").val(no);
      $(".cust_no").val(cust);
      $(".tgl_trm_brg").val(tgl);
      $(".sp").val(sp);
      $(".keterangan").val(ket);
  });
	</script>