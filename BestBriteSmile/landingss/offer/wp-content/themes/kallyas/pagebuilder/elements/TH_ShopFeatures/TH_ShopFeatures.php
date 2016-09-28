<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Shop Features
 Description: Create and display a Shop Features element
 Class: TH_ShopFeatures
 Category: content
 Level: 3
*/
/**
 * Class TH_ShopFeatures
 *
 * Create and display a Shop Features element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ShopFeatures extends ZnElements
{
    public static function getName(){
        return __( "Shop Features", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];
        ?>

        <div class="shop-features <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">
            <div class="row">
                <?php
                    if ( ! empty ( $options['sf_title'] ) ) {
                        echo '<div class="col-sm-3">';
                        echo '<h3 class="title">' . $options['sf_title'] . '</h3>';
                        echo '</div>';
                    }
                    if ( isset ( $options['sf_single'] ) && is_array( $options['sf_single'] ) ) {
                        foreach ( $options['sf_single'] as $single ) {
                            echo '<div class="col-sm-3">';
                            $link_start = '';
                            $link_end   = '';

                            if ( ! empty ( $single['lp_link']['url'] ) ) {
                                $link_start = '<a href="' . $single['lp_link']['url'] . '" target="' .
                                              $single['lp_link']['target'] . '">';
                                $link_end   = '</a>';
                            }


                            echo '<div class="shop-feature">';
                            if ( ! empty ( $single['lp_single_logo'] ) ) {
                                echo '<img src="' . $single['lp_single_logo'] . '" alt="">';
                            }

                            echo '<div class="sf-text">';
                            if ( ! empty ( $single['lp_single_line1'] ) ) {
                                echo '<h4>' . $single['lp_single_line1'] . '</h4>';
                            }

                            if ( ! empty ( $single['lp_single_line2'] ) ) {
                                echo '<h5>' . $single['lp_single_line2'] . '</h5>';
                            }
                            echo '</div>';
                            echo $link_start;
                            echo $link_end;
                            echo '</div><!-- end shop feature -->';

                            echo '</div>';
                        }
                    }
                ?>
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
            "name"           => __( "Features", 'zn_framework' ),
            "description"    => __( "Here you can add your shop features.", 'zn_framework' ),
            "id"             => "sf_single",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Feature", 'zn_framework' ),
            "remove_text"    => __( "Feature", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "lp_single_line1",
            "subelements"    => array (
                array (
                    "name"        => __( "Icon", 'zn_framework' ),
                    "description" => __( "Please select an icon.", 'zn_framework' ),
                    "id"          => "lp_single_logo",
                    "std"         => "",
                    "type"        => "media"
                ),
                array (
                    "name"        => __( "Line 1 text", 'zn_framework' ),
                    "description" => __( "Please enter a text that will appear on the first line.", 'zn_framework' ),
                    "id"          => "lp_single_line1",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Line 2 text", 'zn_framework' ),
                    "description" => __( "Please enter a text that will appear on the second line.", 'zn_framework' ),
                    "id"          => "lp_single_line2",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Feature Link", 'zn_framework' ),
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
                    array(
                        "name"        => __( '<strong style="font-size:120%">Warning!</strong>', 'zn_framework' ),
                        "description" => __( 'Since v4.x, <strong>this element is <em>deprecated</em> & <em>unsuported</em></strong>. It\'s not recommended to be used bucause at some point it\'ll be removed (now it\'s kept only for backwards compatibilty).<br> Instead, try to use a combination of these elements: Section (to add background), 2 Columns (4 + 8), Title element (onto the left column), Icon boxes (into the right column)', 'zn_framework' ),
                        'type'  => 'zn_message',
                        'id'    => 'zn_error_notice',
                        'show_blank'  => 'true',
                        'supports'  => 'warning'
                    ),
                    array (
                        "name"        => __( "Title", 'zn_framework' ),
                        "description" => __( "Please enter the title for this element.", 'zn_framework' ),
                        "id"          => "sf_title",
                        "std"         => "",
                        "type"        => "text",
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#1ypiBcjZEB4" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/shop-features/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
