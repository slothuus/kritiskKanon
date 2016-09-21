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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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
              <a href="<?php echo base_url();?>student_dashboard/logout" class="dropdown-toggle" >Logout</a>           
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
      <section class="content">
        <div class="row">                                
          <div class="post">
            <div class="row margin-bottom game2_all_img">                   
              <div class="col-sm-12">
                <div class="row">  
                <?php foreach($get_image_group_and_student_wise as $key=>$val){?>                        
                  <div style="height: 100px;width:100px;" class="col-sm-2 margin-bottom image_dataModal_link" id="<?php echo $val['primary_image_id']; ?>" virtid="<?php echo $virtual_class_id; ?>">
                    <a href="javascript:void(0)" class="dropdown-toggle"  data-toggle="modal" data-target="#image_dataModal">
                      <img src="<?php echo $val['image_file_path']; ?>" style="max-height: 100%; max-width: 100%">
                    </a>
                  </div>  
                <?php } ?>                      
                </div>                      
              </div>                    
            </div>      
          </div>
        </div>
        <div class="col-sm-3" style="margin: 0 0 2% 40%;">
          <a href="<?php echo base_url();?>student_dashboard" class="btn btn-block btn-primary btn-lg">Done</a>
        </div>
      </section>
    </div>



    <!-- Image Model End -->

   

    <!-- /.container -->
  </div>

<div class="modal fade" id="image_dataModal" role="dialog">
  
</div>
  
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">     
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="javascript:void(0)">Kritisk Kanon</a></strong>
    </div>
    <!-- /.container -->
  </footer>
</div>

  
  <style type="text/css">
 
#drop
{
  background-color: silver;
  min-height: 250px;
}
.list{ min-height: 120px;} /* you need to set the size of the ul otherwise it may not detect the dropped item */
.list li{
display: inline-block;
list-style-type: none;
padding-right: 20px;
}


</style>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="<?php echo base_url();?>dist/js/jquery.ui.touch-punch.js"></script>
<script type="text/javascript">
/*$('.game2_all_img img').each(function() {   
    var maxWidth = 125; // Max width for the image
    var maxHeight = 125;    // Max height for the image
    var ratio = 0;  // Used for aspect ratio
    var width = $(this).width();    // Current image width
    var height = $(this).height();  // Current image height

    // Check if the current width is larger than the max
    if(width > maxWidth){
        ratio = maxWidth / width;   // get ratio for scaling image
        $(this).css("width", maxWidth); // Set new width
        $(this).css("height", height * ratio);  // Scale height based on ratio
        height = height * ratio;    // Reset height to match scaled image
        width = width * ratio;    // Reset width to match scaled image
    }

    // Check if current height is larger than max
    if(height > maxHeight){
        ratio = maxHeight / height; // get ratio for scaling image
        $(this).css("height", maxHeight);   // Set new height
        $(this).css("width", width * ratio);    // Scale width based on ratio
        width = width * ratio;    // Reset width to match scaled image
        height = height * ratio;    // Reset height to match scaled image
    }
});*/


$('.image_dataModal_link').click(function(){
  var student_img_id=$(this).attr('id');
  var virtual_class_id=$(this).attr('virtid');  
  
  $.ajax({
    url:'<?php echo base_url();?>student_dashboard/student_image_data_useing_ajx',
    method:'POST',
    data:{student_img_id:student_img_id,virtual_class_id:virtual_class_id},
    success:function(data)
    {     
      $('#image_dataModal').html(data);
    }
  });
});


</script> 
<!-- SlimScroll -->
<script src="<?php echo base_url();?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>dist/js/demo.js"></script>

</body>
</html>
