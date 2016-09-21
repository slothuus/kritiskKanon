 <div class="content-wrapper">
    <?php if($this->session->flashdata('success_msg')){ ?>
       <div class="container">
         <br>
          <div class="callout callout-success hide_msg">
           <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('success_msg'); ?></h4>
          </div>    
             
       </div>         
    <?php }?>

    <?php if($this->session->flashdata('fail_msg')){ ?>
       <div class="container">
         <section class="content">
          <br>    
          <div class="callout callout-success hide_msg">
           <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('fail_msg'); ?></h4>
          </div>    
         </section>         
       </div>         
    <?php }?>
    <div class="container">
      <!-- Content Header (Page header) -->
      
      <!-- Main content -->
      <section class="content">
      <!-- Unique Image section -->

          <!-- Group wise Image section -->
          <div class="row">    
              
              <div class="form-group">
                <label></label>
                <select class="form-control all_groups valid" name="all_groups" onchange="Class_change(this.value)">
                    <option value="0">Select Class</option>                                    
                    <?php foreach($all_teacher_class_data as $key=>$val) {?>
                      <option value="<?php echo $val['virtual_class_id']; ?>"><?php echo $val['virtual_class_name']; ?></option>
                    <?php }?>                                    
                </select>
              </div> 

              <div class="post">                 
                  
              </div>

          </div>
      </section>
      <!-- /.content -->
    </div>

    <!-- /.container -->
  </div>
<style type="text/css">
  input.error{
    border:1px solid red !important;
  }
  label.error{
    display: none !important;
  }
  .col-sm-5.main_group {
      margin: 0 20px 20px 16px;
      border: 1px solid silver;
      padding: 20px;
  }
  label.gp_name {
      margin: 0 0 0 200px;
  }
  .col-sm-3 img {
      padding: 0 0 10px 0;
  }
</style>

<script type="text/javascript">
    
  
    function Class_change(virtual_class_id)
    {
      if(virtual_class_id!=0)
      {
        $.ajax({
          url:'<?php echo base_url();?>admin/admin_classview/class_wise_group_display',
          type:'POST',
          data:{virtual_class_id:virtual_class_id},
          success:function(data)
          { 
            $('.post').html(data);            
          }
        });
      }
      else
      {
        $('.post').html('');
      }
    }
</script>