<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Steps Box 4
 Description: Create and display a Steps Box 4 element
 Class: TH_StepsBox4
 Category: content
 Level: 3
*/
/**
 * Class TH_StepsBox4
 *
 * Create and display a Steps Box 4 element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StepsBox4 extends ZnElements
{
    public static function getName(){
        return __( "Steps Box 4", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        if ( ! empty ( $options['stp_title'] ) ) {
            echo '<h3 class="m_title">' . $options['stp_title'] . '</h3>';
        }

        echo '<div class="step-boxes-4 '.$this->data['uid'].' '.$this->opt('css_class','').'">';
        if ( ! empty ( $options['steps_single4'] ) && is_array( $options['steps_single4'] ) ) {
            $i   = 1;
            $all = count( $options['steps_single4'] );
            $cls = '';
            foreach ( $options['steps_single4'] as $step )
            {
                if ( $i % 2 != 0 ) {
                    $align = 'left';
                }
                else {
                    $align = 'right';
                }

                if ( $i == $all ) {
                    $cls = 'last';
                }

                echo '<div class="process_box4 ' . $cls . '">';

                if ( ! empty ( $step['stp_single_title'] ) ) {
                    echo '<h4 class="stp_title">' . $step['stp_single_title'] . '</h4>';
                }
                echo '<div class="pb__line"><div class="number">';


                // $tabIcon = (isset($step['vts_tab_icon']) && !empty($step['vts_tab_icon']) ? $step['vts_tab_icon'] : '');

                $iconHolder = $step['vts_tab_icon'];
                $tabIcon = !empty( $iconHolder['family'] )  ? '<span '.zn_generate_icon( $step['vts_tab_icon'] ).'></span>' : '';

                if($options['stepsbox_style'] == 'style2' && !empty($tabIcon)){
                    echo $tabIcon;
                }
                else {
                    echo '<span>';
                    if ( $i < 10 ) {
                        echo '0' . $i;
                    }
                    else {
                        echo $i;
                    }
                    echo '</span>';
                }

                echo '</div></div>';

                echo '<div class="content">';

                // STEP CONTENT
                if ( ! empty ( $step['stp_single_desc'] ) ) {
                    if ( preg_match( '%(<p[^>]*>.*?</p>)%i', $step['stp_single_desc'], $regs ) ) {
                        echo $step['stp_single_desc'];
                    }
                    else {
                        echo '<p>' . $step['stp_single_desc'] . '</p>';
                    }
                }
                echo '</div>';
                echo '<div class="clear"></div>';
                echo '</div>';

                $i ++;
            }
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
            "id"             => "steps_single4",
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
                    "name"        => __( "Step icon", 'zn_framework' ),
                    "description" => __( "Select your desired icon that will appear on the step circle.", 'zn_framework' ),
                    "id"          => "vts_tab_icon",
                    "std"         => "",
                    "type"        => "icon_list",
                    'class'       => 'zn_full',
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
                        "name"        => __( "Steps Box 4 Style", 'zn_framework' ),
                        "description" => __( "Please select the style you want to use.", 'zn_framework' ),
                        "id"          => "stepsbox_style",
                        "std"         => "style1",
                        "options"     => array (
                            'style1'  => __( 'Number', 'zn_framework' ),
                            'style2'  => __( 'Icon', 'zn_framework' ),
                        ),
                        "type"        => "select",
                    ),
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#XT0Vyy3Q8-w" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
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
