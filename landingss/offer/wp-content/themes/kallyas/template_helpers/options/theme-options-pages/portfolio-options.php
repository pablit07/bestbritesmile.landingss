<?php
/**
 * Theme options > General Options  > Favicon options
 */

$activelist = WpkZn::getPortfolioCategories();
if(!empty($activelist)){
    $allarr = array("*" => "All");
    $activelist = $allarr + $activelist;
}

$admin_options[] = array (
    'slug'        => 'portfolio_options',
    'parent'      => 'portfolio_options',
    "name"        => __( "Portfolio Archive style", 'zn_framework' ),
    "description" => __( "Select the desired style for the portfolio archive pages.", 'zn_framework' ),
    "id"          => "portfolio_style",
    "std"         => "portfolio_sortable",
    "type"        => "select",
    "options"     => array (
        'portfolio_category' => __( 'Portfolio Category', 'zn_framework' ),
        'portfolio_sortable' => __( 'Portfolio Sortable', 'zn_framework' ),
        'portfolio_carousel' => __( 'Portfolio Carousel Layout', 'zn_framework' ),
    ),
    "class"       => ""
);

$admin_options[] = array(
    'slug'        => 'portfolio_options',
    'parent'      => 'portfolio_options',
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
    "dependency"  => array( 'element' => 'portfolio_style' , 'value'=> array('portfolio_carousel') ),
);

$admin_options[] = array(
    'slug'        => 'portfolio_options',
    'parent'      => 'portfolio_options',
    "name" => __("Active Button in Portfolio Menu", 'zn_framework'),
    "description" => __("Choose the active category or wether all should be displayed on page load.", 'zn_framework'),
    "id" => "ptf_sort_activebutton",
    "std" => '*',
    "type" => "select",
    "options" => $activelist,
    'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array('portfolio_sortable') )
);

$admin_options[] = array (
    'slug'        => 'portfolio_options',
    'parent'      => 'portfolio_options',
    "name"        => __( "Portfolio items per page", 'zn_framework' ),
    "description" => __( "Please enter the desired number of portfolio items that will be displayed on a page.", 'zn_framework' ),
    "id"          => "portfolio_per_page_show",
    "std"         => "4",
    "type"        => "text",
);

$admin_options[] = array (
    'slug'        => 'portfolio_options',
    'parent'      => 'portfolio_options',
    "name"        => __( "Number of columns", 'zn_framework' ),
    "description" => __( "Please enter how many portfolio items you want to load on a page if you choose to use
		the portfolio category style.", 'zn_framework' ),
    "id"          => "ports_num_columns",
    "std"         => "4",
    "options"     => array (
        '1' => __( '1', 'zn_framework' ),
        '2' => __( '2', 'zn_framework' ),
        '3' => __( '3', 'zn_framework' ),
        '4' => __( '4', 'zn_framework' ),
    ),
    "type"        => "select",
    "dependency"  => array( 'element' => 'portfolio_style' , 'value'=> array( 'portfolio_category', 'portfolio_sortable' ) ),
);

$admin_options[] = array(
    'slug'        => 'portfolio_options',
    'parent'      => 'portfolio_options',
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
);

$admin_options[] = array (
    'slug'        => 'portfolio_options',
    'parent'      => 'portfolio_options',
    "name"        => __( "Link Portfolio Media", 'zn_framework' ),
    "description" => __( "Select Yes if you want your portfolio images to be linked to the portfolio item as
		opposed to open the image in lightbox. ( only works with portfolio sortable )", 'zn_framework' ),
    "id"          => "zn_link_portfolio",
    "std"         => "no",
    "options"     => array ( 'yes' => __( 'Yes', 'zn_framework' ), 'no' => __( 'No', 'zn_framework' ) ),
    "type"        => "select"
);

$admin_options[] = array (
    'slug'        => 'portfolio_options',
    'parent'      => 'portfolio_options',
    "name"        => __( "Single item style", 'zn_framework' ),
    "description" => __( "Select the desired style for the portfolio single item pages.", 'zn_framework' ),
    "id"          => "portfolio_single_style",
    "std"         => "",
    "type"        => "select",
    "options"     => array (
        '' => __( 'Show compacted description', 'zn_framework' ),
        'full_desc' => __( 'Show full description', 'zn_framework' ),
    ),
    "class"       => ""
);

$admin_options[] = array (
    'slug'        => 'portfolio_options',
    'parent'      => 'portfolio_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "ptfo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'portfolio_options',
    'parent'      => 'portfolio_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#rVA576HZaYA" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "ptfo_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'portfolio_options',
    'parent'      => 'portfolio_options',
    "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="http://support.hogash.com/documentation/setting-up-portfolio/" target="_blank">Setting up portfolio</a>, <a href="http://support.hogash.com/documentation/using-custom-permalinks-for-portfolio/" target="_blank">Using custom permalinks for portfolio</a>,', 'zn_framework' ),
    "id"          => "ptfo_link",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'portfolio_options',
    'parent'      => 'portfolio_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "ptfo_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);