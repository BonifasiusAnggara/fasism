<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>asism | Log in</title>
  <link rel="shortcut icon" type="text/css" href="<?php echo base_url() ?>assets/images/F1.jpg">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/square/blue.css">

  <link href="<?php echo base_url() ?>assets/plugins/login/bootstrap.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/plugins/login/login_page.css" rel="stylesheet" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url() ?>"><b>FASISM</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Log in to start your session</p>

    <form action="<?=set_url('Main/login');?>" method="post">
      <div class="form-group has-feedback">
        <?php echo form_error('username');?>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo form_error('password');?>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" id="remember" value="yes" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="#">I forgot my password</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url() ?>assets/plugins/jQuery/jquery-2.1.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/login/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/login/jquery.backstretch.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
    });
</script>

<script type="text/javascript">
    $.backstretch([
      "<?php echo base_url() ?>assets/plugins/login/login1.jpg",
      "<?php echo base_url() ?>assets/plugins/login/login2.jpg",
      "<?php echo base_url() ?>assets/plugins/login/login3.jpg",
      ], {
        fade: 2000,
        duration: 4000
    });
</script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
