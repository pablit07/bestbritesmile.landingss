<?php if(! defined('ABSPATH')){ return; }
/*
Name: Latest Posts 4
Description: Create and display a Latest Posts 4 element
Class: TH_LatestPosts4
Category: content
Level: 3
*/

/**
 * Class TH_LatestPosts4
 *
 * Create and display a Latest Posts 4 element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_LatestPosts4 extends ZnElements
{
    public static function getName(){
        return __( "Latest Posts 4", 'zn_framework' );
    }

    function css(){
        $uid = $this->data['uid'];
        $lp_title_font = $this->opt('lp_title_font', 54);
        $css = '';

        if( $lp_title_font != 54 ){
            $css =  ".{$uid}.latest_posts.default-style.kl-style-2 .lp-title .m_title { font-size: {$lp_title_font}px; }";
        }

        return $css;
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        $style = (isset($options['lp_style_select']) ? $options['lp_style_select'] : 'default-style');
        $placement = (isset($options['lp_placement']) ? $options['lp_placement'] : 'normal');
        $category = $this->opt( 'lp_blog_categories' );

        // required inside /inc/...
        global $post;

        $postTitle = (isset($options['lp_title']) ? $options['lp_title'] : '');

        // HOW MANY POSTS
        $num_posts = 5;
        if ('default-style' == $style ) {
            $num_posts = (isset($options['lp_num_posts']) ? intval($options['lp_num_posts']) : $num_posts);
        }

        $GLOBALS['lp_info'] = array(
            'options' => $options,
            'post' => $post,
            'blog_category' => $category,
            'num_posts' => $num_posts,
            'postTitle' => $postTitle,
            'placement' => $placement,
        );

        $styleClass = 'default-style';
        if('default-style' != $style){
            $styleClass .= ' '.$style;
        }
        ?>
            <div class="latest_posts <?php echo $styleClass . ' '. $this->data['uid'];?> <?php echo $this->opt('css_class',''); ?>">
                <?php
                    $path = dirname(__FILE__). '/inc/'.$style.'.php';
                    if(is_file($path)){
                        include($path);
                    }
                ?>
            </div>
            <!-- end // latest posts style 2 -->
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
                        "name"        => __( "Style", 'zn_framework' ),
                        "description" => __( "Please select the style you want to use.", 'zn_framework' ),
                        "id"          => "lp_style_select",
                        "std"         => "default-style",
                        "options"     => array (
                            'default-style' => __( 'Default Style', 'zn_framework' ),
                            'kl-style-2'    => __( 'Style 2 (since v4.0)', 'zn_framework' ),
                        ),
                        "type"        => "select",
                    ),
                    array (
                        "name"        => __( "Boxes placement", 'zn_framework' ),
                        "description" => __( "Please select the boxes placement.", 'zn_framework' ),
                        "id"          => "lp_placement",
                        "std"         => "normal",
                        "options"     => array (
                            'normal' => __( 'Normal (title left-top)', 'zn_framework' ),
                            'flipped'    => __( 'Flipped (title box, bottom-right)', 'zn_framework' ),
                        ),
                        "type"        => "select",
                        "dependency"  => array('element' => 'lp_style_select', 'value' => array('kl-style-2')),
                    ),
                    array (
                        "name"        => __( "Title font size", 'zn_framework' ),
                        "description" => __( "Please select the desired title font size.", 'zn_framework' ),
                        "id"          => "lp_title_font",
                        "std"         => "54",
                        'class'		  => 'zn_full',
                        'helpers'	  => array(
                            'min' => '0',
                            'max' => '400',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'		=> 'css',
                            'css_class' => '.'.$this->data['uid'].'.latest_posts.default-style.kl-style-2 .lp-title .m_title',
                            'css_rule'	=> 'font-size',
                            'unit'		=> 'px'
                        ),
                        "type"        => "slider",
                        "dependency"  => array('element' => 'lp_style_select', 'value' => array('kl-style-2')),
                    ),
                    array (
                        "name"        => __( "Title", 'zn_framework' ),
                        "description" => __( "Enter a title for your Latest Posts element", 'zn_framework' ),
                        "id"          => "lp_title",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Number of posts", 'zn_framework' ),
                        "description" => __( "Enter the number of posts that you want to show", 'zn_framework' ),
                        "id"          => "lp_num_posts",
                        "std"         => "3",
                        "type"        => "text",
                        "dependency"  => array('element' => 'lp_style_select', 'value' => array('default-style')),
                    ),
                    array (
                        "name"        => __( "Blog Category", 'zn_framework' ),
                        "description" => __( "Select the blog category to show items", 'zn_framework' ),
                        "id"          => "lp_blog_categories",
                        "multiple"    => true,
                        "std"         => "0",
                        "type"        => "select",
                        "options"     => WpkZn::getBlogCategories()
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#gFcL4BXQpAs" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/latest-posts/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
