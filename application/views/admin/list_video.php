<div class="content-wrapper" style="min-height: 916px;">
   
   <section class="content-header">
      <?php if($this->session->flashdata('success_msg')){ ?>
        <div class="alert alert-success alert-dismissible hide_msg" style="width: 900px;">      
          <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('success_msg'); ?></h4>
        </div>
      <?php }?>

      <?php if($this->session->flashdata('fail_msg')){ ?>
        <div class="alert alert-danger alert-dismissible hide_msg" style="width: 900px;">      
          <h4><i class="icon fa fa-ban"></i> <?php echo $this->session->flashdata('fail_msg'); ?></h4>      
        </div>
      <?php }?>

      <div class="alert alert-success alert-dismissible status_msg" style="width: 900px;display:none;">      
        <h4><i class="icon fa fa-check"></i>Successfully video status updated</h4>
      </div>

      <div class="alert alert-success alert-dismissible delete_msg" style="width: 900px;display:none;">      
        <h4><i class="icon fa fa-check"></i>Successfully video deleted</h4>
      </div>

      <h1>
          Video                  
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>admin/users"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="javascript:void(0)">List video</a></li>         
      </ol>

   </section>
   
   <section class="content">
      <div class="row">
         <div class="col-xs-12">
            <div class="box">
               <div class="box-header">
                  <h3 class="box-title">List Video</h3>
               </div>
             
               <div class="box-body">
                  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                     <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6"></div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                              <thead>
                                 <tr role="row">
                                    <th>Video title</th>                                    
                                    <th>Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody class="body_refresh">
                                <?php foreach ($all_video as $key => $value) { ?>
                                 <tr role="row" class="odd_<?php echo $value['video_id'];?>">                                     
                                    <td><?php echo $value['video_title']; ?></td>                                    
                                    <td>
                                      <?php 
                                        if($value['video_status']=='Active')
                                        {
                                           ?>
                                           <a class="label label-success status" href="javascript:void(0)" videostatus="<?php echo $value['video_status'];?>"  id="<?php echo $value['video_id'];?>">Active</a>
                                           <?php
                                        }
                                        else
                                        {
                                          ?>
                                             <a class="label label-danger status" href="javascript:void(0)" videostatus="<?php echo $value['video_status'];?>"  id="<?php echo $value['video_id'];?>">Inactive</a>
                                           <?php
                                        }
                                      ?>
                                     
                                    </td>
                                    <td>
                                      <a href="<?php echo base_url();?>admin/video/manage_video/<?php echo $value['video_id'];?>"><i class="fa fa-fw fa-edit"></i></a>
                                      <a href="javascript:void(0)" onclick="delete_video(<?php echo $value['video_id'];?>)"><i class="fa fa-fw fa-trash"></i></a>
                                    </td>
                                 </tr>                                 
                                 <?php } ?>
                              </tbody>                              
                           </table>
                        </div>
                     </div>
                     
                  </div>
               </div>
              
            </div>
          
         </div>
         
      </div>
      
   </section>
  
</div>

<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
<script>
setTimeout(function() {$('.hide_msg').fadeOut('slow');}, 5000);

  $(function () {
    $('#example2').DataTable({
       "aoColumns": [
            null,
            null,
            { "bSortable": false }
        ]   
    });
  });

  function delete_video(video_id)
  {
    var con=confirm('Are you sure you want to delete data???');
    if(con)
    {
      var video_id=video_id;
      var $ele = $('.odd_'+video_id); 
      $.ajax({
          url:'<?php echo base_url();?>admin/video/delete_video',
          method:'POST',
          data:{video_id:video_id},
          success:function(data)
          {
            $ele.fadeOut().remove(); 
            $('.delete_msg').show();   
            setTimeout(function() {$('.delete_msg').fadeOut('slow');}, 5000);
            setTimeout(function() {$('.hide_msg').fadeOut('slow');}, 5000);
            setTimeout(function() {$('.status_msg').fadeOut('slow');}, 5000);
          }
      });
    }     
    else
    {
        return false;
    } 
  }

 $('.status').on('click',function(){    
    var video_id=$(this).attr('id');
    var video_status=$(this).attr('videostatus');
    
      $.ajax({
        data:{video_id:video_id,video_status:video_status},
        type:'POST',
        url:'<?php echo base_url();?>admin/video/status_change_video',
        success:function(data)
        {           
            $('.body_refresh').html(data);  
            $('.status_msg').show();
            setTimeout(function() {$('.delete_msg').fadeOut('slow');}, 5000);
            setTimeout(function() {$('.hide_msg').fadeOut('slow');}, 5000);
            setTimeout(function() {$('.status_msg').fadeOut('slow');}, 5000);
        }  
      });
  });
  
</script>