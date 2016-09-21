<div class="row margin-bottom">                                     
  <div class="col-sm-12">  

  <?php 
  if(!empty($uniq_image_wise_student_data))
  {
  ?>
    <div class="row">    
      <div class="col-sm-12">
        <p>All the images that each of the student have selected from the first game</p>
      </div>
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-12">                      
              <?php
                
               foreach($uniq_image_wise_student_data as $key=>$val){ ?>
                <div class="col-sm-3" style="height: 100px;width:100px;">               
                    <img style="max-height: 100%; max-width: 100%" title="<?php echo implode(',',$val['student_name']);?>" src="<?php echo $val['image_file_path'];?>">
                </div> 
              <?php }                   
                ?>
          </div>  
        </div>                 
      </div> 
    </div>
    <?php } ?>

    <br><br><br>    

    <?php
        if(!empty($grp_wise_img_dt))
        {
    ?>
    <div class="row">
      <div class="col-sm-12">
        <p>the group select of the images they had time to put sliders on</p>                    
      </div>
      <?php
         foreach($grp_wise_img_dt as $key=>$val){                                                    
      ?>
      <div class="col-sm-5 main_group margin-bottom">
        <label class="gp_name"><?php echo "group".$key; ?></label><br><br>
          <?php 
            foreach($val as $key1){
              //print_r(implode(',',$key1['student_image_id']));    
              $get_image_path=$this->mongo_db->select(array('image_file_path'))->where(array('image_id'=>(int)$key1['image_id']))->get('kk_image'); 
          ?>
              <div class="col-sm-3 image_dataModal1_link" style="height: 100px;width:100px;" stdimg="<?php echo $key1['student_image_id']; ?>">               
                <a href="javascript:void(0)" class="dropdown-toggle"  data-toggle="modal" data-target="#image_dataModal1">
                  <img id="<?php echo $key1['image_id'];?>" style="max-height: 100%; max-width: 100%" src="<?php echo $get_image_path[0]['image_file_path'];?>">
                </a>                    
              </div>
          <?php } ?>                            
      </div>  
      <?php
        }     
      ?>
    </div>  
    <?php } ?>               
  </div>                 
</div>                

<div class="modal fade" id="image_dataModal1" role="dialog">
  
</div>


<script type="text/javascript">
$(document).ready(function(){
  $('.image_dataModal1_link').click(function(){
    var click_img_id=$(this).attr('stdimg');
    var img_id_arry = [];
    $('.image_dataModal1_link').each(function(){
      img_id_arry.push(($(this).attr('stdimg')));
      //alert($(this).attr('stdimg'));
    });    
    $.ajax({
      url:'<?php echo base_url();?>Teacher_dashboard/group_wise_image_data_in_slider',
      method:'POST',
      data:{student_img_id:img_id_arry,click_img_id:click_img_id},
      success:function(data)
      {     
        $('#image_dataModal1').html(data);
      }
    });
  });
});

</script> 