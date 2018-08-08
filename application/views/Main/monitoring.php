  <script type="text/javascript">
    var chk_auto = "";
    var auto_refresh = setInterval(
        function (){
            if(chk_auto){
                // Jika di centang maka akan auto refresh
                get_data_monitor();
            }
        }, 
        1000 // Interval auto refresh 1000 = 1 Detik
    ); 
    
    function logout_user(id,username){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().'monitoring/logout_user'; ?>",
            data: {"id":id},
            success: function(resp){
                    alert("User " + username + " berhasil di logout");
                    get_data_monitor();
            },
            error:function(event, textStatus, errorThrown) {
                alert('Aksi gagal dilakukan, Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
            },
            timeout: 4000 // Timeout query request 4 Detik
        });
    };
    
    function get_data_monitor(){
        chk_auto = $("#chkAutoRefresh").is(':checked');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().'monitoring/get_data_monitoring'; ?>",
            success: function(resp){
                    $("#rmonitoringuser").html(resp);
            },
            error:function(event, textStatus, errorThrown) {
                $("#rmonitoringuser").html('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
            },
            timeout: 4000
        });
    }
    
    get_data_monitor();
  </script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Realtime
        <small>Monitoring User</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=set_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Realtime Monitoring</li>
      </ol>
		</section>

    <!-- Main content -->
    <section class="content">
      <!-- row -->
      <div class="row">
        <!-- col -->
        <div class="col-xs-12">
          <!-- box -->
          <div class="box box-primary">
            <!-- box-body -->
            <div class="box-body">    
              <div class="checkbox">
                <label>
                    <input type="checkbox" name="chkAutoRefresh" id="chkAutoRefresh" onclick="get_data_monitor();" /> Auto Refresh
                </label>
              </div>
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Last Login</th>
                    <th>Username</th>
                    <th>IP Address</th>
                    <th>Browser</th>
                    <th>Platform</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="rmonitoringuser">
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
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