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
  .form-control {
  	-moz-appearance: none;
  	-ms-appearance: none;
  	-o-appearance: none;
  	-webkit-appearance: none;
  	appearance: none;

  }
  select.all_virtual_class_name,
  select#gallery_id,
  select#group {
    
  -ms-appearance: none;
  	-o-appearance: none;
  	-webkit-appearance: none;
  	appearance: none;
  	-moz-appearance: none;
	background-image: url("<?php echo base_url();?>dist/img/down.png");
	background-position: right 13px center;
	background-repeat: no-repeat;
	background-size: 10px auto;

  }
  
  .gallery_section {
  	
  	margin-bottom: 10px;
  }
  .content {
  	padding: 15px 0;
  }
  .inner > p {
  margin: 0;
  padding: 50px 0;
}
@media screen and (max-width: 768px) {
  .content-wrapper .container,
  .navbar.navbar-static-top .container{
    max-width: 750px;
    width: 100%;
  }
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
        <!-- First form virtual class name Start -->

        <form role="form" method="post" id="manage_vc_form" action="<?php echo base_url();?>teacher_dashboard/insert_virtual_class">
            <div class="row refresh_div">
              <!-- /.col -->
              <div class="col-md-6">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Select a class</h3>
                  </div>
                  <input type="hidden" class="form-control hidden_virtual_class_id" name="virtual_class_id"  id="hidden_virtual_class_id" value="0">
                  <!-- /.box-header -->
                  <div class="box-body">
                      <div class="form-group">
                        <label></label>
                        <select class="form-control all_virtual_class_name" name="all_virtual_class_name" onchange="virtualclass(this.value)">
                            <option value="0">Select a virtual class</option>
                            <?php foreach($vc_id_wise_data as $key=>$value){ ?>
                              <option value="<?php echo $value['virtual_class_id']; ?>"><?php echo $value['virtual_class_name']; ?></option>
                            <?php }?>  
                        </select><br>
                      </div>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->       
              </div>

               <div class="col-md-6">  
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">This is where they create a new virtual class</h3>
                  </div>
                  <!-- /.box-header -->
                  
                  <div class="box-body no-padding">
                   <div class="form-group">
                        
                        <div class="col-xs-5">
                          <input type="text" class="form-control" name="virtual_class_name" id="virtual_class_name"><br>
                        </div>  
                        
                        <br><br><br>                       
                        <div class="col-xs-5">
                          <button type="submit" class="btn btn-primary" id="vc_insert">create virtual class</button>
                        </div>
                        <br><br>
                  </div>
                  <!-- /.box-body -->
                  </div>
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->      
            </div> 
            </form> 

        <div class="onchange_show_div" style="display:none;" id="onchange_show_div">    
            <!-- Class wise student manage start-->

            

              <!-- Class wise student manage completed-->
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
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>




<!-- SlimScroll -->
<script src="<?php echo base_url();?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>dist/js/demo.js"></script>

<script src="<?php echo base_url(); ?>dist/js/jquery-validation.js"></script>
<script src="<?php echo base_url(); ?>dist/js/additional-methods.js"></script>
<script type="text/javascript">
  setTimeout(function() {$('.hide_msg').fadeOut('slow');}, 5000);

  $(document).ready(function(){   

    $("#manage_vc_form").validate({
        rules: {
            virtual_class_name: {
                required: true    
            }             
        },                 
        submitHandler: function(form) {
            form.submit();
        }
    });  

   /* $.validator.addMethod("aFunction",
    function(value, element) {
        alert(value);

        if (value == "0")
            return false;
        else
            return true;
    },
    "Please select a Year");

    $("#manage_gallery_form").validate({
        rules: {
            gallery_id: {
                aFunction: true    
            }             
        },                 
        submitHandler: function(form) {
            form.submit();
        }
    });     */  
    

  });

  /*For student and class section*/

  function moveSelected_class_student_from(from, to) {
      $('#'+from+' option:selected').remove().appendTo('#'+to); 
      $('.hidden_student_to_id').val($('#to').val()); 
      //$("#to option").prop("selected",true);
  }
  
  function moveSelected_class_student_to(to, from) {
      $('#'+to+' option:selected').remove().appendTo('#'+from); 
      $('.hidden_student_selected_id').val($('#from').val()); 
     // $("#to option").prop("selected",true);     
  }

  /*For student and group section*/

  function moveSelected_group_student_from(from, to) {

      var grp_id=$('.group_id').val();
      if(grp_id!=0)
      {
        $('#'+from+' option:selected').remove().appendTo('#'+to);   
        $('.hidden_student_group_to').val($('#grp_std_list_to').val()); 
      }
      else
      {
        alert('Please select group first'); 
      }
      
      //$('.hidden_student_to_id').val($('#grp_std_list_to').val()); 
      //$("#to option").prop("selected",true);
  }
  
  function moveSelected_group_student_to(to, from) {
    var grp_id=$('.group_id').val();
    if(grp_id!=0)
    {
      $('#'+to+' option:selected').remove().appendTo('#'+from); 
      $('.hidden_student_group_from').val($('#grp_std_list_from').val()); 
    }
    else
    {
      alert('Please select group first'); 
    }
      //$('.hidden_student_selected_id').val($('#grp_std_list_from').val()); 
     // $("#to option").prop("selected",true);     
  }

  function virtualclass(vc_id)
  {    
    $('.hidden_virtual_class_id').val(vc_id);
    if(vc_id!=0)
    {      
      $('.onchange_show_div').css('display','block')
      $.ajax({
            url:'<?php echo base_url();?>Teacher_dashboard/ajax_teacher_student_class',
            method:'POST',
            data:{virtual_class_id:vc_id},
            success:function(data)
            { 
              //alert(data);
              $('.onchange_show_div').html(data);
            }
          }); 
    }
    else
    {
      $('.onchange_show_div').css('display','none') 
    }

  }
  function search_student(student_name)
  { 
    var student_name=student_name;
    var virtual_class_id=$('.hidden_virtual_class_id').val();
    if(student_name=='')
    {
      $.ajax({
            url:'<?php echo base_url();?>Teacher_dashboard/ajax_teacher_student_class',
            method:'POST',
            data:{virtual_class_id:virtual_class_id},
            success:function(data)
            { 
              //alert(data);
              $('.onchange_show_div').html(data);
            }
          }); 
    }
    else
    {
        $.ajax({
          url:'<?php echo base_url();?>Teacher_dashboard/ajax_live_search',
          method:'POST',
          data:{student_name:student_name,virtual_class_id:virtual_class_id},
          success:function(data)
          {         
            $('#from').html(data);
          }
        }); 
    }
  }

function group_wise_student(group_id)
  {
    $('.group_id').val(group_id); 

    var group_id=group_id;

     var virtual_class_id=$('.hidden_virtual_class_id').val();
    if(group_id!=0)
    {
        $.ajax({
          url:'<?php echo base_url();?>Teacher_dashboard/ajax_group_wise_student',
          method:'POST',
          data:{group_id:group_id,virtual_class_id:virtual_class_id},
          success:function(data)
          {         
            //alert(data);
            $('.group_section').html(data);
          }
        }); 
    }
    else
    {
       $.ajax({
            url:'<?php echo base_url();?>Teacher_dashboard/ajax_teacher_student_class',
            method:'POST',
            data:{virtual_class_id:virtual_class_id},
            success:function(data)
            { 
              //alert(data);
              $('.onchange_show_div').html(data);
            }
          }); 
    }   
  }


</script>


</body>
</html>
