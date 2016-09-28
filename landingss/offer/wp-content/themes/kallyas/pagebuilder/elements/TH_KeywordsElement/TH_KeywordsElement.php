<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Keywords Element
 Description: Create and display a Keywords Element element
 Class: TH_KeywordsElement
 Category: content
 Level: 3
*/

/**
 * Class TH_KeywordsElement
 *
 * Create and display a Keywords Element element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_KeywordsElement extends ZnElements
{
    public static function getName(){
        return __( "Keywords Element", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        $kbStyle = (isset($options['keywordbox_style']) && !empty($options['keywordbox_style']) ? esc_attr($options['keywordbox_style']) : 'style1');

        $cssClass = '';
        $cssRules = '';
        $useBgImage = false;
        $useBgColor = false;

        if('style2' == $kbStyle){
            $cssClass = 'keywordbox-2';
            $useBgImage = true;
        }
        elseif('style3' == $kbStyle){
            $cssClass = 'keywordbox-3';
            $useBgImage = true;
        }
        elseif('style4' == $kbStyle){
            $cssClass = 'keywordbox-4';
            $useBgColor = true;
		}


		if($useBgImage){
			$cssRules .= "background-image: url({$options['kb_bg_image']});";
		}
		if($useBgColor){
			$cssRules .= "background-color: {$options['kb_bg_color']};";
		}

        if ( !empty ( $options['kw_content'] ) ) {
            echo '<div class="keywordbox '.$cssClass.' '.$this->data['uid'].' '.$this->opt('css_class','').'" style="'.$cssRules.'">'.$options['kw_content'].'</div>';
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
                        "name"        => __( "Keyword Box Style", 'zn_framework' ),
                        "description" => __( "Please select the style you want to use.", 'zn_framework' ),
                        "id"          => "keywordbox_style",
                        "std"         => "style1",
                        "options"     => array (
                            'style1'  => __( 'Style 1', 'zn_framework' ),
                            'style2'  => __( 'Style 2 (since v4.0)', 'zn_framework' ),
                            'style3'  => __( 'Style 3 (since v4.0)', 'zn_framework' ),
                            'style4'  => __( 'Style 4 (since v4.0)', 'zn_framework' )
                        ),
                        "type"        => "select",
                    ),
                    array (
                        "name"        => __( "Background image", 'zn_framework' ),
                        "description" => __( "Select a background image for this element", 'zn_framework' ),
                        "id"          => "kb_bg_image",
                        "std"         => "",
                        "type"        => "media",
                        'class'       => 'zn_full',
                        'dependency'  => array('element' => 'keywordbox_style', 'value' => array('style2', 'style3')),
                    ),
                    array (
                        "name"        => __( "Background Color", 'zn_framework' ),
                        "description" => __( "Here you can choose the background color for this element.", 'zn_framework' ),
                        "id"          => "kb_bg_color",
                        "std"         => '',
                        "type"        => "colorpicker",
                        'dependency'  => array('element' => 'keywordbox_style', 'value' => array('style4')),
                    ),
                    array (
                        "name"        => __( "Content", 'zn_framework' ),
                        "description" => __( "Please enter the Keywords content", 'zn_framework' ),
                        "id"          => "kw_content",
                        "std"         => "",
                        "type"        => "textarea",
                    )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#0S7H_kkVP5U" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/keywords-element/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

