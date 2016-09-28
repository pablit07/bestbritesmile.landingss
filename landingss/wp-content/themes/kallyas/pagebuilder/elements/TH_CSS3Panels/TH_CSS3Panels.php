<?php if(! defined('ABSPATH')){ return; }
/*
Name: CSS3 Panels
Description: Create and display a CSS3 Panels element
Class: TH_CSS3Panels
Category: headers, Fullwidth
Level: 1
Scripts: true
*/

/**
 * Class TH_CSS3Panels
 *
 * Create and display a CSS3 Panels element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author Team Hogash
 * @since 3.8.0
 */
class TH_CSS3Panels extends ZnElements
{
    public static function getName(){
        return __( "CSS3 Panels", 'zn_framework' );
    }

    /**
     * Load dependant resources
     */
    function scripts()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_style( 'css3_panels_styles', THEME_BASE_URI . '/sliders/css3panels/css3panels.css', false, ZN_FW_VERSION );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {

        $options = $this->data['options'];

        if( empty( $options ) ) { return; }

        $all = 0;
        if( isset($options['single_css_panel']) && is_array($options['single_css_panel']) ){
            $all = count( $options['single_css_panel'] );
        }

        $sheight = $this->opt('css_height','600');

        $panels_resize = 'css3panels--resize';
        if( isset($options['panel_resize']) ) {
            $panels_resize = $options['panel_resize'] ? 'css3panels--resize' : '';
        }

        ?>
        <div class="kl-slideshow kl-slideshow-css3panels <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">

            <div class="fake-loading loading-1s"></div>

            <div class="css3panels-container <?php echo $panels_resize;?> <?php echo ( isset($options['panel_caption_effect']) ? 'cssp-capt-animated cssp-capt-'.$options['panel_caption_effect'] : ''); ?>" data-panels="<?php echo $all; ?>" style="<?php echo 'height:'.$sheight.'px'; ?>">
                <?php
                if ( isset ( $options['single_css_panel'] ) && is_array( $options['single_css_panel'] ) ) {
                    $i   = 1;

                    foreach ( $options['single_css_panel'] as $panel ) {

                        echo '<div class="css3panel css3panel--' . $i . ' cp-theme--'.(isset($panel['panel_text_theme']) ? $panel['panel_text_theme'] : 'light').'">';

                            echo '<div class="css3panel-inner" style=" height:'.$sheight.'px " >';
                                echo '<div class="css3panel-mainimage-wrapper" style=" height:'.$sheight.'px " >';

                                if ( isset ( $panel['panel_image'] ) && ! empty ( $panel['panel_image'] ) ) {
                                    echo '<div style="background-image:url('.$panel['panel_image'].'); " class="css3panel-mainimage">';

                                    if( isset($options['panel_effect']) && !empty($options['panel_effect']) ){
                                        echo '<div style="background-image:url('.$panel['panel_image'].'); " class="css3panel-mainimage css3panel-mainimage-effect '. $options['panel_effect'] .'"></div>';
                                    }

                                    // check if overlay is enabled
                                    if( isset($panel['panel__overlay']) && $panel['panel__overlay'] && isset($panel['panel__overlay_color']) ){
                                        echo '<div class="css3p-overlay css3p--overlay-color" style="background: '.zn_hex2rgba_str( $panel['panel__overlay_color'], $panel['panel__overlay_opacity'] ).'"></div>';
                                    } else {
                                        echo '<div class="css3p-overlay css3p-overlay--gradient"></div>';
                                    }
                                    echo '</div>';
                                }

                                echo '</div>';
                            echo '</div>';

                        // Panel Position
                        $panel_position = '';
                        if ( isset ( $panel['panel_title_position'] ) && ! empty ( $panel['panel_title_position'] ) ) {
                            $panel_position = 'css3caption--middle';
                        }

                        // Panel Content
                        if (
                            ( isset ($panel['panel_title']) && ! empty ($panel['panel_title']) ) ||
                            ( isset ($panel['panel_text']) && ! empty ($panel['panel_text']) )
                        ) {
                            echo '<div class="css3panel-caption ' . $panel_position . ' ">';

                            // Panel title
                            $link_start = '';
                            $link_end = '';
                            if ( isset ($panel['panel_title']) && ! empty ($panel['panel_title']) ) {
                                if(isset($panel['title_link']) && !empty($panel['title_link']['url'] ) ){
                                    $link_start = '<a href="'.$panel['title_link']['url'].'" target="'.$panel['title_link']['target'].'">';
                                    $link_end = '</a>';
                                }
                                echo $link_start;
                                echo '<h3 class="css3panel-title ff-alternative '.(isset($panel['panel_title_style']) ? $panel['panel_title_style'] : '').' '.(isset($panel['panel_title_size']) ? 'title-size-'.$panel['panel_title_size'] : '' ).'">'.$panel['panel_title'].'</h3>';
                                echo $link_end;
                            }

                            // Panel text
                            if ( isset ($panel['panel_text']) && ! empty ($panel['panel_text']) ) {
                                echo '<div class="css3panel-text">'.$panel['panel_text'].'</div>';
                            }

                            echo '<div class="css3panel-btn-area">';
                            // Panel Primary Button
                            if(isset($panel['title_link']) && !empty($panel['title_link']['url']) && !empty( $panel['title_link']['title'] ) ){
                                $btn_primary = '';
                                echo '<a href="'.$panel['title_link']['url'].'" class="btn btn-fullcolor btn-skewed" target="'.$panel['title_link']['target'].'">' .$panel['title_link']['title'].'</a>';
                            }

                            // Panel Secondary Button
                            if( isset($panel['sec_link']) && !empty($panel['sec_link']['url']) ){
                                echo '<a href="'.$panel['sec_link']['url'].'" class="btn btn-lined btn-skewed" target="'.$panel['sec_link']['target'].'">' .$panel['sec_link']['title'].'</a>';
                            }
                            echo '</div><!-- /.btn-area -->';

                            echo '</div><!-- /.css3panel-caption -->';
                        }

                        echo '</div>';

                        $i ++;
                    }
                }
                ?>
            </div>
            <!-- end panels -->
            <div class="clearfix"></div>

            <div class="kl-bottommask kl-bottommask--shadow_ud"></div>

        </div><!-- end kl-slideshow -->
    <?php
    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $uid = $this->data['uid'];

        $extra_options = array (
            "name"           => __( "CSS Panels", 'zn_framework' ),
            "description"    => __( "Here you can create your CSS3 Panels.", 'zn_framework' ),
            "id"             => "single_css_panel",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Panel", 'zn_framework' ),
            "remove_text"    => __( "Panel", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "panel_title",
            "subelements"    => array (
                'has_tabs'  => true,
                'general' => array(
                    'title' => 'General options',
                    'options' => array(
                        array (
                            "name"        => __( "Panel image", 'zn_framework' ),
                            "description" => __( "Select an image for this Panel", 'zn_framework' ),
                            "id"          => "panel_image",
                            "std"         => "",
                            "type"        => "media"
                        ),
                        array (
                            "name"        => __( "Panel title", 'zn_framework' ),
                            "description" => __( "Here you can enter a title that will appear on this panel.", 'zn_framework' ),
                            "id"          => "panel_title",
                            "std"         => "",
                            "type"        => "text"
                        ),
                        array (
                            "name"        => __( "Title text size", 'zn_framework' ),
                            "description" => __( "Select the size of the title.", 'zn_framework' ),
                            "id"          => "panel_title_size",
                            "std"         => "normal",
                            "type"        => "select",
                            "options"     => array (
                                'normal'  => __( "Normal", 'zn_framework' ),
                                'bigger' => __( "Huge", 'zn_framework' )
                            )
                        ),
                        array (
                            "name"        => __( "Panel Text", 'zn_framework' ),
                            "description" => __( "Here you can enter some that will appear on this panel, under the title.", 'zn_framework' ),
                            "id"          => "panel_text",
                            "std"         => "",
                            "type"        => "textarea"
                        ),
                        array (
                            "name"        => __( "Primary Button", 'zn_framework' ),
                            "description" => __( "Set the url & text of the button. Use title field as text inside the button.", 'zn_framework' ),
                            "id"          => "title_link",
                            "std"         => "",
                            "type"        => "link",
                            "options"     => array (
                                '_self'  => __( "Same window", 'zn_framework' ),
                                '_blank' => __( "New window", 'zn_framework' )
                            )
                        ),
                        array (
                            "name"        => __( "Secondary Button", 'zn_framework' ),
                            "description" => __( "Set the url & text of the button. Use title field as text inside the button.", 'zn_framework' ),
                            "id"          => "sec_link",
                            "std"         => "",
                            "type"        => "link",
                            "options"     => array (
                                '_self'  => __( "Same window", 'zn_framework' ),
                                '_blank' => __( "New window", 'zn_framework' )
                            )
                        ),
                    ),
                ),
                'style' => array(
                    'title' => 'Styling options',
                    'options' => array(
                        array (
                            "name"        => __( "Title style", 'zn_framework' ),
                            "description" => __( "Select title style", 'zn_framework' ),
                            "id"          => "panel_title_style",
                            "std"         => "",
                            "type"        => "select",
                            "options"     => array (
                                ''                  => __( "No Background", 'zn_framework' ),
                                'captiontitle--wbg' => __( "White Background", 'zn_framework' ),
                                'captiontitle--dbg' => __( "Dark background", 'zn_framework' )
                            )
                        ),
                        array (
                            "name"        => __( "Text color theme", 'zn_framework' ),
                            "description" => __( "Select the theme of the colors", 'zn_framework' ),
                            "id"          => "panel_text_theme",
                            "std"         => "light",
                            "type"        => "select",
                            "options"     => array (
                                'light'   => __( "Light", 'zn_framework' ),
                                'dark'    => __( " Dark", 'zn_framework' )
                            )
                        ),
                        array (
                            "name"        => __( "Panel Content Position", 'zn_framework' ),
                            "description" => __( "Here you can choose where the panel content will be shown", 'zn_framework' ),
                            "id"          => "panel_title_position",
                            "std"         => "",
                            "type"        => "select",
                            "options"     => array (
                                ''      => __( "Normal (Bottom)", 'zn_framework' ),
                                'upper' => __( "Upper (Middle)", 'zn_framework' )
                            )
                        ),
                        array(
                            'id'          => 'panel__overlay',
                            'name'        => 'Slide colored overlay',
                            'description' => 'Add slide color overlay over the image or video to darken or enlight?',
                            'type'        => 'select',
                            'std'         => '0',
                            "options"     => array (
                                "1" => __( "Yes", 'zn_framework' ),
                                "0"  => __( "No", 'zn_framework' )
                            ),
                            "class"       => "zn_input_xs"
                        ),
                        array(
                            'id'          => 'panel__overlay_color',
                            'name'        => 'Overlay background color',
                            'description' => 'Pick a color',
                            'type'        => 'colorpicker',
                            'std'         => '#0da3be',
                            "dependency"  => array( 'element' => 'panel__overlay' , 'value'=> array('1') ),
                        ),
                        array(
                            'id'          => 'panel__overlay_opacity',
                            'name'        => 'Overlay\'s opacity.',
                            'description' => 'Overlay background colors opacity level.',
                            'type'        => 'slider',
                            'std'         => '50',
                            "helpers"     => array (
                                "step" => "5",
                                "min" => "10",
                                "max" => "100"
                            ),
                            "dependency"  => array( 'element' => 'panel__overlay' , 'value'=> array('1') ),
                        ),
                    ),
                ),
            )
        );

        $options = array (
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(
                    array (
                        "name"        => __( "Slider Height", 'zn_framework' ),
                        "description" => __( "Please enter a numerical value in pixels for your slider height.", 'zn_framework' ),
                        "id"          => "css_height",
                        "std"         => "600",
                        "type"        => "text",
                        "class"       => ''
                    ),
                    array (
                        "name"        => __( "Image Effect", 'zn_framework' ),
                        "description" => __( "Select an effect for normal and hover states.", 'zn_framework' ),
                        "id"          => "panel_effect",
                        "std"         => "",
                        "type"        => "select",
                        "options"     => array (
                            ''                              => __( "None", 'zn_framework' ),
                            'anim--grayscale'               => __( "Grayscale Effect", 'zn_framework' ),
                            'anim--blur'                    => __( "Blur effect", 'zn_framework' ),
                            'anim--grayscale anim--blur'    => __( "Grayscale & Blur Effect", 'zn_framework' )
                        )
                    ),
                    array (
                        "name"        => __( "Caption Effect", 'zn_framework' ),
                        "description" => __( "Specify the caption effect.", 'zn_framework' ),
                        "id"          => "panel_caption_effect",
                        "std"         => "default",
                        "type"        => "select",
                        "options"     => array (
                            'default'  => __( "No effect, captions always visible", 'zn_framework' ),
                            'fadein' => __( "Hidden captions, fade in on hover", 'zn_framework' ),
                            'fadeout' => __( "Visible captions, fade out (hide) on hover", 'zn_framework' ),
                            'slidein' => __( "Hidden captions, slide in on hover", 'zn_framework' ),
                            'slideout' => __( "Visible captions, slide out on hover", 'zn_framework' )
                        )
                    ),
                    array (
                        "name"        => __( "Panel Resize on hover", 'zn_framework' ),
                        "description" => __( "Resize the panel on hover?", 'zn_framework' ),
                        "id"          => "panel_resize",
                        "std"         => "1",
                        "type"        => "select",
                        "options"     => array (
                            '1' => __( "Yes", 'zn_framework' ),
                            '0' => __( "No", 'zn_framework' )
                        )
                    ),
                ),
            ),
            'panels' => array(
                'title' => 'CSS panels',
                'options' => array(
                    $extra_options,
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#t702hKJbbns" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/css3-panels/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
