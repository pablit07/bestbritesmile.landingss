<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Search Box
 Description: Create and display a Search Box element
 Class: TH_SearchBox
 Category: content
 Level: 3
*/
/**
 * Class TH_SearchBox
 *
 * Create and display a Search Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */

class TH_SearchBox extends ZnElements
{
    public static function getName(){
        return __( "Search Box", 'zn_framework' );
    }

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){
        $css = '';
        $uid = $this->data['uid'];

        $width = (int) $this->opt('sb_btn_width', '130');
        $css .= ".$uid .elm-searchbox__submit { width: ". $width."px; }";
        $css .= ".$uid .elm-searchbox__input { width: calc(100% - ". $width."px); }";

        $css .= ".$uid .elm-searchbox__submit, .$uid .elm-searchbox__input { height: ". (int) $this->opt('sb_btn_height', '55') ."px; }";

        return $css;
    }


    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
?>

<div class="elm-searchbox elm-searchbox--<?php echo $this->opt('sb_style', 'normal'); ?> elm-searchbox--eff-<?php echo $this->opt('sb_placeholder', 'normal'); ?> <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">
    <div class="elm-searchbox__inner">
        <form class="elm-searchbox__form" action="<?php echo home_url(); ?>" method="get">

            <input name="s" maxlength="30" class="elm-searchbox__input" type="text" size="20" value="" placeholder="<?php echo $this->opt('sb_placeholder', 'normal') == 'normal' ? $this->opt('sb_placeholder_text', '') : '' ?>" />
            <?php if( $this->opt('sb_placeholder', 'normal') == 'typing'){ ?>
            <span class="elm-searchbox__input-text"><?php echo $this->opt('sb_placeholder_text', '') ?></span>
            <?php } ?>

            <?php if($this->opt('sb_btn_type','icon') == 'icon'){ ?>
                <button type="submit" class="elm-searchbox__submit glyphicon glyphicon-search"></button>
            <?php } else { ?>
                <button type="submit" class="elm-searchbox__submit"><?php echo $this->opt('sb_btn_text', ''); ?></button>
            <?php } ?>

            <div class="clearfix"></div>
        </form>
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
        $uid = $this->data['uid'];

        $options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(

                    array (
                        "name"        => __( "Search Box Style", 'zn_framework' ),
                        "description" => __( "Choose a style", 'zn_framework' ),
                        "id"          => "sb_style",
                        "std"         => "normal",
                        "type"        => "select",
                        "options"     => array (
                            'normal'  => __( 'White input and filled button', 'zn_framework' ),
                            'normal2' => __( 'White input and transparent button', 'zn_framework' ),
                            'transparent'  => __( 'Transparent input and filled button', 'zn_framework' ),
                            'transparent2' => __( 'Transparent input and transparent button', 'zn_framework' ),
                        )
                    ),

                    array (
                        "name"        => __( "Placeholder Effect", 'zn_framework' ),
                        "description" => __( "Choose the placeholder's effect", 'zn_framework' ),
                        "id"          => "sb_placeholder",
                        "std"         => "typing",
                        "type"        => "select",
                        "options"     => array (
                            'typing'  => __( 'Typing Effect', 'zn_framework' ),
                            'normal' => __( 'Simple placeholder text', 'zn_framework' )
                        )
                    ),

                    array (
                        "name"        => __( "Search Input text", 'zn_framework' ),
                        "description" => __( "Add a placeholder text inside the search input.", 'zn_framework' ),
                        "id"          => "sb_placeholder_text",
                        "std"         => "",
                        "type"        => "text",
                        "placeholder" => "ex: Some search text",
                    ),

                    array (
                        "name"        => __( "Button text type", 'zn_framework' ),
                        "description" => __( "Choose the button text or icon", 'zn_framework' ),
                        "id"          => "sb_btn_type",
                        "std"         => "icon",
                        "type"        => "select",
                        "options"     => array (
                            'icon'  => __( 'Loupe Icon', 'zn_framework' ),
                            'text' => __( 'Custom text', 'zn_framework' )
                        )
                    ),

                    array (
                        "name"        => __( "Button text", 'zn_framework' ),
                        "description" => __( "Add a text inside the button", 'zn_framework' ),
                        "id"          => "sb_btn_text",
                        "std"         => "",
                        "type"        => "text",
                        "placeholder" => "ex: SEARCH",
                        "dependency"  => array( 'element' => 'sb_btn_type' , 'value'=> array('text') )
                    ),

                    array (
                        "name"        => __( "Button width (px)", 'zn_framework' ),
                        "description" => __( "Add a button width", 'zn_framework' ),
                        "id"          => "sb_btn_width",
                        "std"         => "130",
                        "type"        => "text",
                    ),

                    array (
                        "name"        => __( "Form height", 'zn_framework' ),
                        "description" => __( "Specify the form height", 'zn_framework' ),
                        "id"          => "sb_btn_height",
                        "std"         => "55",
                        "type"        => "text",
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#ag58kRfAG7k" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/search-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
