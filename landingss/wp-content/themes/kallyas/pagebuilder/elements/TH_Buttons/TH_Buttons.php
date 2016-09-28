<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Buttons
 Description: Create and display as many buttons as you want
 Class: TH_Buttons
 Category: content
 Level: 3
*/
/**
 * Class TH_Buttons
 *
 * Create and display as many buttons as you want
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_Buttons extends ZnElements
{
    public static function getName(){
        return __( "Buttons", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {

        echo '<div class="zn_buttons_element '.$this->data['uid'].' text-'.$this->opt('el_alignment','left').' '.$this->opt('css_class','').'">';

            $buttons = $this->opt('single_btn');

            if( is_array($buttons) && !empty( $buttons ) ){
                foreach( $buttons as $b ){

                    // Link
                    $link = '';
                    if( !empty($b['button_link']) && is_array($b['button_link']) ){
                        $b_link = $b['button_link'];

                        if( !empty($b_link['url']) ){
                            $link .= ' href="'.$b_link['url'].'"';
                        }
                        if( !empty($b_link['title']) ){
                            $link .= ' title="'.$b_link['title'].'"';
                        }

                        $target = $b_link['target'];
                        if($target == '_blank' || $target == '_self'){
                            $link .= ' target="' . $target  . '"';
                        } else if($target == 'modal'){
                            $link .= ' data-lightbox="image"';
                        } else if($target == 'modal_iframe'){
                            $link .= ' data-lightbox="iframe"';
                        } else if($target == 'modal_inline'){
                            $link .= ' data-lightbox="inline"';
                        } else if($target == 'smoothscroll'){
                            $link .= ' data-target="smoothscroll"';
                        }

                    }

                    $btnblock = isset($b['button_block']) ? $b['button_block'] : '';

                    //Class
                    $classes = $b['button_style']. ' ' . $b['button_size']. ' ' . $b['button_width'] . ' ' . $btnblock;

                    // Styles
                    $style = !empty($b['button_margin']) ? ' style="margin:'.$b['button_margin'].';"' : '';

                    // Icon
                    $icon = $b['button_icon_enable'] == 1 ? '<span '.zn_generate_icon( $b['button_icon'] ).'></span>':'';

                    if( isset($b['button_text']) && !empty($b['button_text']) ){

                        $text = '<span>'.$b['button_text'].'</span>';

                        // Icon position
                        if( $b['button_icon_pos'] == 'before' ){
                            $text = $icon.$text;
                        } else{
                            $text = $text.$icon;
                        }

                        echo '<a class="btn-element btn '.$classes.' " '.$link.' '.$style.'>'.$text.'</a>';
                    }

                }
            }

        echo '</div>';

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
                        "name"        => __( "Element Alignment", 'zn_framework' ),
                        "description" => __( "Please select the alignment of the button/s.", 'zn_framework' ),
                        "id"          => "el_alignment",
                        "std"         => "left",
                        "options"     => array (
                            'left' => __( 'Left (default)', 'zn_framework' ),
                            'right'          => __( 'Right', 'zn_framework' ),
                            'center'          => __( 'Center', 'zn_framework' )
                        ),
                        "type"        => "select",
                        'live' => array(
                           'type'           => 'class',
                           'css_class'      => '.'.$uid,
                           'val_prepend'   => 'text-',
                        ),
                    ),

                    array(
                        "name"           => __( "Button", 'zn_framework' ),
                        "description"    => __( "Add Button.", 'zn_framework' ),
                        "id"             => "single_btn",
                        "element_title" => "button_text",
                        "std"            => "",
                        "type"           => "group",
                        "add_text"       => __( "Button", 'zn_framework' ),
                        "remove_text"    => __( "Button", 'zn_framework' ),
                        "group_sortable" => true,
                        "subelements"    => array (

                            array (
                                "name"        => __( "Text", 'zn_framework' ),
                                "description" => __( "Text inside the button", 'zn_framework' ),
                                "id"          => "button_text",
                                "std"         => "",
                                "type"        => "text",
                            ),

                            array (
                                "name"        => __( "Link", 'zn_framework' ),
                                "description" => __( "Attach a link to the button", 'zn_framework' ),
                                "id"          => "button_link",
                                "std"         => "",
                                "type"        => "link",
                                "options"     => array (
                                    '_self'     => __( "Same window", 'zn_framework' ),
                                    '_blank'    => __( "New window", 'zn_framework' ),
                                    'modal'     => __( "Modal Image", 'zn_framework' ),
                                    'modal_iframe'     => __( "Modal Iframe", 'zn_framework' ),
                                    'modal_inline'     => __( "Modal Inline content", 'zn_framework' ),
                                    'smoothscroll' => __( "Smooth Scroll to Anchor", 'zn_framework' )
                                ),
                            ),
                            array (
                                "name"        => __( "Style", 'zn_framework' ),
                                "description" => __( "Select a style for the button", 'zn_framework' ),
                                "id"          => "button_style",
                                "std"         => "btn-fullcolor",
                                "type"        => "select",
                                "options"     => array (
                                    'btn-fullcolor'                     => __( "Flat (main color)", 'zn_framework' ),
                                    'btn-fullwhite'                     => __( "Flat (white)", 'zn_framework' ),
                                    'btn-fullblack'                     => __( "Flat (black)", 'zn_framework' ),
                                    'btn-lined'                         => __( "Lined (light)", 'zn_framework' ),
                                    'btn-lined lined-dark'              => __( "Lined (dark)", 'zn_framework' ),
                                    'btn-lined lined-gray'              => __( "Lined (gray)", 'zn_framework' ),
                                    'btn-lined lined-custom'            => __( "Lined (custom)", 'zn_framework' ),
                                    'btn-lined lined-full-light'        => __( "Lined-Full (light)", 'zn_framework' ),
                                    'btn-lined lined-full-dark'         => __( "Lined-Full (dark)", 'zn_framework' ),
                                    'btn-lined btn-skewed'              => __( "Lined-Skewed (light)", 'zn_framework' ),
                                    'btn-lined btn-skewed lined-dark'   => __( "Lined-Skewed (dark)", 'zn_framework' ),
                                    'btn-lined btn-skewed lined-gray'   => __( "Lined-Skewed (gray)", 'zn_framework' ),
                                    'btn-fullcolor btn-skewed'          => __( "Flat-Skewed (main color)", 'zn_framework' ),
                                    'btn-fullwhite btn-skewed'          => __( "Flat-Skewed (white)", 'zn_framework' ),
                                    'btn-fullblack btn-skewed'          => __( "Flat-Skewed (black)", 'zn_framework' ),
                                    'btn-default'                       => __( "Bootstrap - Default", 'zn_framework' ),
                                    'btn-primary'                       => __( "Bootstrap - Primary", 'zn_framework' ),
                                    'btn-success'                       => __( "Bootstrap - Success", 'zn_framework' ),
                                    'btn-info'                          => __( "Bootstrap - Info", 'zn_framework' ),
                                    'btn-warning'                       => __( "Bootstrap - Warning", 'zn_framework' ),
                                    'btn-danger'                        => __( "Bootstrap - Danger", 'zn_framework' ),
                                    'btn-link'                          => __( "Bootstrap - Link", 'zn_framework' ),
                                ),
                                'live' => array(
                                   'type'           => 'class',
                                   'css_class'      => '.'.$uid.' .btn-element',
                                ),
                            ),
                            array (
                                "name"        => __( "Size", 'zn_framework' ),
                                "description" => __( "Select a size for the button", 'zn_framework' ),
                                "id"          => "button_size",
                                "std"         => "",
                                "type"        => "select",
                                "options"     => array (
                                    ''          => __( "Default", 'zn_framework' ),
                                    'btn-lg'    => __( "Large", 'zn_framework' ),
                                    'btn-md'    => __( "Medium", 'zn_framework' ),
                                    'btn-sm'    => __( "Small", 'zn_framework' ),
                                    'btn-xs'    => __( "Extra small", 'zn_framework' ),
                                ),
                                'live' => array(
                                   'type'           => 'class',
                                   'css_class'      => '.'.$uid.' .btn-element',
                                ),
                            ),

                            array (
                                "name"        => __( "Width", 'zn_framework' ),
                                "description" => __( "Select a size for the button", 'zn_framework' ),
                                "id"          => "button_width",
                                "std"         => "",
                                "type"        => "select",
                                "options"     => array (
                                    ''                          => __( "Default", 'zn_framework' ),
                                    'btn-block btn-fullwidth'   => __( "Full width (100%)", 'zn_framework' ),
                                    'btn-halfwidth'             => __( "Half width (50%)", 'zn_framework' ),
                                    'btn-third'                 => __( "One-Third width (33%)", 'zn_framework' ),
                                    'btn-forth'                 => __( "One-forth width (25%)", 'zn_framework' ),
                                ),
                                'live' => array(
                                   'type'           => 'class',
                                   'css_class'      => '.'.$uid.' .btn-element',
                                ),
                            ),


                            array (
                                "name"        => __( "Make button as block?", 'zn_framework' ),
                                "description" => __( "Transform the button and make it a block?", 'zn_framework' ),
                                "id"          => "button_block",
                                "std"         => "",
                                "value"       => "btn-block",
                                "type"        => "toggle2",
                                'live' => array(
                                   'type'           => 'class',
                                   'css_class'      => '.'.$uid.' .btn-element',
                                ),
                            ),

                            array (
                                "name"        => __( "Margins", 'zn_framework' ),
                                "description" => __( "Add css margins to the buttons for distancing. The css syntax is [top right bottom left].", 'zn_framework' ),
                                "id"          => "button_margin",
                                "std"         => "",
                                "type"        => "text",
                                "placeholder" => "ex: 10px 10px 10px 10px",
                            ),

                            array (
                                "name"        => __( "Add icon?", 'zn_framework' ),
                                "description" => __( "Add an icon to the button?", 'zn_framework' ),
                                "id"          => "button_icon_enable",
                                "std"         => "0",
                                "value"       => "1",
                                "type"        => "toggle2",
                            ),
                            array (
                                "name"        => __( "Icon position", 'zn_framework' ),
                                "description" => __( "Select the position of the icon", 'zn_framework' ),
                                "id"          => "button_icon_pos",
                                "std"         => "before",
                                "type"        => "select",
                                "options"     => array (
                                    'before'  => __( "Before text", 'zn_framework' ),
                                    'after'   => __( "After text", 'zn_framework' ),
                                ),
                                "dependency"  => array( 'element' => 'button_icon_enable' , 'value'=> array('1') ),
                            ),

                            array (
                                "name"        => __( "Select icon", 'zn_framework' ),
                                "description" => __( "Select an icon to add to the button", 'zn_framework' ),
                                "id"          => "button_icon",
                                "std"         => "0",
                                "type"        => "icon_list",
                                'class'       => 'zn_full',
                                "dependency"  => array( 'element' => 'button_icon_enable' , 'value'=> array('1') ),
                            ),

                        )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#ZZa-J_ls8WY" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/buttons/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
