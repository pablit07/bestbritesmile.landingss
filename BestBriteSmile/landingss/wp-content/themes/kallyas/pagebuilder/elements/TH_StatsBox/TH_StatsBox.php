<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Stats Box
 Description: Create and display a Stats Box element
 Class: TH_StatsBox
 Category: content
 Level: 3
*/
/**
 * Class TH_StatsBox
 *
 * Create and display a Stats Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StatsBox extends ZnElements
{
    public static function getName(){
        return __( "Stats Box", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        if( empty( $options ) ) { return; }

        $iconHolder = $this->opt('vts_tab_icon');
        $tabIcon = !empty( $iconHolder['family'] )  ? '<span class="kl-icon-dark" '.zn_generate_icon( $this->opt('vts_tab_icon') ).'></span>' : '';
        //$tabIcon = (isset($options['vts_tab_icon']) && !empty($options['vts_tab_icon']) ? $options['vts_tab_icon'] : '');
        $tabTitle = (isset($options['stb_title']) && !empty($options['stb_title']) ? $options['stb_title'] : '');


        echo '<div class="zn_stats_box '.$this->data['uid'].' '.$this->opt('css_class','').'">';

        if(!empty($tabTitle)){
            echo '<div class="zn_stats_box">';
                echo '<h3 class="mb_title">' . $tabIcon . $tabTitle . '</h3>';
            echo '</div>';
        }

        if ( ! empty ( $options['single_stats'] ) && is_array( $options['single_stats'] ) ) {
            echo '<div class="row zn_content_no_margin">';
            foreach ( $options['single_stats'] as $stat ) {
                echo '<div class="col-sm-3">';

                echo '<div class="statbox clearfix">';

                    $sb_type = isset($stat['sb_type']) && !empty($stat['sb_type']) ? $stat['sb_type'] : 'img';

                    if ( ! empty ( $stat['sb_icon'] ) && $sb_type == 'img' ) {
                        echo '<img src="' . $stat['sb_icon'] . '" alt="">';
                    }

                    // Fonticon
                    if ( isset($stat['sb_iconfont']) && !empty ( $stat['sb_iconfont'] ) && $sb_type == 'icon' ) {
                        $iconsize = isset($stat['sb_size']) && $stat['sb_size'] != 22 ? 'font-size:'.$stat['sb_size'].'px;' : '';
                        $sb_iconcolor = isset($stat['sb_iconcolor']) && $stat['sb_iconcolor'] != '#8f8f8f' ? 'color:'.$stat['sb_size'].';' : '';
                        echo '<span ' . zn_generate_icon($stat['sb_iconfont']) . ' style="'.$iconsize . $sb_iconcolor.'" class="statbox__fonticon"></span>';
                    }

                    echo '<h4>' . $stat['sb_title'] . '</h4>';
                    echo '<h6>' . $stat['sb_content'] . '</h6>';

                echo '</div>';

                echo '</div>';
            }
            echo '</div>';
        }
        echo '</div>';
    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $extra_options = array (
            "name"           => __( "Stats Boxes", 'zn_framework' ),
            "description"    => __( "Here you can add your desired stats boxes.", 'zn_framework' ),
            "id"             => "single_stats",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Stat Box", 'zn_framework' ),
            "remove_text"    => __( "Stat Box", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "sb_title",
            "subelements"    => array (
                array (
                    "name"        => __( "Title", 'zn_framework' ),
                    "description" => __( "Please enter the desired title that will
                                            appear on the right of the icon.", 'zn_framework' ),
                    "id"          => "sb_title",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Content", 'zn_framework' ),
                    "description" => __( "Please enter the desired title that will appear bellow the icon/Title.", 'zn_framework' ),
                    "id"          => "sb_content",
                    "std"         => "",
                    "type"        => "text"
                ),

                array (
                    "name"        => __( "Icon Type", 'zn_framework' ),
                    "description" => __( "Type of the icon.", 'zn_framework' ),
                    "id"          => "sb_type",
                    "std"         => "img",
                    "type"        => "select",
                    "options"     => array (
                        'icon' => __( 'Font Icon', 'zn_framework' ),
                        'img' => __( 'Image (PNG, JPG, SVG or even GIF)', 'zn_framework' )
                    ),
                ),

                array (
                    "name"        => __( "Icon", 'zn_framework' ),
                    "description" => __( "Please select an icon that will appear on the
                                            left side of the title.", 'zn_framework' ),
                    "id"          => "sb_icon",
                    "std"         => "",
                    "type"        => "media",
                    "dependency"  => array( 'element' => 'sb_type' , 'value'=> array('img') ),
                ),

                array (
                    "name"        => __( "Icon Size", 'zn_framework' ),
                    "description" => __( "Select the size of the icon.", 'zn_framework' ),
                    "id"          => "sb_size",
                    "std"         => "22",
                    'type'        => 'slider',
                    'class'       => 'zn_full',
                    'helpers'     => array(
                        'min' => '16',
                        'max' => '70',
                        'step' => '1'
                    ),
                    "dependency"  => array( 'element' => 'sb_type' , 'value'=> array('icon') ),
                ),

                array (
                    "name"        => __( "Icon Color", 'zn_framework' ),
                    "description" => __( "Select the color of the icon.", 'zn_framework' ),
                    "id"          => "sb_iconcolor",
                    "std"         => "#8f8f8f",
                    'type'        => 'colorpicker',
                    "dependency"  => array( 'element' => 'sb_type' , 'value'=> array('icon') ),
                ),

                array (
                    "name"        => __( "Select Icon", 'zn_framework' ),
                    "description" => __( "Select an icon to display.", 'zn_framework' ),
                    "id"          => "sb_iconfont",
                    "std"         => "",
                    "type"        => "icon_list",
                    'class'       => 'zn_full',
                    "dependency"  => array( 'element' => 'sb_type' , 'value'=> array('icon') ),
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
                        "description" => __( "Please enter the title for this box", 'zn_framework' ),
                        "id"          => "stb_title",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Tab icon", 'zn_framework' ),
                        "description" => __( "Select your desired icon that will appear on the left side of the title.", 'zn_framework' ),
                        "id"          => "vts_tab_icon",
                        "std"         => "",
                        "type"        => "icon_list",
                        'class'       => 'zn_full',
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#1I5uTW7B5_o" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/stats-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
