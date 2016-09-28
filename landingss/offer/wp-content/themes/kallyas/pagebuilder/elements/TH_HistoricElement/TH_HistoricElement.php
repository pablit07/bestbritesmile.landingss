<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Historic Element
 Description: Create and display a Historic element
 Class: TH_HistoricElement
 Category: content
 Level: 3
*/
/**
 * Class TH_HistoricElement
 *
 * Create and display a Historic element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_HistoricElement extends ZnElements
{
    public static function getName(){
        return __( "Historic Element", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        if( empty( $options['historic_single'] ) ){
            return;
        }

        $start_text = $this->opt( 'he_start', '' );


        echo '<div class="timeline_bar '.$this->data['uid'].' '.$this->opt('css_class','').'">';
        echo '<div class="row">';
        echo '<div class="col-sm-12 end_timeline"><span>' . $start_text . '</span></div>';

        if ( ! empty ( $options['historic_single'] ) && is_array( $options['historic_single'] ) ) {
            $i = 1;
            foreach ( $options['historic_single'] as $event ) {
                $pos = '<div class="col-sm-6">';
                if ( $i % 2 != 0 ) {
                    $pos = '<div class="col-sm-6 col-sm-offset-6" data-align="right">';
                }
                echo $pos;
                echo '<div class="timeline_box">';

                echo '<div class="date">' . $event['she_event_date'] . '</div>';
                echo '<h4 class="htitle">' . $event['she_event_name'] . '</h4>';


                echo wpautop(do_shortcode( $event['she_event_desc'] ));


                echo '</div><!-- end timeline box -->';
                echo '</div>';

                $i ++;
            }
        }
        echo '<div class="col-sm-12 end_timeline">';
        echo '<span>' . __( "PRESENT", 'zn_framework' ) . '</span>';
        echo '</div>';
        echo '</div>';
        echo '</div><!-- end timeline bar -->';

    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $extra_options = array (
            "name"           => __( "Events", 'zn_framework' ),
            "description"    => __( "Here you can add your desired events.", 'zn_framework' ),
            "id"             => "historic_single",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Event", 'zn_framework' ),
            "remove_text"    => __( "Event", 'zn_framework' ),
            "group_title"    => "",
            "group_sortable" => true,
            "element_title" => "she_event_name",
            "subelements"    => array (
                array (
                    "name"        => __( "Event title", 'zn_framework' ),
                    "description" => __( "Please enter a title for this event", 'zn_framework' ),
                    "id"          => "she_event_name",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Event date", 'zn_framework' ),
                    "description" => __( "Please enter the date for this event", 'zn_framework' ),
                    "id"          => "she_event_date",
                    "std"         => "",
                    "type"        => "text",
                ),
                array (
                    "name"        => __( "Event description", 'zn_framework' ),
                    "description" => __( "Please enter a description for this event", 'zn_framework' ),
                    "id"          => "she_event_desc",
                    "std"         => "",
                    "type"        => "visual_editor",
                    'class'       => 'zn_full'
                ),
            )
        );

        $uid = $this->data['uid'];

        $options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(
                    array (
                        "name"        => __( "Start text", 'zn_framework' ),
                        "description" => __( "Please enter a text that will appear as a start", 'zn_framework' ),
                        "id"          => "he_start",
                        "std"         => "",
                        "type"        => "text",
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#pp9gH2C90CQ" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/historic-element/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
