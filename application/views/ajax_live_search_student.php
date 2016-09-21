<?php
 if(!empty($remaining_student_data))
 {
  ?>
    <option disabled="disabled" value="0">List of students of all students</option>
  <?php
    foreach($remaining_student_data as $key=>$value)
   { 
  ?>

    <option value="<?php echo $value['student_id']; ?>"><?php echo $value['student_name']; ?></option>
  <?php
   }  
 }
 else
 {
  ?>
    <option value="NO" disabled>No student Found</option>
  <?php
 }
 ?>
  