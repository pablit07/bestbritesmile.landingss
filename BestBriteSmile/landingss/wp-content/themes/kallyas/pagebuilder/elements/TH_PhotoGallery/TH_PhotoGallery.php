<?php if (!defined('ABSPATH')) { return; }
/*
 Name: Photo Gallery
 Description: Create and display a Photo Gallery element
 Class: TH_PhotoGallery
 Category: content, media
 Level: 3
*/
/**
 * Class TH_PhotoGallery
 *
 * Create and display a Photo Gallery element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_PhotoGallery extends ZnElements
{
    public static function getName(){
        return __( "Photo Gallery", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];
        ?>
            <div class="photo-gallery zn_image_gallery row <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">
                <?php
                if (!empty($options['single_photo_gallery']) && is_array($options['single_photo_gallery'])) {
                    $id = uniqid('pp_');
                    $num_cols = 6;
                    if (!empty ($options['pg_num_cols'])) {
                        $num_cols = $options['pg_num_cols'];
                    }

                    $new_size = 12 / $num_cols;
                    $size = zn_get_size('span' . $new_size);

                    global $image_resized;

                    $height = $image_resized['height'];

                    if (isset($options['pg_img_height']) && !empty($options['pg_img_height'])) {
                        $height = $options['pg_img_height'];
                    }

                    foreach ($options['single_photo_gallery'] as $image) {
                        echo '<div class="col-xs-6 col-sm-4 col-lg-' . $new_size . '">';

                            echo '<div class="mfp-gallery mfp-gallery--misc">';
                            // If Video
                            // If Image
                            if(!empty($image['spg_image']) && !empty($image['spg_video'])){
                                $image_resized = vt_resize('', $image['spg_image'], $size['width'], $height, true);
                                echo '<a data-lightbox="mfp" data-mfp="iframe" href="' . $image['spg_video'] . '?width=100%&amp;height=100%" title="' . $image['spg_title'] . '" class="hoverBorder">';
                                echo '<img alt="" src="' . $image_resized['url'] . '" width="' . $image_resized['width'] .
                                     '" height="' . $image_resized['height'] . '">';
                                echo '</a>';
                            }
                            elseif( !empty($image['spg_image'])){
                                $image_resized = vt_resize('', $image['spg_image'], $size['width'], $height, true);
                                echo '<a data-lightbox="mfp" data-mfp="image" href="' . $image['spg_image'] . '" title="' . $image['spg_title'] . '" class="hoverBorder">';
                                echo '<img alt="" src="' . $image_resized['url'] . '" width="' . $image_resized['width'] .
                                     '" height="' . $image_resized['height'] . '">';
                                echo '</a>';
                            }
                            elseif( !empty($image['spg_video'] ) ){
                                echo '<a class="playVideo" data-lightbox="mfp" data-mfp="iframe" href="' . $image['spg_video'] . '?width=100%&amp;height=100%"></a>';
                            }

                            echo '</div>';

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
                    "description" => __("Please select an image.", 'zn_framework'),
                    "id" => "spg_image",
                    "std" => "",
                    "type" => "media"
                ),
                array(
                    "name" => __("Video URL", 'zn_framework'),
                    "description" => __("Please enter the URL for your video.", 'zn_framework'),
                    "id" => "spg_video",
                    "std" => "",
                    "type" => "text"
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
                        "description" => __("Select the desired number of columns for the
                                            images.", 'zn_framework'),
                        "id" => "pg_num_cols",
                        "std" => "6",
                        "type" => "select",
                        "options" => array(
                            '1' => __('1', 'zn_framework'),
                            '2' => __('2', 'zn_framework'),
                            '3' => __('3', 'zn_framework'),
                            '4' => __('4', 'zn_framework'),
                            '6' => __('6', 'zn_framework')
                        )
                    ),
                    array(
                        "name" => __("Images Height", 'zn_framework'),
                        "description" => __("Select the desired image height in pixels.", 'zn_framework'),
                        "id" => "pg_img_height",
                        "std" => "",
                        "type" => "text",
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#o4Ei4xDN71E" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/photo-gallery/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
