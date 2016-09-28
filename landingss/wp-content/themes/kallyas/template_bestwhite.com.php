<?php if(! defined('ABSPATH')){ return; }

/**



 * Template Name: Landing Best White Page



 */

?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' );?>"/>

<meta name="twitter:widgets:csp" content="on">

<link rel="profile" href="http://gmpg.org/xfn/11"/>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<link href='https://fonts.googleapis.com/css?family=Arimo:400,700' rel='stylesheet' type='text/css'>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>

<?php

	global $post;

	wp_head();



?>

</head>

<body  <?php body_class('landing-page'); ?>>





<?php //<!-- AFTER BODY ACTION -->

/*

 * @hooked zn_add_page_loading()

 * @hooked zn_add_hidden_panel()

 * @hooked zn_add_login_form()

 * @hooked zn_add_open_graph()

 */

do_action( 'zn_after_body' ); ?>





<div id="page_wrapper">



<header itemtype="http://schema.org/WPHeader" itemscope="" class="main-header" role="banner" id="site-header">

  <div id="header">

    <div class="container">

      <div class="header-inner clearfix">

        <div class="logo-wrap">

          <h1 itemprop="headline" class="image-logo" id="logo"> <a href="<?php echo site_url();?>"><img alt="Free Trial Teeth Whitening Today" src="<?php echo site_url();?>/wp-content/uploads/2016/06/logo-1.png"></a> </h1>

          <!-- END #logo --> 

        </div>

        <div class="header-right-div">

          <div class="widget-header" id="text-2">

            <div class="textwidget">

              <div class="header-right-inner clearfix">

                <div class="header-image-left"> <img src="<?php echo site_url();?>/wp-content/uploads/2016/05/before-after-image.png"> </div>

                <div class="header-content-middle">

                  <h5>UP TO 90% BRIGHTER WHITE!</h5>

                  <p>GET EXPERT RESULTS!</p>

                </div>

                <div class="header-image-right"> <img src="<?php echo site_url();?>/wp-content/uploads/2016/05/header-top-icon.png"> </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <!--.container--> 

    

  </div>

  <!--#header--> 

</header>



<?php

/*

 * Display SITE HEADER

 */

//do_action('th_display_site_header');



WpkPageHelper::zn_get_subheader();



// Check to see if the page has a sidebar or not

$main_class = zn_get_sidebar_class('page_sidebar');

if( strpos( $main_class , 'right_sidebar' ) !== false || strpos( $main_class , 'left_sidebar' ) !== false ) { $zn_config['sidebar'] = true; } else { $zn_config['sidebar'] = false; }

$zn_config['size'] = $zn_config['sidebar'] ? 'col-sm-9' : 'col-sm-12';



?>



<div class="best-white-landing-page">

		

                        <?php

                        while ( have_posts() ) : the_post();

                            get_template_part( 'inc/page', 'content-view-page.inc' );

                        endwhile;



                        if ( comments_open() || get_comments_number() ) :

                            comments_template();

                        endif;

                        ?>



</div>

                   

    



<div class="mask"></div>

	<div class="mask_message">

	<div style="margin-top: 1px;position: absolute;left:10px;"><img alt="" src="<?php echo get_template_directory_uri();?>/images/loading.gif"></div><div id="progress-text" style="margin-left:25px;text-align:left;">Processing your request.  Please wait...</div>

</div>



<script type="text/javascript">

jQuery(document).ready(function(e) {

    jQuery(document).on("submit","#lv_form",function(event){

		event.preventDefault();

		var $err="";

		jQuery(this).find(".required, .required_num, .required_email").each(function(index, element) {

			

			if(jQuery(this).hasClass("required_num")){

				if(!is_required_num(jQuery(this)))	{

					$err+=" "+jQuery(this).attr("placeholder")+"\n";

					jQuery(this).addClass("error");	

				}else{

					jQuery(this).removeClass("error");					

				}

			}

			

			if(jQuery(this).hasClass("required_email")){

				if(!isEmail(jQuery(this)))	{

					$err+=" "+jQuery(this).attr("placeholder")+"\n";

					jQuery(this).addClass("error");	

				}else{

					jQuery(this).removeClass("error");					

				}

			}

			

			if(jQuery(this).hasClass("required")){

				if(!is_required(jQuery(this)))	{

					$err+=" "+jQuery(this).attr("placeholder")+"\n";

					jQuery(this).addClass("error");	

				}else{

					jQuery(this).removeClass("error");					

				}

			}

			

			

            

        });

		if($err != ""){

			 alert('Please enter/correct the following required fields:\n\n' + $err);

		}else{

			jQuery(".mask,.mask_message").show();

			var $url="<?php echo site_url();?>";

			//if (window.location.protocol != "https:") $url = "//demo.sergiowebdesign.com/bws-new2/";

			jQuery.ajax({

						url: $url+"?action=submitlandingpage001&"+jQuery("#lv_form").serialize(),

						dataType: 'jsonp',

						jsonp: 'jsoncallback',

						timeout: 5000,

						success: function( data ) {

							window.location.href="<?php echo get_permalink(2300);?>";

							console.log(data);

						},						

						error: function( data ) {

							jQuery(".mask,.mask_message").hide(); 

							alert("Something went wrong. Please try again later")

						}

					});	

		}

	});

	



function is_required_num($field){

	var inputVal = $field.val();

	var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;

	if(!numericReg.test(inputVal)) {

		return false;

	}else{

		return true;

	}

}



function is_required($field){

	if($field.val() == "" ) {

		return false;

	}else{

		return true;

	}

}



function isEmail($email) {

  if($email.val() == "") return false;

  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

  return emailReg.test( $email.val() );

}

	

	

	jQuery(".required_email").keypress(function(e) {

		  if(!isEmail(jQuery(this))) {

			jQuery(this).addClass("error");

			jQuery(this).removeClass("valid");

		}else{

			jQuery(this).removeClass("error");

			jQuery(this).addClass("valid");

		}	



	});

	

	

	jQuery(".required_num").keypress(function(e) {

		  if(!is_required_num(jQuery(this))) {

			jQuery(this).addClass("error");

			jQuery(this).removeClass("valid");

		}else{

			jQuery(this).removeClass("error");

			jQuery(this).addClass("valid");

		}	



	});

	

	jQuery(".required").keypress(function(e) {

		if(!is_required(jQuery(this))){

			jQuery(this).addClass("error");

			jQuery(this).removeClass("valid");

		}else{

			jQuery(this).removeClass("error");

			jQuery(this).addClass("valid");

		}

	});

	

	

});

</script>	



<footer itemtype="http://schema.org/WPFooter" itemscope="" role="contentinfo" id="site-footer">

                

            <div class="container">

                        </div>

            

        <div class="copyrights">

            <div class="container">

                <!--start copyrights-->

<div class="clearfix" id="copyright-note">

<div class="footer-content-div">

<div class="widget widget_text" id="text-3">			<div class="textwidget"><p>[<a href="<?php echo get_permalink(2);?>">Privacy Policy</a>] [<a href="<?php echo get_permalink(641);?>">Contact Us</a>] I Toll Free 866-452-2133 | [<a href="https://www.bestbritesmile.com/ingredients/">Ingredients</a>] </p> 

<p>bestbritesmile is committed to maintaining the highest quality products and the utmost integrity in business practices.  All products sold on this website are certified by Good Manufacturing

Practices (GMP), which is the highest standard of testing in the supplement industry.</p>



<p>Notice: The products and information found on http://bestbritesmile.com are not intended to replace professional medical advice or treatment.  These statements have not been

evaluated by the Food and Drug Administration. These products are not intended to diagnose,  treat, cure or prevent any disease.  Individual results may vary.</p></div>

		</div></div>

<span>&copy; Copyright 2016 bestbritesmile</span>

</div>

<!--end copyrights-->

            </div><!--.container-->

        </div><!--.copyrights-->

    </footer>



</div><!-- end page_wrapper -->



<a href="#" id="totop" class="js-scroll-event" data-forch="300" data-visibleclass="on--totop" ><?php echo __( 'TOP', 'zn_framework' ); ?></a>

<?php zn_footer(); ?>

<?php wp_footer(); ?>

</body>

</html>