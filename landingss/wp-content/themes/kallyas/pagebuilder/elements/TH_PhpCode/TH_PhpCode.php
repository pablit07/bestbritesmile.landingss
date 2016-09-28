<?php if(! defined('ABSPATH')){ return; }
/*
 Name: PHP Code
 Description: Create and display a PHP Code element.
 Class: TH_PhpCode
 Category: content
 Level: 3
*/
/**
 * Class TH_PhpCode
 *
 * Create and display a PHP Code element.
 * Executes the provided PHP code in pages this element is included into.
 * Heads up: While this element give you a lot of freedom, please use it responsibly as it can easily break your
 * existent codebase. Also, be aware of the server's limitations: restricted functions or classes.
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_PhpCode extends ZnElements
{

    public static function getName(){
        return __( "PHP Code", 'zn_framework' );
    }

    private static function _updateEntry( $optName, $value = '' ){
        return update_option($optName, $value);
    }
    private static function _getEntry($optName){
        return get_option($optName);
    }


    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];
        $dbOptName = $this->data['uid'];

        echo '<div class="elm-phpcode '.$dbOptName.' '.$this->opt('css_class','').'">';

        if(isset($options['page_php_code_text']) && ! empty($options['page_php_code_text']))
        {
            $oldFileName = self::_getEntry($dbOptName);

            $code = $options['page_php_code_text'];
            $code = trim($code);

            $startStr = substr($code, 0, 5);

            if( $startStr != '<?php' ){
                $code = '<?php '.$code;
            }

            // Add comment if not there already
            $comment = '<?php /*[Kallyas Theme] This file was automatically generated by the PHP Code element. You should not edit this file unless you know what you\'re doing! */ if(!defined("ABSPATH")){return;}'.PHP_EOL;

            if(false === ($pos = stripos($code, '[Kallyas Theme]'))) {
                $code = preg_replace( '/^\<\?php/msi', $comment, $code );
            }

            // Create the tmp file
            $codeHash = md5($code);

            // Get the uploads dir path
            $upload_dir = wp_upload_dir();
            $uploadPath = $upload_dir['basedir'];

            // Check option
            if(! empty($oldFileName)){
                // Edited code -> Delete old file
                $fp = "{$uploadPath}/{$oldFileName}.php";
                if(is_file($fp)){
                    @unlink( $fp );
                }
            }
            // Update db entry
            self::_updateEntry( $dbOptName, $codeHash );

            $fname = $codeHash.'.php';
            $filePath = $upload_dir['basedir'].'/'.$fname;
            if(! is_file($filePath)){
                WpkZn::writeFile($filePath, $code);
            }
            // Include the tmp file and execute the php code
            if( is_file($filePath) && is_readable($filePath) ) {
                include( $filePath );
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
        $uid = $this->data['uid'];

        $options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(
                    array (
                        "name"        => __( "PHP Code", 'zn_framework' ),
                        "description" => __( 'Please enter the PHP code to be executed. You need to be very careful to
                                                write this code properly because it will be executed as it is and it
                                                can potentially break your website.', 'zn_framework' ),
                        "id"          => "page_php_code_text",
                        "std"         => "",
                        "type"        => "textarea",
                        'class' => 'zn_full'
                    ),
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#yh8tyiw8tCc" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/php-code/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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