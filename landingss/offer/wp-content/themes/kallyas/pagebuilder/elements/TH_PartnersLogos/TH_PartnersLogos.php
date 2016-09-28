<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Partners Logos
 Description: Create and display a Partners Logos element
 Class: TH_PartnersLogos
 Category: content
 Level: 3
 Scripts: true
*/
/**
 * Class TH_PartnersLogos
 *
 * Create and display a Partners Logos element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_PartnersLogos extends ZnElements
{
    public static function getName(){
        return __( "Partners Logos", 'zn_framework' );
    }

    /**
     * Load dependant resources
     */
    function scripts(){
        wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/sliders/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];
        $autoscroll = $this->opt( 'autoscroll', 'no' ) == 'yes';

        if( empty( $options['pl_title'] ) && empty( $options['partners_single'] ) ) { return; }

        ?>
            <div class="partners_carousel clearfix <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">
                <div class="row">
                    <div class="col-sm-2">
                        <?php
                        if ( ! empty ( $options['pl_title'] ) && $options['pl_title_style'] == 'style1' ) {
                            echo '<h5 class="title"><span>' . $options['pl_title'] . '</span></h5>';
                        }
                        elseif ( ! empty ( $options['pl_title'] ) && $options['pl_title_style'] == 'style2' ) {
                            echo '<h4 class="m_title"><span>' . $options['pl_title'] . '</span></h4>';
                        }
                        ?>
                        <div class="th-controls controls">
                            <a href="#" class="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                            <a href="#" class="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <ul class="partners_carousel fixclear partners_carousel_trigger" data-autoplay="<?php echo $autoscroll ? 'true' : 'false'; ?>">
                            <?php
                            if ( ! empty ( $options['partners_single'] ) && is_array( $options['partners_single'] ) ) {
                                foreach ( $options['partners_single'] as $partner ) {

                                    $link_start = '<a href="#">';
                                    $link_end   = '</a>';

                                    if ( $slide_image = $partner['lp_single_logo'] ) {
                                        if ( ! empty ( $partner['lp_link']['url'] ) ) {
                                            $link_start = '<a href="' . $partner['lp_link']['url'] . '" target="' . $partner['lp_link']['target'] . '">';
                                            $link_end   = '</a>';
                                        }

                                        $saved_alt   = '';
                                        $saved_title = '';

                                        if ( is_array( $slide_image ) ) {
                                            if ( $saved_image = $slide_image['image'] ) {
                                                // Image alt
                                                if ( ! empty( $slide_image['alt'] ) ) {
                                                    $saved_alt = $slide_image['alt'];
                                                }

                                                // Image title
                                                if ( ! empty( $slide_image['title'] ) ) {
                                                    $saved_title = 'title="' . $slide_image['title'] . '"';
                                                }

                                                echo '<li>';
                                                echo $link_start;
                                                echo '<img src="' . $saved_image . '" ' . $saved_title . ' alt="' . $saved_alt . '" />';
                                                echo $link_end;
                                                echo '</li>';
                                            }
                                        }
                                        else {
                                            $saved_image = $slide_image;
                                            echo '<li>';
                                            echo $link_start;
                                            echo '<img src="' . $saved_image . '" alt="' . $saved_alt . '" ' . $saved_title . '/>';
                                            echo $link_end;
                                            echo '</li>';
                                        }
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $extra_options = array (
            "name"           => __( "Logos", 'zn_framework' ),
            "description"    => __( "Here you can add your partners logos.", 'zn_framework' ),
            "id"             => "partners_single",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Logo", 'zn_framework' ),
            "remove_text"    => __( "Logo", 'zn_framework' ),
            "group_sortable" => true,
            "subelements"    => array (
                array (
                    "name"        => __( "Logo", 'zn_framework' ),
                    "description" => __( "Please enter the logo for this partner.", 'zn_framework' ),
                    "id"          => "lp_single_logo",
                    "std"         => "",
                    "type"        => "media",
                    "alt"         => true
                ),
                array (
                    "name"        => __( "Logo Link", 'zn_framework' ),
                    "description" => __( "Please choose the link you want to use.", 'zn_framework' ),
                    "id"          => "lp_link",
                    "std"         => "",
                    "type"        => "link",
                    "options"     => array (
                        '_blank' => __( "New window", 'zn_framework' ),
                        '_self'  => __( "Same window", 'zn_framework' )
                    )
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
                        "name"        => __( "Title", 'zn_framework' ),
                        "description" => __( "Please enter the title for this element.", 'zn_framework' ),
                        "id"          => "pl_title",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Title Style", 'zn_framework' ),
                        "description" => __( "Please select the style you want to use for this title.", 'zn_framework' ),
                        "id"          => "pl_title_style",
                        "std"         => "style1",
                        "options"     => array (
                            "style1" => __( "Style 1", 'zn_framework' ),
                            "style2" => __( "Style 2", 'zn_framework' )
                        ),
                        "type"        => "select"
                    ),
                    array(
                        'id'            => 'autoscroll',
                        "name"        => __( "Enable autoscroll ?", 'zn_framework' ),
                        "description" => __( "Choose if you want to autoscroll the logos or not.", 'zn_framework' ),
                        'type'          => 'toggle2',
                        'std'           => 'no',
                        'value'         => 'yes'
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#FI_0ex4KB84" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/partners-logos/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
