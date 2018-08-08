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
        <li class="active">Sparepart Record</li>
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
          <div class="box box-info">
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
              <h3 class="box-title col-md-12">Sparepart Record</h3>
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
                    <th>Spareparts</th>
                    <th>Tanggal</th>                 
                    <th>Vendor</th>
                    <th>Nama Teknisi</th>
                    <th>Biaya</th>
                    <th>Catatan</th>
                    <th>Action</th>               
                  </tr>
                </thead>
                <tbody>
                <?php
                  $a1 = new ArrayIterator($sprec);
                  $a2 = new ArrayIterator($spareparts);
                  $Iterator = new MultipleIterator;
                  $Iterator->attachIterator($a1);
                  $Iterator->attachIterator($a2);
                  foreach ($Iterator as $pack) {
                    $sprec = $pack[0];
                    $sprts = $pack[1]; ?>
                  <tr>
                    <td><a href="<?=set_url('uploads/pdf_sprec/'.$sprec->pdf_sprec)?>"><?=$sprec->no_spk?></a></td>
                    <td>
                      <?php
                        foreach ($sprts as $key) {
                          echo $key->nama_sprt.', ';
                        }
                      ?>
                    </td>
                    <td><?=tgl_indo($sprec->tanggal)?></td>
                    <td><?=$sprec->vendor?></td>
                    <td><?=$sprec->nama_teknisi?></td>
                    <td><?=format_rupiah($sprec->biaya)?></td>
                    <td><?=$sprec->catatan?></td>
                    <td>
                      <div class="btn-group">
                        <a type="button" class="btn btn-danger" href="<?=set_url('MHE/delete_sprec/'.base64_encode($sprec->sprec_id))?>" onclick="return confirm('Anda yakin ingin menghapus Sparepart Record <?=$sprec->no_spk?> ??')" data-toggle="tooltip" title="DELETE!"><i class="fa fa-trash-o"></i></a>
                        <a type="button" class="btn btn-warning edit_button" href="#editSprec" data-toggle="modal"
                          data-id="<?=$sprec->sprec_id?>"
                          data-no="<?=$sprec->no_spk?>"
                          data-tgl="<?=$sprec->tanggal?>"
                          data-vdr="<?=$sprec->vendor?>"
                          data-name="<?=$sprec->nama_teknisi?>"
                          data-biaya="<?=$sprec->biaya?>"
                          data-catatan="<?=$sprec->catatan?>"><i class="fa fa-edit"></i></a>
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
              <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#addSprec"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
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
  <div class="modal modal-info fade" id="addSprec">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry Sparepart Record</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('MHE/add_sprec');?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="no_spk">No. SPK</label>
              <input type="text" class="form-control" name="no_spk" placeholder="Enter No. SPK" required pattern="[0-9a-zA-Z- /_]{5,}" title="Alphabet, numerical, dash, space and underscore only, 5 characters minimum" style="text-transform:uppercase">
              <input type="hidden" class="form-control" name="mhe_id" value="<?=$mhe->mhe_id?>">
            </div>
            <div class="form-group">
              <label>Sparepart</label><br>
              <select class="form-control select2" name="sparepart[]" required multiple="multiple" data-placeholder="Select spareparts" style="width: 100%;">
                <?php foreach ($sprt as $key) { ?>
                  <option value="<?=$key->sprt_id?>"><?=$key->nama_sprt?></option>
                <?php } ?>
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
              <label for="total_biaya">Total Biaya</label>
              <input type="number" class="form-control" name="biaya" placeholder="Enter Total Cost" required pattern="[0-9]{3,}" title="Numeric only">
            </div>
            <div class="form-group">
              <label>Catatan</label>
              <textarea class="form-control" name="catatan" rows="3" placeholder="Some Note..." required></textarea>
            </div>
            <div class="form-group">
              <label for="pdf_spk">PDF SPK</label>
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

  <div class="modal modal-info fade" id="editSprec">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Edit Sparepart Record</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('MHE/edit_sprec');?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="no_spk">No. SPK</label>
              <input type="text" class="form-control no_spk" name="no_spk" required pattern="[0-9a-zA-Z- /_]{5,}" title="Alphabet, numerical, dash, space and underscore only, 5 characters minimum" style="text-transform:uppercase" autofocus>
              <input type="hidden" class="form-control" name="mhe_id" value="<?=$mhe->mhe_id?>">
              <input type="hidden" class="form-control sprec_id" name="sprec_id">
            </div>
            <div class="form-group">
              <label>Sparepart</label><br>
              <select class="form-control select2" name="sparepart[]" required multiple="multiple" data-placeholder="Select spareparts" style="width: 100%;">
                <?php foreach ($sprt as $key) { ?>
                  <option value="<?=$key->sprt_id?>"><?=$key->nama_sprt?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="tanggal_lahir">Tanggal Service</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right tanggal" name="tanggal" required>
              </div>
            </div>
            <div class="form-group">
              <label>Vendor</label><br>
              <select class="vendor select2" name="vendor" style="width: 100%;" required>
                <option>:: Pilih Vendor ::</option>
                <?php foreach ($vendor as $key) { ?>
                  <option value="<?=$key->nama_vendor?>"><?=$key->nama_vendor?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="nama_teknisi">Nama Teknisi</label>
              <input type="text" class="form-control nama_teknisi" name="nama teknisi" placeholder="Enter Technician" required pattern="[a-z A-Z]{3,}" title="Alphabet only">
            </div>
            <div class="form-group">
              <label for="total_biaya">Total Biaya</label>
              <input type="number" class="form-control biaya" name="biaya" placeholder="Enter Total Cost" required pattern="[0-9]{3,}" title="Numeric only">
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

      //Initialize Select2 Elements
      $(".select2").select2();
    });

    $(document).on( "click", '.edit_button',function(e) {
      var id = $(this).data('id');
      var no = $(this).data('no');    
      var tgl = $(this).data('tgl');
      var vdr = $(this).data('vdr');
      var name = $(this).data('name');
      var biaya = $(this).data('biaya');
      var catatan = $(this).data('catatan');

      $(".sprec_id").val(id);
      $(".no_spk").val(no);
      $(".tanggal").val(tgl);
      $(".vendor").val(vdr);
      $(".nama_teknisi").val(name);
      $(".biaya").val(biaya);
      $(".catatan").val(catatan); 
  });
  </script>
