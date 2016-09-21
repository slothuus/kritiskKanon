 <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Select a group to update</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="form-group">
                  <label></label>
                  <select class="form-control" name="all_groups" id="all_groups">
                    <option value="0">Select</option>
                    <?php foreach($all_gallery as $key=>$value){ ?>
                    <option value="<?php echo $value['gallery_id']; ?>"><?php echo $value['gallery_name']; ?></option>
                    <?php }?>
                  </select>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->       
        </div>

         <div class="col-md-6">  
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Create a new group of images</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
             <div class="form-group">
             <div class="col-md-12"> 
              <div class="col-xs-5">
                <input type="text" class="form-control" placeholder="Name" name="gallery_name" id="gallery_name">
              </div>
              
              <div class="col-xs-4">
                <button type="button" class="btn btn-primary" id="gallery_insert">Submit</button>
              </div>
             </div><br><br><br>
            </div>
            <!-- /.box-body -->
            </div>
          </div>
          <!-- /.box -->
        </div>

        <script type="text/javascript">
  $(document).ready(function(){   
    $("#manage_siteadmin").validate({
        rules: {
            gallery_name: "required"                      
        },
        messages: {
            gallery_name: "Please enter gallery name"           
        },            
        submitHandler: function(form) {
            form.submit();
        }
    });

    $('#gallery_insert').click(function(){
        var gallery_name=$('#gallery_name').val();        
        $.ajax({
          url:'<?php echo base_url();?>admin/site_admin/insert_gallery',
          method:'POST',
          data:{gallery_name:gallery_name},
          success:function(data)
          {
            $('.refresh_div').html(data);
          }
        });
    });

  });
</script>