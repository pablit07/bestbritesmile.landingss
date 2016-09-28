<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Services Element
 Description: Create and display a Services Element element
 Class: TH_ServicesElement
 Category: content
 Level: 3
*/
/**
 * Class TH_ServicesElement
 *
 * Create and display a Services Element element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ServicesElement extends ZnElements
{
    public static function getName(){
        return __( "Services Element", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];
        echo '<div class="row services_box_element '.$this->opt('css_class','').'">';

        if ( !empty ( $options['single_service_elem'] ) && is_array ( $options['single_service_elem'] ) ) {
            foreach ( $options['single_service_elem'] as $sb ) {
                echo '<div class="col-sm-4">';
                echo '<div class="box fixclear">';

                // TITLE ICON
                if ( !empty ( $sb['sbe_image'] ) ) {
                    echo '<div class="icon"><img src="'.$sb['sbe_image'].'" alt=""></div>';
                }

                // TITLE
                if ( !empty ( $sb['sbe_title'] ) ) {
                    echo '<h4 class="title">'.$sb['sbe_title'].'</h4>';
                }

                // Services list
                if ( !empty ( $sb['sbe_services'] ) ) {
                    echo '<ul class="list">';

                    $textAr = explode("\n", $sb['sbe_services'] );
                    foreach ($textAr as $index=>$line) {
                        echo '<li>'.$line.'</li>';
                    }

                    echo '</ul>';
                }

                // Content
                if ( !empty ( $sb['sbe_content'] ) ) {
                    echo '<div class="text">'.$sb['sbe_content'].'</div>';
                }

                echo '</div><!-- end box -->';
                echo '</div>';
            }
        }
        echo '</div><!-- end row // services_box -->';

        ?>
        <script type="text/javascript">
            (function($){
                $(".services_box_element .box").hover(function() {
                    var _t = $(this),
                        lis = _t.find('li');
                    _t.find('.text').stop().hide();
                    lis.stop().css({ opacity: 0, marginTop:10});
                    _t.find('.list').stop().show();
                    lis.each(function(i) {
                        var duration = i * 50 + 250,
                            delay = i * 250;
                        $(this).delay(delay).stop().animate(
                            {
                                opacity: 1,
                                marginTop:0
                            },
                            {
                                queue: false,
                                duration:duration,
                                easing:"easeOutExpo"
                            }
                        );
                    });
                },function() {
                    $(this).find('.text').stop().show();
                    $(this).find('.list').stop().hide();
                });
            })(jQuery);
        </script>
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
                    array(
                        "name"        => __( '<strong style="font-size:120%">Warning!</strong>', 'zn_framework' ),
                        "description" => __( 'Since v4.x, <strong>this element is <em>deprecated</em> & <em>unsuported</em></strong>. It\'s not recommended to be used bucause at some point it\'ll be removed (now it\'s kept only for backwards compatibilty).<br> Instead, try to use the element <strong>ServiceBox</strong>.', 'zn_framework' ),
                        'type'  => 'zn_message',
                        'id'    => 'zn_error_notice',
                        'show_blank'  => 'true',
                        'supports'  => 'warning'
                    ),
                    array (
                        "name"           => __( "Services", 'zn_framework' ),
                        "description"    => __( "Here you can add your desired service boxes.", 'zn_framework' ),
                        "id"             => "single_service_elem",
                        "std"            => "",
                        "type"           => "group",
                        "add_text"       => __( "Box", 'zn_framework' ),
                        "remove_text"    => __( "Box", 'zn_framework' ),
                        "group_title"    => "",
                        "group_sortable" => true,
                        "element_title" => "sbe_title",
                        "subelements"    => array (
                            array (
                                "name"        => __( "Service title", 'zn_framework' ),
                                "description" => __( "Please enter a title for this service box.", 'zn_framework' ),
                                "id"          => "sbe_title",
                                "std"         => "",
                                "type"        => "text"
                            ),
                            array (
                                "name"        => __( "Service Content", 'zn_framework' ),
                                "description" => __( "Please enter a content for this service box.", 'zn_framework' ),
                                "id"          => "sbe_content",
                                "std"         => "",
                                "type"        => "textarea"
                            ),
                            array (
                                "name"        => __( "Sub Services", 'zn_framework' ),
                                "description" => __( "Please enter your secondary services one on a
                                                        line. These will appear when someone hovers over the service box
                                                        .", 'zn_framework' ),
                                "id"          => "sbe_services",
                                "std"         => "",
                                "type"        => "textarea"
                            ),
                            array (
                                "name"        => __( "Title Icon", 'zn_framework' ),
                                "description" => __( "Please select an icon that will appear on the
                                                        left of the title.", 'zn_framework' ),
                                "id"          => "sbe_image",
                                "std"         => "",
                                "type"        => "media"
                            )
                        )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#aO1F-r8RIUU" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/services-element/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
