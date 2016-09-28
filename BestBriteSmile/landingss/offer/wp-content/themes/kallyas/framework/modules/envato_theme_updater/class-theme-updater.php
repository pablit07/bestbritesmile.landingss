<?php
/**
 * Theme updater system for Envato marketplaces
 *
 * @author 		ThemeFuzz
 * @category 	Admin
 * @package 	ZnFramework/Modules/envato_theme_updater
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ZnThemeUpdater Class
 */
class ZnThemeUpdater {

	private $config = array();

	function __construct( $updater_config ){

		$this->config = $updater_config;

		// add the options in the admin panel
		add_filter( 'zn_theme_pages', array( $this, 'zn_theme_updater_page' ) );
		add_filter( 'zn_theme_options', array( $this, 'zn_theme_updater_options' ) );
		add_action( 'init', array( $this, 'zn_check_updates' ) );

	}

	function zn_theme_updater_page( $admin_pages ){
		$admin_pages[$this->config['admin_parent']]['submenus'][] = array(
			'slug' => 'zn_theme_updater',
			'title' =>  __( "Automatic updates", 'zn_framework' )
		);

		return $admin_pages;
	}

	function zn_theme_updater_options( $admin_options ){

		$admin_options[] = array (
		    'slug'        => 'zn_theme_updater',
		    'parent'      => $this->config['admin_parent'],
		    "name"        => __( "Themeforest Username", 'zn_framework' ),
		    "description" => __( "Please fill in your Themeforest username.", 'zn_framework' ),
		    "id"          => "zn_theme_username",
		    "std"         => "",
		    "type"        => "text",
		);

		$admin_options[] = array (
		    'slug'        => 'zn_theme_updater',
		    'parent'      => $this->config['admin_parent'],
		    "name"        => __( "Themeforest API key", 'zn_framework' ),
		    "description" => __( "Please fill in your Themeforest API key.", 'zn_framework' ),
		    "id"          => "zn_theme_api",
		    "std"         => "",
		    "type"        => "text",
		);

		return $admin_options;
	}

	function zn_check_updates(){
		$username = zget_option( 'zn_theme_username', $this->config['admin_parent'], false, null );
		$apikey = zget_option( 'zn_theme_api', $this->config['admin_parent'], false, null );

		if ( ! empty( $username ) && ! empty( $apikey ) && ! empty( $this->config['author'] ) )
		{

			require_once( FW_PATH .'/modules/envato_theme_updater/class-pixelentity-theme-update.php' );
			PixelentityThemeUpdate::init( $username, $apikey, $this->config['author'] );
		}
	}

}