<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Devices Images
 Description: Create and display a Devices Images element
 Class: TH_DevicesImages
 Category: content
 Level: 3
*/
/**
 * Class TH_DevicesImages
 *
 * Create and display a Devices Images element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_DevicesImages extends ZnElements
{
    public static function getName(){
        return __( "Devices Images", 'zn_framework' );
    }

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){
        $css = '';
        $uid = $this->data['uid'];
        $image_type = $this->opt('di_imgtype','macbook');

        if( $this->opt('di_direction','ltr') == 'center' && $image_type == 'frame'){
            $height = $this->opt('di_center_height', 0);
            if( $height > 0 ){
                $css .= '.'.$uid.'.el-devimages--center.el-devimages { overflow: hidden; max-height: '.$height.'px; }';
            }
        }

        if( $image_type == 'custom_frame' ){

            $cstcss = '';
            $cst_height = $this->opt('di_custom_frame_height', 520);
            $cst_width = $this->opt('di_custom_frame_width', 1160);

            if( $cst_height != 520 ){
                $cstcss .= 'height:'.$cst_height.'px;';
            }
            if( $cst_width != 1160 ){
                $cstcss .= 'width:'.$cst_width.'px;';
            }

            $css .= '.'.$uid.' .el-devimages__frame--custom {'.$cstcss.'}';
        }

        // Add delay transitions
        if( $this->opt('di_appear', '') == '1' ){
            $delay = $this->opt('di_appear_delay', '0');
            $css .= '.'.$uid.' .el-devimages__laptop.el--appear, .'.$uid.' .el-devimages__frame.el--appear { -webkit-transition-delay:'.$delay.'ms !important; transition-delay:'.$delay.'ms !important; }';
            $css .= '.'.$uid.' .el-devimages__smartphone.el--appear { -webkit-transition-delay:'.($delay+100).'ms !important; transition-delay:'.($delay+100).'ms !important; }
             ';
        }
        return $css;
    }
    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $image_type = $this->opt('di_imgtype','macbook');

        $direction = $this->opt('di_direction','ltr');

        // Force LTR in case center is selected while Custom frame is defined aswell.
        if($direction == 'center' && $image_type == 'custom_frame'){
            $direction = 'ltr';
        }

        $mods = array();
        $mods[] = 'el-devimages--type-'.$this->opt('di_type','vector');
        $mods[] = 'el-devimages--'.$direction;
        $mods[] = $this->data['uid'];

        $appear_effect = $this->opt('di_appear','') == 1 ? 'el--appear el--appear-'.$this->opt('di_appear_effect','fadein') : '';
?>

<div class="el-devimages <?php echo implode(' ', $mods); ?> <?php echo $this->opt('css_class',''); ?>">

<?php if($image_type == 'macbook'){ ?>

    <?php if( $this->opt('di_macbook_image','') ){ ?>
    <div class="el-devimages__laptop <?php echo $appear_effect; ?>">
        <div class="el-devimages__laptop-img" style="background-image:url(<?php echo $this->opt('di_macbook_image'); ?>);"></div>
    </div>
    <?php } ?>

<?php } else { ?>

    <?php if( $this->opt('di_frame_image','') ){ ?>

    <?php
        $custom_frame = '';
        if($image_type == 'custom_frame') {
            $custom_frame = 'el-devimages__frame--custom';
        }
    ?>

    <div class="el-devimages__frame <?php echo $custom_frame; ?> <?php echo $appear_effect; ?>">
        <div class="el-devimages__frame-img" style="background-image:url(<?php echo $this->opt('di_frame_image'); ?>);"></div>
    </div>
    <?php } ?>

<?php } ?>

    <?php if( $this->opt('di_iphone_image','') && $direction != 'center' && $image_type != 'custom_frame' ){ ?>
    <div class="el-devimages__smartphone <?php echo $appear_effect; ?>">
        <div class="el-devimages__smartphone-img" style="background-image:url(<?php echo $this->opt('di_iphone_image'); ?>);"></div>
    </div>
    <?php } ?>

</div>

<?php
    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $uid = $this->data['uid'];

        $options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(

                    array (
                        "name"        => __( "Main image type", 'zn_framework' ),
                        "description" => __( "Select the main image type", 'zn_framework' ),
                        "id"          => "di_imgtype",
                        "std"         => "macbook",
                        "type"        => "select",
                        "options"     => array (
                            "macbook" => __( "Laptop", 'zn_framework' ),
                            "frame"    => __( "App Frame", 'zn_framework' ),
                            "custom_frame"    => __( "Custom size App Frame", 'zn_framework' ),
                        ),
                    ),

                    array (
                        "name"        => __( "Image for Laptop", 'zn_framework' ),
                        "description" => __( "Add an image to display inside the laptop", 'zn_framework' ),
                        "id"          => "di_macbook_image",
                        "std"         => "",
                        "type"        => "media",
                        "dependency"  => array( 'element' => 'di_imgtype' , 'value'=> array('macbook') ),
                    ),

                    array (
                        "name"        => __( "Image for App Frame", 'zn_framework' ),
                        "description" => __( "Add an image to display inside the App frame", 'zn_framework' ),
                        "id"          => "di_frame_image",
                        "std"         => "",
                        "type"        => "media",
                        "dependency"  => array( 'element' => 'di_imgtype' , 'value'=> array('frame', 'custom_frame') ),
                    ),

                    array (
                        "name"        => __( "Image for Iphone", 'zn_framework' ),
                        "description" => __( "Add an image to display inside the smartphone", 'zn_framework' ),
                        "id"          => "di_iphone_image",
                        "std"         => "",
                        "type"        => "media",
                        "dependency"  => array( 'element' => 'di_imgtype' , 'value'=> array('macbook','frame') ),
                    ),

                    array (
                        "name"        => __( "Direction", 'zn_framework' ),
                        "description" => __( "Select the direction of the images. ", 'zn_framework' ),
                        "id"          => "di_direction",
                        "std"         => "ltr",
                        "type"        => "select",
                        "options"     => array (
                            "ltr" => __( "Left to right. Usually for RIGHT side placement.", 'zn_framework' ),
                            "rtl"    => __( "Right to left. Usually for LEFT side placement.", 'zn_framework' ),
                            "center"    => __( "Center display (Only Laptop or normal Frame)", 'zn_framework' ),
                        ),
                    ),

                    array (
                        "name"        => __( "Max. Height ", 'zn_framework' ),
                        "description" => __( "Maximum height (px)", 'zn_framework' ),
                        "id"          => "di_center_height",
                        "std"         => "0",
                        "type"        => "text",
                        "dependency"  => array( 'element' => 'di_direction' , 'value'=> array('center') )
                    ),

                    array (
                        "name"        => __( "Width ", 'zn_framework' ),
                        "description" => __( "Frame width", 'zn_framework' ),
                        "id"          => "di_custom_frame_width",
                        "std"         => "1160",
                        "type"        => "slider",
                        "helpers"     => array (
                            "step" => "5",
                            "min" => "300",
                            "max" => "1600"
                        ),
                        "dependency"  => array( 'element' => 'di_imgtype' , 'value'=> array('custom_frame') ),
                        'live' => array(
                           'type'        => 'css',
                           'css_class' => '.'.$this->data['uid'].' .el-devimages__frame--custom',
                           'css_rule'    => 'width',
                           'unit'        => 'px'
                        ),
                    ),

                    array (
                        "name"        => __( "Height ", 'zn_framework' ),
                        "description" => __( "Frame height", 'zn_framework' ),
                        "id"          => "di_custom_frame_height",
                        "std"         => "520",
                        "type"        => "slider",
                        "helpers"     => array (
                            "step" => "5",
                            "min" => "260",
                            "max" => "900"
                        ),
                        "dependency"  => array( 'element' => 'di_imgtype' , 'value'=> array('custom_frame') ),
                        'live' => array(
                           'type'        => 'css',
                           'css_class' => '.'.$this->data['uid'].' .el-devimages__frame--custom',
                           'css_rule'    => 'height',
                           'unit'        => 'px'
                        ),
                    ),

                    array (
                        "name"        => __( "Devices Type", 'zn_framework' ),
                        "description" => __( "Select the type of devices images. The vector types looks more cartoonish.", 'zn_framework' ),
                        "id"          => "di_type",
                        "std"         => "vector",
                        "type"        => "select",
                        "options"     => array (
                            "vector" => __( "Vector - Illustrations.", 'zn_framework' ),
                            "img"    => __( "Normal - 3D Renderings.", 'zn_framework' ),
                        ),
                        "dependency"  => array( 'element' => 'di_imgtype' , 'value'=> array('macbook', 'frame') ),
                    ),


                    array (
                        "name"        => __( "Appear on scroll?", 'zn_framework' ),
                        "description" => __( "Start invisible and appear on scroll, when in viewport?", 'zn_framework' ),
                        "id"          => "di_appear",
                        "std"         => "",
                        "value"         => "1",
                        "type"        => "toggle2",
                    ),

                    array (
                        "name"        => __( "Appear Effect", 'zn_framework' ),
                        "description" => __( "Select the appear effect.", 'zn_framework' ),
                        "id"          => "di_appear_effect",
                        "std"         => "fadein",
                        "type"        => "select",
                        "options"     => array (
                            "fadein" => __( "Fade IN", 'zn_framework' ),
                            "sfl"    => __( "Slide from left", 'zn_framework' ),
                            "sfr"    => __( "Slide from right", 'zn_framework' ),
                            "sft"    => __( "Slide from top", 'zn_framework' ),
                            "sfb"    => __( "Slide from bottom", 'zn_framework' ),
                            "scale"    => __( "Scale IN", 'zn_framework' ),
                        ),
                        "dependency"  => array( 'element' => 'di_appear' , 'value'=> array('1') )
                    ),

                    array (
                        "name"        => __( "Delay appearance (milliseconds)", 'zn_framework' ),
                        "description" => __( "Delay the appearance? If multiple icon boxes, you can delay each one to appear sequentially. The numbers are in milliseconds.", 'zn_framework' ),
                        "id"          => "di_appear_delay",
                        "std"         => "0",
                        "type"        => "slider",
                        "helpers"     => array (
                            "step" => "50",
                            "min" => "0",
                            "max" => "2500"
                        ),
                        "dependency"  => array( 'element' => 'di_appear' , 'value'=> array('1') )
                    ),
                ),
            ),

            'other' => array(
                'title' => 'Other Options',
                'options' => array(

                    array(
                        'id'          => 'css_class',
                        'name'        => 'CSS class',
                        'description' => 'Enter a css class that will be applied to this element. You can than edit the custom css, either in the Page builder\'s CUSTOM CSS (which is loaded only into that particular page), or in Kallyas options > Advanced > Custom CSS which will load the css into the entire website.',
                        'type'        => 'text',
                        'std'         => '',
                    ),

                ),
            ),
            'help' => array(
                'title' => '<span class="dashicons dashicons-editor-help"></span> HELP',
                'options' => array(

                    array (
                        "name"        => __( 'Video Tutorial', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#xmNQYNuU2ms" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/devices-images/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
                        "id"          => "docs_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => sprintf(__( '<span data-clipboard-text="%s" data-tooltip="Click to copy ID to clipboard">Unique ID: %s</span> ', 'zn_framework' ), $uid, $uid),
                        "description" => __( 'In case you need some custom styling use as a css class selector <span class="u-code" data-clipboard-text=".'.$uid.' {  }" data-tooltip="Click to copy CSS class to clipboard">.'.$uid.'</span> .', 'zn_framework' ),
                        "id"          => "id_element",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
                        "id"          => "otherlinks",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn-custom-title-sm zn_nomargin"
                    ),
                ),
            ),
        );

        return $options;
    }
}
