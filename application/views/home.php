<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KRITISK KANON</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>dist/css/skins/_all-skins.min.css">

 <!--  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css"> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<style type="text/css">
  input[type="text"].error,
  input[type="password"].error{
        border: 1px solid red;
  }
  label.error{
    color: red;
  }
</style>

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="javascript:void(0)" class="navbar-brand"><b>KRITISK KANON</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
          
            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">           
              <a href="javascript:void(0)" class="dropdown-toggle" id="sign_in" data-toggle="modal" data-target="#sign_inModal">Sign In</a>           
            </li>
            <!-- Tasks Menu -->
            <li class="dropdown tasks-menu">
              <a href="javascript:void(0)" class="dropdown-toggle" id="sign_up" data-toggle="modal" data-target="#sign_upModal">Sign Up</a>             
            </li>
           
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <?php if($this->session->flashdata('success_msg')){ ?>
       <div class="container">
         <section class="content">
          <br>    
          <div class="callout callout-success hide_msg">
           <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('success_msg'); ?></h4>
          </div>    
         </section>         
       </div>         
    <?php }?>

    <?php if($this->session->flashdata('fail_msg')){ ?>
       <div class="container">
         <section class="content">
          <br>    
          <div class="callout callout-success hide_msg">
           <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('fail_msg'); ?></h4>
          </div>    
         </section>         
       </div>         
    <?php }?>
    <div class="container">
      <!-- Content Header (Page header) -->
      
      <!-- Main content -->
      <section class="content">
        <div class="callout callout-info">
         <p>Some text</p>
        </div>
        <div class="callout callout-info">
         <p>Some text</p>
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>

    <!-- /.container -->
  </div>
  
  
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">     
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="javascript:void(0)">Kritisk Kanon</a></strong>
    </div>
    <!-- /.container -->
  </footer>
</div>

<!-- Sign In Model start -->
<div class="modal fade" id="sign_inModal" role="dialog">
<form name="signin_form" id="signin_form" action="<?php echo base_url();?>home/login_student_teacher" method="post">
  <div class="modal-dialog">  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sign In</h4>
      </div>
      <div class="modal-body">
        
            <!-- left column -->
            <div class="col-md-12">
              <!-- <form name="" action="<?php echo base_url();?>" method="post" onsubmit="return login_validation();"> -->
              
              <!-- Form Element sizes -->
              <div class="box box-success">
               <!--  <div class="box-header with-border">
                  <h3 class="box-title">Sign Up</h3>
                </div> -->
                <div class="box-body">
                 
                  <input class="form-control" type="text" placeholder="Email" name="login_email" id="login_email">
                  <br>
                  <input class="form-control" type="password" placeholder="Password" name="login_password" id="login_password">
                  <br>
                  
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
              
            </div>
            </div>
        
          <!-- /.row -->
        
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" >Close</button> -->
        <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-info pull-right" >Login</button>
      </div>
    </div>
  </div>
  </form>
</div>

<!-- Sign In Model End -->

<!-- Sign Up Model Start-->
<div class="modal fade" id="sign_upModal" role="dialog">
  <form name="signup_form" id="signup_form" action="<?php echo base_url();?>home/insert_student_teacher" method="post">
    <div class="modal-dialog">      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sign Up</h4>
        </div>
        <div class="modal-body">
           
              <!-- left column -->
              <div class="col-md-12">
                
                <!-- Form Element sizes -->
                <div class="box box-success">
                 <!--  <div class="box-header with-border">
                    <h3 class="box-title">Sign Up</h3>
                  </div> -->
                  <div class="box-body">
                    <div class="form-group">
                        <div class="radio chk" style="float: left;margin: -2px 0 0 7px;">
                          <label>
                           <input type="radio" name="user_type" value="student" checked="checked">Student             
                          </label>
                        </div>
                        <div class="radio chk" style="float: left;margin: -2px 0 0 7px;">
                          <label>
                           <input type="radio" name="user_type" value="teacher">Teacher        
                          </label>
                        </div>
                        
                      </div>
                    
                    <br>
                    <input class="form-control  input-sm" type="text" placeholder="Name" name="name">
                    <br>
                    <input class="form-control  input-sm" type="text" placeholder="Email" name="email" id="email">
                    <br>
                    <input class="form-control input-sm" type="text" placeholder="City" name="city">
                    <br>
                    <input class="form-control input-sm" type="password" placeholder="Password" name="password" id="signup_password">
                    <br>
                    <input class="form-control input-sm" type="password" placeholder="Retype Password" name="retype_password">
                    
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
                
              </div>
             
            </div>
            <!-- /.row -->
          
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" >Close</button> -->
          <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-info pull-right" >Create</button>

        </div>
      </div>
    </div>
  </form>
</div>

<!-- Sign Up Model End-->

<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script> -->




<!-- SlimScroll -->
<script src="<?php echo base_url();?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>dist/js/demo.js"></script>
<!--<script src="<?php echo base_url(); ?>dist/js/jquery.min.js"></script>-->
<script src="<?php echo base_url(); ?>dist/js/jquery-validation.js"></script>
<script type="text/javascript">
  $("#signin_form").validate({
        rules: {
            login_email:{
                required:true,
                email:true,
            },            
            login_password:"required"
        },
        messages: {
            login_email:{
                required:"Please enter email",
                email:"Please enter valid email"                
            },            
            login_password:"Please enter password"            
        },
    });

  $("#signup_form").validate({
        rules: {
            name:"required",            
            email:{
                required:true,
                email:true,
                remote: {
                    url: "<?php echo base_url();?>home/chek_exists_email",
                    type: "post",
                    data: {
                        email: function(){ return $("#email").val(); }
                    }
                }
            },
            city:"required",
            password:"required",
            retype_password:{
                required:true,
                equalTo:'#signup_password'
            },            
        },
        messages: {
            name:"Please enter name",
            email:{
                required:"Please enter email",
                email:"Please enter valid email",
                remote: "Email already exists" 
            },            
            city:"Please enter city",
            password:"Please enter password",
            retype_password:{
              required:"Please enter retype password",
              equalTo: "Password not match"
            }           
        },
    });
</script>
<script>
  setTimeout(function() {$('.hide_msg').fadeOut('slow');}, 5000);  
</script>
</body>
</html>
