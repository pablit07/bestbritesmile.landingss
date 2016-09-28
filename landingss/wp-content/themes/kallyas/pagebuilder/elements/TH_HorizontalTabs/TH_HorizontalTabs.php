<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Horizontal Tabs
 Description: Create and display a Horizontal Tabs element
 Class: TH_HorizontalTabs
 Category: content
 Level: 3
 Multiple: true
*/
/**
 * Class TH_HorizontalTabs
 *
 * Create and display a Horizontal Tabs element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_HorizontalTabs extends ZnElements
{
    public static function getName(){
        return __( "Horizontal Tabs", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {

        $options = $this->data['options'];

        if( empty ( $options['single_horizontal_tab'] ) ){
            return;
        }

        $uid = $this->data['uid'];
        $single_tabs = $this->opt('single_horizontal_tab');
        $tabsListCount = count($single_tabs);
        $style = $this->opt('vts_tab_style','tabs_style1');

        $pb_tab = 0;

        echo '<div class="tabbable '.$style.' '.$this->data['uid'].' '.$this->opt('css_class','').'">';

        if ( ! empty ( $single_tabs ) && is_array( $single_tabs ) )
        {
            echo '<ul class="nav nav-alignment--'.($this->opt('tabs_alignment','left')).' clearfix" role="tablist">';

                // foreach ( $single_tabs as $tab )
                for ($i = 0; $i < $tabsListCount; $i++ )
                {
                    $cls = '';
                    if ( $i === 0 ) {
                        $cls = 'active in';
                    }

                    $uniq_name = $uid.'_'.$i;
                    // Tab Handle
                    echo '<li class="' . $cls . '">';
                        echo '<a href="#' . $uniq_name . '" role="tab" data-toggle="tab">';
                            echo $single_tabs[$i]['vts_tab_title'];
                        echo '</a>';
                    echo '</li>';
                    // $i++;
                }

            echo '</ul>';

            echo '<div class="tab-content">';

                // foreach ( $single_tabs as $tab )
                for ($i = 0; $i < $tabsListCount; $i++ )
                {
                    $cls = $content = '';
                    if ( $i === 0 ) {
                        $cls = 'active in';
                    }
                    $uniq_name = $uid.'_'.$i;


                    // TAB CONTENT
                    echo '<div class="tab-pane ' . $cls . '" id="' . $uniq_name . '">';

                        // Convert the old content to PB elements
                        if( empty( $this->data['content'][$i] ) && ( ! empty( $single_tabs[$i]['vts_tab_c_title'] ) || ! empty( $single_tabs[$i]['vts_tab_c_content'] ) ) ){
                            $textbox = ZNPB()->add_module_to_layout( 'TH_TextBox', array( 'stb_title' => $single_tabs[$i]['vts_tab_c_title'], 'stb_content' => $single_tabs[$i]['vts_tab_c_content'] ) );
                            $column = ZNPB()->add_module_to_layout( 'ZnColumn', array() , array( $textbox ), 'col-sm-12' );
                            $this->data['content'][$i] = array ( $column );
                        }

                        // Add complex page builder element
                        echo '<div class="row tabPaneContainer zn_columns_container zn_content" data-droplevel="1">';
                            if ( empty( $this->data['content'][$i] ) ) {
                                $column = ZNPB()->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' );
                                $this->data['content'][$i] = array ( $column );
                            }

                            if ( !empty( $this->data['content'][$i] ) ) {
                                ZNPB()->zn_render_content( $this->data['content'][$i] );
                            }
                        echo '   </div>';

                    echo '</div>';

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
            "name"           => __( "Tabs", 'zn_framework' ),
            "description"    => __( "Here you can add your desired tabs.", 'zn_framework' ),
            "id"             => "single_horizontal_tab",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Tab", 'zn_framework' ),
            "remove_text"    => __( "Tab", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "vts_tab_title",
            "subelements"    => array (
                array (
                    "name"        => __( "Tab Title", 'zn_framework' ),
                    "description" => __( "Please enter the desired title that will appear as tab.", 'zn_framework' ),
                    "id"          => "vts_tab_title",
                    "std"         => "",
                    "type"        => "text"
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
                        "name"        => __( "Tabs Style", 'zn_framework' ),
                        "description" => __( "Using this option you can choose the desired tabs style.", 'zn_framework' ),
                        "id"          => "vts_tab_style",
                        "std"         => "tabs_style1",
                        'options'     => array(
                                'tabs_style1' => __( 'Style 1', 'zn_framework' ),
                                'tabs_style2' => __( 'Style 2', 'zn_framework' ),
                                'tabs_style3' => __( 'Style 3', 'zn_framework' ),
                                'tabs_style4' => __( 'Style 4', 'zn_framework' ),
                                'tabs_style5' => __( 'Style 5', 'zn_framework' ),
                            ),
                        "type"        => "select",
                        'live' => array(
                            'type'      => 'class',
                            'css_class' => '.'.$this->data['uid']
                        ),
                    ),

                    array (
                        "name"        => __( "Tab Buttons Alignment", 'zn_framework' ),
                        "description" => __( "Please select an alignment for the Tab Buttons", 'zn_framework' ),
                        "id"          => "tabs_alignment",
                        "std"         => "left",
                        "type"        => "select",
                        'options'     => array(
                            'left' => __( 'Left (default)', 'zn_framework' ),
                            'center' => __( 'Center', 'zn_framework' ),
                            'right' => __( 'Right', 'zn_framework' ),
                        ),
                        'live' => array(
                            'type'      => 'class',
                            'css_class' => '.'.$this->data['uid'].' ul.nav',
                            'val_prepend'   => 'nav-alignment--'
                        ),
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#WvgZVeXIKRY" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/horizontal-tabs/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
