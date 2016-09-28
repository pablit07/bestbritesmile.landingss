<?php if (!defined('ABSPATH')) {
    return;
}
/*
 Name: Portfolio Archive
 Description: Create and display a Portfolio archive element
 Class: TH_PortfolioArchive
 Category: content
 Level: 3
*/
/**
 * Class TH_PortfolioArchive
 *
 * Create and display a Portfolio Category element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_PortfolioArchive extends ZnElements
{
    public static function getName(){
        return __( "Portfolio Category", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        global $paged, $zn_config;

        echo '<div class="elm-portfolio-archive '.$this->data['uid'].' '.$this->opt('css_class','').'">';

        // Get the proper page - this resolves the pagination on static frontpage
        if( get_query_var('paged') ){ $paged = get_query_var('paged'); }
        elseif( get_query_var('page') ){ $paged = get_query_var('page'); }
        else{ $paged = 1; }

        $portfolio_style = $this->opt( 'portfolio_style', 'portfolio_sortable' );
        // Forwared element set-up to templates
        $zn_config['port_columns'] = $this->opt( 'ports_num_columns', '4' );
        $zn_config['frame_style'] = $this->opt( 'frame_style', 'classic' );
        $zn_config['portfolio_categories'] = $this->opt( 'portfolio_categories' );
        $zn_config['posts_per_page'] = $this->opt( 'ports_per_page_visible', 4 );
        $zn_config['ports_extra_content'] = $this->opt( 'ports_extra_content', 'no' );
        $zn_config['ptf_sort_activebutton'] = $this->opt( 'ptf_sort_activebutton', '*' );

        // Build query
        $queryArgs = array(
            'post_type' => 'portfolio',
            'paged' => $paged,
            'posts_per_page' => $zn_config['posts_per_page'],
        );

        if( !empty( $zn_config['portfolio_categories'] ) ){
            $queryArgs['tax_query'] = array(
                array(
                    'taxonomy' => 'project_category',
                    'field' => 'id',
                    'terms' => $zn_config['portfolio_categories']
                ),
            );
        }

        query_posts($queryArgs);
        get_template_part( 'inc/loop', $portfolio_style );
        wp_reset_query();

        echo '</div>';
    }

    function scripts() {
        $portfolio_style = $this->opt( 'portfolio_style', 'portfolio_sortable' );

        if( $portfolio_style == 'portfolio_sortable' || $portfolio_style == 'portfolio_carousel' ){
            wp_enqueue_script( 'isotope');
        }
        elseif( $portfolio_style == 'portfolio_carousel' ){
            wp_enqueue_script( 'caroufredsel');
        }
    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {

        $activelist = WpkZn::getPortfolioCategories();
        if(!empty($activelist)){
            $allarr = array("*" => "All");
            $activelist = $allarr + $activelist;
        }

        $uid = $this->data['uid'];

        $options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(
                    array(
                        "name" => __("Archive style", 'zn_framework'),
                        "description" => __("Please choose the desired archive style to display.", 'zn_framework'),
                        "id" => "portfolio_style",
                        "std" => 'portfolio_sortable',
                        "type" => "select",
                        "options" => array(
                            'portfolio_category' => __( 'Portfolio Category', 'zn_framework' ),
                            'portfolio_sortable' => __( 'Portfolio Sortable', 'zn_framework' ),
                            'portfolio_carousel' => __( 'Portfolio Carousel Layout', 'zn_framework' ),
                        ),
                    ),
                    array(
                        "name" => __("Frame Style", 'zn_framework'),
                        "description" => __("Please choose which frame style to apply.", 'zn_framework'),
                        "id" => "frame_style",
                        "std" => 'classic',
                        "type" => "select",
                        "options" => array(
                            "classic" => 'Classic',
                            "modern" => 'Modern',
                            "minimal" => 'Minimal',
                        ),
                        'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array('portfolio_carousel') ),
                    ),
                    array(
                        "name" => __("Portfolio Category", 'zn_framework'),
                        "description" => __("Select the portfolio category to show items", 'zn_framework'),
                        "id" => "portfolio_categories",
                        "multiple"    => true,
                        "std" => "0",
                        "type" => "select",
                        "options" => WpkZn::getPortfolioCategories(),
                    ),
                    array(
                        "name" => __("Active Button in Portfolio Menu", 'zn_framework'),
                        "description" => __("Choose the active category or wether all should be displayed on page load.", 'zn_framework'),
                        "id" => "ptf_sort_activebutton",
                        "std" => '*',
                        "type" => "select",
                        "options" => $activelist,
                        'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array('portfolio_sortable') ),
                    ),
                    array(
                        "name" => __("Number of portfolio Items Per Page", 'zn_framework'),
                        "description" => __("Please enter how many portfolio items you want to load on a page.", 'zn_framework'),
                        "id" => "ports_per_page_visible",
                        "std" => "4",
                        "type" => "text"
                    ),
                    array(
                        "name" => __("Number of columns", 'zn_framework'),
                        "description" => __("Please enter how many portfolio items you want to load on a page.", 'zn_framework'),
                        "id" => "ports_num_columns",
                        "std" => "4",
                        "options" => array(
                            '1' => __('1', 'zn_framework'),
                            '2' => __('2', 'zn_framework'),
                            '3' => __('3', 'zn_framework'),
                            '4' => __('4', 'zn_framework'),
                        ),
                        "type" => "select",
                        'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array( 'portfolio_sortable', 'portfolio_category' ) ),
                    ),
                    array(
                        "name" => __("Show item details bellow post content", 'zn_framework'),
                        "description" => __("Here, you can choose to show the portfolio item details like CLIENt, YEAR, etc. <b> Important : Will only work when you select 1 column layout </b> ).", 'zn_framework'),
                        "id" => "ports_extra_content",
                        "std" => "no",
                        "options" => array(
                            'yes' => __('Show', 'zn_framework'),
                            'no' => __('Hide', 'zn_framework'),
                        ),
                        "type" => "select",
                        'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array( 'portfolio_category' ) ),
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#b1z44M6EaM4" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/portfolio-archive/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
