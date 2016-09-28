<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Shop Products Presentation
 Description: Create and display a Shop Products Presentation element
 Class: TH_ShopProductsPresentation
 Category: content
 Level: 3
 Scripts: true
 Dependency_class: WooCommerce
*/
/**
 * Class TH_ShopProductsPresentation
 *
 * Create and display a Shop Products Presentation element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ShopProductsPresentation extends ZnElements
{
    public static function getName(){
        return __( "Shop Products Presentation", 'zn_framework' );
    }

    /**
     * Load dependant resources
     */
    function scripts(){
        wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/sliders/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        global $woocommerce;

        if (!isset($woocommerce) || empty( $woocommerce ) ) {
            return;
        }

        $randId = rand( 1, 10000 );

        $layout = $this->opt('woo_spp_display','tabs');
        $layout_type = $layout == 'tabs' ? 'tabbable' : 'spp-products-rows';
        $types = array(
            'woo_fp_prod' => array(
                'wtitle' => $this->opt( 'woo_fp_title', __("FEATURED PRODUCTS", 'zn_framework' ) ),
                'wauto' => $this->opt( 'woo_fp_auto', '' ),
                'wtimeout' => $this->opt( 'woo_fp_timeout', '5000' )
            ),
            'woo_lp_prod' => array(
                'wtitle' => $this->opt( 'woo_lp_title', __("LATEST PRODUCTS", 'zn_framework' ) ),
                'wauto' => $this->opt( 'woo_lp_auto', '' ),
                'wtimeout' => $this->opt( 'woo_lp_timeout', '5000' )
            ),
            'woo_bs_prod' => array(
                'wtitle' => $this->opt( 'woo_bsp_title', __("BEST SELLING PRODUCTS", 'zn_framework' ) ),
                'wauto' => $this->opt( 'woo_bs_auto', '' ),
                'wtimeout' => $this->opt( 'woo_bs_timeout', '5000' )
            ),
        );

        ?>

            <div class="shop-latest <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">
                <div class="<?php echo $layout_type; ?>">

                <?php
                // Disply tabs
                if($layout == 'tabs') { ?>
                    <ul class="nav fixclear">
                        <?php

                        $i = 0;
                        foreach ($types as $type => $name) {
                            if ($this->opt($type) == 1) {
                                $cls = '';
                                if ($i == 0) {
                                    $cls = 'active';
                                }
                                echo '<li class="' . $cls . '"><a href="#tabpan_' . $randId . $i . '" data-toggle="tab">' . $name['wtitle'] . '</a></li>';
                                $i++;
                            }
                        }
                        ?>
                    </ul>

                    <div class="tab-content">
                    <?php
                    }
                        $i = 0;
                        foreach ($types as $type => $name) {
                            if ($this->opt($type) == 1) {
                                $cls = '';
                                if ($i == 0) {
                                    $cls = 'active';
                                }

                                // If layout == tabs
                                if ($layout == 'tabs') {
                                    echo '<div class="tab-pane ' . $cls . '" id="tabpan_' . $randId . $i . '">';
                                } else {
                                    echo '<div class="row">';
                                    echo '<div class="col-sm-12">';
                                    echo '<h3 class="m_title ff-alternative spp-title">' . $name['wtitle'] . '</h3>';
                                    echo '</div>';
                                    echo '<div class="col-sm-12">';
                                }

                                $product_query = $this->get_query($type);

                                echo '<div class="shop-latest-carousel">';
                                echo '<ul class="featured_products" data-autoplay="'.$name['wauto'].'" data-timeout="'.$name['wtimeout'].'">';

                                if ($product_query->have_posts()) {
                                    while ($product_query->have_posts()) {
                                        $product_query->the_post();
                                        global $product;
                                        // bail
                                        if (!isset($product) || empty($product) || !is_object($product)) {
                                            continue;
                                        }
                                        wc_get_template_part( 'content', 'product' );
                                    }
                                }

                                echo '</ul>';
                                echo '<div class="th-controls controls">';
                                echo '<a href="#" class="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>';
                                echo '<a href="#" class="next"><span class="glyphicon glyphicon-chevron-right"></span></a>';
                                echo '</div>';
                                echo '</div>';

                                if ($layout == 'tabs') {
                                    echo '</div>';
                                } else {
                                    echo '</div>';
                                    echo '</div>';
                                }

                                $i++;
                            }
                        }

                    if($layout == 'tabs') {
                        echo '</div>'; // End tab-content
                    }
                    ?>
            </div><!-- /.tabbable / spp-products-rows -->
        </div>
        <!-- end shop latest -->

    <?php
        wp_reset_query();
    }

    function get_query( $type ){

        /*
        * Get all product category Ids. They will be used if there are no categories selected in the
        *  Page Builder element
        */
        $categories = $this->opt( 'woo_categories', false );

        $query_args = array (
            'posts_per_page' => $this->opt( 'prods_per_page', '6' ),
            'no_found_rows'  => 1,
            'post_status'    => 'publish',
            'post_type'      => 'product'
        );

        if( $type != 'woo_fp_prod' && ! empty( $categories ) ){
            $query_args['tax_query'] = array (
                array (
                    'taxonomy' => 'product_cat',
                    'field'    => 'id',
                    'terms'    => $categories,
                )
            );
        }

        // Add meta key => value for the current type
        // Best selling
        if( $type == 'woo_bs_prod' ){
            $query_args['meta_key'] = 'total_sales';
            $query_args['orderby'] = 'meta_value';
        }

        // Featured products
        if( $type == 'woo_fp_prod' ){
            $query_args['meta_key'] = '_featured';
            $query_args['meta_value'] = 'yes';
        }

        return new WP_Query( $query_args );
    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        /*
         * Get Shop categories
         */
        $categories = WpkZn::getShopCategories();

        $uid = $this->data['uid'];

        $options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(

                    array (
                        "name"        => __( "Display style", 'zn_framework' ),
                        "description" => __( "Select the display layout.", 'zn_framework' ),
                        "id"          => "woo_spp_display",
                        "std"         => 'tabs',
                        "options"     => array ( 'tabs' => __( 'Tabs', 'zn_framework' ), 'rows' => __( 'Simple Rows', 'zn_framework' ) ),
                        "type"        => "select",
                    ),

                    array (
                        "name"        => __( "Show Latest Products", 'zn_framework' ),
                        "description" => __( "Select yes if you want to show the latest products.", 'zn_framework' ),
                        "id"          => "woo_lp_prod",
                        "std"         => '1',
                        "options"     => array ( '1' => __( 'Yes', 'zn_framework' ), '0' => __( 'No', 'zn_framework' ) ),
                        "type"        => "select",
                    ),
                    array (
                        "name"        => __( "Latest Products Title", 'zn_framework' ),
                        "description" => __( "Please enter a title for the latest products. If no title is set, the default title
                                    will be shown ( LATEST PRODUCTS )", 'zn_framework' ),
                        "id"          => "woo_lp_title",
                        "std"         => "",
                        "type"        => "text",
                        'dependency'  => array( 'element' => 'woo_lp_prod', 'value' => array('1') ),
                    ),
                    array (
                        "name"        => __( "Enable Autoplay?", 'zn_framework' ),
                        "description" => __( "Please select if you want the Latest Products panel to be auto-played.", 'zn_framework' ),
                        "id"          => "woo_lp_auto",
                        "std"         => "",
                        "value"         => "yes",
                        "type"        => "toggle2",
                        'dependency'  => array( 'element' => 'woo_lp_prod', 'value' => array('1') ),
                    ),
                    array (
                        "name"        => __( "Autoplay timeout", 'zn_framework' ),
                        "description" => __( "If autoplay is enabled, please select the autoplay timeout, duration between the carousel will slide. Add in miliseconds, 5000ms = 5 seconds .", 'zn_framework' ),
                        "id"          => "woo_lp_timeout",
                        "std"         => "5000",
                        "type"        => "text",
                        'dependency'  => array( 'element' => 'woo_lp_prod', 'value' => array('1') ),
                    ),
                    array (
                        "name"        => __( "Show Best Selling Products", 'zn_framework' ),
                        "description" => __( "Select yes if you want to show the best selling
                                            products.", 'zn_framework' ),
                        "id"          => "woo_bs_prod",
                        "std"         => 1,
                        "options"     => array ( '1' => __( 'Yes', 'zn_framework' ), '0' => __( 'No', 'zn_framework' ) ),
                        "type"        => "select",
                    ),
                    array (
                        "name"        => __( "Best Selling Title", 'zn_framework' ),
                        "description" => __( "Please enter a title for the best selling products. If no title is set , the default
                                    title will be shown ( BEST SELLING PRODUCTS )", 'zn_framework' ),
                        "id"          => "woo_bsp_title",
                        "std"         => "",
                        "type"        => "text",
                        'dependency'  => array( 'element' => 'woo_bs_prod', 'value' => array('1') ),
                    ),
                    array (
                        "name"        => __( "Enable Autoplay?", 'zn_framework' ),
                        "description" => __( "Please select if you want the Best Selling panel to be auto-played.", 'zn_framework' ),
                        "id"          => "woo_bs_auto",
                        "std"         => "",
                        "value"         => "yes",
                        "type"        => "toggle2",
                        'dependency'  => array( 'element' => 'woo_bs_prod', 'value' => array('1') ),
                    ),
                    array (
                        "name"        => __( "Autoplay timeout", 'zn_framework' ),
                        "description" => __( "If autoplay is enabled, please select the autoplay timeout, duration between the carousel will slide. Add in miliseconds, 5000ms = 5 seconds .", 'zn_framework' ),
                        "id"          => "woo_bs_timeout",
                        "std"         => "5000",
                        "type"        => "text",
                        'dependency'  => array( 'element' => 'woo_bs_prod', 'value' => array('1') ),
                    ),

                    array (
                        "name"        => __( "Show Featured Products", 'zn_framework' ),
                        "description" => __( "Select yes if you want to show the featured products.", 'zn_framework' ),
                        "id"          => "woo_fp_prod",
                        "std"         => '1',
                        "options"     => array ( '1' => __( 'Yes', 'zn_framework' ), '0' => __( 'No', 'zn_framework' ) ),
                        "type"        => "select",
                    ),
                    array (
                        "name"        => __( "Featured Products Title", 'zn_framework' ),
                        "description" => __( "Please enter a title for the featured products. If no title is set, the default title
                                    will be shown ( FEATURED PRODUCTS )", 'zn_framework' ),
                        "id"          => "woo_fp_title",
                        "std"         => "",
                        "type"        => "text",
                        'dependency'  => array( 'element' => 'woo_fp_prod', 'value' => array('1') ),
                    ),
                    array (
                        "name"        => __( "Enable Autoplay?", 'zn_framework' ),
                        "description" => __( "Please select if you want the Featured Products panel to be auto-played.", 'zn_framework' ),
                        "id"          => "woo_fp_auto",
                        "std"         => "",
                        "value"         => "yes",
                        "type"        => "toggle2",
                        'dependency'  => array( 'element' => 'woo_fp_prod', 'value' => array('1') ),
                    ),
                    array (
                        "name"        => __( "Autoplay timeout", 'zn_framework' ),
                        "description" => __( "If autoplay is enabled, please select the autoplay timeout, duration between the carousel will slide. Add in miliseconds, 5000ms = 5 seconds .", 'zn_framework' ),
                        "id"          => "woo_fp_timeout",
                        "std"         => "5000",
                        "type"        => "text",
                        'dependency'  => array( 'element' => 'woo_fp_prod', 'value' => array('1') ),
                    ),

                    array (
                        "name"        => __( "Shop Category", 'zn_framework' ),
                        "description" => __( "Select the shop category to show items", 'zn_framework' ),
                        "id"          => "woo_categories",
                        "multiple"    => true,
                        "std"         => "0",
                        "type"        => "select",
                        "options"     => $categories
                    ),
                    array (
                        "name"        => __( "Number of products", 'zn_framework' ),
                        "description" => __( "Please enter how many products you want to load.", 'zn_framework' ),
                        "id"          => "prods_per_page",
                        "std"         => "6",
                        "type"        => "text"
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#hy-twTGcQ7c" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/shop-products-presentation/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
