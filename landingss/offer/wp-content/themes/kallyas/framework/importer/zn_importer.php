<?php

	/*--------------------------------------------------------------------------------------------------
	Main function for importing dummy data
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'installDummy' ) ) {
	function installDummy(){

		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

			require_once( dirname( __FILE__ ) . '/wordpress-importer.php' );
				
			if(!is_file( THEME_BASE."/template_helpers/dummy_content/dummy.xml"))
			{
				echo "The XML file containing the dummy content is not available or could not be read in <pre>".get_template_directory()."/admin/dummy_content/dummy.xml</pre>";
			}
			else
			{

				$wp_import = new ZN_WP_Import();
				set_time_limit(0);
				// ini_set('max_execution_time', 500);
				$wp_import->fetch_attachments = true;
				$wp_import->import( THEME_BASE."/template_helpers/dummy_content/dummy.xml" );
				//setMenus();
			}
		

	}
}

?>