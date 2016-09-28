<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Sidebar
 Description: Create and display a Sidebar element
 Class: TH_Sidebar
 Category: content
 Level: 3
*/
/**
 * Class TH_Sidebar
 *
 * Create and display a Sidebar element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_Sidebar extends ZnElements
{
    public static function getName(){
        return __( "Sidebar", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        $sidebar_select = $this->opt( 'sidebar_select', 'defaultsidebar' );
        $sidebar_css = $this->opt( 'sidebar_bg', 'yes' ) == 'yes' ? '' : 'no_bg';
        ?>

        <?php
        echo '<div id="sidebar-widget-'.$this->data['uid'].'" class="sidebar ' . $sidebar_css . ' '.$this->data['uid'].' '.$this->opt('css_class','').'">';
            if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( $sidebar_select ) ) : endif;
        echo '</div>';
        ?>
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
                        "name"        => __( "Select sidebar", 'zn_framework' ),
                        "description" => __( "Select your desired sidebar to be used on this
                                            post", 'zn_framework' ),
                        "id"          => "sidebar_select",
                        "std"         => "",
                        "type"        => "select",
                        "options"     => WpkZn::getThemeSidebars()
                    ),
                    array (
                        "name"        => __( "Show background?", 'zn_framework' ),
                        "description" => __( "Select yes if you want to show the default sidebar
                                             background or no to use a transparent background.", 'zn_framework' ),
                        "id"          => "sidebar_bg",
                        "std"         => "yes",
                        "type"        => "select",
                        "options"     => array ( 'yes' => __( 'Yes', 'zn_framework' ), 'no' => __( 'No', 'zn_framework' ) )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#QeOx0SoUq9E" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    // array (
                    //     "name"        => __( 'Written Documentation', 'zn_framework' ),
                    //     "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
                    //     "id"          => "docs_link",
                    //     "std"         => "",
                    //     "type"        => "zn_title",
                    //     "class"       => "zn_full zn_nomargin"
                    // ),

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

