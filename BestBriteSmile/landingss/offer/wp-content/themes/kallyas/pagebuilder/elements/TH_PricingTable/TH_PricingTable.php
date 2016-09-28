<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Pricing Tables
 Description: Create and display a Pricing Table element
 Class: TH_PricingTable
 Category: content
 Level: 3
*/
/**
 * Class HT_Accordion
 *
 * Create and display an Accordion element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author Team Hogash
 * @since 3.8.0
 */
class TH_PricingTable extends ZnElements
{
    public static function getName(){
        return __( "Pricing Tables", 'zn_framework' );
    }

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){

        //print_z($this);
        $uid = $this->data['uid'];
        $css = '';

        $pt_color = $this->opt('pt_color') ? $this->opt('pt_color') : '';
        //** Set background color of the section
        if (!empty($pt_color))
        {
            $css .= ".$uid .btn-fullcolor, .$uid .plan-column.featured .subscription-price .inner-cell{background-color:$pt_color}";
            $css .= ".$uid .btn-fullcolor:hover{background-color:".adjustBrightness($pt_color, 20)."}";
            $css .= ".$uid .plan-column .plan-title {color:$pt_color}";
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

        $numItems = (isset($options['pt_num_items']) && !empty($options['pt_num_items']) ) ? $options['pt_num_items'] : 4;

        // Don't display anything if the element is not configured
        if( empty($options['pricing_tables_single']) ){ return; }

        echo '<div class="pricing-table-element '.$this->data['uid'].' '.$this->opt('css_class','').'" data-columns="'.$numItems.'">';

        // Features Column
        if($this->opt('pt_feature_titles','') == 'yes'){
            echo '<div class=" features-column hidden-sm hidden-xs"><ul>';
                $feature_titles_list = $this->opt('pt_feature_titles_features','');
                if( !empty($feature_titles_list) ){
                    $feature_titles_list = explode("\n", $feature_titles_list);
                    foreach($feature_titles_list as $feature_titles_item){
                        echo '<li><div class="inner-cell">'.$feature_titles_item.'</div></li>';
                    }
                }
            echo '</ul></div>';
        }

        if(isset($options['pricing_tables_single']) && !empty($options['pricing_tables_single']))
        {

            foreach($options['pricing_tables_single'] as $entry)
            {
                $featured = (isset($entry['pt_single_featured']) && $entry['pt_single_featured'] != 'no' ? '': 'featured');
                $features = (isset($entry['pt_single_features']) && !empty($entry['pt_single_features']) ? $entry['pt_single_features'] : '');
                $title = (isset($entry['pt_single_title']) ? $entry['pt_single_title'] : '');
                $price = (isset($entry['pt_single_price']) ? $entry['pt_single_price'] : '');
                $pt_single_currency = (isset($entry['pt_single_currency']) ? $entry['pt_single_currency'] : '$');
                $period = (isset($entry['pt_single_plan_period']) ? $entry['pt_single_plan_period'] : '');
                $caButtonText = (isset($entry['pt_single_ca_btn_text']) ? $entry['pt_single_ca_btn_text'] : '');
                $caButtonLink = '';
                if(isset($entry['pt_single_ca_btn_link']) && !empty($entry['pt_single_ca_btn_link']) && is_array($entry['pt_single_ca_btn_link']) && !empty($caButtonText)){
                    $caButtonLink = '<a href="' . $entry['pt_single_ca_btn_link']['url'] . '" target="' .
                        $entry['pt_single_ca_btn_link']['target'] . '" class="btn btn-fullcolor">' .$caButtonText .'</a>';
                }

                $featured_mostpopular = ($featured == 'featured') ? 'data-featuredtitle="'. esc_attr( __( 'MOST POPULAR', 'zn_framework' ) ) .'"' : '';

                echo '<div class="plan-column '.$featured.' ">';
                echo '<ul>
                        <li class="plan-title">
                            <div class="inner-cell" '.$featured_mostpopular.'>'.$title.'</div>
                        </li>
                        <li class="subscription-price">
                            <div class="inner-cell"><span class="currency">'.$pt_single_currency.'</span>
                                <span class="price">'.$price.'</span>
                                '.__('per', 'zn_framework').' '.$period.'</div>
                        </li>';

                if(! empty($features)){
                    $features = explode("\n", $features);
                    foreach($features as $feature){
                        echo '<li><div class="inner-cell">'.$feature.'</div></li>';
                    }
                }

                if(! empty($caButtonLink)){
                    echo '<li><div class="inner-cell">'.$caButtonLink.'</div></li>';
                }
                echo '</ul>';
                echo '</div>';
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
            "name"           => __( "Pricing Tables", 'zn_framework' ),
            "description"    => __( "Here you can create your desired pricing tables.", 'zn_framework' ),
            "id"             => "pricing_tables_single",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Pricing Table", 'zn_framework' ),
            "remove_text"    => __( "Pricing Table", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "pt_single_title",
            "subelements"    => array (
                array (
                    "name"        => __( "Featured", 'zn_framework' ),
                    "description" => __( "Please select yes if you want this plan to be featured.", 'zn_framework' ),
                    "id"          => "pt_single_featured",
                    'type'          => 'toggle2',
                    'std'           => '',
                    'value'         => 'no'
                ),
                array (
                    "name"        => __( "Title", 'zn_framework' ),
                    "description" => __( "Please specify title for this plan", 'zn_framework' ),
                    "id"          => "pt_single_title",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Price", 'zn_framework' ),
                    "description" => __( "Select specify the price for this plan. Prices will use the dollar currency by default", 'zn_framework' ),
                    "id"          => "pt_single_price",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Currency", 'zn_framework' ),
                    "description" => __( "Add the currency simbol you want to use", 'zn_framework' ),
                    "id"          => "pt_single_currency",
                    "std"         => "$",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Plan Period", 'zn_framework' ),
                    "description" => __( "Please specify the plan period", 'zn_framework' ),
                    "id"          => "pt_single_plan_period",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Call to action button text", 'zn_framework' ),
                    "description" => __( "Please specify the call to action button text.", 'zn_framework' ),
                    "id"          => "pt_single_ca_btn_text",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Button link", 'zn_framework' ),
                    "description" => __( "Please choose the link you want to use.", 'zn_framework' ),
                    "id"          => "pt_single_ca_btn_link",
                    "std"         => "",
                    "type"        => "link",
                    "options"     => array (
                        '_blank' => __( "New window", 'zn_framework' ),
                        '_self'  => __( "Same window", 'zn_framework' )
                    ),
                ),
                array (
                    "name"        => __( "Features", 'zn_framework' ),
                    "description" => __( "Please specify each feature on its own line", 'zn_framework' ),
                    "id"          => "pt_single_features",
                    "std"         => "",
                    "type"        => "textarea"
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
                        "name"        => __( "Columns", 'zn_framework' ),
                        "description" => __( "Please select the number of pricing tables to display.", 'zn_framework' ),
                        "id"          => "pt_num_items",
                        "std"         => "4",
                        "options"     => array (
                            '1'        => 1,
                            '2'        => 2,
                            '3'        => 3,
                            '4'        => 4,
                            '5'        => 5,
                        ),
                        "type"        => "select",
                    ),

                    array (
                        "name"        => __( "Enable Feature Titles column?", 'zn_framework' ),
                        "description" => __( "If you want the first column to contain the list of features titles, please enable this option.", 'zn_framework' ),
                        "id"          => "pt_feature_titles",
                        'type'          => 'toggle2',
                        'std'           => '',
                        'value'         => 'yes'
                    ),

                    array (
                        "name"        => __( "Feature Titles List", 'zn_framework' ),
                        "description" => __( "Please specify each feature on its own line, after each one pressing Enter key (or Return)", 'zn_framework' ),
                        "id"          => "pt_feature_titles_features",
                        "std"         => "",
                        "type"        => "textarea",
                        'dependency' => array( 'element' => 'pt_feature_titles' , 'value'=> array('yes') )
                    ),

                    array (
                        "name"        => __( "Colors", 'zn_framework' ),
                        "description" => __( "Please select a color theme for the table elements.", 'zn_framework' ),
                        "id"          => "pt_color",
                        'type'        => 'colorpicker',
                        'std'         => '',
                        'live' => array(
                                'multiple' => array(
                                    array(
                                        'type'      => 'css',
                                        'css_class' => '.'.$this->data['uid'].' .btn-fullcolor, .'.$this->data['uid'].' .plan-column.featured .subscription-price .inner-cell ',
                                        'css_rule'  => 'background-color',
                                        'unit'      => ''
                                    ),
                                    array(
                                        'type'      => 'css',
                                        'css_class' => '.'.$this->data['uid'].' .plan-column .plan-title',
                                        'css_rule'  => 'color',
                                        'unit'      => ''
                                    ),
                                )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#nB-eNrqr_cQ" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/pricing-table/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
