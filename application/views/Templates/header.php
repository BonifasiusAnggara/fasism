<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <!-- Dynamic title, takes from app_helper -->
    <title><?=title();?></title>
    <!-- title's logo -->
    <link rel="shortcut icon" type="text/css" href="<?=base_url() ?>assets/images/F1.jpg">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>">
    <!-- Font Awesome Icons -->
    <link href="<?=base_url('assets/plugins/fontawesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?=base_url('assets/plugins/ionicons/css/ionicons.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?=base_url('assets/plugins/datatables2/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/plugins/datatables2/responsive.bootstrap.css');?>" rel="stylesheet" type="text/css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/datepicker/datepicker3.css');?>">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/iCheck/all.css');?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/select2/select2.min.css');?>">
    <!-- Theme style -->
    <link href="<?=base_url('assets/dist/css/AdminLTE.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?=base_url('assets/dist/css/skins/_all-skins.min.css');?>" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    
    <!-- jQuery 2.1.3 -->
    <script src="<?=base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js');?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <!-- jQueryUI -->
    <script src="<?=base_url('assets/plugins/jQueryUI/jquery-ui-1.10.3.min.js');?>"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?=base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?=base_url('assets/plugins/fastclick/fastclick.min.js');?>'></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('assets/dist/js/app.min.js');?>" type="text/javascript"></script>
    <!-- bootstrap datepicker -->
    <script src="<?=base_url('assets/plugins/datepicker/bootstrap-datepicker.js');?>"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?=base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?=base_url('assets/plugins/datatables2/jquery.dataTables.js');?>" type="text/javascript"></script>
    <script src="<?=base_url('assets/plugins/datatables2/dataTables.bootstrap.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables2/dataTables.responsive.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables2/responsive.bootstrap.js" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="<?=base_url('assets/plugins/select2/select2.full.min.js');?>"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?=base_url('assets/plugins/chartjs/Chart.min.js');?>"></script>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="<?=set_url('Dashboard') ?>" class="logo">
          <span class="logo-mini"><b>F</b>SM</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>FASI</b>SM</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?=base_url() ?>uploads/users_pict/<?php echo $user['pp_pict_filename']?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $user['username'] ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?=base_url() ?>uploads/users_pict/<?php echo $user['pp_pict_filename']?>" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $user['username'] ?> - Web Developer
                      <small>Member since Feb. 2017</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?=set_url('User/profile/'.md5($user['user_id']))?>" class="btn btn-info btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?=set_url('Main/logout');?>" class="btn btn-danger btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=base_url() ?>uploads/users_pict/<?php echo $user['pp_pict_filename']?>" class="profile-user-img img-responsive" alt="User Image"/>
            </div>
            <div class="pull-left info">
              <p><?php echo $user['username'] ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li class="<?=is_active_page_print('Dashboard','active');?>">
              <a href="<?=set_url('Dashboard') ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>

            <?php if($user['akses'] == 99) { ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>SUPERUSER</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?=is_active_page_print('User','active');?>">
                  <a href="<?=set_url('User')?>">
                    <i class="fa fa-laptop"></i> <span>User</span>
                  </a>
                </li>

                <li class="<?=is_active_page_print('Pegawai','active');?>">
                  <a href="<?=set_url('Pegawai') ?>">
                    <i class="fa fa-group"></i> <span>Pegawai</span>
                  </a>
                </li>

                <li class="<?=is_active_page_print('Monitoring','active');?>">
                  <a href="<?=set_url('Monitoring') ?>">
                    <i class="fa fa-paw"></i> <span>Realtime Monitoring</span>
                  </a>
                </li>

              </ul>
            </li>
            <?php } ?>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-bank"></i>
                <span>FINANCE</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">
                <li class="<?=is_active_page_print('ReturChainStore','active');?>">
                  <a href="<?=set_url('ReturChainStore') ?>">
                    <i class="fa fa-diamond"></i> <span>Faktur Sisa RTV</span>
                  </a>
                </li>
              </ul>
              <ul class="treeview-menu">
                <li class="<?=is_active_page_print('Ppn','active');?>">
                  <a href="<?=set_url('Ppn') ?>">
                    <i class="fa fa-cloud-download"></i> <span>Faktur Sisa Ppn</span>
                  </a>
                </li>
              </ul>
              <ul class="treeview-menu">
                <li class="<?=is_active_page_print('Promo','active');?>">
                  <a href="<?=set_url('Promo') ?>">
                    <i class="fa fa-camera-retro"></i> <span>Faktur Sisa Promo</span>
                  </a>
                </li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-fighter-jet"></i>
                <span>WAREHOUSE</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">
                <li class="<?=is_active_page_print('MHE','active');?>">
                  <a href="<?=set_url('MHE') ?>">
                    <i class="fa fa-space-shuttle"></i> <span>MHE</span>
                  </a>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li class="<?=is_active_page_print('RegisterRetur','active');?>">
                  <a href="<?=set_url('RegisterRetur') ?>">
                    <i class="fa fa-birthday-cake"></i> <span>Register Retur NKA</span>
                  </a>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li class="<?=is_active_page_print('TukarGuling','active');?>">
                  <a href="<?=set_url('TukarGuling') ?>">
                    <i class="fa fa-random"></i> <span>Tukar Guling</span>
                  </a>
                </li>
              </ul>
            </li>

            <li class="header">DATA</li>
            
            <li class="<?=is_active_page_print('Vendor','active');?>">
              <a href="<?=set_url('Vendor') ?>">
                <i class="fa fa-hotel"></i> <span>Vendor MHE</span>
              </a>
            </li>

            <li class="<?=is_active_page_print('Sparepart_mhe','active');?>">
              <a href="<?=set_url('Sparepart_mhe') ?>">
                <i class="fa fa-cogs"></i> <span>Sparepart MHE</span>
              </a>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>