<div class="content-wrapper" style="min-height: 916px;">
<form role="form" method="post" id="manage_siteadmin" action="<?php echo base_url();?>admin/site_admin/insert_gallery">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>       
        Site admin page
      </h1>
      <ol class="breadcrumb">
        <!-- <li><a href="<?php echo base_url();?>admin/users"><i class="fa fa-dashboard"></i> Home</a></li>         -->
        <li class="active"><i class="fa fa-dashboard"></i> Site Admin</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row refresh_div">
        <!-- /.col -->
        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Select a group to update</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                  <label></label>
                  <select class="form-control all_groups" name="all_groups" onchange="Gallerywise_Image(this.value)">
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
                <button type="submit" class="btn btn-primary" id="gallery_insert">Submit</button>
              </div>
             </div><br><br><br>
            </div>
            <!-- /.box-body -->
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

       
      </div>
    
    </section>
</form>
<form role="form" method="post" id="manage_gallery_image" action="<?php echo base_url();?>admin/site_admin/insert_gallery_images">
    <?php if($this->session->flashdata('success_msg')){ ?>
      <div class="alert alert-success alert-dismissible hide_msg" style="width: 1000px;margin: 0 0 0 10px;">      
        <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('success_msg'); ?></h4>
      </div>
    <?php }?>

    <div class="alert alert-success alert-dismissible delete_msg" style="width: 1000px;margin: 0 0 0 10px;display:none;">      
      <h4><i class="icon fa fa-check"></i>Successfully data deleted</h4>
    </div>

    <section class="content">
      <div class="row">
        <!-- /.col -->
        <div style="float: right;margin: 0px 40px 0px 0px;">                
          <a class="btn bg-olive btn-sm add_btn" style="display:none;"><i class="fa fa-fw fa-plus-square"></i></a>
        </div> 
        <div class="col-md-12 table_list" style="display:none;">
          <input type="hidden" class="form-control" name="gallery_id" class="gallery_id" id="hidden_gallery_id" value="0">
            <div class="row">
              <div class="col-xs-2">
                Name
              </div>
              <div class="col-xs-2">
                Year
              </div>
              <div class="col-xs-3">
                Description
              </div>
              <div class="col-xs-4">
                Path To File
              </div>
            </div>
        </div>

        <div class="adddata">
            <!-- <div class="col-md-12">
                <div class="row">
                  <div class="col-xs-2">
                    <input type="text" class="form-control" name="image_name[]">
                  </div>
                  <div class="col-xs-2">
                    <input type="text" class="form-control" name="image_year[]">
                  </div>
                  <div class="col-xs-3">
                    <input type="text" class="form-control" name="image_description[]">
                  </div>
                  <div class="col-xs-4">
                    <input type="text" class="form-control" name="image_file_path[]">
                  </div>
                  <div class="col-xs-1">                
                    <a class="btn btn-danger btn-sm"><i class="fa fa-fw fa-minus-square"></i></a>
                  </div>
                </div>
            </div> -->
        </div> 

        <div class="editdata">
        </div>
        <div class="col-xs-3" style="margin: 100px 0 0px 480px;">     
            <button type="submit" class="btn btn-block btn-primary btn-sm" id="submit_server" style="display:none;">Submit To Server MongoDB</button>
        </div>
      </div>

    </section>
    <!-- /.content -->

     </form>
  </div>

  <style type="text/css">
  input.error{
    border:1px solid red !important;
  }
  label.error{
    display: none !important;
  }
  </style>
<script src="<?php echo base_url(); ?>dist/js/jquery.min.js"></script>

<script type="text/javascript">
  setTimeout(function() {$('.hide_msg').fadeOut('slow');}, 5000);

  function find_last_img_id_from_imgtab()
  {
      $.ajax({
        url:'<?php echo base_url();?>admin/site_admin/get_last_imageid',        
        success:function(data)
        {   
          return data;          
        }
      });
  }

  $(document).ready(function(){   

     var hidden_gal_id=$('#hidden_gallery_id').val();     
     if(hidden_gal_id!=0)
     {              
        $('.table_list').css('display','block');
        $('.add_btn').css('display','block');
        $('#submit_server').css('display','block');
     }
     else
     {        
        $('.table_list').css('display','none');
        $('.add_btn').css('display','none');
        $('#submit_server').css('display','none');
     }
       
    /*First Form validation start*/

    $("#manage_siteadmin").validate({
        rules: {
            gallery_name: {
                required: true,                
                remote: {
                    url: "<?php echo base_url();?>admin/site_admin/chek_exists_galname",
                    type: "post",
                    data: {
                        gallery_name: function(){ return $("#gallery_name").val(); }
                    }
                }             
            }             
        },
        messages: {
            gallery_name:{
                required:'Please enter gallery name',
                remote: "Gallery name already exist"                
            }
                    
        },                  
        submitHandler: function(form) {
            form.submit();
        }
    });

    /*First Form validation end*/
       


    /*Dynamic add and delete section start*/
    
    var addbutton=$('.add_btn');
    var wrapper=$('.adddata');
    
    $(addbutton).click(function(){   

      $.ajax({
          url:'<?php echo base_url();?>admin/site_admin/get_last_imageid',        
          success:function(img_id)
          { 
            var ig_id=img_id;
            var hidden_gal_id1=$('#hidden_gallery_id').val();
              $.ajax({
                url:'<?php echo base_url();?>admin/site_admin/insert_gallery_images_ajx',
                method:'POST',      
                data:{ig_id:ig_id,gal_id:hidden_gal_id1},  
                success:function(img_id1)
                {       
                      var x=img_id;                                        
                      var hidden_gal_id=$('#hidden_gallery_id').val();
                      $('.no_record').remove();           
                      if(hidden_gal_id!=0)
                      {    
                        //  x++;
                          var new_html='<div class="odd_'+x+' col-md-12">';
                          new_html+='<div class="row"><input type="hidden" class="form-control" name="image_id[]" value="'+x+'">';
                          new_html+='<div class="col-xs-2"><input type="text" class="form-control" name="image_name[]"></div>';
                          new_html+='<div class="col-xs-2"><input type="text" class="form-control" name="image_year[]"></div>';
                          new_html+='<div class="col-xs-3"><input type="text" class="form-control" name="image_description[]"></div>';
                          new_html+='<div class="col-xs-4"><input type="text" class="form-control" name="image_file_path[]"></div>';          
                          new_html+='<div class="col-xs-1"><a class="btn btn-danger btn-sm delete_class" onclick="delete_image_from_gallery('+x+')"><i class="fa fa-fw fa-minus-square"></i></a></div>';
                          new_html+='</div>';
                          new_html+='</div>';
                          wrapper.append(new_html);  

                           }
                      else
                      {
                        alert('Please select group first');
                      }  
                  }
              });       
          }
        });


      /*alert(find_last_img_id_from_imgtab());*/
          
    });

   /* $(wrapper).on('click','.delete_class',function(e){
        var a=confirm('Are you sure you want to delete?');      
        if(a)
        {
            e.preventDefault();
            $(this).parent().parent().remove();
            x--;
            return true
        }
        else
        {
            return false;
        }        
    });*/
    

    /*Dynamic add and delete section end*/

    /*Second Form validation start*/

    $("#manage_gallery_image").validate({      
      ignore: [],
      rules: {
        'image_name[]': {
          required: true
        },
        'image_year[]': {
          required: true
        },
        'image_description[]': {
          required: true
        },
        'image_file_path[]': {
          required: true
        },
      }
    });

  /*Second Form validation end*/


    /*$('.all_groups').change(function(){
      var img_gallery_id=$(this).val();           
        if(img_gallery_id!='0')
        {
          $.ajax({
            url:'<?php echo base_url();?>admin/site_admin/get_gallery_wise_images',
            method:'POST',
            data:{img_gallery_id:img_gallery_id},
            success:function(data)
            {            
              //alert(data);
              $('.adddata').html(data);
            }
          });  
        }
        else
        {
          $('.adddata').html('');
        }
        
    });*/
  });
  function Gallerywise_Image(img_gallery_id){
      $('#hidden_gallery_id').val(img_gallery_id);
      
      var img_gallery_id=img_gallery_id;           
        if(img_gallery_id!='0')
        {          
         $('.table_list').css('display','block');
        $('.add_btn').css('display','block');
        $('#submit_server').css('display','block');

          $.ajax({
            url:'<?php echo base_url();?>admin/site_admin/get_gallery_wise_images',
            method:'POST',
            data:{img_gallery_id:img_gallery_id},
            success:function(data)
            {            
              //alert(data);
              $('.adddata').html(data);
            }
          });  
        }
        else
        {
          $('.adddata').html('');          
          $('.table_list').css('display','none');
          $('.add_btn').css('display','none');
          $('#submit_server').css('display','none');
        }
    }

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
