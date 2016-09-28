<?php
if(!defined('ABSPATH')) {
	die("Don't call this file directly.");
}

if ( ! class_exists( 'ZnThemeOptionsExport' ) ) {
	class ZnThemeOptionsExport
	{

		private $file_name = 'theme_options.txt';

		function __construct(){
		}

		function render_page() {
		}

		function do_deploy(){


		}

		function do_export(){
			header( 'Content-Description: File Transfer' );
			header( 'Content-Disposition: attachment; filename=' . $this->file_name );
			header( 'Content-Type: text/plain; charset=' . get_option( 'blog_charset' ), true );

			$options_json = $this->build_options_json();
			echo $options_json;

			die();
		}

		function build_options_json(){
			$options = $this->get_all_options();

			return json_encode($options);

		}

		// Make this function to pass trough all the options and skipe the 'skip_export' ones
		function get_all_options(){
			$options = zget_option(false,false,true);

			unset($options['general_options']['mailchimp_api']);
			unset($options['general_options']['google_analytics']);

			return $options;
		}


	}
	
}


?>