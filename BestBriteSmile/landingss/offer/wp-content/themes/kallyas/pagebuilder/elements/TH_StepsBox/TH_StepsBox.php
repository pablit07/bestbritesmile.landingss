<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Steps Box
 Description: Create and display a Steps Box element
 Class: TH_StepsBox
 Category: content
 Level: 3
*/
/**
 * Class TH_StepsBox
 *
 * Create and display a Steps Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StepsBox extends ZnElements
{
    public static function getName(){
        return __( "Steps Box", 'zn_framework' );
    }

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){
        $css = '';
        $uid = $this->data['uid'];
        $boxes = $this->opt( 'steps_single', array() );

        // Box background
        foreach ($boxes as $key => $box) {
            if( ! empty( $box['stp_box_color'] ) ){
                // proper index, start from 1
                $index = $key + 1;
                // fix for intro process box
                $index = $index + 1;
                $bg_color = $box['stp_box_color'];
                $css .= ".process_steps--style1 .process_steps__step:nth-child({$index}) { background-color: {$bg_color}; }";
                $css .= ".process_steps--style1 .process_steps__step:nth-child({$index}):after { border-left-color: {$bg_color}; }";
            }
        }


        // Icon sizes
        $icon_size = $this->opt('stp_size','56');
        if( $icon_size != '56' ){
            $css .= ".{$uid} .process_steps__step-icon {font-size: {$icon_size}px }";
        }

        // Icon sizes
        $height = $this->opt('stp_height','235');
        if( $height != '235' && $this->opt('stepsbox_style','style1') == 'style2' ){
            $css .= ".{$uid} .process_steps__intro, .{$uid} .process_steps__inner { min-height: {$height}px }";
        }


        return $css;
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

//        var_dump($options);

        $stepbox_style = isset($options['stepsbox_style']) && !empty($options['stepsbox_style']) ?
            $options['stepsbox_style'] : 'style1';
        $stp_bgcolor = isset($options['stp_bgcolor']) && !empty($options['stp_bgcolor']) ?
            $options['stp_bgcolor'] : 'light';
        ?>
        <div class="process_steps process_steps--<?php echo $stepbox_style; ?> kl-bgc-<?php echo $stp_bgcolor; ?> <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">
            <div class="process_steps__step process_steps__intro process_steps__height">
                <div class="process_steps__intro-wrp">
                <?php
                if ( ! empty ( $options['stp_title'] ) || ! empty ( $options['stp_subtitle'] ) ) {

                    echo '<h3 class="process_steps__intro-title">';
                    // TITLE
                    if ( ! empty ( $options['stp_title'] ) ) {
                        echo $options['stp_title'];
                    }
                    // TITLE
                    if ( ! empty ( $options['stp_subtitle'] ) ) {
                        echo '<strong>' . $options['stp_subtitle'] . '</strong>';
                    }
                    echo '</h3>';
                }

                // CONTENT
                if ( ! empty ( $options['stp_desc'] ) ) {
                    if ( preg_match( '%(<p[^>]*>.*?</p>)%i', $options['stp_desc'], $regs ) ) {
                        echo $options['stp_desc'];
                    }
                    else {
                        echo '<p class="process_steps__intro-desc">' . $options['stp_desc'] . '</p>';
                    }
                }

                if ( ! empty ( $options['stp_text_link'] ) && ! empty ( $options['stp_link']['url'] ) ) {
                    echo '<a href="' . $options['stp_link']['url'] . '" target="' . $options['stp_link']['target'] . '" class="process_steps__intro-link">' . $options['stp_text_link'] . ' +</a>';
                }
                ?>
                </div>
            </div>
            <!-- end step -->

            <?php if($stepbox_style == 'style2'){ ?>
            <div class="process_steps__container">
                <div class="process_steps__inner process_steps__height">
            <?php } ?>

            <?php
            if ( ! empty ( $options['steps_single'] ) && is_array( $options['steps_single'] ) ) {
                foreach ( $options['steps_single'] as $step ) {
                    echo '<div class="process_steps__step">';

                    $animation = '';
                    if($stepbox_style != 'style2' && $step['stp_single_anim'] != ''){
                        $animation = 'data-animation="'.$step['stp_single_anim'].'"';
                    }
                    $iconColor = (isset($step['stp_icon_color']) && !empty($step['stp_icon_color']) ? 'color: '.$step['stp_icon_color'].';' : '');
                        // ICON AND ANIMATION
                    $stp_icontype = ( isset($step['stp_icontype']) && !empty($step['stp_icontype']) ) ? $step['stp_icontype'] : 'img' ;

                    if ( $stp_icontype == 'img' && ! empty ( $step['stp_single_icon'] ) ) {
                        echo '<div class="process_steps__step-icon process_steps__step-typeimg">';
                        echo '<img ' . $animation . ' src="' . $step['stp_single_icon'] . '" alt="" class="process_steps__step-icon-src">';
                        echo '</div>';
                    }
                    elseif ( $stp_icontype == 'fonticon' && is_array ( $step['stp_single_iconfont'] ) ){
                        echo '<div class="process_steps__step-icon">';
                        echo '<span ' . $animation . ' class="process_steps__step-icon-src " ' .
                             zn_generate_icon( $step['stp_single_iconfont'] ) . ' style="'.$iconColor.'"></span>';
                        echo '</div>';
                    }


                    // STEP TITLE
                    if ( ! empty ( $step['stp_single_title'] ) ) {
                        echo '<h3 class="process_steps__step-title">' . $step['stp_single_title'] . '</h3>';
                    }

                    // STEP CONTENT
                    if ( ! empty ( $step['stp_single_desc'] ) ) {
                        if ( preg_match( '%(<p[^>]*>.*?</p>)%i', $step['stp_single_desc'], $regs ) ) {
                            echo $step['stp_single_desc'];
                        }
                        else {
                            echo '<p class="process_steps__step-desc">' . $step['stp_single_desc'] . '</p>';
                        }
                    }
                    echo '</div>';

                }
            }
            ?>
            <?php if($stepbox_style == 'style2'){ ?>
                </div>
            </div><!-- /.steps-container -->
            <div class="clearfix"></div>
            <?php } ?>

        </div>

    <?php
    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $extra_options = array (
            "name"           => __( "Steps", 'zn_framework' ),
            "description"    => __( "Here you can create your desired Steps.", 'zn_framework' ),
            "id"             => "steps_single",
            "std"            => "",
            "type"           => "group",
            // "max_items"     => 3,
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
                    "name"        => __( "Box color", 'zn_framework' ),
                    "description" => __( "Using this option you can define your own color for this step box. If left empty, the default colors will be used. Please note that this option only works in style 1.", 'zn_framework' ),
                    "id"          => "stp_box_color",
                    "std"         => "",
                    "type"        => "colorpicker",
                ),
                array (
                    "name"        => __( "Step content", 'zn_framework' ),
                    "description" => __( "Please enter a content for this step.", 'zn_framework' ),
                    "id"          => "stp_single_desc",
                    "std"         => "",
                    "type"        => "textarea"
                ),

                array (
                    "name"        => __( "Icon type", 'zn_framework' ),
                    "description" => __( "Select the icon type", 'zn_framework' ),
                    "id"          => "stp_icontype",
                    "type"        => "select",
                    "std"         => "img",
                    "options"     => array (
                        'fonticon'   => __( 'Font Icon', 'zn_framework' ),
                        'img'        => __( 'Image (Png, SVG etc.)', 'zn_framework' ),
                    ),
                ),

                array (
                    "name"        => __( "Icon color", 'zn_framework' ),
                    "description" => __( "Please select the color for this icon.", 'zn_framework' ),
                    "id"          => "stp_icon_color",
                    "std"         => "",
                    "type"        => "colorpicker",
                    "dependency"  => array( 'element' => 'stp_icontype' , 'value'=> array('fonticon') )
                ),

                array (
                    "name"        => __( "Step icon", 'zn_framework' ),
                    "description" => __( "Please enter an icon for this step.", 'zn_framework' ),
                    "id"          => "stp_single_icon",
                    "std"         => "",
                    "type"        => "media",
                    "dependency"  => array( 'element' => 'stp_icontype' , 'value'=> array('img') )
                ),

                array (
                    "name"        => __( "Social icon", 'zn_framework' ),
                    "description" => __( "Select your desired social icon.", 'zn_framework' ),
                    "id"          => "stp_single_iconfont",
                    "std"         => "",
                    "type"        => "icon_list",
                    'class'       => 'zn_full',
                    "dependency"  => array( 'element' => 'stp_icontype' , 'value'=> array('fonticon') )
                ),

                array (
                    "name"        => __( "Step Icon Animation", 'zn_framework' ),
                    "description" => __( "Select the desired animation for this step. Disabled in Style 2!!", 'zn_framework' ),
                    "id"          => "stp_single_anim",
                    "type"        => "select",
                    "std"         => "tada",
                    "options"     => array (
                        ''            => __( 'No animation', 'zn_framework' ),
                        'tada'            => __( 'Tada', 'zn_framework' ),
                        'pulse'           => __( 'Pulse', 'zn_framework' ),
                        'fadeOutRightBig' => __( 'Fade Out Right Big', 'zn_framework' )
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
                        "name"        => __( "Select style", 'zn_framework' ),
                        "description" => __( "Please choose a style you want to use.", 'zn_framework' ),
                        "id"          => "stepsbox_style",
                        "std"         => "style1",
                        "type"        => "select",
                        "options"     => array (
                            'style1' => __( "Style 1", 'zn_framework' ),
                            'style2'  => __( "Style 2 (since v4.0)", 'zn_framework' )
                        )
                    ),

                    array (
                        "name"        => __( "Element Height", 'zn_framework' ),
                        "description" => __( "Select the minimum height of the element.", 'zn_framework' ),
                        "id"          => "stp_height",
                        "std"         => "235",
                        'type'        => 'slider',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '50',
                            'max' => '800',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$this->data['uid'] .' .process_steps__height',
                            'css_rule'  => 'min-height',
                            'unit'      => 'px'
                        ),
                        "dependency"  => array( 'element' => 'stepsbox_style' , 'value'=> array('style2') )
                    ),

                    array (
                        "name"        => __( "Right side background color", 'zn_framework' ),
                        "description" => __( "Please select the right side background color.", 'zn_framework' ),
                        "id"          => "stp_bgcolor",
                        "std"         => "light",
                        "type"        => "select",
                        "options"     => array (
                            'light' => __( "Light", 'zn_framework' ),
                            'gray'  => __( "Gray", 'zn_framework' )
                        ),
                        "dependency"  => array( 'element' => 'stepsbox_style' , 'value'=> array('style2') )
                    ),

                    array (
                        "name"        => __( "Icons Size", 'zn_framework' ),
                        "description" => __( "Select the size of the icon.", 'zn_framework' ),
                        "id"          => "stp_size",
                        "std"         => "56",
                        'type'        => 'slider',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '10',
                            'max' => '200',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$this->data['uid'] .' .process_steps__step-icon',
                            'css_rule'  => 'font-size',
                            'unit'      => 'px'
                        ),
                    ),

                    array (
                        "name"        => __( "Title", 'zn_framework' ),
                        "description" => __( "Please enter a title that will appear on the first box", 'zn_framework' ),
                        "id"          => "stp_title",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Subtitle", 'zn_framework' ),
                        "description" => __( "Please enter a subtitle that will appear on the first box", 'zn_framework' ),
                        "id"          => "stp_subtitle",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Description", 'zn_framework' ),
                        "description" => __( "Please enter a description that will appear on the first box", 'zn_framework' ),
                        "id"          => "stp_desc",
                        "std"         => "",
                        "type"        => "textarea",
                    ),
                    array (
                        "name"        => __( "Link Text", 'zn_framework' ),
                        "description" => __( "Please enter a text that will appear as link in
                                            the first box under the description.", 'zn_framework' ),
                        "id"          => "stp_text_link",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Bottom Link", 'zn_framework' ),
                        "description" => __( "Please choose the link you want to use.", 'zn_framework' ),
                        "id"          => "stp_link",
                        "std"         => "",
                        "type"        => "link",
                        "options"     => array (
                            '_blank' => __( "New window", 'zn_framework' ),
                            '_self'  => __( "Same window", 'zn_framework' )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#f4nKO-461X0" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
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
