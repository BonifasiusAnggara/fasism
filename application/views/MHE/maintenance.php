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
        <li><a href="<?=set_url('MHE') ?>">MHE</a></li>
        <li class="active">Maintenance Record</li>
      </ol>
		</section>
		<!-- ./Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
    	<!-- row -->
      <div class="row">
      	<!-- col -->
        <div class="col-md-12">            
          <!-- box -->
          <div class="box box-success">
            <!-- box-header -->
            <div class="box-header with-border">
              <h3 class="box-title col-md-12">Data MHE</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->            

            <!-- box-body -->
            <div class="box-body">
              <div class="col-xs-3">
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <img class="img-responsive" src="<?=base_url()?>uploads/photo_mhe/<?=$mhe->photo_filename?>" alt="Photo MHE">
                  </div>
                </div>
              </div>
              <div class="col-xs-9">
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <i class="fa fa-bug"></i> <b>Serial Number : </b> <?=$mhe->no_seri?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-bolt"></i> <b>Jenis MHE : </b> <?=$mhe->jenis?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-cc-mastercard"></i> <b>Merk : </b> <?=$mhe->merk?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-calendar"></i> <b>Tahun Pembuatan : </b> <?=$mhe->thn_pembuatan?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-file-text"></i> <b>Keterangan : </b> <?=$mhe->keterangan?>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col -->
      </div>
      <!-- /.row -->

      <!-- row -->
      <div class="row">
        <!-- col -->
        <div class="col-md-12">            
          <!-- box -->
          <div class="box box-info">
            <!-- box-header -->
            <div class="box-header with-border">
              <h3 class="box-title col-md-12">Maintenance Record</h3>
              <label class="label label-danger" style="margin-left: 15px;">
                  <?php echo " Total data " . number_format($jmldata) . " - Ditampilkan dalam " . $this->benchmark->elapsed_time() ." Detik"; ?>
              </label>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            
            <!-- box-body -->
            <div class="box-body table-responsive">   
              <table id="table1" class="table table-striped table-bordered table-hover responsive nowrap">
                <thead>
                  <tr>
                    <th>No. SPK</th>
                    <th>Jenis Maintenance</th>
                    <th>Tanggal</th>                 
                    <th>Vendor</th>
                    <th>Nama Teknisi</th>
                    <th>Catatan</th>  
                    <th>Action</th>               
                  </tr>
                </thead>
                <tbody>
                <?php
                  $a1 = new ArrayIterator($mtc);
                  $Iterator = new MultipleIterator;
                  $Iterator->attachIterator($a1);
                  foreach ($Iterator as $pack) {
                    $mtc = $pack[0]; ?>
                  <tr>
                    <td><a href="<?=set_url('uploads/pdf_maintenance/'.$mtc->pdf_maintenance)?>"><?=$mtc->no_spk?></a></td>
                    <td><?=$mtc->jenis?></td>
                    <td><?=tgl_indo($mtc->tanggal)?></td>
                    <td><?=$mtc->vendor?></td>
                    <td><?=$mtc->nama_teknisi?></td>
                    <td><?=$mtc->catatan?></td>
                    <td>
                      <div class="btn-group">
                        <a type="button" class="btn btn-danger" href="<?=set_url('MHE/delete_mtc/'.base64_encode($mtc->mtc_id))?>" onclick="return confirm('Anda yakin ingin menghapus Mtc. Record <?=$mtc->no_spk?> ??')" data-toggle="tooltip" title="DELETE!"><i class="fa fa-trash-o"></i></a>
                        <a type="button" class="btn btn-warning edit_button" href="#editMaintenance" data-toggle="modal"
                          data-id="<?=$mtc->mtc_id?>"
                          data-no="<?=$mtc->no_spk?>"
                          data-tgl="<?=$mtc->tanggal?>"
                          data-jns="<?=$mtc->jenis?>"                   
                          data-vdr="<?=$mtc->vendor?>"
                          data-name="<?=$mtc->nama_teknisi?>"
                          data-catatan="<?=$mtc->catatan?>"><i class="fa fa-edit"></i></a>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>  
            </div>
            <!-- /.box-body -->
            <?php if (($user->akses == 99) || ($user_detail->dir_id == 4)) { ?>
            <div class="box-footer">
              <button type="button" class="btn bg-maroon add_button" data-toggle="modal" data-target="#addMaintenance"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
            </div>
            <?php } ?>
          </div>
          <!-- /.box -->
        </div>
        <!-- col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modals -->
  <div class="modal modal-info fade" id="addMaintenance">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry Maintenance</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('MHE/add_mtc');?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="no_spk">No. SPK</label>
              <input type="text" class="form-control" name="no_spk" placeholder="Enter No. SPK" required pattern="[0-9a-zA-Z- /_]{5,}" title="Alphabet, numerical, dash, space and underscore only, 5 characters minimum" style="text-transform:uppercase" autofocus>
              <input type="hidden" class="form-control" name="mhe_id" value="<?=$mhe->mhe_id?>">
            </div>
            <div class="form-group">
              <label>Jenis Service</label><br>
              <select class="select2" name="jenis" required style="width: 100%;">
                <option value="">:: Pilih Jenis Service ::</option>
                <option value="Maintenance Rutin 2 bulan">Maintenance Rutin 2 bulan</option>
                <option value="Service Ringan">Service Ringan</option>
                <option value="Service Sedang">Service Sedang</option>
                <option value="Service Berat">Service Berat</option>
                <option value="Ganti Sparepart">Ganti Sparepart</option>
              </select>
            </div>
            <div class="form-group">
              <label for="tanggal_lahir">Tanggal Service</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right" name="tanggal" required>
              </div>
            </div>
            <div class="form-group">
              <label>Vendor</label><br>
              <select class="select2" name="vendor" required style="width: 100%;">
                <option value="">:: Pilih Vendor ::</option>
                <?php foreach ($vendor as $key) { ?>
                  <option value="<?=$key->nama_vendor?>"><?=$key->nama_vendor?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="nama_teknisi">Nama Teknisi</label>
              <input type="text" class="form-control" name="nama_teknisi" placeholder="Enter Technician" required pattern="[a-z A-Z]{3,}" title="Alphabet only">
            </div>
            <div class="form-group">
              <label>Catatan</label>
              <textarea class="form-control" name="catatan" rows="3" placeholder="Some Note..." required></textarea>
            </div>
            <div class="form-group">
              <label for="pdf_spk">PDF SPK</label>
              <input type="file" class="filestyle" name="pdf" accept="image/jpeg,image/png,pdf">
              <p class="help-block">Input Your pdf here...<sup>(max. file size: 8MB)</sup></p>
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

  <div class="modal modal-info fade" id="editMaintenance">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Edit Maintenance</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('MHE/edit_mtc');?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="no_spk">No. SPK</label>
              <input type="text" class="form-control no_spk" name="no_spk" required pattern="[0-9a-zA-Z- /_]{5,}" title="Alphabet, numerical, dash, space and underscore only, 5 characters minimum" style="text-transform:uppercase" autofocus>
              <input type="hidden" class="form-control mtc_id" name="mtc_id">
              <input type="hidden" class="form-control" name="mhe_id" value="<?=$mhe->mhe_id?>">
            </div>
            <div class="form-group">
              <label>Jenis Service</label><br>
              <select class="jenis select2" name="jenis" required style="width: 100%;">
                <option>:: Pilih Jenis Service ::</option>
                <option value="Maintenance Rutin 2 bulan">Maintenance Rutin 2 bulan</option>
                <option value="Service Ringan">Service Ringan</option>
                <option value="Service Sedang">Service Sedang</option>
                <option value="Service Berat">Service Berat</option>
                <option value="Ganti Sparepart">Ganti Sparepart</option>
              </select>
            </div>
            <div class="form-group">
              <label>Tanggal Service</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right tanggal" name="tanggal" required>
              </div>
            </div>
            <div class="form-group">
              <label>Vendor</label><br>
              <select class="vendor select2" name="vendor" required style="width: 100%;">
                <option>:: Pilih Vendor ::</option>
                <?php foreach ($vendor as $key) { ?>
                  <option value="<?=$key->nama_vendor?>"><?=$key->nama_vendor?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="nama_teknisi">Nama Teknisi</label>
              <input type="text" class="form-control nama_teknisi" name="nama_teknisi" placeholder="Enter Technician" required pattern="[a-z A-Z]{3,}" title="Alphabet only">
            </div>
            <div class="form-group">
              <label>Catatan</label>
              <textarea class="form-control catatan" name="catatan" rows="3" placeholder="Some Note..." required></textarea>
            </div>
            <div class="form-group">
              <label for="pdf_spk">PDF SPK</label>
              <input type="file" class="filestyle" name="pdf" accept="image/jpeg,image/png,pdf">
              <p class="help-block">Input Your pdf here...<sup>(max. file size: 8MB)</sup></p>
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
  <!-- /.modals -->

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

    $(document).on( "click", '.edit_button',function(e) {
      //Initialize Select2 Elements
      $(".select2").select2();
      var id = $(this).data('id');
      var no = $(this).data('no');      
      var tgl = $(this).data('tgl');
      var jns = $(this).data('jns');
      var vdr = $(this).data('vdr');
      var name = $(this).data('name');
      var catatan = $(this).data('catatan');

      $(".mtc_id").val(id);
      $(".no_spk").val(no);
      $(".tanggal").val(tgl);
      $(".jenis").val(jns);
      $(".vendor").val(vdr);
      $(".nama_teknisi").val(name);
      $(".catatan").val(catatan);
    });

    $(document).on("click", '.add_button', function(e){
      //Initialize Select2 Elements
      $(".select2").select2();
    });
  </script>
