<div class="modal-dialog">  
  <div class="modal-content">            
    
    <div class="modal-body">
    	<img src="<?php echo base_url();?>dist/img/close.png" data-dismiss="modal" style="float:right;">
     
        <!-- 	<div class="container"> -->
		        <!-- Jssor Slider Begin -->
		        <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
		        <!-- ================================================== -->
		        <div id="slider1_container" style="visibility: hidden; position: relative; margin: 0; max-width: 550px !important; height: 600px; overflow: hidden;">

		            <!-- Loading Screen -->
		            <div u="loading" style="position: absolute; top: 0px; left: 0px;">
		                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;

		                background-color: #000; top: 0px; left: 0px;width: 100%; height:100%;">
		                </div>
		                <div style="position: absolute; display: block; background: url(<?php echo base_url();?>dist/img/loading.gif) no-repeat center center;

		                top: 0px; left: 0px;width: 100%;height:100%;">
		                </div>
		            </div>

		            <!-- Slides Container -->
		            <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1140px; height: 600px;
		            overflow: hidden;">

		                <?php 		                
		                foreach($student_image_data as $key => $value) {

		                	?>
		                		<input type="hidden" name="student_image_rating1_<?php echo $value['student_image_id']; ?>" value="<?php echo $value['student_image_rating1']; ?>" id="student_image_rating1_<?php echo $value['student_image_id']; ?>">

		                		<input type="hidden" name="student_image_rating2_<?php echo $value['student_image_id']; ?>" value="<?php echo $value['student_image_rating2']; ?>" id="student_image_rating2_<?php echo $value['student_image_id']; ?>">

		                		<input type="hidden" name="student_image_rating3_<?php echo $value['student_image_id']; ?>" value="<?php echo $value['student_image_rating3']; ?>" id="student_image_rating3_<?php echo $value['student_image_id']; ?>">
		                		<div class="col-md-12">                  
			                      
			                        <div class="row">
			                          
			                          <div class="col-sm-6 imgs">
			                          	<div style="height: 230px;width:125px; float:left; margin-bottom: 40px;">
			                            	<img style="max-width: 100%" src="<?php echo $value['image_file_path']; ?>" >
			                            </div>
			                           	<div class="col-sm-6 desc_cmt" style="float: right;margin:0 0 0;">
			                              <label>Description</label>                          
			                                <div class="form-group">                                 
			                                   <span style="height: 70px;"><?php echo $value['image_description']; ?>
			                                </div>                               
			                          
			                              <label>Comment</label>                           
			                                <div class="form-group">                                 
			                                   <span style="height: 70px;"><?php if(!empty($value['student_image_description']) && $value['student_image_description']!='null'){ echo $value['student_image_description'];}; ?>
			                                </div> 
			                            </div> 
			                            <br><br>
			                            <div id="ratingd" style="margin:0 0 0 0;  clear: both; width:93%;">
		                                  <label>Does it speak to the Heart(-10)</label>
					                      <label style="float: right;">Does it speak to the brain(+10)</label>
					                      <div class="rating1_<?php echo $value['student_image_id']; ?>"></div><br><br>

					                      <label>Does it have one story(-10)</label>
					                      <label style="float: right;">Does it have many story(+10)</label>                    
					                      <div class="rating2_<?php echo $value['student_image_id']; ?>"></div><br><br>

					                      <label>Does it speak to you nationality(-10)</label>
					                      <label style="float: right;">is it international(+10)</label>
					                      <div class="rating3_<?php echo $value['student_image_id']; ?>"></div><br><br>
					                    </div>                            
			                          </div> 
			                          </div>
			                    </div>

			                    <script type="text/javascript">
				                   
				                    $('.rating1_<?php echo $value['student_image_id']; ?>').slider({
				                        min: -10,
				                        max: 10,
				                        value: $('#student_image_rating1_<?php echo $value['student_image_id']; ?>').val(),
				                        step: 1,
				                        disabled: true
				                    });

				                    $('.rating2_<?php echo $value['student_image_id']; ?>').slider({
				                        min: -10,
				                        max: 10,
				                        value: $('#student_image_rating2_<?php echo $value['student_image_id']; ?>').val(),
				                        step: 1,
				                        disabled: true 
				                    });


				                    $('.rating3_<?php echo $value['student_image_id']; ?>').slider({
				                        min: -10,
				                        max: 10,
				                        value: $('#student_image_rating3_<?php echo $value['student_image_id']; ?>').val(),
				                        step: 1,
				                        disabled: true
				                    });

				                    </script>
		                	<?php
		                } ?>
		                
		            </div>
		            
		            <!--#region Bullet Navigator Skin Begin -->
		            <!-- Help: http://www.jssor.com/tutorial/set-bullet-navigator.html -->
		            <style>
		           /*.ui-widget-header{background-image:none;background-color:red;}*/
				   /*.ui-widget-content { background: blue; }*/
				   .ui-widget-content .ui-state-default { background: black; }

				   /*.col-sm-6.imgs > div#ratingd {
					    margin: 20px 0 0 40px;
					    width: 80%;
					}*/
		                /* jssor slider bullet navigator skin 05 css */
		                /*
		                .jssorb05 div           (normal)
		                .jssorb05 div:hover     (normal mouseover)
		                .jssorb05 .av           (active)
		                .jssorb05 .av:hover     (active mouseover)
		                .jssorb05 .dn           (mousedown)
		                */
		                .jssorb05 {
		                    position: absolute;
		                }
		                .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
		                    position: absolute;
		                    /* size of bullet elment */
		                    width: 16px;
		                    height: 16px;
		                    background: url(<?php echo base_url();?>dist/img/b05.png) no-repeat;
		                    overflow: hidden;
		                    cursor: pointer;
		                }
		                .jssorb05 div { background-position: -7px -7px; }
		                .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
		                .jssorb05 .av { background-position: -67px -7px; }
		                .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }
		            </style>
		            <!-- bullet navigator container -->
		           <!--  <div u="navigator" class="jssorb05" style="bottom: 16px; right: 6px;">
		                
		                <div u="prototype"></div>
		            </div> -->
		            <!--#endregion Bullet Navigator Skin End -->
		            
		            <!--#region Arrow Navigator Skin Begin -->
		            <!-- Help: http://www.jssor.com/tutorial/set-arrow-navigator.html -->
		            <style>
		                /* jssor slider arrow navigator skin 11 css */
		                /*
		                .jssora11l                  (normal)
		                .jssora11r                  (normal)
		                .jssora11l:hover            (normal mouseover)
		                .jssora11r:hover            (normal mouseover)
		                .jssora11l.jssora11ldn      (mousedown)
		                .jssora11r.jssora11rdn      (mousedown)
		                */
		                .jssora11l, .jssora11r {
		                    display: block;
		                    position: absolute;
		                    /* size of arrow element */
		                    width: 37px;
		                    height: 37px;
		                    cursor: pointer;
		                    background: url(<?php echo base_url();?>dist/img/a11.png) no-repeat;
		                    overflow: hidden;
		                }
		                .jssora11l { background-position: -11px -41px; }
		                .jssora11r { background-position: -71px -41px; }
		                .jssora11l:hover { background-position: -131px -41px; }
		                .jssora11r:hover { background-position: -191px -41px; }
		                .jssora11l.jssora11ldn { background-position: -251px -41px; }
		                .jssora11r.jssora11rdn { background-position: -311px -41px; }
		            </style>
		            <!-- Arrow Left -->
		            <span u="arrowleft" class="jssora11l" style="top: 123px; left: 8px;">
		            </span>
		            <!-- Arrow Right -->
		            <span u="arrowright" class="jssora11r" style="top: 123px; right: 8px;">
		            </span>
		          
		        </div>
		        <!-- Jssor Slider End -->
		   <!--  </div> -->
    </div>

    
    <!-- <div class="modal-footer">            
      <button type="button" data-dismiss="modal">Cancel</button>      
    </div> -->
    
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>dist/js/jssor.slider.mini.js"></script>
    <script>

        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: false,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $Idle: 2000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideEasing: $JssorEasing$.$EaseOutQuint,          //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
                $SlideDuration: 800,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $Cols: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $Cols is greater than 1, or parking position is not 0)

                $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Scale: false                                   //Scales bullets navigator or not while slider scale
                },

                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Rows: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 12,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 4,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1,                                //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                    $Scale: false                                   //Scales bullets navigator or not while slider scale
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth) {
                    jssor_slider1.$ScaleWidth(parentWidth - 30);
                }
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>