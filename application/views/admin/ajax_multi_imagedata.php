<?php 
    $count_dt=count($gallery_img_arr);
    if($count_dt > 0)
    {
          foreach($gallery_img_arr as $key=>$val)
          {       
          ?>
          <input type="hidden" class="form-control" name="image_id[]" value="<?php echo $val['image_id'];?>" >
          <div class="odd_<?php echo $val['image_id'];?> col-md-12">
              <div class="row">
                <div class="col-xs-2">
                  <input type="text" class="form-control" name="image_name[]" value="<?php echo $val['image_name'];?>" >
                </div>
                <div class="col-xs-2">
                  <input type="text" class="form-control" name="image_year[]" value="<?php echo $val['image_year'];?>">
                </div>
                <div class="col-xs-3">
                  <input type="text" class="form-control" name="image_description[]" value="<?php echo $val['image_description'];?>">
                </div>
                <div class="col-xs-4">
                  <input type="text" class="form-control" name="image_file_path[]" value="<?php echo $val['image_file_path'];?>">
                </div>
               <div class="col-xs-1"><a class="btn btn-danger btn-sm delete_dynamic" onclick="delete_image_from_gallery(<?php echo $val['image_id'];?>)"><i class="fa fa-fw fa-minus-square"></i></a></div>
              </div>
          </div>
          <?php
          }
    
    } 
    else
    {
        ?>
    <div class="col-md-12">
         
            <h3 class="no_record">No gallery record found</h3>
          
    </div>
    <?php
    }  
    ?>

    <script type="text/javascript">
      /*$(document).ready(function(){
        $('.delete_dynamic').click(function(){
          var img_id=$(this).attr('id');
          alert(img_id);
        });
      });*/

      function delete_image_from_gallery(image_id)
      {
        var con=confirm('Are you sure you want to delete???');
        if(con)
        {
          var image_id=image_id;
          var $ele = $('.odd_'+image_id); 
          $.ajax({
              url:'<?php echo base_url();?>admin/site_admin/delete_image_from',
              method:'POST',
              data:{image_id:image_id},
              success:function(data)
              {
                $ele.fadeOut().remove(); 
                $('.delete_msg').show();  
                setTimeout(function() {$('.delete_msg').fadeOut('slow');}, 5000);                
              }
          });
        }     
        else
        {
            return false;
        } 
      }
    </script>