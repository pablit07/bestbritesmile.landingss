<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Service Box
 Description: Create and display a Service Box element
 Class: TH_ServiceBox
 Category: content
 Level: 3
*/
/**
 * Class TH_ServiceBox
 *
 * Create and display a Service Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ServiceBox extends ZnElements
{
    public static function getName(){
        return __( "Service Box", 'zn_framework' );
    }

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){
        $css = '';
        $uid = $this->data['uid'];

        // Icon sizes
        $icon_size = $this->opt('sbx_size','22');
        if( $icon_size != '22' ){
            $css .= ".{$uid} .services_box__fonticon { font-size: {$icon_size}px }";
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
        $options = $this->data['options'];

        $sb_style = $this->opt('sbx_style','classic');
        $sbx_type = $this->opt('sbx_type','img');
        $image = $this->opt('service_box_image');
        $icon = $this->opt('sbx_icon');
        $has_icon = '';
        if ( ! empty ( $image ) || ! empty ( $icon ) ) {
            $has_icon = 'sb--hasicon';
        }

        ?>
        <div class="services_box services_box--<?php echo $sb_style; ?> <?php echo $this->data['uid']; ?> <?php echo $has_icon; ?> <?php echo $this->opt('css_class',''); ?>">
            <div class="services_box__inner clearfix">
                <?php
                // Image
                if ( ! empty ( $image ) && $sbx_type == 'img' ) {

                    $hover_image = $this->opt('service_box_image_hover');

                    echo '<div class="services_box__icon '.(! empty ( $hover_image ) ? 'sb--hashover':'').'">';
                        echo '<div class="services_box__icon-inner">';

                            echo '<img src="' . $image . '" alt="" class="services_box__iconimg services_box__iconimg-main">';

                            if ( ! empty ( $hover_image ) ) {
                                echo '<img src="' . $hover_image . '" alt="" class="services_box__iconimg services_box__iconimg-hover ">';
                            }

                        echo '</div>';
                    echo '</div>';
                }

                // Fonticon

                if ( ! empty ( $icon ) && $sbx_type == 'icon' ) {

                    echo '<div class="services_box__icon">';
                        echo '<div class="services_box__icon-inner">';

                            echo '<span ' . zn_generate_icon($icon) . ' class="services_box__fonticon"></span>';

                        echo '</div>';
                    echo '</div>';
                }

                echo '<div class="services_box__content">';

                    // Title
                    $title = $this->opt('service_box_title');
                    if ( ! empty ( $title ) ) {
                        echo '<h4 class="services_box__title">' . $title . '</h4>';
                    }

                    // Desc
                    $desc = $this->opt('service_box_desc');
                    if ( ! empty ( $desc ) ) {
                        echo '<div class="services_box__desc"><p>'.$desc.'</p></div>';
                    }

                    echo '<div class="services_box__list-wrapper">';
                        echo '<span class="services_box__list-bg"></span>';
                        // FEATURES LIST
                        $features = $this->opt('service_box_features');
                        if ( ! empty ($features ) ) {
                            echo '<ul class="services_box__list">';

                            $textAr = explode( "\n",$features );
                            foreach ( $textAr as $index => $line ) {
                                echo '<li>';
                                if($sb_style == 'classic') echo '<span class="glyphicon glyphicon-play"></span>';
                                echo '<span class="services_box__list-text">'.$line.'</span>';
                                echo '</li>';
                            }

                            echo '</ul>';
                        }
                    echo '</div>';
                echo '</div>'
                ?>
            </div>
            <!-- end box -->
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
                        "name"        => __( "Service Box Style", 'zn_framework' ),
                        "description" => __( "Select the style of this services box.", 'zn_framework' ),
                        "id"          => "sbx_style",
                        "std"         => "classic",
                        "type"        => "select",
                        "options"     => array (
                            'classic' => __( 'Classic', 'zn_framework' ),
                            'modern' => __( 'Modern (since v4.0+)', 'zn_framework' ),
                            'boxed' => __( 'Boxed (since v4.0+)', 'zn_framework' )
                        ),
                    ),

                    array (
                        "name"        => __( "Service Box Title", 'zn_framework' ),
                        "description" => __( "Enter a title for your Service box", 'zn_framework' ),
                        "id"          => "service_box_title",
                        "std"         => "",
                        "type"        => "text",
                    ),

                    array (
                        "name"        => __( "Service Box Text Description", 'zn_framework' ),
                        "description" => __( "Enter a text for your Service box", 'zn_framework' ),
                        "id"          => "service_box_desc",
                        "std"         => "",
                        "type"        => "textarea",
                    ),

                    array (
                        "name"        => __( "Service Box Features", 'zn_framework' ),
                        "description" => __( "Please enter your features one on a line.This will
                                             create your features list with an arrow on the right.", 'zn_framework' ),
                        "id"          => "service_box_features",
                        "std"         => "",
                        "type"        => "textarea",
                    ),

                    array (
                        "name"        => __( "Icon Type", 'zn_framework' ),
                        "description" => __( "Type of the icon.", 'zn_framework' ),
                        "id"          => "sbx_type",
                        "std"         => "img",
                        "type"        => "select",
                        "options"     => array (
                            'icon' => __( 'Font Icon', 'zn_framework' ),
                            'img' => __( 'Image (PNG, JPG, SVG or even GIF)', 'zn_framework' )
                        ),
                    ),

                    array (
                        "name"        => __( "Image Icon", 'zn_framework' ),
                        "description" => __( "Upload an Icon Image.", 'zn_framework' ),
                        "id"          => "service_box_image",
                        "std"         => "",
                        "type"        => "media",
                        "dependency"  => array( 'element' => 'sbx_type' , 'value'=> array('img') ),
                    ),

                    array (
                        "name"        => __( "Image Hover Icon", 'zn_framework' ),
                        "description" => __( "Upload an Icon Image for the hover transition.", 'zn_framework' ),
                        "id"          => "service_box_image_hover",
                        "std"         => "",
                        "type"        => "media",
                        "dependency"  => array( 'element' => 'sbx_type' , 'value'=> array('img') ),
                    ),

                    array (
                        "name"        => __( "Icon Size", 'zn_framework' ),
                        "description" => __( "Select the size of the icon.", 'zn_framework' ),
                        "id"          => "sbx_size",
                        "std"         => "22",
                        'type'        => 'slider',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '16',
                            'max' => '50',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$this->data['uid'] .' .services_box__fonticon',
                            'css_rule'  => 'font-size',
                            'unit'      => 'px'
                        ),
                        "dependency"  => array( 'element' => 'sbx_type' , 'value'=> array('icon') ),
                    ),

                    array (
                        "name"        => __( "Select Icon", 'zn_framework' ),
                        "description" => __( "Select an icon to display.", 'zn_framework' ),
                        "id"          => "sbx_icon",
                        "std"         => "",
                        "type"        => "icon_list",
                        'class'       => 'zn_full',
                        "dependency"  => array( 'element' => 'sbx_type' , 'value'=> array('icon') ),
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#uCRbnvo68_A" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/service-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
