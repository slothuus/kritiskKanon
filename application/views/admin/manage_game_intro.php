<?php    
     $url=base_url().'admin/Game_intro/manage_game_intro';   
?>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Game Introduction</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/site_admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Game Introdution</li>        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <div class="col-md-12">
         
          <div class="box box-primary">
            
           

            <form role="form" method="post" id="manage_gameintro" action="<?php echo $url?>">
              <input type="hidden" name="intro_id" value="1"></input>
              <div class="box-body">
                <div class="form-group">
                  <label for="intro_description">Game Introduction</label>
                  <textarea class="form-control" id="intro_description" name="intro_description"><?php if(!empty($get_gane_intro[0]['intro_description'])){ echo $get_gane_intro[0]['intro_description'];} ?></textarea>
                </div>                
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
              </div>
            </form>
          </div>
          
        </div>        
      </div>      
    </section>
    
  </div>
<!-- Validation -->
<script src="<?php echo base_url(); ?>dist/js/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){   
    $("#manage_gameintro").validate({
        rules: {
            intro_description: "required"   
        },
        messages: {
            intro_description: "Please enter game introduction"     
        },            
        submitHandler: function(form) {
            form.submit();
        }
    });
  });
</script>