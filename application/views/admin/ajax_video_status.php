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
<script src="<?php echo base_url();?>dist/js/jquery.js"></script>

<script type="text/javascript">
setTimeout(function() {$('.delete_msg').fadeOut('slow');}, 5000);
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