<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Spacer Element
 Description: Create and display a Spacer Element element
 Class: TH_SpacerElement
 Category: content
 Level: 3
*/
/**
 * Class TH_SpacerElement
 *
 * Create and display a Spacer Element element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_SpacerElement extends ZnElements
{
    public static function getName(){
        return __( "Spacer Element", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];
        $height = 30; // the default value

        if(isset($options['spacer_height']) && !empty($options['spacer_height'])){
            $height = absint($options['spacer_height']);
        }

        $hide = array();
        $hide[] = $this->opt('spacer_hide_lg','0') == 1 ? 'hidden-lg' : '';
        $hide[] = $this->opt('spacer_hide_md','0') == 1 ? 'hidden-md' : '';
        $hide[] = $this->opt('spacer_hide_sm','0') == 1 ? 'hidden-sm' : '';
        $hide[] = $this->opt('spacer_hide_xs','0') == 1 ? 'hidden-xs' : '';

        echo '<div class="th-spacer clearfix '.$this->data['uid'].' '. implode(' ', $hide ) .' '.$this->opt('css_class','').'" style="height: '.$height.'px;"></div>';
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
                        "name"        => __( "Set height", 'zn_framework' ),
                        "description" => __( "Set the height, in pixels, for this element", 'zn_framework' ),
                        "id"          => "spacer_height",
                        "std"         => "30",
                        "type"        => "slider",
                        "helpers"     => array (
                            "step" => "5",
                            "min" => "0",
                            "max" => "600"
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$this->data['uid'],
                            'css_rule'  => 'height',
                            'unit'      => 'px'
                        )
                    ),

                    array (
                        "name"        => __( "Hide on Large Breakpoint", 'zn_framework' ),
                        "description" => __( "Bigger than 1200px", 'zn_framework' ),
                        "id"          => "spacer_hide_lg",
                        "std"         => "0",
                        "value"       => "1",
                        "type"        => "toggle2",
                    ),
                    array (
                        "name"        => __( "Hide on Medium Breakpoint", 'zn_framework' ),
                        "description" => __( "Bigger than 992px and smaller than 1199px", 'zn_framework' ),
                        "id"          => "spacer_hide_md",
                        "std"         => "0",
                        "value"       => "1",
                        "type"        => "toggle2",
                    ),
                    array (
                        "name"        => __( "Hide on Small Breakpoint ", 'zn_framework' ),
                        "description" => __( "Bigger than 768px and smaller than 991px", 'zn_framework' ),
                        "id"          => "spacer_hide_sm",
                        "std"         => "0",
                        "value"       => "1",
                        "type"        => "toggle2",
                    ),
                    array (
                        "name"        => __( "Hide on Extra small Breakpoint ", 'zn_framework' ),
                        "description" => __( "Smaller than 767px", 'zn_framework' ),
                        "id"          => "spacer_hide_xs",
                        "std"         => "0",
                        "value"       => "1",
                        "type"        => "toggle2",
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#O03njJEtSNQ" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
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
