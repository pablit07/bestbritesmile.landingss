<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Steps Box 2
 Description: Create and display a Steps Box 2 element
 Class: TH_StepsBox2
 Category: content
 Level: 3
*/
/**
 * Class TH_StepsBox2
 *
 * Create and display a Steps Box 2 element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StepsBox2 extends ZnElements
{
    public static function getName(){
        return __( "Steps Box 2", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        echo '<div class="elm-stepsbox2 row '.$this->data['uid'].' '.$this->opt('css_class','').'">';

        if ( ! empty ( $options['stp_title'] ) ) {
            echo '<div class="col-sm-12">';
            echo '<h3 class="m_title">' . $options['stp_title'] . '</h3>';
            echo '</div>';
        }

        if ( ! empty ( $options['steps_single2'] ) && is_array( $options['steps_single2'] ) ) {
            $i     = 1;
            $count = count( $options['steps_single2'] );
            echo '<div class="col-sm-12">';
            foreach ( $options['steps_single2'] as $step )
            {
                if ( $i % 3 == 1 ) {
                    echo '<div class="row gutter-md">';
                }

                $ok    = '';
                $image = '';

                if ( $step['stp_single_ok'] == 'yes' ) {
                    $ok    = 'ok';
                    // $image = '<img src="' . THEME_BASE_URI . '/images/ok.png" alt="">';
                    $image = '<span class="glyphicon glyphicon-ok-circle"></span>';
                }

                $goboxfirst = '';
                if($i == 1) $goboxfirst = 'gobox-first';

                $goboxlast = '';
                if($i == $count) $goboxlast = 'gobox-last';

                echo '<div class="col-sm-4">';

                echo '<div class="gobox ' . $ok . ' '.$goboxfirst.' '.$goboxlast.'">';

                echo $image;

                echo '<div class="gobox-content">';

                if ( ! empty ( $step['stp_single_title'] ) ) {
                    echo '<h4>' . $step['stp_single_title'] . '</h4>';
                }

                if ( ! empty ( $step['stp_single_link']['url'] ) ) {
                    echo '<a class="zn_step_link" href="' . $step['stp_single_link']['url'] . '" target="' . $step['stp_single_link']['target'] . '"></a>';
                }

                if ( ! empty ( $step['stp_single_desc'] ) ) {
                    echo '<p>' . $step['stp_single_desc'] . '</p>';
                }

                echo '</div>';

                echo '</div>';

                echo '</div>';

                if ( $i % 3 == 0 || $i == $count ) {
                    echo '</div>';
                }
                $i ++;
            }
            echo '</div>';
        }

        echo '</div>';
    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $extra_options = array (
            "name"           => __( "Steps", 'zn_framework' ),
            "description"    => __( "Here you can create your desired steps.", 'zn_framework' ),
            "id"             => "steps_single2",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Step", 'zn_framework' ),
            "remove_text"    => __( "Step", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "stp_single_title",
            "subelements"    => array (
                array (
                    "name"        => __( "Step Title", 'zn_framework' ),
                    "description" => __( "Please enter a title for this step.", 'zn_framework' ),
                    "id"          => "stp_single_title",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Step content", 'zn_framework' ),
                    "description" => __( "Please enter a content for this step.", 'zn_framework' ),
                    "id"          => "stp_single_desc",
                    "std"         => "",
                    "type"        => "textarea"
                ),
                array (
                    "name"        => __( "Box Link", 'zn_framework' ),
                    "description" => __( "Please choose the link you want to use for this box.", 'zn_framework' ),
                    "id"          => "stp_single_link",
                    "std"         => "",
                    "type"        => "link",
                    "options"     => array (
                        '_blank' => __( "New window", 'zn_framework' ),
                        '_self'  => __( "Same window", 'zn_framework' )
                    )
                ),
                array (
                    "name"        => __( "Use alternative style?", 'zn_framework' ),
                    "description" => __( "Select yes if you want your box to use a different background color and display an OK
                                icon on the left", 'zn_framework' ),
                    "id"          => "stp_single_ok",
                    "type"        => "select",
                    "std"         => "no",
                    "options"     => array (
                        'yes' => __( 'Yes', 'zn_framework' ),
                        'no'  => __( 'No', 'zn_framework' )
                    ),
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
                        "name"        => __( "Title", 'zn_framework' ),
                        "description" => __( "Please enter a title that will appear on over the boxes", 'zn_framework' ),
                        "id"          => "stp_title",
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#B0LG1fxTQv0" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/steps-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
