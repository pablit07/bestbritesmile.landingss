<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Image Box 2
 Description: Create and display an Image Box element
 Class: TH_ImageBox2
 Category: content, media
 Level: 3
*/
    /**
     * Class TH_ImageBox2
     *
     * Create and display an Images Box element
     *
     * @package  Kallyas
     * @category Page Builder
     * @author   Team Hogash
     * @since    3.8.0
     */
    class TH_ImageBox2 extends ZnElements
    {
        public static function getName(){
            return __( "Images Box 2", 'zn_framework' );
        }
/**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){
        $css = '';
        $uid = $this->data['uid'];
        $margin = $this->opt('ib2_bottommargin', '20');

        if( $margin != '20' ){
            $css .= ".{$uid} .offer-banners-link { margin-bottom: {$margin}px }";
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
            $uid = $this->data['uid'];
            $resize_method = $this->opt('ib2_resize_method','default');

            echo '<div class="offer-banners ob--resize-'.$resize_method.' '.$uid.' '.$this->opt('css_class','').'">';

            if ( ! empty ( $options['image_box_title'] ) ) {
                echo '<h3 class="m_title">' . $options['image_box_title'] . '</h3>';
            }

            if ( ! empty ( $options['ib2_single'] ) && is_array( $options['ib2_single'] ) )
            {
                echo '<div class="row">';
                foreach ( $options['ib2_single'] as $simage )
                {
                    if ( $slide_image = $simage['ib2_image'] )
                    {
                        $saved_alt = $saved_title = '';
                        if ( is_array( $slide_image ) )
                        {
                            // Get the saved image
                            $saved_image = $slide_image['image'];

                            if ( ! empty( $slide_image['alt'] ) ) {
                                $saved_alt = $slide_image['alt'];
                            }
                            if ( ! empty( $slide_image['title'] ) ) {
                                $saved_title = 'title="' . $slide_image['title'] . '"';
                            }
                        }
                        else {
                            $saved_image = $slide_image;
                        }

                        $element_size = zn_get_size( $simage['ib2_width'] );

                        echo '<div class="'.$element_size['sizer'].'">';

                            $link_start   = '<a href="#" class="offer-banners-link hoverBorder">';
                            $link_end     = '</a>';

                            if ( ! empty ( $simage['ib2_link']['url'] ) ) {
                                $link_start = '<a href="' . $simage['ib2_link']['url'] . '" target="' . $simage['ib2_link']['target'] . '" class="offer-banners-link hoverBorder">';
                                $link_end   = '</a>';
                            }

                            echo $link_start;

                            if($resize_method == 'default') {
                                $image = vt_resize( '', $saved_image, $element_size['width'], '', true );
                                echo '<img src="' . $image['url'] . '" height="' . $image['height'] . '" width="' . $image['width'] . '" alt="' . $saved_alt . '"  ' . $saved_title . ' class="img-responsive offer-banners-img" />';
                            } else if($resize_method == 'cover') {
                                $imgheight = isset($simage['ib2_image_height']) && !empty($simage['ib2_image_height']) ? $simage['ib2_image_height'] : 330;
                                echo '<div class="offer-banners-img hoverborder-img" style="background-image:url('.$saved_image.'); height:'.$imgheight.'px;"></div>';
                            } else if($resize_method == 'no-resize') {
                                echo '<img src="' . $saved_image . '" alt="' . $saved_alt . '"  ' . $saved_title . ' class="img-responsive offer-banners-img" />';
                            }

                            echo $link_end;

                        echo '</div>';
                    }
                }
                echo '</div>';
            }
            echo "</div>";
        }

        /**
         * This method is used to retrieve the configurable options of the element.
         * @return array The list of options that compose the element and then passed as the argument for the render() function
         */
        function options()
        {
            $extra_options = array (
                "name"           => __( "Images", 'zn_framework' ),
                "description"    => __( "Here you can add your images.", 'zn_framework' ),
                "id"             => "ib2_single",
                "std"            => "",
                "type"           => "group",
                "add_text"       => __( "Image", 'zn_framework' ),
                "remove_text"    => __( "Image", 'zn_framework' ),
                "group_sortable" => true,
                // "element_title" => "ib2_link",
                "subelements"    => array (
                    array (
                        "name"        => __( "Image", 'zn_framework' ),
                        "description" => __( "Please select an image.", 'zn_framework' ),
                        "id"          => "ib2_image",
                        "std"         => "",
                        "type"        => "media",
                        "alt"         => true
                    ),
                    array (
                        "name"        => __( "Image Link", 'zn_framework' ),
                        "description" => __( "Please choose the link you want to use.", 'zn_framework' ),
                        "id"          => "ib2_link",
                        "std"         => "",
                        "type"        => "link",
                        "options"     => array (
                            '_blank' => __( "New window", 'zn_framework' ),
                            '_self'  => __( "Same window", 'zn_framework' )
                        )
                    ),
                    array (
                        "name"        => __( "Image Width", 'zn_framework' ),
                        "description" => __( "Please select the desired width for this image.The number 3 means the image will take
            a quarter of the space and 12 means it will take the full width of the page. Depending on the image sizes,
            you can stack images one under the other.", 'zn_framework' ),
                        "id"          => "ib2_width",
                        "std"         => "one-third",
                        "options"     => array (
                            'four'  => __( '3', 'zn_framework' ),
                            'one-third'  => __( '4', 'zn_framework' ),
                            'span5'  => __( '5', 'zn_framework' ),
                            'eight'  => __( '6', 'zn_framework' ),
                            'span7'  => __( '7', 'zn_framework' ),
                            'two-thirds'  => __( '8', 'zn_framework' ),
                            'twelve'  => __( '9', 'zn_framework' ),
                            'span10' => __( '10', 'zn_framework' ),
                            'span11' => __( '11', 'zn_framework' ),
                            'sixteen' => __( '12', 'zn_framework' )
                        ),
                        "type"        => "select"
                    ),
                    array (
                        "name"        => __( "Image Height", 'zn_framework' ),
                        "description" => __( "Please select an image height. This option works only with the COVER option of the resize method.", 'zn_framework' ),
                        "id"          => "ib2_image_height",
                        "std"         => "330",
                        'type'        => 'slider',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '50',
                            'max' => '500',
                            'step' => '5'
                        ),
                    ),
                )
            );

            $uid = $this->data['uid'];

            $options = array(
                'has_tabs'  => true,
                'general' => array(
                    'title' => 'General options',
                    'options' => array(
                        array (
                            "name"        => __( "Image Box Title", 'zn_framework' ),
                            "description" => __( "Enter a title for your Image box", 'zn_framework' ),
                            "id"          => "image_box_title",
                            "std"         => "",
                            "type"        => "text",
                        ),
                        array (
                            "name"        => __( "Resize Method", 'zn_framework' ),
                            "description" => __( "This option determines wether the images should be resized by a default 1170px grid column split; or, by a un resized but filled block with custom height.", 'zn_framework' ),
                            "id"          => "ib2_resize_method",
                            "std"         => "default",
                            "options"     => array (
                                'no-resize'  => __( 'No Resize', 'zn_framework' ),
                                'default'  => __( 'Default resize (grid formula)', 'zn_framework' ),
                                'cover'  => __( 'Cover ( No resize, cover image and custom image height).', 'zn_framework' ),
                            ),
                            "type"        => "select"
                        ),
                        array (
                            "name"        => __( "Bottom Margins", 'zn_framework' ),
                            "description" => __( "Please select an image height. This option works only with the COVER option of the resize method.", 'zn_framework' ),
                            "id"          => "ib2_bottommargin",
                            "std"         => "20",
                            'type'        => 'slider',
                            'class'       => 'zn_full',
                            'helpers'     => array(
                                'min' => '0',
                                'max' => '100',
                                'step' => '1'
                            ),
                        ),
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
                            "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#NduGrZO1S4E" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                            "id"          => "video_link",
                            "std"         => "",
                            "type"        => "zn_title",
                            "class"       => "zn_full zn_nomargin"
                        ),

                        array (
                            "name"        => __( 'Written Documentation', 'zn_framework' ),
                            "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/image-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
