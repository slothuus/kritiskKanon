<!-- For class wise student  -->
<form role="form" method="post" id="manage_vc_form" action="<?php echo base_url();?>teacher_dashboard/manage_class_wise_student">
    <input type="hidden" class="form-control hidden_virtual_class_id" name="virtual_class_id" id="hidden_virtual_class_id" value="<?php echo $virtual_class_id; ?>">

    <input type="hidden" class="form-control hidden_student_to_id" name="hidden_student_to_id[]" id="hidden_student_to_id">
    <input type="hidden" class="form-control hidden_student_selected_id" name="hidden_student_selected_id" id="hidden_student_selected_id">

    <div class="row">
        <div class="col-md-4">       
        <?php
          /*echo "<pre>";
            print_r($remaining_student_data);*/
        ?>          
          <input type="text" class="form-control"  onkeyup="search_student(this.value);">  <br>
          <select multiple="multiple" id="from" size="7" class="form-control" >
              <option disabled="disabled" value="0">List of students of all students</option>
              <?php

               foreach($remaining_student_data as $key=>$value){ ?>
                <option value="<?php echo $value['student_id']; ?>"><?php echo $value['student_name']; ?></option>
              <?php }?>                  
          </select>
        </div>
        
        <div class="col-md-4">                 
          <a href="javascript:moveSelected_class_student_from('from', 'to')" class="btn btn-block btn-success btn-lg">Add more students to class</a> 
          <a href="javascript:moveSelected_class_student_to('to', 'from')" class="btn btn-block btn-danger btn-lg">Remove student</a>
          <button type="submit" class="btn btn-block btn-primary btn-lg">Submit</button>                   
        </div>

        <div class="col-md-4">   
          <?php 
            /*echo "<pre>";
            print_r($remaining_student_data);
            foreach ($student_selected_data as $key => $value) {
              print_r($key);
            }*/
          ?> 
          <select multiple id="to" size="10" name="student_id[]" class="form-control"> 
            <?php
             foreach($student_selected_data as $key=>$value){   echo $value['student_id'];?>
                <option value="<?php echo $value[0]['student_id']; ?>"><?php echo $value[0]['student_name']; ?></option>
              <?php }?> 
         </select>   
        </div>

    </div>
</form>

<br><br>

<!-- For group wise student  -->

<form role="form" method="post" id="manage_student_group_form" action="<?php echo base_url();?>teacher_dashboard/manage_group_wise_student">
    <input type="hidden" class="form-control hidden_virtual_class_id" name="virtual_class_id" id="hidden_virtual_class_id" value="<?php echo $virtual_class_id; ?>">

    <input type="hidden" class="form-control group_id" name="group_id" id="group_id" value="0">
    
    <input type="hidden" class="form-control hidden_student_group_to" name="hidden_student_group_to[]" id="hidden_student_group_to">
    <input type="hidden" class="form-control hidden_student_group_from" name="hidden_student_group_from" id="hidden_student_group_from">

    <div class="row">
      <div class="col-md-12"> 
        <div class="row">
        <div class="col-md-4"> 
        </div>
        <div class="col-md-4"> 
        </div>
        <div class="col-md-4"> 
            <select id="group" class="form-control" onchange="group_wise_student(this.value);">
                <option value="0">Select</option>
                <option value="1">group01</option>
                <option value="2">group02</option>
                <option value="3">group03</option>
                <option value="4">group04</option>
                <option value="5">group05</option>
                <option value="6">group06</option>
                <option value="7">group07</option>
                <option value="8">group08</option>
                <option value="9">group09</option>
                <option value="10">group10</option>
            </select>
        </div>
        </div>
      </div>

      <div class="col-md-12">  
          <h3 style="text-align: center;">Put the students in to groups</h3>
          </div>
          <br>
          <div class="group_section">
            <div class="col-md-4"> 
           
              <p>Put the students in to groups</p>
              <select multiple id="grp_std_list_from" size="8" class="form-control">              
                  <?php                  
                 foreach($student_selected_data as $key=>$value){?>
                    <option value="<?php echo $value[0]['student_id']; ?>"><?php echo $value[0]['student_name']; ?></option>
                  <?php }?>                  
              </select>
            </div>
            
            <div class="col-md-4 btn_section">    
            <br>  <br>            
              <a href="javascript:moveSelected_group_student_from('grp_std_list_from', 'grp_std_list_to')" class="btn btn-block btn-success btn-lg chk_grp">Add select student to group</a> 
              <a href="javascript:moveSelected_group_student_to('grp_std_list_to', 'grp_std_list_from')" class="btn btn-block btn-danger btn-lg chk_grp">Remove student</a>
              <button type="submit" class="btn btn-block btn-primary btn-lg chk_grp">Submit</button>                   
            </div>

            <div class="col-md-4">  
            

            <br>
              <?php 
                /*echo "<pre>";
                print_r($remaining_student_data);
                foreach ($student_selected_data as $key => $value) {
                  print_r($key);
                }*/
              ?> 
              <select multiple id="grp_std_list_to" size="6" class="form-control"> 
                
             </select>   
            </div>
          </div>
    </div>

</form>


<br><br>

<!-- For gallery dropdown -->

<form role="form" method="post" id="manage_gallery_form" action="<?php echo base_url();?>teacher_dashboard/gallery_insert">
    <input type="hidden" class="form-control hidden_virtual_class_id" name="virtual_class_id" id="hidden_virtual_class_id" value="<?php echo $virtual_class_id; ?>">

    <div class="row">
      
      <div class="col-md-12">  
          <h4 style="text-align: center;">Select a group of images that the student should go though</h4>
          </div>
          <br>
          <div class="col-md-8 col-md-offset-2 gallery_section">           
           <select id="gallery_id" class="form-control" name="gallery_id">
                <option value="0">Need to select a group before the class can start</option>
                <?php                  
                 foreach($gallery_data as $key=>$value){?>
                    <option <?php if($gallery_id_data==$value['gallery_id']){ ?> selected="selected" <?php } ?> value="<?php echo $value['gallery_id']; ?>"><?php echo $value['gallery_name']; ?></option>
                  <?php }?>   
            </select>        

            
          </div>
          <div class="col-md-2 col-md-offset-5">
              <button  type="submit" class="btn btn-block btn-primary btn-lg" >Submit</button> 
           </div>
    </div>

</form>

<br><br>

<!-- 3 static Video  -->

<div class="row">
  <div class="col-md-12"> 
    <div class="row">
    <div class="col-md-4"> 
     <iframe width="100%" height="330" src="https://www.youtube.com/embed/1uFY60CESlM?list=PL6gx4Cwl9DGDQ5DrbIl20Zu9hx1IjeVhO" frameborder="0" allowfullscreen></iframe>
    </div>
    
    <div class="col-md-4"> 
     <iframe width="100%" height="330" src="https://www.youtube.com/embed/1uFY60CESlM?list=PL6gx4Cwl9DGDQ5DrbIl20Zu9hx1IjeVhO" frameborder="0" allowfullscreen></iframe>
    </div>

    <div class="col-md-4"> 
     <iframe width="100%" height="330" src="https://www.youtube.com/embed/1uFY60CESlM?list=PL6gx4Cwl9DGDQ5DrbIl20Zu9hx1IjeVhO" frameborder="0" allowfullscreen></iframe>   
    </div>
  </div>
  </div>
</div>

<!-- Class view button -->

<br><br>
<div class="row">
  <div class="col-md-4 col-md-offset-4"> 
    
   
    <a href="<?php echo base_url();?>teacher_dashboard/class_view/<?php echo $virtual_class_id; ?>" class="small-box-footer">
      
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <p style="text-align: center;">Class View</p>
              </div>            
      </div>
    </a>
   
  </div>
</div>


<script type="text/javascript">
  
</script>