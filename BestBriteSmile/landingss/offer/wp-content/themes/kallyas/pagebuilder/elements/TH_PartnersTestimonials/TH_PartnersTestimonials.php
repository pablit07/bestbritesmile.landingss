<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Partners & Testimonials
 Description: Display a block with partners logos and testimonials
 Class: TH_PartnersTestimonials
 Category: content
 Level: 3
*/
/**
 * Class TH_PartnersTestimonials
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_PartnersTestimonials extends ZnElements
{
    public static function getName(){
        return __( "Partners Testimonials", 'zn_framework' );
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
        $testimonials = $this->opt('tst_single');
        $partners = $this->opt('prt_single');


    ?>

<div class="testimonials-partners testimonials-partners--<?php echo $this->opt('pts_color_theme', 'light'); ?> <?php echo $this->data['uid'] ?> <?php echo $this->opt('css_class',''); ?>">

    <?php if( ! empty( $testimonials ) ): ?>

    <div class="ts-pt-testimonials clearfix">

        <?php foreach($testimonials as $tst):

            $tst_name = '';
            if(!empty( $tst['tst_name'] ))
                $tst_name = $tst['tst_name'];

            $tst_text = '';
            if( !empty( $tst['tst_testimonial'] ) )
                $tst_text = '<div class="ts-pt-testimonials__text">'.$tst['tst_testimonial'].'</div>';

            $tst_layout = $tst['tst_layout'];

            $margin_top = isset($tst['top_margin']) && !empty($tst['top_margin']) ? 'margin-top:'.$tst['top_margin'].'px;' : '';
            $margin_bottom = isset($tst['bottom_margin']) && !empty($tst['bottom_margin']) ? 'margin-bottom:'.$tst['bottom_margin'].'px;' : '';
        ?>
        <div class="ts-pt-testimonials__item ts-pt-testimonials__item--size-<?php echo $tst['tst_size']; ?> ts-pt-testimonials__item--<?php echo $tst_layout; ?>" style="<?php echo $margin_top; ?> <?php echo $margin_bottom; ?>">

            <?php if($tst_layout == 'normal') echo $tst_text; ?>

            <div class="ts-pt-testimonials__infos ts-pt-testimonials__infos--<?php echo empty( $tst['tst_img'] ) ? 'noimg':''; ?>">

                <?php if( !empty( $tst['tst_img'] ) ): ?>
                    <div class="ts-pt-testimonials__img" style="background-image:url('<?php echo $tst['tst_img'] ?>');" title="<?php echo $tst_name; ?>"></div>
                 <?php endif; ?>

                <?php if( $tst_name ): ?>
                    <h4 class="ts-pt-testimonials__name"><?php echo $tst_name ?></h4>
                <?php endif; ?>

                <?php if( !empty( $tst['tst_position'] ) ): ?>
                    <div class="ts-pt-testimonials__position"><?php echo $tst['tst_position'] ?></div>
                <?php endif; ?>

                <?php if( ($tst_stars = $tst['tst_stars']) != 0 ): ?>
                <div class="ts-pt-testimonials__stars ts-pt-testimonials__stars--<?php echo $tst_stars ?>">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                </div>
                <?php endif; ?>

            </div><!-- /.ts-pt-testimonials__infos -->

            <?php if($tst_layout == 'reversed') echo $tst_text; ?>

        </div><!-- /.ts-pt-testimonials__item -->
        <?php endforeach; ?>

    </div><!-- /.ts-pt-testimonials -->

    <?php endif; ?>

    <?php if( ! empty( $partners ) && ! empty( $testimonials ) ): ?>
    <div class="testimonials-partners__separator clearfix"></div>
    <?php endif; ?>

    <?php if( ! empty( $partners ) ):

        $pts_ptitle = $this->opt('pts_ptitle');
    ?>

    <div class="ts-pt-partners ts-pt-partners--<?php echo !empty( $pts_ptitle ) ? 'y':'n'; ?>-title clearfix">

        <?php if( !empty($pts_ptitle) ): ?>
            <div class="ts-pt-partners__title"><?php echo $pts_ptitle; ?></div>
        <?php endif; ?>

        <div class="ts-pt-partners__carousel-wrapper">
            <div class="ts-pt-partners__carousel">

                <?php foreach($partners as $prt):

                    $link_start = '';
                    $link_end = '';
                    $link_title = '';
                    if( !empty( $prt['prt_link']['url'] ) ){
                        $link_start = '<a class="ts-pt-partners__link" href="'.$prt['prt_link']['url'].'" target="'.$prt['prt_link']['target'].'" title="'.$prt['prt_link']['title'].'">';
                        $link_end = '</a>';
                    }
                    if( !empty( $prt['prt_link']['title'] ) ){
                        $link_title = $prt['prt_link']['title'];
                    }

                ?>
                <div class="ts-pt-partners__carousel-item">

                    <?php echo $link_start; ?>

                        <?php if( !empty( $prt['prt_img'] ) ): ?>
                            <img class="ts-pt-partners__img img-responsive" src="<?php echo $prt['prt_img']; ?>" alt="<?php echo $link_title; ?>">
                        <?php endif; ?>

                    <?php echo $link_end; ?>

                </div>
                <?php endforeach; ?>

            </div><!-- /.ts-pt-partners__carousel -->
        </div>

    </div><!-- /.ts-pt-partners -->

    <?php endif; ?>

</div><!-- /.testimonials-partners -->


<?php

    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {

        $testimonials = array (
            "name"           => __( "Testimonials", 'zn_framework' ),
            "description"    => __( "Add testimonials.", 'zn_framework' ),
            "id"             => "tst_single",
            "std"            => "",
            "type"           => "group",
            "max_items"      => "4",
            "add_text"       => __( "Testimonial", 'zn_framework' ),
            "remove_text"    => __( "Testimonial", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "tst_name",
            "subelements"    => array (
                array (
                    "name"        => __( "Name", 'zn_framework' ),
                    "description" => __( "Add the person's name.", 'zn_framework' ),
                    "id"          => "tst_name",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Position", 'zn_framework' ),
                    "description" => __( "Add the person's position.", 'zn_framework' ),
                    "id"          => "tst_position",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Testimonial Text", 'zn_framework' ),
                    "description" => __( "Add the testimonial text.", 'zn_framework' ),
                    "id"          => "tst_testimonial",
                    "std"         => "",
                    "type"        => "textarea"
                ),
                array (
                    "name"        => __( "Stars", 'zn_framework' ),
                    "description" => __( "Add the person's name.", 'zn_framework' ),
                    "id"          => "tst_stars",
                    "std"         => "0",
                    "type"        => "select",
                    "options"     => array (
                        '0' => __( 'No stars', 'zn_framework' ),
                        '1'  => __( '1 Star', 'zn_framework' ),
                        '2'  => __( '2 Stars', 'zn_framework' ),
                        '3'  => __( '3 Stars', 'zn_framework' ),
                        '4'  => __( '4 Stars', 'zn_framework' ),
                        '5'  => __( '5 Stars', 'zn_framework' )
                    ),
                ),
                array (
                    "name"        => __( "Image", 'zn_framework' ),
                    "description" => __( "Add the person's image.", 'zn_framework' ),
                    "id"          => "tst_img",
                    "std"         => "",
                    "type"        => "media"
                ),
                array (
                    "name"        => __( "Testimonial layout", 'zn_framework' ),
                    "description" => __( "Select a layout.", 'zn_framework' ),
                    "id"          => "tst_layout",
                    "std"         => "normal",
                    "type"        => "select",
                    "options"     => array (
                        'normal' => __( 'Normal (text top; name and img down)', 'zn_framework' ),
                        'reversed' => __( 'Reversed (text bottom; name and img top)', 'zn_framework' )
                    )
                ),
                array (
                    "name"        => __( "Testimonial Size", 'zn_framework' ),
                    "description" => __( "Select a size.", 'zn_framework' ),
                    "id"          => "tst_size",
                    "std"         => "1",
                    "type"        => "select",
                    "options"     => array (
                        '1' => __( '1x', 'zn_framework' ),
                        '2' => __( '2x', 'zn_framework' ),
                        '3' => __( '3x', 'zn_framework' ),
                        '4' => __( '4x', 'zn_framework' )
                    )
                ),

                array(
                    'id'          => 'top_margin',
                    'name'        => 'Top margin',
                    'description' => 'Select the top margin ( in pixels ) for this section.',
                    'type'        => 'slider',
                    'std'         => '0',
                    'class'       => 'zn_full',
                    'helpers'     => array(
                        'min' => '0',
                        'max' => '100',
                        'step' => '1'
                    )
                ),
                array(
                    'id'          => 'bottom_margin',
                    'name'        => 'Bottom margin',
                    'description' => 'Select the bottom margin ( in pixels ) for this section.',
                    'type'        => 'slider',
                    'std'         => '0',
                    'class'       => 'zn_full',
                    'helpers'     => array(
                        'min' => '0',
                        'max' => '100',
                        'step' => '1'
                    )
                ),
            )
        );

        $partners = array (
            "name"           => __( "Partners", 'zn_framework' ),
            "description"    => __( "Add partners/logos.", 'zn_framework' ),
            "id"             => "prt_single",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Logo", 'zn_framework' ),
            "remove_text"    => __( "Logo", 'zn_framework' ),
            "group_sortable" => true,
            // "element_title" => "prt_img",
            "subelements"    => array (
                array (
                    "name"        => __( "Upload logo/image", 'zn_framework' ),
                    "description" => __( "Add the partners/client/logo image.", 'zn_framework' ),
                    "id"          => "prt_img",
                    "std"         => "",
                    "type"        => "media"
                ),
                array (
                    "name"        => __( "Link", 'zn_framework' ),
                    "description" => __( "Link the partner?.", 'zn_framework' ),
                    "id"          => "prt_link",
                    "std"         => "",
                    "type"        => "link",
                    "options"     => array (
                        '_self'  => __( "Same window", 'zn_framework' ),
                        '_blank' => __( "New window", 'zn_framework' )
                    )
                )
            )
        );

        $uid = $this->data['uid'];

        $options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(

                    array (
                        "name"        => sprintf(__( "ID: %s", 'zn_framework' ), $uid),
                        "description" => __( "In case you need some custom styling use as a css selector <strong><em>.".$uid."</em></strong> .", 'zn_framework' ),
                        "id"          => "klt_uid",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full"
                    ),

                    array (
                        "name"        => __( "General text color theme", 'zn_framework' ),
                        "description" => __( "Select the color theme for the texts", 'zn_framework' ),
                        "id"          => "pts_color_theme",
                        "std"         => "light",
                        "type"        => "select",
                        "options"     => array (
                            'light' => __( 'Light text and elements (default)', 'zn_framework' ),
                            'dark' => __( 'Dark text and elements', 'zn_framework' )
                        ),
                    ),

                    $testimonials,

                    array (
                        "name"        => __( "Partners/Clients side title", 'zn_framework' ),
                        "description" => __( "Add a title (or not)", 'zn_framework' ),
                        "id"          => "pts_ptitle",
                        "std"         => "",
                        "type"        => "text"
                    ),

                    $partners
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#f0pUeZBtHao" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/partners-and-testimonials/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
