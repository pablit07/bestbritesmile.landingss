<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Screenshots Box
 Description: Create and display a Screenshots Box element
 Class: TH_ScreenshotsBox
 Category: content, media
 Level: 3
 Scripts: true
*/
/**
 * Class TH_ScreenshotsBox
 *
 * Create and display a Screenshots Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ScreenshotsBox extends ZnElements
{
    public static function getName(){
        return __( "Screenshots Box", 'zn_framework' );
    }

    /**
     * Load dependant resources
     */
    function scripts(){
        wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/sliders/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        $sbStyle = (isset($options['sb_style']) && !empty($options['sb_style']) ? esc_attr($options['sb_style']) : 'kl-style-1');

        if( empty( $options['ssb_imag_single'] ) ) { return; }

        $dataAttribute = '';
        $paginationID = uniqid('th-');
        if('kl-style-2' == $sbStyle){
            $dataAttribute = 'data-carousel-pagination=".'.$paginationID.'"';
        }

        ?>

            <div class="screenshot-box <?php echo $sbStyle ?> <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?> clearfix">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="left-side">
                            <h3 class="title"><?php echo $options['ssb_title'];?></h3>
                            <?php
                                if ( ! empty ( $options['ssb_feat_single'] ) && is_array( $options['ssb_feat_single'] ) ) {
                                    echo '<ul class="features">';
                                    foreach ( $options['ssb_feat_single'] as $feat ) {
                                        echo '<li>';
                                        // FEATURE TITLE
                                        if ( ! empty ( $feat['ssb_single_title'] ) ) {
                                            echo '<h4>' . $feat['ssb_single_title'] . '</h4>';
                                        }
                                        // FEATURE DESC
                                        if ( ! empty ( $feat['ssb_single_desc'] ) ) {
                                            echo '<span>' . $feat['ssb_single_desc'] . '</span>';
                                        }
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                }

                                // BUTTON LINK
                                if ( ! empty ( $options['ssb_link_text'] ) && ! empty ( $options['ssb_button_link']['url'] ) ) {
                                    echo '<a href="' . $options['ssb_button_link']['url'] . '" target="' .
                                         $options['ssb_button_link']['target'] . '" class="btn btn-fullcolor btn-third">' .
                                         $options['ssb_link_text'] . '</a>';
                                }
                            ?>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="thescreenshot">
                            <div class="controls"><a href="#" class="prev"></a><a href="#" class="next"></a></div>
                            <ul class=" zn_screenshot-carousel" <?php echo $dataAttribute;?>>
                                <?php
                                    if ( ! empty ( $options['ssb_imag_single'] ) && is_array( $options['ssb_imag_single'] ) ) {
                                        foreach ( $options['ssb_imag_single'] as $image ) {
                                            $image = vt_resize( '', $image['ssb_single_screenshoot'], '580', '380', true );
                                            echo '<li><img src="' . $image['url'] . '" width="' . $image['width'] .
                                                 '" height="' . $image['height'] . '" alt=""></li>';
                                        }

                                    }
                                ?>
                            </ul>
                            <?php if(! empty($dataAttribute)) { ?>
                            <div class="<?php echo $paginationID;?>"></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end screenshot-box -->

        <?php

    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $extra_options = array();

// FEATURES SINGLE
        $extra_options['ssb_feat_single'] = array (
            "name"           => __( "Features", 'zn_framework' ),
            "description"    => __( "Here you can add your desired features.", 'zn_framework' ),
            "id"             => "ssb_feat_single",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Feature", 'zn_framework' ),
            "remove_text"    => __( "Feature", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "ssb_single_title",
            "subelements"    => array (
                array (
                    "name"        => __( "Title", 'zn_framework' ),
                    "description" => __( "Please enter the desired title for this
                                            feature.", 'zn_framework' ),
                    "id"          => "ssb_single_title",
                    "std"         => "",
                    "type"        => "textarea"
                ),
                array (
                    "name"        => __( "Description", 'zn_framework' ),
                    "description" => __( "Please enter the desired description for this
                                            feature.", 'zn_framework' ),
                    "id"          => "ssb_single_desc",
                    "std"         => "",
                    "type"        => "textarea"
                )
            )
        );

// IMAGES SINGLE
        $extra_options['ssb_imag_single'] = array (
            "name"           => __( "Images", 'zn_framework' ),
            "description"    => __( "Here you can add your screenshots images.", 'zn_framework' ),
            "id"             => "ssb_imag_single",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Image", 'zn_framework' ),
            "remove_text"    => __( "Image", 'zn_framework' ),
            "group_sortable" => true,
            // "element_title" => "ssb_single_screenshoot",
            "subelements"    => array (
                array (
                    "name"        => __( "Image", 'zn_framework' ),
                    "description" => __( "Please choose your desired screenshot.", 'zn_framework' ),
                    "id"          => "ssb_single_screenshoot",
                    "std"         => "",
                    "type"        => "media"
                )
            )
        );

        $uid = $this->data['uid'];

        $options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(
                    array (
                        "name"        => __( "Title", 'zn_framework' ),
                        "description" => __( "Please enter title for this box.", 'zn_framework' ),
                        "id"          => "ssb_title",
                        "std"         => "",
                        "type"        => "textarea",
                    ),
                    array (
                        "name"        => __( "Style", 'zn_framework' ),
                        "description" => __( "Please select the style you want to use.", 'zn_framework' ),
                        "id"          => "sb_style",
                        "std"         => "kl-style-1",
                        "type"        => "select",
                        "options"     => array (
                            'kl-style-1'     => __( 'Style 1', 'zn_framework' ),
                            'kl-style-2'    => __( 'Style 2 (since v4.0)', 'zn_framework' )
                        ),
                    ),
                    array (
                        "name"        => __( "Link Text", 'zn_framework' ),
                        "description" => __( "Please enter a text that will appear as a button
                                            link.", 'zn_framework' ),
                        "id"          => "ssb_link_text",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Button Link", 'zn_framework' ),
                        "description" => __( "Please choose the link you want to use.", 'zn_framework' ),
                        "id"          => "ssb_button_link",
                        "std"         => "",
                        "type"        => "link",
                        "options"     => array (
                            '_blank' => __( "New window", 'zn_framework' ),
                            '_self'  => __( "Same window", 'zn_framework' )
                        )
                    ),
                    $extra_options['ssb_feat_single'],
                    $extra_options['ssb_imag_single'],
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#MjnESQZG6pY" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/screenshots-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
