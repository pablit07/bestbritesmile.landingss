<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Skills
 Description: Create and display a Skills element
 Class: TH_Skills
 Category: content
 Level: 3
*/
/**
 * @since    4.0.0
 */
class TH_Skills extends ZnElements
{
    public static function getName(){
        return __( "Skills", 'zn_framework' );
    }

   /**
     * Load dependant resources
     */
    function scripts(){
        wp_enqueue_script( 'raphael', '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js', array ( 'jquery' ), ZN_FW_VERSION, true );
        wp_enqueue_script( 'raphael_diagram', THEME_BASE_URI . '/addons/raphael_diagram/diagram_el.js', array ( 'jquery' ), ZN_FW_VERSION, true );
    }

    function css(){
        $css = '';
        $uid = $this->data['uid'];

        $width = (int)$this->opt('sk_width',600);

        if($width != '600'){
            $scale = $width * 0.07;
            $css .= '.'.$uid.' {width:'.($width + $scale).'px;}';
        }

        return $css;
    }



    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        ?>

        <div id="skills_diagram_el" class="kl-skills-diagram <?php echo $this->data['uid'] ?> <?php echo $this->opt('css_class',''); ?>">

            <div class="kl-skills-legend <?php echo $this->opt('sk_enablelegend',1) != 1 ? 'hidden':'' ?> legend-<?php echo $this->opt('sk_legend_align', 'topright') ?>">

                <?php if($legend_text = $this->opt('sk_legend_text')): ?>
                    <h4><?php echo $legend_text; ?></h4>
                <?php endif; ?>

                <?php
                    $skills = $this->opt('skills_single');
                    if( is_array($skills) && !empty($skills) ){

                    echo '<ul class="kl-skills-list">';

                        foreach ($skills as $skill) {
                            $percentage = !empty( $skill['skill_level'] ) ? $skill['skill_level'] : 95;
                            $main_color = !empty( $skill['skill_color'] ) ? $skill['skill_color'] : '#97BE0D';
                            echo '<li data-percent="' . $percentage . '" style="background-color:' . $main_color . ';">'.$skill['skill_text'].'</li>';
                        }

                    echo '</ul>';
                    }
                ?>

            </div>

            <div class="skills-responsive-diagram">
                <div id="thediagram_el" class="kl-diagram" data-width="<?php echo (int)$this->opt('sk_width',600) ?>" data-maincolor="<?php echo $this->opt('sk_maincolor','#193340') ?>" data-maintext="<?php echo $this->opt('sk_main_text','skills') ?>" data-fontsize="<?php echo (int)$this->opt('sk_fontsize','20') ?>px Open Sans" data-textcolor="<?php echo $this->opt('sk_maintextcolor','#ffffff') ?>"></div>
            </div>
        </div><!-- end skills diagram -->


        <?php

    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $extra_options = array (
            "name"           => __( "Skill", 'zn_framework' ),
            "description"    => __( "Here you can add skills.", 'zn_framework' ),
            "id"             => "skills_single",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Skill", 'zn_framework' ),
            "remove_text"    => __( "Skill", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "skill_text",
            "subelements"    => array (
                array (
                    "name"        => __( "Skill Text", 'zn_framework' ),
                    "description" => __( "Please enter the skill text.", 'zn_framework' ),
                    "id"          => "skill_text",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Skill Color", 'zn_framework' ),
                    "description" => __( "Please enter the skill color.", 'zn_framework' ),
                    "id"          => "skill_color",
                    "std"         => "#97BE0D",
                    "type"        => "colorpicker"
                ),
                array (
                    "name"        => __( "Skill Level", 'zn_framework' ),
                    "description" => __( "Please select the skill level.", 'zn_framework' ),
                    "id"          => "skill_level",
                    "std"         => "95",
                    "type"        => "slider",
                    'class'       => 'zn_full',
                    'helpers'     => array(
                        'min' => '0',
                        'max' => '100',
                        'step' => '1'
                    ),
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
                        "name"        => __( "Main center text", 'zn_framework' ),
                        "description" => __( "Add a text that's going to be placed inside the center", 'zn_framework' ),
                        "id"          => "sk_main_text",
                        "std"         => "skills",
                        "type"        => "text",
                    ),

                    array (
                        "name"        => __( "Diagram Width & Height", 'zn_framework' ),
                        "description" => __( "Select the diagram width and height", 'zn_framework' ),
                        "id"          => "sk_width",
                        "std"         => "600",
                        "type"        => "text",
                    ),

                    array (
                        "name"        => __( "Diagram font-size", 'zn_framework' ),
                        "description" => __( "Select the diagram text font-size", 'zn_framework' ),
                        "id"          => "sk_fontsize",
                        "std"         => "20",
                        "type"        => "text",
                    ),

                    array (
                        "name"        => __( "Center main color", 'zn_framework' ),
                        "description" => __( "Select the center color of the diagram", 'zn_framework' ),
                        "id"          => "sk_maincolor",
                        "std"         => "#193340",
                        "type"        => "colorpicker",
                    ),

                    array (
                        "name"        => __( "Center text color", 'zn_framework' ),
                        "description" => __( "Select the center text color of the diagram.", 'zn_framework' ),
                        "id"          => "sk_maintextcolor",
                        "std"         => "#ffffff",
                        "type"        => "colorpicker",
                    ),

                    array (
                        "name"        => __( "Enable Legend", 'zn_framework' ),
                        "description" => __( "Enable legend?", 'zn_framework' ),
                        "id"          => "sk_enablelegend",
                        "std"         => "1",
                        "value"       => "1",
                        "type"        => "toggle2",
                    ),

                    array (
                        "name"        => __( "Legend title", 'zn_framework' ),
                        "description" => __( "Add a text that's going to be placed into the legend box", 'zn_framework' ),
                        "id"          => "sk_legend_text",
                        "std"         => "LEGEND",
                        "type"        => "text",
                        "dependency"  => array( 'element' => 'sk_enablelegend' , 'value'=> array('1') )
                    ),

                    array (
                        "name"        => __( "Legend Alignment", 'zn_framework' ),
                        "description" => __( "Select the alignment of the legend", 'zn_framework' ),
                        "id"          => "sk_legend_align",
                        "std"         => "topright",
                        "type"        => "select",
                        "options"     => array(
                            "topright" => "Top-Right",
                            "topleft" => "Top-Left",
                            "bottomright" => "Bottom-Right",
                            "bottomleft" => "Bottom-Left"
                        ),
                        "dependency"  => array( 'element' => 'sk_enablelegend' , 'value'=> array('1') )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#Nxh__JmEPX8" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/skills/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
