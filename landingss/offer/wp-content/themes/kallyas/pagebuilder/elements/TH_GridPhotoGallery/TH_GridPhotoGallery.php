<?php if (!defined('ABSPATH')) { return; }
/*
 Name: Grid Photo Gallery
 Description: Create and display a Grid based Photo Gallery element
 Class: TH_GridPhotoGallery
 Category: content
 Level: 3
*/
/**
 * Class TH_GridPhotoGallery
 *
 * Create and display a Grid Photo Gallery element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_GridPhotoGallery extends ZnElements
{
    public static function getName(){
        return __( "Grid Photo Gallery", 'zn_framework' );
    }

    /**
     * Load dependant resources
     */
    function scripts(){
        wp_enqueue_script( 'isotope', THEME_BASE_URI . '/js/jquery.isotope.min.js', array ( 'jquery' ), ZN_FW_VERSION, true );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {

        $height_ratio = $this->opt('pg_img_height', 'square');
        $num_cols = $this->opt('pg_num_cols', 4);

        $gridGallery = $this->opt('single_photo_gallery');

        ?>
            <div class="gridPhotoGallery mfp-gallery mfp-gallery--misc gridPhotoGallery--ratio-<?php echo $height_ratio; ?> gridPhotoGallery--cols-<?php echo $num_cols; ?> <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>" data-cols="<?php echo $num_cols; ?>">

                <div class="gridPhotoGallery__item gridPhotoGallery__item--sizer"></div>
                <?php
                if ( $gridGallery && is_array($gridGallery) ) {

                    foreach ($gridGallery as $image) {

                        $itemWidth = $image['spg_width'] ? $image['spg_width'] : 1;
                        $itemHeight = $image['spg_height'] ? $image['spg_height'] : 1;
                        $link_start = '';
                        $img = $image['spg_image'];

                        echo '<div class="gridPhotoGallery__item gridPhotoGalleryItem--w'.$itemWidth.' ">';

                            // If Image
                            if( isset($img) && !empty($img) ){
                                $link_start = 'class="gridPhotoGalleryItem--h'.$itemHeight.' gridPhotoGallery__link hoverBorder" data-lightbox="mfp" data-mfp="image" href="' . $img . '"';
                                $icon = '<i class="kl-icon glyphicon glyphicon-search circled-icon ci-large"></i>';
                            }
                            // If Video
                            if(isset($image['spg_video']) && !empty($image['spg_video'])){
                                $link_start = 'class="gridPhotoGalleryItem--h'.$itemHeight.' gridPhotoGallery__link hoverBorder" data-lightbox="mfp" data-mfp="iframe" href="' . $image['spg_video'] . '"';
                                $icon = '<i class="kl-icon glyphicon glyphicon-play circled-icon ci-large"></i>';
                            }

                            echo '<a title="' . $image['spg_title'] . '" '.$link_start.' >';

                                if( isset($img) && !empty($img) ){
                                    echo '<div class="gridPhotoGallery__img" style="background-image:url('.$img.')"></div>';
                                    echo $icon;
                                }

                            echo '</a>';

                        echo '</div>';

                    }
                }
                ?>
            </div>
    <?php
    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $extra_options = array(
            "name" => __("Images", 'zn_framework'),
            "description" => __("Here you can add your desired images.", 'zn_framework'),
            "id" => "single_photo_gallery",
            "std" => "",
            "type" => "group",
            "add_text" => __("Image", 'zn_framework'),
            "remove_text" => __("Image", 'zn_framework'),
            "group_title" => "",
            "group_sortable" => true,
            "element_title" => "spg_title",
            "subelements" => array(
                array(
                    "name" => __("Title", 'zn_framework'),
                    "description" => __("Please enter a title for this image.", 'zn_framework'),
                    "id" => "spg_title",
                    "std" => "",
                    "type" => "text"
                ),
                array(
                    "name" => __("Image", 'zn_framework'),
                    "description" => __("Please select an image. This is mandatory", 'zn_framework'),
                    "id" => "spg_image",
                    "std" => "",
                    "type" => "media"
                ),
                array(
                    "name" => __("Video URL", 'zn_framework'),
                    "description" => __("Please enter the URL for your video. This video will appear when the user clicks on the image", 'zn_framework'),
                    "id" => "spg_video",
                    "std" => "",
                    "type" => "text"
                ),
                array(
                    "name" => __("Item Width", 'zn_framework'),
                    "description" => __("Select the width of the element.", 'zn_framework'),
                    "id" => "spg_width",
                    "std" => "1",
                    "type" => "select",
                    "options" => array(
                        '1' => __('1x', 'zn_framework'),
                        '2' => __('2x', 'zn_framework')
                    )
                ),
                array(
                    "name" => __("Item Height", 'zn_framework'),
                    "description" => __("Select the height of the element.", 'zn_framework'),
                    "id" => "spg_height",
                    "std" => "1",
                    "type" => "select",
                    "options" => array(
                        '1' => __('1x', 'zn_framework'),
                        '2' => __('2x', 'zn_framework')
                    )
                ),

            )
        );

        $uid = $this->data['uid'];

        $options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(
                    array(
                        "name" => __("Number of columns", 'zn_framework'),
                        "description" => __("Select the desired number of columns for the grid.", 'zn_framework'),
                        "id" => "pg_num_cols",
                        "std" => "4",
                        "type" => "select",
                        "options" => array(
                            '1' => __('1', 'zn_framework'),
                            '2' => __('2', 'zn_framework'),
                            '3' => __('3', 'zn_framework'),
                            '4' => __('4', 'zn_framework'),
                            '5' => __('5', 'zn_framework'),
                            '6' => __('6', 'zn_framework')
                        )
                    ),
                    array(
                        "name" => __("Images Height Ratio", 'zn_framework'),
                        "description" => __("Select the desired image height ratio.", 'zn_framework'),
                        "id" => "pg_img_height",
                        "std" => "square",
                        "type" => "select",
                        "options" => array(
                            'short' => __('Shorter Ratio', 'zn_framework'),
                            'square' => __('Square Ratio', 'zn_framework'),
                            'tall' => __('Taller Ratio', 'zn_framework')
                        )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#Kj7XG3Vm-HQ" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/grid-based-photo-gallery/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
