<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kritikts Kanon :: Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/iCheck/square/blue.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:(0)"><b>ADMIN LOGIN</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">    
     <?php if($this->session->flashdata('fail_msg')){ ?>
        <div class="alert alert-danger alert-dismissible hide_msg" style="width: 320px;padding: 10px 10px 0px 10px;">      
          <h4><i class="icon fa fa-ban"></i> <?php echo $this->session->flashdata('fail_msg'); ?></h4>      
        </div>
      <?php }?>
    <form action="<?php echo base_url(); ?>admin/users/check_login" method="post" id="log_form">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="admin_email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="admin_password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
       
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
       
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>dist/js/jquery-validation.js"></script>
<script src="<?php echo base_url(); ?>dist/js/additional-methods.js"></script>
<script>
  setTimeout(function() {$('.hide_msg').fadeOut('slow');}, 5000);
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<style type="text/css">
  .error{border:1px solid red !important; }
</style>
<script type="text/javascript">
      $(document).ready(function(){   
          $("#log_form").validate({
              rules: {
                  admin_email:"required",
                  admin_password:"required"
              },
            errorPlacement: function(){
                return false;
            },
          });
      });
    </script>
</body>
</html>
