<form name="std_game2_insert_frm" id="std_game2_insert_frm" action="<?php echo base_url();?>student_dashboard/student_game2_insert_data" method="post">
            <div class="modal-dialog">  
            <input type="hidden" name="virtual_class_id" value="<?php echo $virtual_class_id; ?>"></input>
              <input type="hidden" name="primary_image_id" value="<?php echo $student_image_data[0]['student_image_id']; ?>"></input>
              <input type="hidden" name="image_id" value="<?php echo $student_image_data[0]['image_id']; ?>"></input>
              <input type="hidden" name="student_id" value="<?php echo $student_image_data[0]['student_id']; ?>"></input>
              <input type="hidden" name="student_image_rating1" class="student_image_rating1" value="<?php echo $student_image_data[0]['student_image_rating1']; ?>"></input>
              <input type="hidden" name="student_image_rating2" class="student_image_rating2" value="<?php echo $student_image_data[0]['student_image_rating2']; ?>"></input>
              <input type="hidden" name="student_image_rating3" class="student_image_rating3" value="<?php echo $student_image_data[0]['student_image_rating3']; ?>"></input> 

              <div class="modal-content">            
                <div class="modal-body">
                    <div class="col-md-12">                  
                      <div class="post">
                        <div class="row margin-bottom">
                          
                          <div class="col-sm-6" style="height: 400px;width:250px;">
                            <img src="<?php echo $student_image_data[0]['image_file_path']; ?>"  style="max-height: 100%; max-width: 100%">
                          </div>
                          
                           <div class="col-sm-6 ">  
                              <label>Description</label>                          
                                <div class="form-group">                                 
                                  <span style="height: 70px;"><?php echo $student_image_data[0]['image_description']; ?>
                                </div>                               
                          </div>

                          <div class="col-sm-6 ">  
                              <label>Comment</label>                           
                                <div class="form-group">                                 
                                  <textarea class="form-control cmt" style="height: 70px;" name="student_image_description" rows="10" placeholder="Comment" id="student_image_description"><?php if(!empty($student_image_data[0]['student_image_description']) && $student_image_data[0]['student_image_description']!='null'){ echo $student_image_data[0]['student_image_description'];}; ?></textarea>
                                </div>                               
                          </div>
                        </div>
                      </div>
                       
                      
                    </div>

                    <div class="col-md-12 margin-bottom">
                      <label>Does it speak to the Heart(-10)</label>
                      <label style="float: right;">Does it speak to the brain(+10)</label>
                      <div class="rating1"></div><br><br>                     
                    </div>

                    <div class="col-md-12 margin-bottom">  
                      <label>Does it have one story(-10)</label>
                      <label style="float: right;">Does it have many story(+10)</label>                    
                      <div class="rating2"></div><br><br>                      
                    </div>

                    <div class="col-md-12 margin-bottom">
                      <label>Does it speak to you nationality(-10)</label>
                      <label style="float: right;">is it international(+10)</label>
                      <div class="rating3"></div><br><br>
                    </div>

                </div>

                
                <div class="modal-footer">            
                  <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-info pull-right" >Submit</button>
                </div>
                
                <style type="text/css">
                  textarea.error{
                    border:1px solid red !important;
                  }
                  label.error{
                    display: none !important;
                  }
                </style>
                <script src="<?php echo base_url(); ?>dist/js/jquery-validation.js"></script>
                <script src="<?php echo base_url(); ?>dist/js/additional-methods.js"></script>

                <script type="text/javascript">
                   $(document).ready(function(){   
                      $("#std_game2_insert_frm").validate({
                          rules: {
                              student_image_description: {
                                  required: true    
                              }             
                          },                 
                          submitHandler: function(form) {
                              form.submit();
                          }
                      });  
                    });  
                </script>
                <script type="text/javascript">
                    
                  
                    $('.rating1').slider({
                        min: -10,
                        max: 10,
                        value: <?php echo $student_image_data[0]['student_image_rating1']; ?>,
                        step: 1,
                        change: function(event, ui) {      
                            $(".student_image_rating1").val(ui.value);        
                        } 
                    });

                    $('.rating2').slider({
                        min: -10,
                        max: 10,
                        value: <?php echo $student_image_data[0]['student_image_rating2']; ?>,
                        step: 1,
                        change: function(event, ui) {      
                            $(".student_image_rating2").val(ui.value);        
                        } 
                    });


                    $('.rating3').slider({
                        min: -10,
                        max: 10,
                        value: <?php echo $student_image_data[0]['student_image_rating3']; ?>,
                        step: 1,
                        change: function(event, ui) {      
                            $(".student_image_rating3").val(ui.value);        
                        } 
                    });

                    </script>
              </div>
            </div>
            </form>