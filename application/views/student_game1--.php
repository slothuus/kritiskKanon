<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KRITISK KANON</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">


  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dist/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dist/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dist/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />

    <!--  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dist/css/fire.css" /> -->

 
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="javascript:void(0)" class="navbar-brand"><b>KRITISK KANON</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
          
            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">           
              <a href="<?php echo base_url();?>student_dashboard/logout" class="dropdown-toggle" >Logout</a>           
            </li>
            
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <?php if($this->session->flashdata('success_msg')){ ?>
       <div class="container">
         <section class="content">
          <br>    
          <div class="callout callout-success hide_msg">
           <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('success_msg'); ?></h4>
          </div>    
         </section>         
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
      <span class="countdown"></span>
    <!-- <div class="container"> -->

      <section class="content game1_intro">
          <div id="intro_time" style="text-align: center;"></div>
          <!-- START ALERTS AND CALLOUTS -->
          <div class="row">
            <div class="col-md-12">                    
              <div class="col-md-10"> 
                  <div class="box box-default">
               
                    <!-- /.box-header -->
                    <div class="box-body">
                      
                      <div class="alert alert-info alert-dismissible">                         
                          <h4><?php echo $game_intro_data[0]['intro_description'];?>
                          </h4>                                
                      </div>
                    </div>                          
                  </div>
              </div>
              <div class="col-md-2">                        
              </div>
            </div>
          </div>
      </section>
    
      <section class="content game1_start" style="display: none !important">
        <input type="hidden" name="virtual_class_id" id="virtual_class_id" value="<?php echo $virtual_class_id; ?>">
        <div id="time"></div>

        

        <div class="box box-default color-palette-box">
            <div class="box-body" style="padding: 0;">
                <div class="row fbox list origin_cls">
                  <div class="box1"><!-- <img src="<?php echo base_url();?>dist/img/fire_img/bottom.gif"> --></div>
                  <div class="box2"><!-- <img src="<?php echo base_url();?>dist/img/fire_img/bottom.gif"> --></div>
                  <div class="box3"></div>
                  <div class="box4"></div> 
                  <div id="origin" class="boxes show image_show_data">
                        <?php foreach($remainin_image_data as $key=>$value) { ?>
                                    <a href="<?php echo $value['image_file_path'];?>" data-fancybox-group="gallery" class="draggable fancybox-buttons ">
                                    <img style="max-width: 100%" src="<?php echo $value['image_file_path'];?>"  id="<?php echo $value['image_id'];?>">
                                    </a>
                        <?php }?>
                      </div>
                </div>
            <!-- </div> -->
          </div>
        </div>

          
        <div id="drop" class="fbox">
          <?php foreach($already_selected_image_data as $key1=>$value1) { ?>
          <a href="<?php echo $value1['image_file_path'];?>" data-fancybox-group="gallery" class="draggable fancybox-buttons ">
              <img src="<?php echo $value1['image_file_path'];?>" style="max-width: 100%" id="<?php echo $value1['image_id'];?>">
          </a>
          <?php } ?>

        </div>
      </section>
      <div style="clear: both;"></div>
    
    <!-- /.container -->
  </div>
  
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="float: left !important;">
    <div class="container">     
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="javascript:void(0)">Kritisk Kanon</a></strong>
    </div>
    <!-- /.container -->
  </footer>
</div>


<style type="text/css">


.boxes.show{
-moz-column-width: 13em;
-webkit-column-width: 13em;
-moz-column-gap: 0;
-webkit-column-gap:0;
}

.boxes.show a{
    display: inline-block;
    margin:  0;
    padding: 0;
    width:  100%;
    background:  #fff;
}

.grid {
    background: #fff;
    width: 100%;
}
.list {
    display: table;
    height: 100%;
    table-layout: fixed;
    width: 100%;
}
/* clear fix */
.grid:after {
    content: '';
    display: block;
    clear: both;
}

/* ---- .grid-item ---- */
#drop .draggable.fancybox-buttons.grid-item.ui-draggable.ui-draggable-handle {
    position: static !important;
    width: 100%;
}
.grid-sizer,
.grid-item {
    width:14.2%;
}

.grid-item {
    float: left;
}

.grid-item img {
    display: block;
    max-width: 100%;
}
/*.boxes {
  float: left;
  padding: 5px;
  line-height: 1px;  
}
.origin_cls a img {
  width: 100px;
  padding: 6px;
}*/
html, body {
  height: 100%;
}
.content.game1_start {
  height: 100%;
  /*display: table !important;*/
  width: 100%;
}
.content-wrapper {
  min-height: none !important;
  height: 100%;
}
.box.box-default.color-palette-box {
  display: table;
  float: left;
  height: 100%;
  width: 85%;
}
.box-body {
  display: table;
  height: 100%;
}
.list {
  display: table;
  height: 100%;
}




.box.box-default.color-palette-box {
  float: left;
  width: 85%;
}
.origin_cls {
  margin: 0; 
}

#drop {
  background-color: silver;
  float: left;
  padding: 20px 38px;
  text-align: center;
  width: 13%;
  margin-left: 2%;
  min-height: 500px;
}
#drop img {
  margin-bottom: 5px;
  margin-top: 5px;
    position: relative;
    z-index: 101;
  /*width: 100px;*/
}
.list{ min-height: 120px;} /* you need to set the size of the ul otherwise it may not detect the dropped item */
.list li{
display: inline-block;
list-style-type: none;
padding-right: 20px;
}
#time {
  background: transparent none repeat scroll 0 0;
  border-radius: 10px;
  color: white;
  display: inline-block;
  font-size: 17px;
  height: 50px;
  left: 53%;
  margin: 0;
  overflow: hidden;
  padding: 12px 10px 10px 6px;
  position: absolute;
  top: 3px;
  width: auto;
  z-index: 9999;
}

#intro_time {
  background: transparent none repeat scroll 0 0;
  border-radius: 10px;
  color: white;
  display: inline-block;
  font-size: 17px;
  height: 50px;
  left: 53%;
  margin: 0;
  overflow: hidden;
  padding: 12px 10px 10px 6px;
  position: absolute;
  top: 3px;
  width: auto;
  z-index: 9999;
}

/*Fire css Start*/

.max-w {
  max-width: 800px;
  height: 600px;
  width: 100%;
  margin: 0 auto;
  overflow: hidden;
  position: relative;
  border: 2px solid #000;
  transition: all 0.5s ease 0s;
}
.origin_cls {
	/*overflow: hidden;*/
	position: relative;
}
.box1 {
  background-image: url('<?php echo base_url();?>dist/img/fire_img/bottom.gif');
  background-repeat: no-repeat;
  background-size: 100% 100%;
  bottom: 0;
  height: 0;
  position: absolute;
  -webkit-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  -moz-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  -ms-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  -o-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  width: 100%;
}
.box2 {
 background-image: url('<?php echo base_url();?>dist/img/fire_img/top.gif');
  background-repeat: no-repeat;
  background-size: 100% 100%;
  top: 0;
  height: 0;
  position: absolute;
  -webkit-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  -moz-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  -ms-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  -o-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;

  width: 100%;
}
.box3 {
  background-image: url('<?php echo base_url();?>dist/img/fire_img/right.gif');
  background-repeat: no-repeat;
  background-size: 100% 100%;
  right: 0;
  height: 100%;
  position: absolute;
  -webkit-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  -moz-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  -ms-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  -o-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  width: 0;
}
.box4 {
  background-image: url('<?php echo base_url();?>dist/img/fire_img/lefth.gif');
  background-repeat: no-repeat;
  background-size: 100% 100%;
  left: 0;
  height: 100%;
  position: absolute;
  -webkit-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  -moz-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  -ms-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  -o-transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  transition: all <?php echo $timer_time[0]['timer_time'] * 60 * 3; ?>s ease;
  width: 0;
}
.show.box1,
.show.box2,
.show.box3,
.show.box4 {
  height: 100%;
  width: 100%;
  opacity: 0.7;z-index:101;
}
.show img {
  width: 100%;
  /*height: 100%;*/
  vertical-align: top;
}
.box2 img {
  transform: rotate(180deg);
}
/*.origin_cls > a,
.boxes .color-palette-set > a{
   height: 150px;width:9%; float:left;
}
.boxes .color-palette-set > a {
  height: auto;
}*/
.origin_cls > img {
  width:9%; float:left;
}
.origin_cls > a > img,
.boxes .color-palette-set > a > img {
  width: 100%;
}
#drop > img,
#drop > a {
  width:100%;
  display: inline-block;

}

.skin-blue.layout-top-nav .wrapper {
  overflow: visible;
  height: 100%;
  min-height: 85%;
}

/*Fire css End*/
@media screen and (max-width: 1100px) {
  .box.box-default.color-palette-box {
    width:80%;
  }
  #drop {
    width: 18%;
  }
}

@media screen and (max-width: 767px) {
  .origin_cls > a, .boxes .color-palette-set > a {
    height: 110px;
    width: 11%;
  }
  .box.box-default.color-palette-box {
    width:75%;
  }
  #drop {
    width: 23%;
  }
  .navbar-header {
    display: inline-block;
    float: left;
  }
  .navbar-toggle {
    display: none;
  }
  .main-header .navbar-custom-menu {
    margin-right: -15px;
  }
}
@media screen and (max-width: 480px) {
  .origin_cls > a, .boxes .color-palette-set > a {
    height: 85px;
    width: 14%;
  }
  #drop {
    padding: 20px;
  }
  .box.box-default.color-palette-box {
    width:75%;
  }
  #drop {
    width: 23%;
  }
}
@media screen and (max-width: 320px) {
  .origin_cls > a, .boxes .color-palette-set > a {
    height: 75px;
    width: 20%;
  }
}
</style>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="<?php echo base_url();?>dist/js/jquery-ui.js"></script>
<!--<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>-->
<script src="<?php echo base_url();?>dist/js/jquery.ui.touch-punch.js"></script>

<script src="<?php echo base_url();?>dist/js/isotope.min.js"></script>

 <script type="text/javascript">
    $(document).ready(function(){
      /*$(window).load(function(){
        $('.origin_cls > div').addClass('show');
      });*/
      $(window).load(function(){
        
          $('.game1_start').attr('style', 'display: none !important');
          var count = 3;
          var countdown = setInterval(function(){
          $('.game1_start').attr('style', 'display: none !important');
          $("#intro_time").html(count);
          if (count == 0) {  
            $('.game1_start').attr('style', 'display: block !important');
            clearInterval(countdown);            
            $('#intro_time').remove();            
            game1_sta();
          }
          count--;
        }, 1000);
      });       
    });    
   
  </script>

<!-- SlimScroll -->
<script src="<?php echo base_url();?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>dist/js/demo.js"></script>

<script type="text/javascript">
  /*Drag & drop code start

  $(".draggable").draggable({
   cursor: "crosshair",
   revert: "invalid",
   stack: ".draggable",
    stop: function(){
        // Make it properly draggable again in case it was cancelled
        $(this).draggable('option','revert','invalid');
    }
  });

  $(".draggable").draggable({ cursor: "crosshair", revert: "invalid"});*/

  $(".draggable").draggable({ cursor: "crosshair", revert: "invalid"});
  $("#drop").droppable({ accept: ".draggable",
      drop: function(event, ui) {
          console.log("drop");
          $(this).removeClass("border").removeClass("over");
          var dropped = ui.draggable;
          var droppedOn = $(this);
          $(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);


      },
      over: function(event, elem) {
          $(this).addClass("over");
          console.log("over");
      }
      ,
      out: function(event, elem) {
          $(this).removeClass("over");
      }
  });
  $("#drop").sortable();

  $("#origin").droppable({ accept: ".draggable", drop: function(event, ui) {
      console.log("drop");
      $(this).removeClass("border").removeClass("over");
      var dropped = ui.draggable;
      var droppedOn = $(this);
      $(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);


  }});





    function ArrNoDupe(a) {
      var temp = {};
      for (var i = 0; i < a.length; i++)
          temp[a[i]] = true;
      var r = [];
      for (var k in temp)
          r.push(k);
      return r;
    }

    var all = [];  
    var results = []; 

    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            $('.origin_cls > div').addClass('show');    
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {

                timer = duration; 
                var img_id=$('#drop img'); 
                $(img_id).each(function(){
                  $(this).attr('id');
                  all.push($(this).attr('id'));          
                });                

                var noDupes = ArrNoDupe(all);

                var image_id=noDupes.join(",");
                var virtual_class_id=$('#virtual_class_id').val();
                $.ajax({
                  url:'<?php echo base_url();?>Student_dashboard/student_game1_insert_data',
                  method:'POST',
                  data:{image_id:image_id,virtual_class_id:virtual_class_id},
                  success:function(data)
                  {
                    window.location.href = '<?php echo base_url();?>Student_dashboard'; 
                  }
                });                
            }
        }, 1000);
    }

    /*Drag & drop code End*/

    /*Game intro section start*/

    function gameintro_Timer(duration, display) {
        
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;
            if (--timer < 0) {
              $('#intro_time').html('');
              game1_sta();
            }
        }, 1000);
    }

    function game1_sta()
    {
      $(".game1_intro").css({ 'display': "none" });
      $(".game1_start").css({ 'display': "block" });
    //  var fiveMinutes = 60 * <?php echo $timer_time[0]['timer_time']; ?>,
    //  display1 = document.querySelector('#time');
    //  startTimer(fiveMinutes, display1);
    }

    /*Game intro section end*/
</script>
 <script type="text/javascript" src="<?php echo base_url();?>dist/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
  <script type="text/javascript" src="<?php echo base_url();?>dist/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>dist/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
  <script type="text/javascript" src="<?php echo base_url();?>dist/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
  <script type="text/javascript" src="<?php echo base_url();?>dist/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<script type="text/javascript">
  $(document).ready(function() {
      
      $('.fancybox-buttons').fancybox({
        openEffect  : 'none',
        closeEffect : 'none',

        prevEffect : 'none',
        nextEffect : 'none',

        closeBtn  : false,

        helpers : {
          title : {
            type : 'inside'
          },
          buttons : {}
        },

        afterLoad : function() {
          this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
        }
      });



  });





</script>
</body>
</html>
