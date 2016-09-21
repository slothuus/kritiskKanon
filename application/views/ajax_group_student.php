<div class="col-md-4"> 
      
    <p>Put the students in to groups</p>
    <select multiple id="grp_std_list_from" size="8" class="form-control">              
        <?php     
        /*echo "<pre>";       
        print_r($remaining_grp_student_data);*/
        foreach($remaining_grp_student_data as $key=>$value){
              ?>
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
     /* echo "<pre>";
      print_r($grp_wise_selected_student_data);
     */
    ?> 
    <select multiple id="grp_std_list_to" size="6" class="form-control"> 
      
        <?php    
        foreach($grp_wise_selected_student_data as $key=>$value){
              ?>
        <option value="<?php echo $value['student_id']; ?>"><?php echo $value['student_name']; ?></option>
      <?php }?>
    </select>   
  </div>
