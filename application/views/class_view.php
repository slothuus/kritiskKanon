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

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <style type="text/css">
  input.error{
    border:1px solid red !important;
  }
  label.error{
    display: none !important;
  }
  .col-sm-5.main_group {
      margin: 0 20px 20px 16px;
      border: 1px solid silver;
      padding: 20px;
  }
  label.gp_name {
      margin: 0 0 0 200px;
  }
  .col-sm-3 img {
      padding: 0 0 10px 0;
  }
   
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="skin-blue sidebar-collapse sidebar-mini">
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
              <a href="<?php echo base_url();?>teacher_dashboard/logout" class="dropdown-toggle" >Logout</a>           
            </li>
            
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  




  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> -->
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
       
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Teacher</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>teacher_dashboard"><i class="fa fa-circle-o"></i>Teacher Dashboard </a></li>
            <li><a href="<?php echo base_url();?>teacher_dashboard/class_view"><i class="fa fa-circle-o"></i>Class view</a></li>
          </ul>
        </li>
        
     
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <?php if($this->session->flashdata('success_msg')){ ?>
       <div class="container">
         <br>
          <div class="callout callout-success hide_msg">
           <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('success_msg'); ?></h4>
          </div>    
             
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
      <!-- Unique Image section -->

          <!-- Group wise Image section -->
          <div class="row">    
              <input type="hidden" name="v_class_seg" id="v_class_seg" value="<?php echo $this->uri->segment(3); ?>">
              <div class="form-group">
                <label></label>               
                <select class="form-control all_groups valid" name="all_groups" onchange="Class_change(this.value)">
                    <option value="0">Select Class</option>                                    
                    <?php foreach($vc_id_wise_data as $key=>$val) {?>
                      <option <?php if($this->uri->segment(3)==$val['virtual_class_id']){?> selected="selected" <?php } ?> value="<?php echo $val['virtual_class_id']; ?>"><?php echo $val['virtual_class_name']; ?></option>
                    <?php }?>                                    
                </select>
              </div> 

              <div class="post">                 
                  
              </div>

          </div>
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

  
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="<?php echo base_url();?>dist/js/jquery-ui.js"></script>

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


<script type="text/javascript">
   
    $(document).ready(function(){
      var v_class_seg=$('#v_class_seg').val();
      if(v_class_seg!='')
      {
        Class_change(v_class_seg);
      }
    }); 
  
    function Class_change(virtual_class_id)
    {
      if(virtual_class_id!=0)
      {
        $.ajax({
          url:'<?php echo base_url();?>Teacher_dashboard/class_wise_group_display',
          type:'POST',
          data:{virtual_class_id:virtual_class_id},
          success:function(data)
          { 
            $('.post').html(data);            
          }
        });
      }
      else
      {
        $('.post').html('');
      }
    }
</script>


</body>
</html>
