<?php  
  if($submit=='Add')
  {
      $url=base_url().'admin/video/manage_video';
  } 
  else
  {
     $url=base_url().'admin/video/manage_video/'.$Get_ID_Wise_Video['video_id']; 
  }   
?>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Video</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/users"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:void(0)"><?php echo $action_name; ?></a></li>        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <div class="col-md-12">
         
          <div class="box box-primary">
            
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $action_name; ?></h3>
            </div>

            <form role="form" method="post" id="manage_video" action="<?php echo $url?>">
              <input type="hidden" name="video_id" value="<?php echo $Get_ID_Wise_Video['video_id']; ?>"></input>
              <div class="box-body">
                <div class="form-group">
                  <label for="video_title">Video title</label>
                  <input type="video_title" class="form-control" id="video_title" name="video_title" value="<?php echo $Get_ID_Wise_Video['video_title']; ?>" placeholder="Enter video title">
                </div>
                <div class="form-group">
                  <label for="video_link">Video link</label><br>                  
                  <textarea class="form-control" rows="3" id="video_link" name="video_link" placeholder="Enter video link"><?php echo $Get_ID_Wise_Video['video_link']; ?></textarea>                  
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" class="btn btn-primary" value="<?php echo $submit; ?>" name="<?php echo $submit; ?>">
              </div>
            </form>
          </div>
          
        </div>        
      </div>      
    </section>
    
  </div>
<!-- Validation -->
<script src="<?php echo base_url(); ?>dist/js/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){   
    $("#manage_video").validate({
        rules: {
            video_title: "required",
            video_link: "required",           
        },
        messages: {
            video_title: "Please enter video title",
            video_link: "Please enter video link",            
        },            
        submitHandler: function(form) {
            form.submit();
        }
    });
  });
</script>