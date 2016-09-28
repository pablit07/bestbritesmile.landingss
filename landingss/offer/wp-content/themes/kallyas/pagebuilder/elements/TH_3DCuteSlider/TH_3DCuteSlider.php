<?php if(! defined('ABSPATH')){ return; }
/*
Name: 3D Cute Slider
Description: Create and display a 3D Cute Slider element
Class: TH_3DCuteSlider
Category: Headers, Fullwidth
Level: 1
*/

/**
 * Class TH_3DCuteSlider
 *
 * Create and display a 3D Cute Slider element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_3DCuteSlider extends ZnElements
{
    /**
     * Holds the list of sliders created with this plugin
     * @type array
     */
    private $_sliders = array();

    public function __construct(){
        parent::__construct();

        $this->checkForPlugin();
    }

    /**
     * Check to see whether or not the plugin CuteSlider is installed and active
     */
    public function checkForPlugin()
    {
        global $wpdb;
        $_options = array ();
        if(! function_exists('is_plugin_active')) {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }
        if ( is_plugin_active( 'CuteSlider/cuteslider.php' ) ) {
            // Table name
            $table_name = $wpdb->prefix . "cuteslider";
            // Get sliders
            $cute_sliders = $wpdb->get_results(
                "SELECT * FROM $table_name
                    WHERE flag_hidden = '0' AND flag_deleted = '0'
                  ORDER BY date_c ASC LIMIT 100"
            );
            // Iterate over the sliders

            $_options[] = 'Select slider';

            if(! empty($cute_sliders)) {
                foreach ($cute_sliders as $key => $item) {
                    if (isset($item->id) && isset($item->name)) {
                        $_options[$item->id] = $item->name;
                    }
                }
            }
        }
        $this->_sliders = $_options;
    }

    public static function getName(){
        return __( "3D Cute Slider", 'zn_framework' );
    }

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){
        $css = '';
        $uid = $this->data['uid'];

        $top_padding = $this->opt('top_padding');
        if($top_padding != '170'){
            $css .= '.'.$uid.' .kl-slideshow-inner{padding-top : '.$top_padding.'px;}';
        }

        $bottom_padding = $this->opt('bottom_padding');
        if($bottom_padding != '50'){
            $css .= '.'.$uid.' .kl-slideshow-inner{padding-bottom:'.$bottom_padding.'px;}';
        }

        return $css;
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {

        $slider_id = $this->opt( 'cuteslider_id' );
        if( empty( $slider_id  ) ) { return; }

        $style = $this->opt('ww_header_style', '');
        if ( ! empty ( $style ) ) {
            $style = 'uh_' . $style;
        }
        $sliderId = $this->opt('cuteslider_id', '');

        $bottom_mask = $this->opt('hm_header_bmasks','none');
        $bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

        ?>
        <div class="kl-slideshow cute3dslider <?php echo $style; ?> <?php echo $bm_class; ?> <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">
            <div class="bgback"></div>
            <div class="th-sparkles"></div>
            <div class="kl-slideshow-inner container zn_slideshow">
                <?php echo do_shortcode( '[cuteslider id="' . $sliderId . '"]' ); ?>
            </div>
            <?php WpkPageHelper::zn_bottommask_markup($bottom_mask); ?>
        </div>
        <?php
    }

    function element_edit(){

            ob_start();
                $this->element();
            $return = ob_get_clean();

            $uid = uniqid();
            $return = preg_replace("/(cuteslider_)(\d)_(\d)/i", '$1$2$3'. $uid, $return);
            $return = preg_replace("/(cuteslider_)(\d)/i", '$1$2'. $uid, $return);

            echo $return;

       // echo '<div class="zn-pb-notification">'.__( 'The slider will appear when viewing the page without the pagebuilder editor enabled' ).'</div>';
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
                        "name"        => __( "Background Style", 'zn_framework' ),
                        "description" => __( "Select the background style you want to use. Please note that styles can be created
                                    from the unlimited headers options in the theme admin's page.", 'zn_framework' ),
                        "id"          => "ww_header_style",
                        "std"         => "",
                        "type"        => "select",
                        "options"     => WpkZn::getThemeHeaders(true),
                        "class"       => ""
                    ),
                    array (
                        "name"        => __( "Select slider", 'zn_framework' ),
                        "description" => __( "Select the desired slider you want to use. Please note that the slider can be created
                                    from inside the Cute Slider option.", 'zn_framework' ),
                        "id"          => "cuteslider_id",
                        "std"         => "",
                        "type"        => "select",
                        "options"     => $this->_sliders
                    ),

                    array(
                        'id'          => 'top_padding',
                        'name'        => 'Top padding',
                        'description' => 'Select the top padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '170',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '0',
                            'max' => '400',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$this->data['uid'].' .kl-slideshow-inner',
                            'css_rule'  => 'padding-top',
                            'unit'      => 'px'
                        )
                    ),
                    array(
                        'id'          => 'bottom_padding',
                        'name'        => 'Bottom padding',
                        'description' => 'Select the bottom padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '50',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '0',
                            'max' => '400',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$this->data['uid'].' .kl-slideshow-inner',
                            'css_rule'  => 'padding-bottom',
                            'unit'      => 'px'
                        )
                    ),
                    // Bottom masks overrides
                    array (
                        "name"        => __( "Bottom masks override", 'zn_framework' ),
                        "description" => __( "The new masks are svg based, vectorial and color adapted.", 'zn_framework' ),
                        "id"          => "hm_header_bmasks",
                        "std"         => "none",
                        "type"        => "select",
                        "options"     => array (
                            'none' => __( 'None, just rely on Background style.', 'zn_framework' ),
                            'shadow' => __( 'Shadow Up', 'zn_framework' ),
                            'shadow_ud' => __( 'Shadow Up and down', 'zn_framework' ),
                            'mask1' => __( 'Raster Mask 1 (Old, not recommended)', 'zn_framework' ),
                            'mask2' => __( 'Raster Mask 2 (Old, not recommended)', 'zn_framework' ),
                            'mask3' => __( 'Vector Mask 3 CENTER (New! From v4.0)', 'zn_framework' ),
                            'mask3 mask3l' => __( 'Vector Mask 3 LEFT (New! From v4.0)', 'zn_framework' ),
                            'mask3 mask3r' => __( 'Vector Mask 3 RIGHT (New! From v4.0)', 'zn_framework' ),
                            'mask4' => __( 'Vector Mask 4 CENTER (New! From v4.0)', 'zn_framework' ),
                            'mask4 mask4l' => __( 'Vector Mask 4 LEFT (New! From v4.0)', 'zn_framework' ),
                            'mask4 mask4r' => __( 'Vector Mask 4 RIGHT (New! From v4.0)', 'zn_framework' ),
                            'mask5' => __( 'Vector Mask 5 (New! From v4.0)', 'zn_framework' ),
                            'mask6' => __( 'Vector Mask 6 (New! From v4.0)', 'zn_framework' ),
                        ),
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#hiQeyNfwHXw" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/3d-cute-slider/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
