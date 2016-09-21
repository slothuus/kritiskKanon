 
      <?php
        if(!empty($group_id))
        {
          ?>
            <section class="content">
               
                <!-- START ALERTS AND CALLOUTS -->
                <div class="row">
                  <div class="col-md-12"> 
                    <div class="col-md-2"> 
                    </div>
                    <div class="col-md-8"> 
                        <div class="box box-default">
                          
                          <!-- /.box-header -->
                          <div class="box-body both_game_sec" style="display: none;">
                            
                            <a href="<?php echo base_url(); ?>student_dashboard/student_game1/<?php echo $virtual_class_id; ?>" class="game1" id="game1">
                              <div class="alert alert-info alert-dismissible">                         
                                <h4>Saving The art work from the fire</h4>
                                (Game 01)
                              </div>
                            </a>
                            
                            <a href="<?php echo base_url(); ?>student_dashboard/student_game2/<?php echo $virtual_class_id; ?>" class="game2" id="game2">                            
                              <div class="alert alert-info alert-dismissible">                          
                                <h4>Have a discussion in you group about the art you have saved</h4>
                                (Game 02)
                              </div>
                            </a>

                          </div>
                          <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="col-md-2">                        
                    </div>
                  </div>
                   
                </div>
                
              

          </section>
          <?php
        } 
        else
        {
          ?>
            <section class="content">
              <div class="callout callout-info">
               <p>Not assign any group</p>         
              </div>
              
              <!-- /.box -->
            </section>
       <?php   
        }  
      ?>