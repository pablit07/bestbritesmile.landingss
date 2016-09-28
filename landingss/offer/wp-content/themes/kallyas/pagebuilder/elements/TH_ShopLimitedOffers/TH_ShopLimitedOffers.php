<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Shop Limited Offers
 Description: Create and display a Shop Limited Offers element
 Class: TH_ShopLimitedOffers
 Category: content
 Level: 3
 Scripts: true
 Dependency_class: WooCommerce
*/
/**
 * Class TH_ShopLimitedOffers
 *
 * Create and display a Shop Limited Offers element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ShopLimitedOffers extends ZnElements
{

    public static function getName(){
        return __( "Shop Limited Offers", 'zn_framework' );
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

        if( empty( $options['woo_categories'] ) ) { return; }

        global $woocommerce;

        if (!isset($woocommerce) || empty( $woocommerce ) ) {
            return;
        }

        ?>
        <div class="elm-shoplimited <?php echo $this->opt('css_class',''); ?>">
            <?php
            if ( ! empty ( $options['woo_lo_title'] ) ) {
                echo '<h3 class="m_title">' . $options['woo_lo_title'] . '</h3>';
            }

            // Get products on sale
            if ( false === ( $product_ids_on_sale = get_transient( 'wc_products_onsale' ) ) ) {
                $meta_query = array ();
                $meta_query[] = array (
                    'key'     => '_sale_price',
                    'value'   => 0,
                    'compare' => '>',
                    'type'    => 'NUMERIC'
                );
                $on_sale = get_posts( array (
                    'post_type'      => array ( 'product', 'product_variation' ),
                    'posts_per_page' => - 1,
                    'post_status'    => 'publish',
                    'meta_query'     => $meta_query,
                    'fields'         => 'id=>parent'
                ) );

                $product_ids = array_keys( $on_sale );
                $parent_ids  = array_values( $on_sale );

                // Check for scheduled sales which have not started
                foreach ( $product_ids as $key => $id ) {
                    if ( get_post_meta( $id, '_sale_price_dates_from', true ) > current_time( 'timestamp' ) ) {
                        unset( $product_ids[ $key ] );
                    }
                }
                $product_ids_on_sale = array_unique( array_merge( $product_ids, $parent_ids ) );
                set_transient( 'wc_products_onsale', $product_ids_on_sale );
            }

            $product_ids_on_sale[] = 0;

            $meta_query   = array ();
            $meta_query[] = $woocommerce->query->visibility_meta_query();
            $meta_query[] = $woocommerce->query->stock_status_meta_query();

            if ( empty ( $options['woo_categories'] ) ) {
                $options['woo_categories'] = '';
            }

            $query_args = array (
                'posts_per_page' => $options['prods_per_page'],
                'tax_query'      => array (
                    array (
                        'taxonomy' => 'product_cat',
                        'field'    => 'id',
                        'terms'    => $options['woo_categories']
                    )
                ),
                'no_found_rows'  => 1,
                'post_status'    => 'publish',
                'post_type'      => 'product',
                'orderby'        => 'date',
                'order'          => 'ASC',
                'meta_query'     => $meta_query,
                'post__in'       => $product_ids_on_sale
            );

            $r = new WP_Query( $query_args );

            ?>
            <div class="limited-offers-carousel <?php echo $r->post_count == 1 ? 'lofc--single':''; ?> fixclear <?php echo $this->data['uid']; ?>">
                <ul class="zn_limited_offers" data-autoplay="<?php echo $this->opt('sl_autoplay',1); ?>" data-timeout="<?php echo $this->opt('sl_timeout', 6000) ?>">
                    <?php


                    if ( $r->have_posts() ) {
                        while ( $r->have_posts() ) {
                            $r->the_post();
                            global $product;

                            // bail
                            if ( ! isset( $product ) || empty( $product ) || ! is_object( $product ) ) {
                                continue;
                            }

                            //echo $product->product_type;
                            if ( $product->product_type == 'variable' ) {

                                $old_price = $product->min_variation_regular_price;
                                $new_price = $product->min_variation_price;
                            }
                            else {

                                $old_price = $product->regular_price;
                                $new_price = $product->sale_price;
                            }

                            $reduced = 0;
                            if ( $old_price != 0 ) {
                                $reduced = round( 100 - ( $new_price * 100 ) / $old_price, 0 );
                            }

                            echo '<li class="product-list-item" data-discount="' . $reduced . '%">';
                                echo '<a href="'.get_permalink().'">';
                                    do_action( 'woocommerce_before_shop_loop_item_title' );
                                        echo '<h6 class="price">' . $product->get_price_html() . '</h6>';
                                    echo '</div>'; // This is necessary to close the div comming from before shop loop item title
                                echo '</a>';
                            echo '</li>';
                        }
                    }
                    wp_reset_query();
                    ?>

                </ul>

                <div class="th-controls controls">
                    <a href="#" class="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a href="#" class="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>

            </div>
            <!-- end limited offers carousel -->
        </div>
        <?php
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
                        "name"        => __( "Element Title", 'zn_framework' ),
                        "description" => __( "Enter a title for this element", 'zn_framework' ),
                        "id"          => "woo_lo_title",
                        "std"         => "",
                        "type"        => "text",
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

                    array (
                        "name"        => __( "Autoplay carousel?", 'zn_framework' ),
                        "description" => __( "Does the carousel autoplay itself?", 'zn_framework' ),
                        "id"          => "sl_autoplay",
                        "std"         => "1",
                        "value"         => "1",
                        "type"        => "toggle2"
                    ),
                    array (
                        "name"        => __( "Timeout duration", 'zn_framework' ),
                        "description" => __( "The amount of milliseconds the carousel will pause", 'zn_framework' ),
                        "id"          => "sl_timeout",
                        "std"         => "6000",
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#H06NN5lC_Ic" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/shop-limited-offers/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
