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
        <li><a href="<?=set_url('TukarGuling') ?>">Tukar Guling</a></li>
        <li class="active">Detail Item</li>
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
              <h3 class="box-title col-md-12">Data Tukar Guling</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->            

            <!-- box-body -->
            <div class="box-body">
              <div class="col-xs-6">
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <i class="fa fa-bug"></i> <b>No. TTRB : </b> <?=$header->no_ttrb?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-bolt"></i> <b>Cust No : </b> <?=$header->cust_no?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-cc-mastercard"></i> <b>Cust Name : </b> <?=$header->cust_name?>
                  </li>
                </ul>
              </div>
              <div class="col-xs-6">
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <i class="fa fa-calendar"></i> <b>Tgl. Terima Barang : </b> <?=tgl_indo($header->tgl_trm_brg)?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-file-text"></i> <b>SP : </b> <?=$header->sp?>
                  </li>
                  <li class="list-group-item">
                    <i class="fa fa-bell-o"></i> <b>Keterangan : </b> <?=$header->keterangan?>
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
              <h3 class="box-title col-md-12">Detail Item</h3>
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
                    <th>Item Code</th>
                    <th>Item Desc</th>
                    <th>Batch Num</th>                 
                    <th>Exp. Date</th>
                    <th>Quantity</th>
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
                    <td><?=$data->item_code?></td>
                    <td><?=$data->item_desc?></td>
                    <td><?=$data->batch_num?></td>
                    <td><?=tgl_indo($data->exp_date)?></td>
                    <td align="right"><?=format_ribuan($data->quantity)?></td>
                    <td>
                      <div class="btn-group">
                        <a type="button" class="btn btn-danger" href="<?=set_url('TukarGuling/delete_item/'.base64_encode($data->itg_id))?>" onclick="return confirm('Anda yakin ingin menghapus Item <?=$data->item_desc?> ??')" data-toggle="tooltip" title="DELETE!"><i class="fa fa-trash-o"></i></a>
                        <a type="button" class="btn btn-warning edit_button" href="#editItem" data-toggle="modal"
                          data-id="<?=$data->itg_id?>"
                          data-desc="<?=$data->item_desc?>"
                          data-batch="<?=$data->batch_num?>"
                          data-exp="<?=$data->exp_date?>"
                          data-qty="<?=$data->quantity?>"><i class="fa fa-edit"></i></a>
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
              <button type="button" class="btn bg-maroon add_button" data-toggle="modal" data-target="#addItem"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
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

  <!-- Modal -->
  <div class="modal modal-info fade" id="addItem">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry Item Tukar Guling</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('TukarGuling/add_item');?>" method="post">
            <div class="form-group">
              <label>Item</label><br>
              <select class="form-control select2" name="item_code" required style="width: 100%;">
                <option>:: SELECT ITEM ::</option>
                <?php foreach ($item as $key) { ?>
                  <option value="<?=$key->item_code?>"><?=$key->item_desc?></option>
                <?php } ?>
              </select>
              <input type="hidden" class="form-control" name="tg_id" value="<?=$header->tg_id?>">
            </div>
            <div class="form-group">
              <label>Batch Number</label>
              <input type="text" class="form-control" name="batch_num" placeholder="Enter Batch Number" required pattern="[a-z0-9A-Z .-_/]{3,}" title="a-z0-9A-Z .-_/ only, 3 characters minimum" style="text-transform:uppercase">
            </div>
            <div class="form-group">
              <label>Expired Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right" name="exp_date" required>
              </div>
            </div>
            <div class="form-group">
              <label>Quantity</label>
              <input type="number" class="form-control" name="quantity" placeholder="Enter Quantity" required pattern="[0-9]{1,}" title="Number only">
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline">Save changes</button>
        </div>
          </form>
      </div>
    </div>
  </div>

  <div class="modal modal-info fade" id="editItem">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-text="true">&times;</span></button>
          <h4 class="modal-title">Entry Item Tukar Guling</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?=set_url('TukarGuling/edit_item');?>" method="post">
            <div class="form-group">
              <label>Item</label>
              <input type="text" class="form-control item_desc" disabled>
              <input type="hidden" class="form-control" name="tg_id" value="<?=$header->tg_id?>">
              <input type="hidden" class="form-control itg_id" name="itg_id">
            </div>
            <div class="form-group">
              <label>Batch Number</label>
              <input type="text" class="form-control batch_num" name="batch_num" placeholder="Enter Batch Number" required pattern="[a-z0-9A-Z .-_/]{3,}" title="a-z0-9A-Z .-_/ only, 3 characters minimum" style="text-transform:uppercase">
            </div>
            <div class="form-group">
              <label>Expired Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right exp_date" name="exp_date" required>
              </div>
            </div>
            <div class="form-group">
              <label>Quantity</label>
              <input type="number" class="form-control quantity" name="quantity" placeholder="Enter Quantity" required pattern="[0-9]{1,}" title="Number only">
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline">Save changes</button>
        </div>
          </form>
      </div>
    </div>
  </div>
  <!-- /.Modal -->

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
      var id = $(this).data('id');
      var desc = $(this).data('desc');      
      var batch = $(this).data('batch');
      var exp = $(this).data('exp');
      var qty = $(this).data('qty');

      $(".itg_id").val(id);
      $(".item_desc").val(desc);
      $(".batch_num").val(batch);
      $(".exp_date").val(exp);
      $(".quantity").val(qty);
    });

    $(document).on("click", '.add_button', function(e){
      //Initialize Select2 Elements
      $(".select2").select2();
    });
  </script>
