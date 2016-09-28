<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Image Box
 Description: Create and display an Image Box element
 Class: TH_ImageBox
 Category: content, media
 Level: 3
*/
    /**
     * Class TH_ImageBox
     *
     * Create and display an Image Box element
     *
     * @package  Kallyas
     * @category Page Builder
     * @author   Team Hogash
     * @since    3.8.0
     */
    class TH_ImageBox extends ZnElements
    {
        public static function getName(){
            return __( "Image Box", 'zn_framework' );
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

            $slide_image = $this->opt( 'image_box_image', false );

            $link_start = '<span class="zn_image_box_cont">';
            $link_end   = '</span>';
            $image      = '';
            $title      = '';
            $text       = '';
            $link_text  = '';

            global $saved_alt, $saved_title;

            if(! isset($saved_alt)){ $saved_alt = ''; }
            if(! isset($saved_title)){ $saved_title = ''; }

            // Title
            if ( ! empty ( $options['image_box_title'] ) ) {
                $title = '<h3 class="m_title imgboxes-title">' . $options['image_box_title'] . '</h3>';
            }

            // TEXT
            if ( ! empty ( $options['image_box_text'] ) ) {
                $text = $options['image_box_text'];
            }

            // READ MORE TEXT
            if ( ! empty ( $options['image_box_link_text'] ) ) {
                $link_text = '<h6>' . $options['image_box_link_text'] . '</h6>';
            }

            // Check to see if we have an image
            if ( $slide_image ) {

                $saved_alt   = 'alt="' . strip_tags( $options['image_box_title'] ) . '"';
                $saved_title = 'title="' . strip_tags( $options['image_box_title'] ) . '"';

                if ( is_array( $slide_image ) ) {

                    if ( $saved_image = $slide_image['image'] ) {

                        // Image alt
                        if ( ! empty( $slide_image['alt'] ) ) {
                            $saved_alt = 'alt="' . $slide_image['alt'] . '"';
                        }

                        // Image title
                        if ( ! empty( $slide_image['title'] ) ) {
                            $saved_title = 'title="' . $slide_image['title'] . '"';
                        }
                    }
                }
                else {
                    $saved_image = $slide_image;
                }
            }

            // Display the element based on what style is chosen

            // STYLE 2 - IMAGE IS ON THE RIGHT
            if ( ! empty ( $options['image_box_style'] ) && $options['image_box_style'] == 'style2' ) {
                $zn_style = 'imgboxes_style1 zn_ib_style2';

                // IMAGE
                if ( ! empty ( $saved_image ) ) {
                    $image = vt_resize( '', $saved_image, '220', '156', true );
                    $image = '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' .
                        $image['height'] . '" ' . $saved_alt . ' ' . $saved_title . ' />';
                }

                if ( ! empty( $options['image_box_link']['url'] ) ) {
                    $link_start = '<a class="hoverBorder alignright" href="' . $options['image_box_link']['url'] .
                        '" target="' . $options['image_box_link']['target'] . '">';
                    $link_end   = '</a>';
                }
                else {
                    $link_start = '<span class="zn_image_box_cont alignright">';
                    $link_end   = '</span>';
                }

                echo '<div class="box image-boxes ' . $zn_style . ' '.$uid.' '.$this->opt('css_class','').'">';

                echo $title;

                echo $link_start;
                    echo $image;
                echo $link_end;

                echo $text;

                echo '</div><!-- end span -->';            }
            // STYLE 3 - CONTENT IS OVER IMAGE
            elseif ( ! empty ( $options['image_box_style'] ) && $options['image_box_style'] == 'style3' ) {
                $zn_style = 'imgboxes_style2';
                // IMAGE
                if ( ! empty ( $saved_image ) ) {
                    $image = vt_resize( '', $saved_image, '', '', true );
                    $image = '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' .
                        $image['height'] . '" ' . $saved_alt . ' ' . $saved_title . ' />';
                }

                if ( ! empty( $options['image_box_link']['url'] ) ) {
                    $link_start = '<a class="slidingDetails" href="' . $options['image_box_link']['url'] . '" target="' .
                        $options['image_box_link']['target'] . '">';
                    $link_end   = '</a>';
                }
                else {
                    $link_start = '<a class="slidingDetails" href="javascript:;" target="' . $options['image_box_link']['target'] . '">';
                    $link_end   = '</a>';
                }

                // Title
                if ( ! empty ( $options['image_box_title'] ) ) {
                    $title = '<h4>' . $options['image_box_title'] . '</h4>';
                }

                echo '<div class="box image-boxes ' . $zn_style . ' '.$uid.' '.$this->opt('css_class','').'">';

                echo $link_start;

                echo $image;

                echo '<div class="details">';

                echo $title;
                echo $text;

                echo '</div>';

                echo $link_end;

                echo '</div><!-- end span -->';
            }

            // STYLE 4 - IMAGE WITH READ MORE BUTTON OVER IT
            elseif ( ! empty ( $options['image_box_style'] ) && $options['image_box_style'] == 'style4' ) {
                $zn_style   = 'imgboxes_style4';
                $link_start = '<div class="imgboxes-wrapper">';
                $link_end   = '</div>';

                // IMAGE
                if ( ! empty ( $saved_image ) ) {
                    $image = vt_resize( '', $saved_image, '', '', true );
                    $image = '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' .
                        $image['height'] . '" ' . $saved_alt . ' ' . $saved_title . ' class="img-responsive imgbox_image" />';
                }

                if ( ! empty( $options['image_box_link']['url'] ) ) {
                    $link_start = '<a class="imgboxes4_link imgboxes-wrapper" href="' . $options['image_box_link']['url'] . '" target="' .
                        $options['image_box_link']['target'] . '">';
                    $link_end   =  '</a>';
                }

                $image_box_title_style = isset( $options['image_box_title_style'] ) && ! empty( $options['image_box_title_style']) ? $options['image_box_title_style'] : 'title_style_center';

                if($link_text){
                    $link_text = '<a href="' . $options['image_box_link']['url'] . '" target="' . $options['image_box_link']['target'] . '">' . $link_text . '</a>';
                }

                echo '<div class="box image-boxes ' . $zn_style . ' kl-'. $image_box_title_style .' '.$uid.' '.$this->opt('css_class','').'">';

                    echo $link_start;

                        echo $image;
                        echo '<span class="imgboxes-border-helper"></span>';

                        echo $title;

                    echo $link_end;

                    if($text){
                        echo '<p>' . $text . '</p>';
                    }

                    echo $link_text;

                echo '</div><!-- end span -->';
            }

            // STYLE 1 - IMAGE WITH READ MORE BUTTON OVER IT
            else {
                $zn_style   = 'imgboxes_style1';
                $link_start = '<span>';
                $link_end   = '</span>';

                // IMAGE
                if ( ! empty ( $saved_image ) ) {
                    $image = vt_resize( '', $saved_image, '', '', true );
                    $image = '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' .
                        $image['height'] . '" ' . $saved_alt . ' ' . $saved_title . ' />';
                }

                if ( ! empty( $options['image_box_link']['url'] ) ) {
                    $link_start = '<a class="hoverBorder" href="' . $options['image_box_link']['url'] . '" target="' .
                        $options['image_box_link']['target'] . '">';
                    $link_end   = $link_text . '</a>';
                }

                echo '<div class="box image-boxes ' . $zn_style . ' '.$uid.' '.$this->opt('css_class','').'">';

                echo $link_start;

                echo $image;

                echo $link_end;

                echo $title;
                echo $text;

                echo '</div><!-- end span -->';
            }
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
                            "name"        => __( "Image Box Title", 'zn_framework' ),
                            "description" => __( "Enter a title for your Image box", 'zn_framework' ),
                            "id"          => "image_box_title",
                            "std"         => "",
                            "type"        => "text",
                        ),
                        array (
                            "name"        => __( "Image Box Text", 'zn_framework' ),
                            "description" => __("Please enter a text that will appear inside your action Image button.", 'zn_framework' ),
                            "id"          => "image_box_text",
                            "std"         => "",
                            "type"        => "textarea",
                        ),
                        array (
                            "name"        => __( "Image", 'zn_framework' ),
                            "description" => __( "Please select an image that will appear above the title.", 'zn_framework' ),
                            "id"          => "image_box_image",
                            "std"         => "",
                            "type"        => "media",
                            "alt"         => true,
                        ),
                        array (
                            "name"        => __( "Image Box Style", 'zn_framework' ),
                            "description" => __( "Please select the style you want to use.", 'zn_framework' ),
                            "id"          => "image_box_style",
                            "std"         => "imgboxes_style1",
                            "options"     => array (
                                'imgboxes_style1' => __( 'Style 1', 'zn_framework' ),
                                'style2'          => __( 'Style 2', 'zn_framework' ),
                                'style3'          => __( 'Style 3', 'zn_framework' ),
                                'style4'          => __( 'Style 4 (since v4.0)', 'zn_framework' )
                            ),
                            "type"        => "select",
                        ),
                        array (
                            "name"        => __( "Image Box Title Style", 'zn_framework' ),
                            "description" => __( "Please select the style you want to use.", 'zn_framework' ),
                            "id"          => "image_box_title_style",
                            "std"         => "title_style_center",
                            "options"     => array (
                                'title_style_center' => __( 'Title Centered', 'zn_framework' ),
                                'title_style_left'   => __( 'Title Left', 'zn_framework' ),
                                'title_style_bottom' => __( 'Title Left with border bottom', 'zn_framework' )
                            ),
                            "type"        => "select",
                             "dependency"  => array( 'element' => 'image_box_style' , 'value'=> array('style4') ),
                        ),
                        array (
                            "name"        => __( "Link text", 'zn_framework' ),
                            "description" => __( "Enter a that will appear as link over the image.", 'zn_framework' ),
                            "id"          => "image_box_link_text",
                            "std"         => "",
                            "type"        => "text",
                        ),
                        array (
                            "name"        => __( "Image Box link", 'zn_framework' ),
                            "description" => __( "Please choose the link you want to use for your Image box button.", 'zn_framework' ),
                            "id"          => "image_box_link",
                            "std"         => "",
                            "type"        => "link",
                            "options"     => array (
                                '_blank' => __( "New window", 'zn_framework' ),
                                '_self'  => __( "Same window", 'zn_framework' ),
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
                            "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#aKNFr7BfB5k" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
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
