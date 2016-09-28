/* HEADINGS */
h1,
.page-title{

	<?php
		$h1_typo = zget_option( 'h1_typo', 'font_options', false, array() );
		foreach ($h1_typo as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}

h2 {

	<?php
		$h2_typo = zget_option( 'h2_typo', 'font_options', false, array() );
		foreach ($h2_typo as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>

}

h3 {

	<?php
		$h3_typo = zget_option( 'h3_typo', 'font_options', false, array() );
		foreach ($h3_typo as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>

}

h4 {

	<?php
		$h4_typo = zget_option( 'h4_typo', 'font_options', false, array() );
		foreach ($h4_typo as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>

}

h5 {

	<?php
		$h5_typo = zget_option( 'h5_typo', 'font_options', false, array() );
		foreach ($h5_typo as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}

h6 {

	<?php
		$h6_typo = zget_option( 'h6_typo', 'font_options', false, array() );
		foreach ($h6_typo as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}

/* Body */
body{

	<?php
		// Check if font option has body color included
		$body_tcolor_fonts = '';
		// Add body fonts values
		$body_font = zget_option( 'body_font', 'font_options', false, array() );
		foreach ($body_font as $key => $value) {
			echo $key .':'. $value.';';
			if( $key = 'color' ){
				$body_tcolor_fonts = $value;
			}
		}
	?>
}
/* Grey Area */
body .gray-area {

	<?php
		$ga_font = zget_option( 'ga_font', 'font_options', false, array() );
		foreach ($ga_font as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}
/* Footer Area */
body #footer {

	<?php
		$footer_font = zget_option( 'footer_font', 'font_options', false, array() );
		foreach ($footer_font as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}

/* Add Text Color, but check first if the Color option from Body Fonts exists and use that one */
body {
	<?php
		if(empty( $body_tcolor_fonts )){
			if($zn_body_def_textcolor = zget_option( 'zn_body_def_textcolor', 'color_options' )){
				echo 'color:'.$zn_body_def_textcolor.';';
			}
		}
	?>
}
/* Link Color */
a {
	<?php
		if($zn_body_def_linkscolor = zget_option( 'zn_body_def_linkscolor', 'color_options' )){
			echo 'color:'.$zn_body_def_linkscolor.';';
		}
	?>
}
/* Link Hover Color */
a:focus,
a:hover {
	<?php
		if($zn_body_def_linkscolor_hov = zget_option( 'zn_body_def_linkscolor_hov', 'color_options' )){
			echo 'color:'.$zn_body_def_linkscolor_hov.';';
		}
	?>
}

body #page_wrapper ,
body.boxed #page_wrapper {

	<?php

	// Color
	$zn_body_def_color = zget_option( 'zn_body_def_color', 'color_options' );
	if ( isset($zn_body_def_color) && !empty($zn_body_def_color) ) {
		echo 'background-color:'.$zn_body_def_color.';';
	}

	// Image
	$body_back_image = zget_option( 'body_back_image', 'color_options', false, array() );

	if( !empty( $body_back_image['image'] ) ) { echo 'background-image:url("'.$body_back_image['image'].'");'; }
	if( !empty( $body_back_image['repeat'] ) ) { echo 'background-repeat:'.$body_back_image['repeat'].';'; }
	if( !empty( $body_back_image['position'] ) ) { echo 'background-position:'.$body_back_image['position']['x'].' '.$body_back_image['position']['y'].';'; }
	if( !empty( $body_back_image['attachment'] ) ) { echo 'background-attachment:'.$body_back_image['attachment'].';'; }
	?>
}

/* Force background color for sections after Fixed Position IOS Slider */
.ios-fixed-position-scr ~ .zn_section { background-color:<?php echo $zn_body_def_color;?>}

.kl-bottommask .bmask-bgfill { fill: <?php echo $zn_body_def_color;?>; }

.gray-area {

	<?php
	// Color
	if ( $zn_gr_area_def_color = zget_option( 'zn_gr_area_def_color', 'color_options' ) ) {
		echo 'background-color:'.$zn_gr_area_def_color.';';
	}
	// Image
	$gr_arr_back_image = zget_option( 'gr_arr_back_image', 'color_options', false, array() );
	if( !empty( $gr_arr_back_image['image'] ) ) { echo 'background-image:url("'.$gr_arr_back_image['image'].'");'; }
	if( !empty( $gr_arr_back_image['repeat'] ) ) { echo 'background-repeat:'.$gr_arr_back_image['repeat'].';'; }
	if( !empty( $gr_arr_back_image['position'] ) ) { echo 'background-position:'.$gr_arr_back_image['position']['x'].' '.$gr_arr_back_image['position']['y'].';'; }
	if( !empty( $gr_arr_back_image['attachment'] ) ) { echo 'background-attachment:'.$gr_arr_back_image['attachment'].';'; }
	?>
}

<?php
/* LAYOUT OPTIONS - BOXED */
	if(zget_option( 'zn_width' , 'layout_options', false, '1170' ) == '960'){
		echo '@media screen and (min-width: 1200px) { .container {width: 970px; } }';
	}

/* SEARCH BUTTON */
	if( zget_option( 'head_show_search' , 'general_options', false, 'yes' ) == 'no' ){
		echo '.main-nav {clear: right;}';
	}

/* RESPONSIVE MENU TRIGGER */
$menu_trigger = zget_option( 'header_res_width', 'general_options', false, 992 );
$menu_trigger2 = $menu_trigger + 1;
echo "
@media (max-width: {$menu_trigger}px) {
	#main-menu { display: none !important;}
}
@media (min-width: {$menu_trigger2}px) {
	.zn-res-menuwrapper { display: none;}
}
";

/* CUSTOM HEADER HEIGHT */
$zn_header_layout = zget_option( 'zn_header_layout' , 'general_options', false, 'style2' );
$zn_head_height = (int)zget_option( 'zn_head_height' , 'general_options', false, false );
if( !empty($zn_head_height) && !in_array( $zn_header_layout, array('style7', 'style8', 'style9') ) ){

		echo '
/** Header height */
.site-header,
.logosize--contain .site-logo a { height:'.$zn_head_height.'px; }
.logosize--contain .site-logo .logo-img,
.logosize--contain .site-logo .logo-img-sticky { max-height:'.$zn_head_height.'px;}
/** Autosized logo, add a minheight for proper display */
.logosize--yes .site-logo {min-height: '.$zn_head_height.'px;}
/** Page-subheader padding (default) */
.page-subheader:not(.site-subheader-cst) .ph-content-wrap {padding-top:'.$zn_head_height.'px;}
		';

	if( $zn_header_layout != 'style7' && $zn_header_layout != 'style8' && $zn_header_layout != 'style8' ){
		echo '.site-header.site-header--relative.header--sticky + .siteheader-helper { height:'.$zn_head_height.'px; }';
	}
}


/*----------------------  Logo --------------------------*/
if( $logo_image = zget_option( 'logo_upload', 'general_options' ) ) {

	$logo_saved_size_type = zget_option( 'logo_size', 'general_options', false, 'yes' );
		$logo_width = '';
		$logo_height = '';

	if( $logo_saved_size_type == 'yes'){

		$logo_size = getimagesize($logo_image);

		if (isset($logo_size[0]) && isset($logo_size[1])) {
			$logo_width = 'width:auto;';
			$logo_height = 'height:auto;';
		}

	}
	elseif( $logo_saved_size_type == 'no'){

		$logo_saved_sizes = zget_option( 'logo_manual_size', 'general_options', false, 'false' );

		if ( !empty( $logo_saved_sizes['width'] ) ) {
			$logo_width = 'width:'.$logo_saved_sizes['width'].'px;';
		}
		if( !empty( $logo_saved_sizes['height'] ) ) {
			$logo_height = 'height:'.$logo_saved_sizes['height'].'px;';
		}
	}
?>
.site-logo .logo-img {
	max-width:none;
	<?php echo $logo_width; ?>
	<?php echo $logo_height; ?>
}

<?php }
else { ?>
.site-logo,
.site-logo a  {
	text-decoration:none;
	<?php
		$logo_font_option = zget_option( 'logo_font', 'general_options', false, array() );
		foreach ($logo_font_option as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}

.site-logo a:hover {
	<?php if ( $logo_hover_color = zget_option( 'logo_hover', 'general_options', false, array() ) ) {
		foreach ($logo_hover_color as $key => $value) {
			echo $key .':'. $value.';';
		}
	} ?>
}

<?php } ?>

/*----------------------  Header --------------------------*/

.uh_zn_def_header_style ,
.zn_def_header_style ,
.page-subheader.zn_def_header_style ,
.kl-slideshow.zn_def_header_style ,
.page-subheader.uh_zn_def_header_style ,
.kl-slideshow.uh_zn_def_header_style {
<?php if ( $def_header_color = zget_option( 'def_header_color', 'general_options' ) ) { echo 'background-color:'.$def_header_color.';'; } ?>
}

.page-subheader.zn_def_header_style .bgback ,
.kl-slideshow.zn_def_header_style .bgback ,
.page-subheader.uh_zn_def_header_style .bgback ,
.kl-slideshow.uh_zn_def_header_style .bgback{
<?php if ( $def_header_background = zget_option( 'def_header_background', 'general_options', false, false ) ) { echo 'background-image:url("'.$def_header_background.'");'; } ?>
}

<?php

/* PAGE SUBHEADER */
	$def_header_height = zget_option( 'def_header_custom_height', 'general_options', false, false );
	if( ! empty( $def_header_height ) ){
		echo "
			.page-subheader.zn_def_header_style,
			.page-subheader.uh_zn_def_header_style {
				min-height: {$def_header_height}px;
				height: {$def_header_height}px;
			}
		";
	}


	echo '
		.page-subheader.zn_def_header_style ,
		.kl-slideshow.zn_def_header_style,
		.page-subheader.uh_zn_def_header_style ,
		.kl-slideshow.uh_zn_def_header_style {';
		// GRADIENT OVER COLOR
		if ( zget_option( 'def_grad_bg', 'general_options', false, 1 ) ) {
			echo 'background-image: -moz-linear-gradient(top, transparent 0%, rgba(0,0,0,0.5) 100%);';
			echo 'background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,transparent), color-stop(100%,rgba(0,0,0,0.5)));';
			echo 'background-image: -webkit-linear-gradient(top, transparent 0%,rgba(0,0,0,0.5) 100%);';
			echo 'background-image: -o-linear-gradient(top, transparent 0%,rgba(0,0,0,0.5) 100%);';
			echo 'background-image: -ms-linear-gradient(top, transparent 0%,rgba(0,0,0,0.5) 100%);';
			echo 'background-image: linear-gradient(to bottom, transparent 0%,rgba(0,0,0,0.5) 100%);';
			echo "filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#80000000',GradientType=0 );";
		}
	echo '}';

	// GLARE EFFECT
	if ( zget_option( 'def_glare', 'general_options', false, 0 ) ) {
			echo '
			.page-subheader.zn_def_header_style .bgback:after,
			.kl-slideshow.zn_def_header_style .bgback:after,
			.page-subheader.uh_zn_def_header_style .bgback:after,
			.kl-slideshow.uh_zn_def_header_style .bgback:after {';
			echo 'content:""; position:absolute; top:0; left:0; width:100%; height:100%; z-index:-1;background-image: url('.get_template_directory_uri().'/images/glare-effect.png); background-repeat: no-repeat; background-position: center top;';
		echo '}';
	}

	// Animation
	if ( zget_option( 'def_header_animate', 'general_options', false, 0 ) ) {
		echo '
		.zn_def_header_style .th-sparkles,
		.kl-slideshow.zn_def_header_style .th-sparkles,
		.uh_zn_def_header_style .th-sparkles,
		.kl-slideshow.uh_zn_def_header_style .th-sparkles {display:block}';
	}

	// Default SHADOW
	$def_bottom_style = zget_option( 'def_bottom_style', 'general_options', false, false );
	/*
		Commented as per https://github.com/hogash/kallyas/issues/386
	*/
	// $zn_main_style = zget_option( 'zn_main_style', 'color_options', false, 'light' );
	$zn_main_style = 'light';

	if ( $def_bottom_style == 'shadow' ) {

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style {';
			echo 'position:absolute; bottom:0; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-up.png) no-repeat center bottom; z-index: 2;';
		echo '}';

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style:after , .kl-slideshow.zn_def_header_style .zn_header_bottom_style:after,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style:after , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style:after {';
			echo 'content:\'\'; position:absolute; bottom:-18px; left:50%; border:6px solid transparent; border-top-color:#fff; margin-left:-6px;';
		echo '}';

		echo '.page-subheader.zn_def_header_style, .kl-slideshow.zn_def_header_style,';
		echo '.page-subheader.uh_zn_def_header_style, .kl-slideshow.uh_zn_def_header_style {';
			echo 'border-bottom:6px solid #FFFFFF';
		echo '}';

	}


	// SHADOW UP AND DOWN
	if ( $def_bottom_style == 'shadow_ud' ) {

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style {';
			echo 'position:absolute; bottom:0; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-up.png) no-repeat center bottom; z-index: 2;';
		echo '}';

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style:after , .kl-slideshow.zn_def_header_style .zn_header_bottom_style:after,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style:after , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style:after {';
			echo 'content:\'\'; position:absolute; bottom:-18px; left:50%; border:6px solid transparent; border-top-color:#fff; margin-left:-6px;';
		echo '}';

		echo '.page-subheader.zn_def_header_style, .kl-slideshow.zn_def_header_style,';
		echo '.page-subheader.uh_zn_def_header_style, .kl-slideshow.uh_zn_def_header_style {';
			echo 'border-bottom:6px solid #FFFFFF';
		echo '}';

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style:before , .kl-slideshow.zn_def_header_style .zn_header_bottom_style:before,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style:before , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style:before {';
			echo 'content:\'\'; position:absolute; bottom:-26px; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-down.png) no-repeat center top; opacity:.6; filter:alpha(opacity=60);';
		echo '}';

	}

	// MASK 1
	if ( $def_bottom_style == 'mask1' && $zn_main_style == 'light' ) {

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style {';
			echo 'position:absolute; bottom:0; left:0; width:100%; height:27px; z-index:99; background:url('.get_template_directory_uri().'/images/bottom_mask.png) no-repeat center top;';
		echo '}';

	}
	/*
		Commented as per https://github.com/hogash/kallyas/issues/386
	*/
	// elseif ( $def_bottom_style == 'mask1' && $zn_main_style == 'dark' )  {
	// 	echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style {';
	// 		echo 'position:absolute; bottom:0; left:0; width:100%; height:27px; z-index:99; background:url('.get_template_directory_uri().'/images/bottom_mask_dark.png) no-repeat center top;';
	// 	echo '}';
	// }

	// MASK 2
	if ( $def_bottom_style == 'mask2' && $zn_main_style == 'light' ) {

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style {';
			echo 'position:absolute; bottom:0; left:0; width:100%; z-index:99; ';
			echo 'height:33px; background:url('.get_template_directory_uri().'/images/bottom_mask2.png) no-repeat center top;';
		echo '}';

	}
	/*
		Commented as per https://github.com/hogash/kallyas/issues/386
	*/
	// elseif ( $def_bottom_style == 'mask2' && $zn_main_style == 'dark' ) {
	// 	echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style {';
	// 		echo 'position:absolute; bottom:0; left:0; width:100%;  z-index:99; ';
	// 		echo 'height:33px; background:url('.get_template_directory_uri().'/images/bottom_mask2_dark.png) no-repeat center top;';
	// 	echo '}';
	// }
?>



/*----------------------  Unlimited Headers --------------------------*/

<?php
	$saved_headers = zget_option( 'header_generator', 'unlimited_header_options', false, array() );
	foreach ( $saved_headers as $header ) {

		if ( isset ( $header['uh_style_name'] ) && !empty ( $header['uh_style_name'] ) ) {
			$header_name = strtolower ( str_replace(' ','_',$header['uh_style_name'] ) );

			// Background type
			$bg_type = isset($header['uh_bg_type']) && !empty($header['uh_bg_type']) ? $header['uh_bg_type'] : 'simple_bg';

			// Page header + BGBACK
			echo '.page-subheader.uh_'.$header_name.' .bgback , .kl-slideshow.uh_'.$header_name.' .bgback {';

			if($bg_type == 'simple_bg'){

				if ( isset ( $header['uh_background_image'] ) && !empty ( $header['uh_background_image'] ) ) {
					echo 'background-image:url("'.$header['uh_background_image'].'");';
				}

			} else if($bg_type == 'advanced_bg'){
				$advanced_bg = $header['uh_background_image_advanced'];

				if ( isset ( $advanced_bg ) && !empty ( $advanced_bg ) ) {

	                $background_image = $advanced_bg['image'];

	                $background_styles = array();
	                $background_styles[] = 'background-image:url('.$background_image.')';
	                $background_styles[] = 'background-repeat:'.$advanced_bg['repeat'];
	                $background_styles[] = 'background-attachment:'.$advanced_bg['attachment'];
	                $background_styles[] = 'background-position:'.$advanced_bg['position']['x'].' '.$advanced_bg['position']['y'];
	                $background_styles[] = 'background-size:'.$advanced_bg['size'];

	                if ( !empty($background_image) ) {
	                    echo implode(';', $background_styles);
	                }

				}
			}

			echo '}';

			// Animate - Page header + SPARKLES
			if ( !empty ( $header['uh_anim_bg'] ) ) {
				echo '.uh_'.$header_name.' .th-sparkles , .kl-slideshow.uh_'.$header_name.' .th-sparkles {display:block}';
			}
			else {
				echo '.uh_'.$header_name.' .th-sparkles , .kl-slideshow.uh_'.$header_name.' .th-sparkles{display:none}';
			}

			// COLOR - Page header
			echo '.page-subheader.uh_'.$header_name.' , .kl-slideshow.uh_'.$header_name.' {';

			if ( isset ( $header['uh_header_color'] ) && !empty ( $header['uh_header_color'] ) ) {
				echo 'background-color:'.$header['uh_header_color'].';';
			}

			// GRADIENT OVER COLOR
			if ( isset ( $header['uh_grad_bg'] ) && !empty ( $header['uh_grad_bg'] ) ) {

				echo 'background-image: -moz-linear-gradient(top, transparent 0%, rgba(0,0,0,0.5) 100%);';
				echo 'background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,transparent), color-stop(100%,rgba(0,0,0,0.5)));';
				echo 'background-image: -webkit-linear-gradient(top, transparent 0%,rgba(0,0,0,0.5) 100%);';
				echo 'background-image: -o-linear-gradient(top, transparent 0%,rgba(0,0,0,0.5) 100%);';
				echo 'background-image: -ms-linear-gradient(top, transparent 0%,rgba(0,0,0,0.5) 100%);';
				echo 'background-image: linear-gradient(to bottom, transparent 0%,rgba(0,0,0,0.5) 100%);';
				echo "filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#80000000',GradientType=0 );";
			}

			echo '}';

			// GLARE EFFECT
			if ( isset ( $header['uh_glare'] ) && !empty ( $header['uh_glare'] ) ) {

				echo '.page-subheader.uh_'.$header_name.' .bgback:after , .kl-slideshow.uh_'.$header_name.' .bgback:after {';
					echo 'content:""; position:absolute; top:0; left:0; width:100%; height:100%; z-index:-1;background-image: url('.get_template_directory_uri().'/images/glare-effect.png); background-repeat: no-repeat; background-position: center top;';
				echo '}';

			}

			// Intentionally skipped "kl-slideshow" class
			echo '.page-subheader.uh_'.$header_name.':not(.site-subheader-cst){';
				// Custom Height
				$header_height = $header['uh_header_height'];
				if ( isset ( $header_height ) && !empty ( $header_height ) ) {
					if($header_height != 300){
						echo 'height:'.$header_height.'px; min-height:'.$header_height.'px;';
					}
				}
			echo '}';
			echo '.page-subheader.uh_'.$header_name.':not(.site-subheader-cst) .ph-content-wrap {';
				// Custom Top Padding
				$subheader_top_padding = $header['uh_top_padding'];
				if ( isset ( $subheader_top_padding ) && !empty ( $subheader_top_padding ) ) {
					if($subheader_top_padding != 170){
						echo 'padding-top:'.$subheader_top_padding.'px;';
					}
				}
				// Custom Bottom Padding
				$subheader_bottom_padding = $header['uh_bottom_padding'];
				if ( isset ( $subheader_bottom_padding ) && !empty ( $subheader_bottom_padding ) ) {
					if($subheader_bottom_padding != 0){
						echo 'padding-bottom:'.$subheader_bottom_padding.'px;';
					}
				}
			echo '}';

			// Subheader height & padding for MEDIUM
			echo '@media screen and (min-width:992px) and (max-width:1199px) {';
				echo '.page-subheader.uh_'.$header_name.':not(.site-subheader-cst){';
					// Custom Height
					$header_height_md = $header['uh_header_height_md'];
					if ( isset ( $header_height_md ) && !empty ( $header_height_md ) ) {
						if($header_height_md != 300){
							echo 'height:'.$header_height_md.'px; min-height:'.$header_height_md.'px;';
						}
					}
				echo '}';
				echo '.page-subheader.uh_'.$header_name.':not(.site-subheader-cst) .ph-content-wrap {';
					// Custom Top Padding
					$subheader_top_padding_md = $header['uh_top_padding_md'];
					if ( isset ( $subheader_top_padding_md ) && !empty ( $subheader_top_padding_md ) ) {
						if($subheader_top_padding_md != 170){
							echo 'padding-top:'.$subheader_top_padding_md.'px;';
						}
					}
					// Custom Bottom Padding
					$subheader_bottom_padding_md = $header['uh_bottom_padding_md'];
					if ( isset ( $subheader_bottom_padding_md ) && !empty ( $subheader_bottom_padding_md ) ) {
						if($subheader_bottom_padding_md != 0){
							echo 'padding-bottom:'.$subheader_bottom_padding_md.'px;';
						}
					}
				echo '}';
			echo '}';

			// Subheader height & padding for SMALL
			echo '@media screen and (min-width:768px) and (max-width:991px) {';
				echo '.page-subheader.uh_'.$header_name.':not(.site-subheader-cst){';
					// Custom Height
					$header_height_sm = $header['uh_header_height_sm'];
					if ( isset ( $header_height_sm ) && !empty ( $header_height_sm ) ) {
						if($header_height_sm != 300){
							echo 'height:'.$header_height_sm.'px; min-height:'.$header_height_sm.'px;';
						}
					}
				echo '}';
				echo '.page-subheader.uh_'.$header_name.':not(.site-subheader-cst) .ph-content-wrap {';
					// Custom Top Padding
					$subheader_top_padding_sm = $header['uh_top_padding_sm'];
					if ( isset ( $subheader_top_padding_sm ) && !empty ( $subheader_top_padding_sm ) ) {
						if($subheader_top_padding_sm != 170){
							echo 'padding-top:'.$subheader_top_padding_sm.'px;';
						}
					}
					// Custom Bottom Padding
					$subheader_bottom_padding_sm = $header['uh_bottom_padding_sm'];
					if ( isset ( $subheader_bottom_padding_sm ) && !empty ( $subheader_bottom_padding_sm ) ) {
						if($subheader_bottom_padding_sm != 0){
							echo 'padding-bottom:'.$subheader_bottom_padding_sm.'px;';
						}
					}
				echo '}';
			echo '}';

			// Subheader height & padding for EXTRA SMALL
			echo '@media screen and (max-width:767px) {';
				echo '.page-subheader.uh_'.$header_name.':not(.site-subheader-cst){';
					// Custom Height
					$header_height_xs = $header['uh_header_height_xs'];
					if ( isset ( $header_height_xs ) && !empty ( $header_height_xs ) ) {
						if($header_height_xs != 300){
							echo 'height:'.$header_height_xs.'px; min-height:'.$header_height_xs.'px;';
						}
					}
				echo '}';
				echo '.page-subheader.uh_'.$header_name.':not(.site-subheader-cst) .ph-content-wrap {';
					// Custom Top Padding
					$subheader_top_padding_xs = $header['uh_top_padding_xs'];
					if ( isset ( $subheader_top_padding_xs ) && !empty ( $subheader_top_padding_xs ) ) {
						if($subheader_top_padding_xs != 170){
							echo 'padding-top:'.$subheader_top_padding_xs.'px;';
						}
					}
					// Custom Bottom Padding
					$subheader_bottom_padding_xs = $header['uh_bottom_padding_xs'];
					if ( isset ( $subheader_bottom_padding_xs ) && !empty ( $subheader_bottom_padding_xs ) ) {
						if($subheader_bottom_padding_xs != 0){
							echo 'padding-bottom:'.$subheader_bottom_padding_xs.'px;';
						}
					}
				echo '}';
			echo '}';



			// Default SHADOW
			if ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'shadow' ) {

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
					echo 'position:absolute; bottom:0; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-up.png) no-repeat center bottom; z-index: 2;';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style:after , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style:after {';
					echo 'content:\'\'; position:absolute; bottom:-18px; left:50%; border:6px solid transparent; border-top-color:#fff; margin-left:-6px;';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.', .kl-slideshow.uh_'.$header_name.' {';
					echo 'border-bottom:6px solid #FFFFFF';
				echo '}';

			}


			// SHADOW UP AND DOWN
			if ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'shadow_ud' ) {

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
					echo 'position:absolute; bottom:0; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-up.png) no-repeat center bottom; z-index: 2;';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style:after , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style:after {';
					echo 'content:\'\'; position:absolute; bottom:-18px; left:50%; border:6px solid transparent; border-top-color:#fff; margin-left:-6px;';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.', .kl-slideshow.uh_'.$header_name.' {';
					echo 'border-bottom:6px solid #FFFFFF';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style:before , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style:before {';
					echo 'content:\'\'; position:absolute; bottom:-26px; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-down.png) no-repeat center top; opacity:.6; filter:alpha(opacity=60);';
				echo '}';

			}

			// MASK 1
			if ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'mask1' && $zn_main_style == 'light' ) {

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
					echo 'position:absolute; bottom:0; left:0; width:100%; height:27px; z-index:99; background:url('.get_template_directory_uri().'/images/bottom_mask.png) no-repeat center top;';
				echo '}';

			}
			/*
				Commented as per https://github.com/hogash/kallyas/issues/386
			*/
			// elseif ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'mask1' && $zn_main_style == 'dark' )  {
			// 	echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
			// 		echo 'position:absolute; bottom:0; left:0; width:100%; height:27px; z-index:99; background:url('.get_template_directory_uri().'/images/bottom_mask_dark.png) no-repeat center top;';
			// 	echo '}';
			// }

			// MASK 2
			if ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'mask2' && $zn_main_style == 'light' ) {

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
					echo 'position:absolute; bottom:0; left:0; width:100%; z-index:99; ';
					echo 'height:33px; background:url('.get_template_directory_uri().'/images/bottom_mask2.png) no-repeat center top;';
				echo '}';

			}
			/*
				Commented as per https://github.com/hogash/kallyas/issues/386
			*/
			// elseif ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'mask2' && $zn_main_style == 'dark' ) {
			// 	echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
			// 		echo 'position:absolute; bottom:0; left:0; width:100%;  z-index:99; ';
			// 		echo 'height:33px; background:url('.get_template_directory_uri().'/images/bottom_mask2_dark.png) no-repeat center top;';
			// 	echo '}';
			// }

		}

	}

?>
/* GENERAL COLOR */
<?php
	$zn_main_color = zget_option( 'zn_main_color', 'color_options', false, '#cd2122' );
?>

.itemBody img:hover {
	outline: 5px solid <?php echo $zn_main_color; ?>;
}
/* Text - Main Color */
 a:hover,
.cart-container > .widget_shopping_cart_content .checkout,
.sc-infopop__btn,
.m_title,
.smallm_title,
.circle_title,
.zn_text_box-title--style1,
.feature_box .title,
.services_box--classic .services_box__title,
.latest_posts.default-style .hoverBorder:hover h6,
.latest_posts.style2 ul.posts .title,
.recentwork_carousel--1 .recentwork_carousel__crsl-title,
.acc--default-style .acc-tgg-button,
.acc--style3 .acc-tgg-button:after,
.screenshot-box .left-side h3.title,
.vertical_tabs.kl-style-1 .tabbable .nav>li.active>a,
.services_box_element .box .list li,
.shop-latest .tabbable .nav li.active a,
.product-list-item:hover .details h3,
.product-category .product-list-item:hover h3,
.eBlog .itemContainer:not(.featured-post) .post_details .catItemAuthor a,
.theHoverBorder:hover,
.text-custom,
.text-custom-hover:hover,
.statbox h4 , #bbpress-forums .bbp-topics li.bbp-body .bbp-topic-title > a,
.ib2-text-color-light-theme .ib2-info-message:before,
.tbk--color-theme.tbk-symbol--icon .tbk__icon,
.pricing-table-element .plan-column .plan-title,
.process_steps--style2 .process_steps__step-icon,
.vertical_tabs.kl-style-2 .tabbable .nav>li>a:hover,
.vertical_tabs.kl-style-2 .tabbable .nav>li.active>a [data-zn_icon]:before,
.vertical_tabs.kl-style-2 .tabbable .nav>li>a:hover [data-zn_icon]:before,
.services_box--boxed .services_box__fonticon,
.services_box--boxed .services_box__list li,
.woocommerce ul.product_list_widget li .star-rating,
.woocommerce .woocommerce-product-rating .star-rating,
body .static-content__infopop .sc-infopop__btn,
.acc--style3 .acc-tgg-button:hover,
.acc--style3 .acc-tgg-button:hover:after,
.acc--default-style .acc-tgg-button,
.acc--style2 .acc-tgg-button,
.acc--style3 .acc-tgg-button,
.acc--style4 .acc-tgg-button,
.circle-text-box .wpk-circle-title,
.services_box--modern .services_box__fonticon
{color:<?php echo $zn_main_color; ?>;}

/* Border - Main Color */
.acc--style4,
#page-loading:after,
.ib2-text-color-light-theme .ib2-info-message:before,
.itemThumbnail .overlay__inner a:hover,
.acc--style4 .acc-tgg-button .acc-icon{ border-color: <?php echo $zn_main_color;?>  }

/* Background Color - Main Color */
.main-nav > ul > li > a:before,
.main-nav .zn_mega_container li a:not(.zn_mega_title):before,
.social-icons.sc--normal li a:hover,
.elm-social-icons.sc--normal .elm-sc-icon:hover,
.action_box,
body .circlehover,
body .kl-flex--classic .zn_general_carousel-arr:hover,
body .kl-ioscaption--style1 .more:before,
body .kl-ioscaption--style1 .more:after,
body .kl-ioscaption--style2 .more,
body .nivo-directionNav a:hover,
body .th-wowslider a.ws_next:hover,
body .th-wowslider a.ws_prev:hover,
body .ca-more,
body .title_circle,
body .title_circle:before,
body ul.links li a,
.hg-portfolio-sortable #portfolio-nav li a:hover, .hg-portfolio-sortable #portfolio-nav li.current a,
.kl-ioscaption--style1 .more:before, .kl-ioscaption--style1 .more:after,
.btn-flat ,
.zn_limited_offers li:after,
.login-panel .login_facebook ,
.imgboxes_style1 .hoverBorder h6,
.circlehover:before,
.kl-cta-ribbon,
.newsletter-signup input[type=submit],
.recentwork_carousel--1 .recentwork_carousel__bg,
.zn-acc--style4 .acc-title,
.zn-acc--style3 .acc-tgg-button:before,
.process_box .content:before,
#bbpress-forums div.bbp-search-form input[type=submit], #bbpress-forums .bbp-submit-wrapper button, #bbpress-forums #bbp-your-profile fieldset.submit button,
.bg-custom,
.bg-custom-hover:hover,
.site-header.style8 .kl-main-header .kl-cta-lined,
.site-header.style9 .kl-cta-lined,
.latest_posts.default-style.kl-style-2 .lp-title,
.latest_posts.default-style.kl-style-2 .post:not(.lp-title) .m_title:after,
.latest_posts.default-style .hoverBorder h6,
.itemThumbnail .overlay__inner a:hover,
.elm-searchbox--normal .elm-searchbox__submit,
.elm-searchbox--transparent .elm-searchbox__submit,
.itemThumbnail .overlay__inner a:hover,
.zn-acc--style4 .acc-tgg-button .acc-icon:before,
span.zn_badge_sale,
span.zn_badge_sale:after,
.zn_limited_offers li:before,
.style3 .action_box_inner,
.style3 .action_box_inner:before,
.action_box.style3:before,
.circlehover.style2,
.circlehover.style2:before,
body .kl-flex--classic .zn_simple_carousel-arr:hover,
.how_to_shop .number, .newsletter-signup input[type=submit],
.th-map_controls,
.hg-portfolio-sortable #portfolio-nav li.current a,
.ptcarousel .controls > a:hover,
.itemLinks span a:hover,
.product-list-item .kw-actions a,
.woocommerce ul.products li.product .product-list-item .kw-actions a,
.shop-features .shop-feature:hover,
.btn-flat,
.redbtn,
.imgboxes_style1 .hoverBorder h6,
.feature_box.style3 .box:hover,
.services_box--classic:hover .services_box__icon,
.services_box_element:hover .box .icon,
.latest_posts.default-style .hoverBorder h6,
.process_steps--style1 .process_steps__intro,
.process_steps--style2 .process_steps__intro,
.process_steps--style2 .process_steps__intro:before,
.recentwork_carousel.style2 li a .details .plus,
.gobox.ok:before,
.gobox.ok:after,
.gobox.ok,
.hover-box:hover,
.recentwork_carousel--1 .recentwork_carousel__bg,
.circlehover:before,.kl-ioscaption--style1 .more:before,
.kl-ioscaption--style1 .more:after ,
.kl-ioscaption--style2 .more,
.process_box4 .number:before,
.loginbox-popup input[type=submit],
.login-panel .login_facebook,
.circle-text-box.style3 .wpk-circle-span,
.circle-text-box.style2 .wpk-circle-span::before,
.circle-text-box:not(.style3) .wpk-circle-span:after,
body .kl-ioscaption--style3.s3ext .main_title::before,
body .kl-ios-selectors-block.bullets2 .item.selected::before,
.iosslider__item .kl-ioscaption--style5 .klios-separator-line span,
.btn-fullcolor,
.btn-fullcolor:focus,
.btn-fullcolor.btn-skewed:before,
.cart-container .buttons .button.wc-forward,
body .kl-flex--modern .flex-underbar,
.tbk--color-theme.tbk-symbol--line .tbk__symbol span,
.tbk--color-theme.tbk-symbol--line_border .tbk__symbol span,
.ls__nav-item.selected,
.site-header.style7 .kl-cart-button .glyphicon:after,
.how_to_shop .number,
.recentwork_carousel--2 .recentwork_carousel__title:after,
.recentwork_carousel_v3 .btn::before,
.recentwork_carousel--2 .recentwork_carousel__cat,
.recentwork_carousel_v2 .recentwork_carousel__plus,
.recentwork_carousel_v3 .recentwork_carousel__cat,
.pricing-table-element .plan-column.featured .subscription-price .inner-cell,
.shop-latest .tabbable .nav li.active a:before,
.product-list-item .kw-actions a, .woocommerce ul.products li.product .product-list-item .kw-actions a,
.latest_posts.style2 ul.posts .details span.date,
.eBlog .related-articles .rta-post > a:after,
.shop-features .shop-feature:hover,
.cart-container .buttons .button.wc-forward,
.media-container__link--style-borderanim1 > i,
.site-header .kl-cart-button .glyphicon:after,
.chaser .main-menu li.active > a,
.imgboxes_style4 .imgboxes-title:after,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce button.button.alt,
.woocommerce input.button,
.woocommerce input#button,
.woocommerce #review_form #submit
 {background-color:<?php echo $zn_main_color;?>;}

/* Hover Background color - Main Color */
.btn-fullcolor:hover,
.btn-fullcolor.btn-skewed:hover:before,
.cart-container .buttons .button.wc-forward:hover,
.woocommerce a.button:hover,
.woocommerce button.button:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button:hover,
.woocommerce input#button:hover,
.woocommerce #review_form #submit:hover { background-color: <?php echo adjustBrightness($zn_main_color, 20); ?> }

/* Border left - Main Color */
.breadcrumbs li:after,
.ib2-text-color-light-theme .ib2-inner,
.process_steps--style1 .process_steps__intro:after,
body .nivo-caption,
body .kl-flex--classic .flex-caption,
body .th-wowslider .ws-title,
.process_box[data-align=left] .content:after,
body .ls--laptop .ls__item-caption
{border-left-color:<?php echo $zn_main_color;?>; }

/* Border Bottom - Main Color */
.site-header.style8 .kl-main-header,
.site-header.style9,
.shop-latest .tabbable .nav li.active a:after,
.zn_post_image,
.zn_full_image,
.sidebar .widget .widgettitle:after,
.imgboxes_style4.kl-title_style_bottom .imgboxes-border-helper,
.imgboxes_style4.kl-title_style_bottom:hover .imgboxes-border-helper,
.statistic-box__line {border-bottom-color:<?php echo $zn_main_color;?>}

/* Various properties - Main Color */
.tabs_style5 > ul.nav > li.active > a { border-bottom: 2px solid <?php echo $zn_main_color;?>;}

header.style1,
header.style2 .site-logo a,
header.style3 .site-logo a {border-top: 3px solid <?php echo $zn_main_color;?>;}

.tabs_style1 > ul.nav > li.active > a { box-shadow: inset 0 3px 0 <?php echo $zn_main_color;?>;}

.kl-cta-ribbon .trisvg path,
.kl-bottommask .bmask-customfill,
.kl-slideshow .kl-loader svg path,
.kl-slideshow  .kl-loadersvg rect,
.kl-diagram circle { fill: <?php echo $zn_main_color;?>; }

.action_box:before, .action_box:after, .site-header.style1, .site-header.style6 { border-top-color:<?php echo $zn_main_color;?>; }

.process_box[data-align=right] .content:after { border-right-color:<?php echo $zn_main_color;?>; }

.theHoverBorder:hover {box-shadow:0 0 0 5px <?php echo $zn_main_color;?> inset;}

.vertical_tabs.kl-style-1 .tabbable .nav>li.active>a {box-shadow:inset -3px 0 0 0 <?php echo $zn_main_color;?> inset;}

.offline-page .containerbox {border-bottom:5px solid <?php echo $zn_main_color;?>; }

.offline-page .containerbox:after {border-top: 20px solid <?php echo $zn_main_color;?>;}

.site-header.style2 .site-logo a {border-top: 3px solid <?php echo $zn_main_color;?>;}

body .kl-ioscaption--style2 .title_big, body .kl-ioscaption--style2 .title_small {border-left: 5px solid <?php echo $zn_main_color;?>; }
body .kl-ioscaption--style2.fromright .title_big,
body .kl-ioscaption--style2.fromright .title_small {border-right: 5px solid <?php echo $zn_main_color;?> ; }

/* Buddypress styles */
#buddypress form#whats-new-form p.activity-greeting:after {border-top-color: <?php echo $zn_main_color;?>;}
#buddypress input[type=submit],
#buddypress input[type=button],
#buddypress input[type=reset] ,
#buddypress .activity-list li.load-more a {background: <?php echo $zn_main_color;?>;}
#buddypress div.item-list-tabs ul li.selected a,
#buddypress div.item-list-tabs ul li.current a {border-top: 2px solid <?php echo $zn_main_color;?>;}
#buddypress form#whats-new-form p.activity-greeting,
.widget.buddypress ul.item-list li:hover {background-color: <?php echo $zn_main_color;?>;}
.widget.buddypress div.item-options a.selected ,
#buddypress div.item-list-tabs ul li.selected a,
#buddypress div.item-list-tabs ul li.current a ,
#buddypress div.activity-meta a ,
#buddypress div.activity-meta a:hover,
#buddypress .acomment-options a
{color:<?php echo $zn_main_color;?>;}

.keywordbox.keywordbox-2 { border-bottom: solid 5px <?php echo $zn_main_color;?>;}
.keywordbox.keywordbox-3 { border-bottom: solid 10px <?php echo $zn_main_color;?>;}

.statistics-horizontal .v-line { border-bottom: dotted 1px <?php echo $zn_main_color;?>;}
.statistics-vertical::before {border-left: dotted 1px <?php echo $zn_main_color;?>;}

/* Services boxes (modern style) */
.services_box--modern .services_box__icon { box-shadow:inset 0 0 0 2px <?php echo $zn_main_color;?>; }
.services_box--modern:hover .services_box__icon {box-shadow:inset 0 0 0 40px <?php echo $zn_main_color;?>;}
.services_box--modern .services_box__list li:before {box-shadow: 0 0 0 2px <?php echo $zn_main_color;?>;}
.services_box--modern .services_box__list li:hover:before {box-shadow: 0 0 0 3px <?php echo $zn_main_color;?>;}

.kl-has-overlay .img-intro:hover .overlay {box-shadow: inset 0 -8px 0 0 <?php echo $zn_main_color;?>;}

body .kl-ioscaption--style4 .more:before { border-color:<?php echo $zn_main_color;?>; background: <?php echo zn_hex2rgba_str($zn_main_color, 70); ?> }
body .kl-ioscaption--style4 .more:hover:before { background: <?php echo zn_hex2rgba_str($zn_main_color, 90); ?> }

.timeline_box:hover:before { background-color: <?php echo $zn_main_color;?> }

.borderanim2-svg__shape {stroke: <?php echo $zn_main_color;?>;}

/* Lined Custom color */
.btn-lined.lined-custom { color: <?php echo $zn_main_color; ?>; border-color: <?php echo $zn_main_color; ?>;}
.btn-lined.lined-custom:hover { color: <?php echo adjustBrightness($zn_main_color, 20); ?>;}

.fake-loading:after { border: 2px solid <?php echo zn_hex2rgba_str($zn_main_color, 15); ?>; border-top-color: <?php echo $zn_main_color;?>; border-right-color: <?php echo $zn_main_color;?>; }

.latest_posts.style2 ul.posts .details span.date:after { border-top-color: <?php echo $zn_main_color;?>; }

/***** End Main Color */

/* Call to action header */
<?php $cta_bg = zget_option( 'wpk_cs_bg_color', 'general_options', false, $zn_main_color ); ?>
.kl-cta-ribbon { background-color: <?php echo $cta_bg; ?> }
.kl-cta-ribbon .trisvg path { fill: <?php echo $cta_bg; ?> }
.ctabutton { color: <?php echo zget_option( 'wpk_cs_fg_color', 'general_options', false, '#fff' ); ?> }

/* Infocard */
.logo-container .logo-infocard {background: <?php echo zget_option( 'infocard_bg_color', 'general_options', false, $zn_main_color ); ?>}

/* Hidden panel */
.support_panel {background: <?php echo zget_option( 'hidden_panel_bg', 'general_options', false, '#fff' ); ?>; }
.support_panel,
.support_panel * {color:<?php echo zget_option( 'hidden_panel_fg', 'general_options', false, '#000000' ); ?>;}


<?php
    if( zget_option( 'header_style', 'general_options', false, 'default' ) == 'image_color'):
?>
.site-header:not(.style7):not(.style8)  {
	<?php
        if( $header_style_color = zget_option( 'header_style_color', 'general_options', false, '#000' ) ){
            echo 'background-color:' . $header_style_color . ';';
        }
        echo 'background-image:none;';
        $header_style_image = zget_option( 'header_style_image', 'general_options', false, array() );
        if( !empty( $header_style_image['image'] ) ){
            echo 'background-image:url("'.$header_style_image['image'].'");';
        }
        if(isset( $header_style_image['repeat']) && !empty( $header_style_image['repeat'])){
            echo 'background-repeat:'.$header_style_image['repeat'].';';
        }
        if(isset( $header_style_image['position']) && !empty( $header_style_image['position'])){
            echo 'background-position:'.$header_style_image['position']['x'].' '. $header_style_image['position']['y'].';';
        }
        if(isset( $header_style_image['attachment']) && !empty( $header_style_image['attachment'])){
            echo 'background-attachment:'. $header_style_image['attachment'].';';
        }
    ?>
}
<?php
    endif;
?>

<?php

/* Social Header */
if ( zget_option( 'social_icons_visibility_status', 'general_options', false, 'yes' ) == 'yes' ) {
	$header_which_icons_set = zget_option( 'header_which_icons_set', 'general_options', false, 'normal' );
	if($header_which_icons_set != 'normal' && $header_which_icons_set != 'clean'){
		if ( $header_social_icons = zget_option( 'header_social_icons', 'general_options', false, array() ) ) {
			foreach ( $header_social_icons as $key => $icon ):
				$hhover = $header_which_icons_set == 'colored_hov' ? ':hover':'';
				if(isset($icon['header_social_color']) && !empty($icon['header_social_color'])){
					echo '.scheader-icon-'.$icon['header_social_icon']['unicode'].$hhover.' { background-color: '.$icon['header_social_color'].'; }';
				}
			endforeach;
		}
	}
}

/* Social Footer */
if ( zget_option( 'footer_social_icons_enable', 'general_options', false, 'yes' ) == 'yes' ) {
	$footer_which_icons_set = zget_option( 'footer_which_icons_set', 'general_options', false, 'normal' );
	if($footer_which_icons_set != 'normal' && $footer_which_icons_set != 'clean'){
		if ( $footer_social_icons = zget_option( 'footer_social_icons', 'general_options', false, array() ) ) {
			foreach ( $footer_social_icons as $key => $icon ):
				$fhover = $footer_which_icons_set == 'colored_hov' ? ':hover':'';
				if(isset($icon['footer_social_color']) && !empty($icon['footer_social_color'])){
					echo '.scfooter-icon-'.$icon['footer_social_icon']['unicode'].$fhover.' { background-color: '.$icon['footer_social_color'].'; }';
				}
			endforeach;
		}
	}
}

/* Social icons in Coming Soon page */
if ( zget_option( 'cs_social_icons_enable', 'coming_soon_options', false, 'yes' ) == 'yes' && zget_option( 'cs_enable', 'coming_soon_options', false, 'no' ) == 'yes' ) {
	$cs_which_icons_set = zget_option( 'cs_which_icons_set', 'coming_soon_options', false, 'normal' );
	if($cs_which_icons_set != 'normal' && $cs_which_icons_set != 'clean'){
		if ( $cs_social_icons = zget_option( 'cs_social_icons', 'coming_soon_options', false, array() ) ) {
			foreach ( $cs_social_icons as $key => $icon ):
				$chover = $cs_which_icons_set == 'colored_hov' ? ':hover':'';
				if(isset($icon['cs_social_color']) && !empty($icon['cs_social_color'])){
					echo '.sccsoon-icon-'.$icon['cs_social_icon']['unicode'].$chover.' { background-color: '.$icon['cs_social_color'].'; }';
				}
			endforeach;
		}
	}
}

?>

footer#footer {
	<?php
	$footer_top_padding = zget_option( 'footer_top_padding', 'general_options', false, '60' );
	if ( $footer_top_padding != '' && $footer_top_padding != 60 ) {
			echo 'padding-top:'. $footer_top_padding .'px;';
	}

	if ( $footer_border_color_top = zget_option( 'footer_border_color_top', 'general_options', false, '#FFFFFF' ) ) {
	echo 'border-top-color:'. $footer_border_color_top .';'; }

	// Footer Styles
	$footer_style = zget_option( 'footer_style', 'general_options', false, 'default' );

	if( $footer_style == 'image_color' ){

		// Color
		$footer_style_color = zget_option( 'footer_style_color', 'general_options', false, '#000' );
		if ( !empty( $footer_style_color ) ){
			echo 'background-color:'.$footer_style_color.';';
		}

		// Image
		$footer_style_image = zget_option( 'footer_style_image', 'general_options', false, array() );

		if( !empty( $footer_style_image['image'] ) ) { echo 'background-image:url("'.$footer_style_image['image'].'");'; }
		if( !empty( $footer_style_image['repeat'] ) ) { echo 'background-repeat:'.$footer_style_image['repeat'].';'; }
		if( !empty( $footer_style_image['position'] ) ) { echo 'background-position:'.$footer_style_image['position']['x'].' '.$footer_style_image['position']['y'].';'; }
		if( !empty( $footer_style_image['attachment'] ) ) { echo 'background-attachment:'.$footer_style_image['attachment'].';'; }

	} ?>
}
footer#footer .bottom {	<?php if ( $footer_border_color = zget_option( 'footer_border_color', 'general_options', false, '#484848' ) ) {
	echo 'border-top-color:'. $footer_border_color .';'; } ?>
}

/* Main menu font */
.main-nav ul li a {
	<?php
		$menu_font = zget_option( 'menu_font', 'font_options', false, array() );
		foreach ($menu_font as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}
/* Alternative font - Several elements using other font */
.ff-alternative,
div.pp_kalypso .ppt,
.flex-caption,
.nivo-caption,
.info_pop .text, .playVideo,
.textpop-style .texts > span,
.ud_counter ul li,
.video-container .captions .line,
.newsletter-signup input[type=submit],
.page-title,
.subtitle,
#sidebar .widgettitle,
.zn_sidebar .widgettitle,
[id*='sidebar-widget-'] .title,
.shop-latest .tabbable .nav li a,
.topnav > li > a,
.pricing_table .tb_header h4,
.pricing_table .price,
.process_box .number span,
.shop-features .shop-feature,
.shop-features .shop-feature > h4,
.shop-features .shop-feature > h5,
.kl-fancy-form label,
.gridPhotoGallery__link:after,
.eBlog .post_details,
.eBlog .itemComments a,
.eBlog .itemLinks,
.eBlog .itemTagsBlock, .eBlog .itemTagsBlock,
.eBlog .userItemTagsBlock,
.media-container__link--style-borderanim1,
.media-container__link--style-borderanim2,
.hg-portfolio-sortable #sorting,
.hg-portfolio-sortable #portfolio-nav li a,
span.zn_badge_sale,
span.zn_badge_new,
.cart-container .cart_list li a:not(.remove),
.zn_gmap_canvas .zn_startLocation,
.th-wowslider .ws-title {
<?php
	$alternative_font = zget_option( 'alternative_font', 'font_options', false, $menu_font );
	if ( !empty ( $alternative_font['font-family'] ) ) {
		echo 'font-family:"' .$alternative_font['font-family'].'" , "Helvetica Neue", Helvetica, Arial, sans-serif;';
	}
 ?>
}


<?php
if ( zget_option( 'zn_boxed_layout', 'layout_options', false, 'no' ) == 'yes') {
	?>
	body {

		<?php
		// Color
		$boxed_style_color = zget_option( 'boxed_style_color', 'layout_options', false, '#fff' );
		if ( !empty( $boxed_style_color ) ){
			echo 'background-color:'.$boxed_style_color.';';
		}

		// Image
		$boxed_style_image = zget_option( 'boxed_style_image', 'layout_options', false, array() );

		if( !empty( $boxed_style_image['image'] ) ) { echo 'background-image:url("'.$boxed_style_image['image'].'");'; }
		if( !empty( $boxed_style_image['repeat'] ) ) { echo 'background-repeat:'.$boxed_style_image['repeat'].';'; }
		if( !empty( $boxed_style_image['position'] ) ) { echo 'background-position:'.$boxed_style_image['position']['x'].' '.$boxed_style_image['position']['y'].';'; }
		if( !empty( $boxed_style_image['attachment'] ) ) { echo 'background-attachment:'.$boxed_style_image['attachment'].';'; }
		?>
	}
	<?php
}

// Top Navigation Colors
if( $zn_top_nav_color = zget_option( 'zn_top_nav_color', 'color_options' ) ){
	echo '.topnav > li > a { color:'.$zn_top_nav_color.' ;}';
}
if ( $zn_top_nav_h_color = zget_option( 'zn_top_nav_h_color', 'color_options' ) ) {
	echo '.topnav > li > a:hover { color:'.$zn_top_nav_h_color.' ;}';
}

// Various usages of the body color
if ( isset($zn_body_def_color) && !empty($zn_body_def_color) ) {
	// Static content fade mask
	echo '.sc__fade-mask, .portfolio-item-desc-inner:after {background: -moz-linear-gradient(top, transparent 0%, '.$zn_body_def_color.' 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,transparent), color-stop(100%, '.$zn_body_def_color.')); background: -webkit-linear-gradient(top, transparent 0%, '.$zn_body_def_color.' 100%); background: -o-linear-gradient(top, transparent 0%,'.$zn_body_def_color.' 100%); background: -ms-linear-gradient(top, transparent 0%,'.$zn_body_def_color.' 100%); background: linear-gradient(to bottom, transparent 0%, '.$zn_body_def_color.' 100%); }
	 ';
	// Laptop Slider Mask
	echo '.ls-source__mask-front {background: -moz-linear-gradient(top,  '.zn_hex2rgba_str($zn_body_def_color, 60).' 0%,  '.$zn_body_def_color.' 50%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.zn_hex2rgba_str($zn_body_def_color, 60).'), color-stop(50%, '.$zn_body_def_color.')); background: -webkit-linear-gradient(top,  '.zn_hex2rgba_str($zn_body_def_color, 60).' 0%, '.$zn_body_def_color.' 50%); background: -o-linear-gradient(top,  '.zn_hex2rgba_str($zn_body_def_color, 60).' 0%, '.$zn_body_def_color.' 50%); background: -ms-linear-gradient(top,  '.zn_hex2rgba_str($zn_body_def_color, 60).' 0%, '.$zn_body_def_color.' 50%); background: linear-gradient(to bottom,  '.zn_hex2rgba_str($zn_body_def_color, 60).' 0%, '.$zn_body_def_color.' 50%);}';
}

// Header background & text color for smaller than 480px devices
$header_resp_textcolor = zget_option( 'zn_header_resp_textcolor', 'color_options',  false, '#fff' );
echo '
@media (max-width: 480px) {
	.site-header {background-color: '.zget_option( 'zn_header_resp_color', 'color_options',  false, '#2f2f2f' ).' !important; color: '.$header_resp_textcolor.';}
	.site-header .xs-icon,
	.site-header .glyphicon-remove-circle,
	.site-header .kl-header-toptext,
	.site-header .kl-header-toptext a,
	.topnav:not(.zn_header_top_nav) > li > a {color: '.$header_resp_textcolor.' !important;}
	.topnav:not(.zn_header_top_nav) > li > a:hover { color:'.zget_option( 'zn_header_resp_textcolor_hov', 'color_options',  false, '#fff' ).' !important;}
	.zn-res-menuwrapper .zn-res-trigger:after { background: '.$header_resp_textcolor.' !important; box-shadow: 0 8px 0 '.$header_resp_textcolor.', 0 16px 0 '.$header_resp_textcolor.' !important;}
	.headernav-trigger { background: '.$header_resp_textcolor.' !important; box-shadow: 0 -6px 0 '.$header_resp_textcolor.', 0 -12px 0 '.$header_resp_textcolor.' !important;}
}';