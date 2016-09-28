<?php if(! defined('ABSPATH')) { return; }
/**
 * Custom Classes
 *
 * @package  Kallyas
 * @category Custom Classes
 * @author Team Hogash
 * @since 3.8.0
 */

if(! class_exists('WpkZn'))
{
	/**
	 * Class WpkZn
	 *
	 * @category Custom Classes
	 * @author Team Hogash
	 */
	class WpkZn
	{


		/**
		 * Retrieve the Category ID from a WP Category Object. Should be used in array_map context
		 *
		 * @param object $catObj The WP Category object
		 *
		 * @return int
		 */
		public static function wpk_extract_cat_id($catObj){
			if(isset($catObj->term_id)){
				return $catObj->term_id;
			}
			return 0;
		}

		/**
		 * Retrieve all product category Ids as an array
		 *
		 * @return array
		 */
		public static function getAllProductCategories(){
			$catArgs = array(
				'taxonomy'     => 'product_cat',
				'orderby'      => 'name',
				'show_count'   => 0,
				'pad_counts'   => 0,
				'hierarchical' => 0,
				'title_li'     => '',
				'hide_empty'   => 1,
			);
			$all_categories = get_categories( $catArgs );
			$allCats = array_map(array(get_class(),'wpk_extract_cat_id'), $all_categories);
			if(empty($allCats)){
				$allCats = array();
			}
			else {
				$allCats = array_values($allCats);
			}
			return $allCats;
		}

		/**
		 * Updates the search query to include the Page Builder elements
		 *
		 * @param $query
		 * @return mixed
		 */
		public static function updateSearchQuery($query){
			$canSearch = ( ! is_admin() && $query->is_main_query() && is_search() && !empty($query));
			if($canSearch){
				// So we can include the post meta table
				$query->set( 'meta_query', array(
					'relation' => 'OR',
					array(
						'key'     => 'zn_page_builder_els',
						'compare' => 'EXISTS',
					),
				) );
				add_filter( 'posts_where', array(get_class(), 'updateSearchWhere'), 99 , 1);
			}
			return $query;
		}

		/**
		 * Include the custom search query in the WHERE clause.
		 *
		 * @see: WpkZn::updateSearchQuery()
		 *
		 * @param string $where
		 * @return string
		 */
		public static function updateSearchWhere($where = ''){
			global $wpdb;

			$where .= " OR ( $wpdb->postmeta.meta_key = 'zn_page_builder_els' AND CAST($wpdb->postmeta.meta_value AS CHAR) LIKE '%".get_search_query()."%') ";

			remove_filter( 'posts_where', array(get_class(), 'updateSearchWhere'), 99 );

			return $where;
		}

		/**
		 * This function will return true if the provided $screen matches the file in the URL thus making it safe to
		 * load resources in only those pages where they're needed.
		 *
		 * @param string $screen
		 * @param bool   $isFunction If set to true, then $screen will be executed as a function
		 * @param array  $args The list of arguments to pass to $screen function if $isFunction is true.
		 * @since 3.6.8
		 * @return bool
		 */
		public static function canLoadResources($screen, $isFunction = false, $args = array()){
			if(! isset($_SERVER['SCRIPT_FILENAME']) || empty($_SERVER['SCRIPT_FILENAME'])){
				return false;
			}
			$crtPath = basename($_SERVER['SCRIPT_FILENAME']);
			if(empty($screen) || empty($crtPath)){
				return false;
			}
			if($isFunction){
				if(! empty($args)){
					return call_user_func_array($screen, $args);
				}
				else return call_user_func($screen);
			}
			return (strtolower($screen) == strtolower($crtPath));
		}

		/**
		 * Retrieve the media ID from the given URL
		 * @param string $attachment_url
		 * @return bool|null|string
		 */
		public static function getAttachmentIdFromUrl($attachment_url = ''){
			global $wpdb;
			$attachment_id = false;
			// If there is no url, return.
			if ( empty( $attachment_url ) ) {
				return $attachment_id;
			}

			// Get the upload directory paths
			$upload_dir_paths = wp_upload_dir();

			// Make sure the upload path base directory exists in the attachment URL
			if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
				// If this is the URL of an auto-generated thumbnail, get the URL of the original image
				$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

				// Remove the upload path base directory from the attachment URL
				$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

				// Run a custom database query to get the attachment ID from the modified attachment URL
				$attachment_id = $wpdb->get_var(
					$wpdb->prepare( "
				SELECT wposts.ID
					FROM {$wpdb->posts} AS wposts
						INNER JOIN {$wpdb->postmeta} AS wpostmeta
							ON wposts.ID = wpostmeta.post_id
						WHERE wpostmeta.meta_key = '_wp_attached_file'
							AND wpostmeta.meta_value = '%s'
							AND wposts.post_type = 'attachment'", $attachment_url ) );
			}
			return $attachment_id;
		}

		/**
		 * Retrieve the contents of the specified file
		 * @param string $filePath The absolute system path to the file
		 * @return string
		 */
		public static function getFileContents($filePath){
			$out = '';
			if(! is_file($filePath)){
				return $out;
			}
			if(function_exists('file_get_contents')){
				return file_get_contents($filePath);
			}
			if(function_exists('fopen')){
				$fh = fopen($filePath, 'rb');
				if($fh){
					while(! feof($fh)){
						$out .= fread($fh, 1024);
					}
				}
			}
			return $out;
		}

		/**
		 * Write the specified $content to a file $filePath.
		 * @param string $filePath
		 * @param string $content
		 * @param bool   $append
		 * @since 3.8.0
		 * @return int 0 on error, >=1 on success
		 */
		public static function writeFile($filePath, $content, $append = false){
			if(function_exists('file_put_contents')){
				$append = $append ? FILE_APPEND : 0;
				return file_put_contents($filePath, $content, $append);
			}
			$result = 0;
			if(function_exists('fopen')){
				$append = $append ? 'a+b' : 'wb';
				$fh = fopen($filePath, $append);
				if($fh){
					if (fwrite($fh, $content) !== FALSE) {
						$result = 1;
					}
					fclose($fh);
				}
			}
			return $result;
		}


		/**
		 * Fix for seo-workers not seeing multiple keyphrases
		 * This method is deprecated, use WpkZn::smcLanguageAttributes() instead.
		 * @param $content
		 * @hooked to language_attributes
		 * @see functions.php
		 * @return string
		 */
		public static function smcLanguageAttributes($content){
			global $is_IE;
			if (isset($is_IE) && (bool)$is_IE ) {
				$browser = $_SERVER['HTTP_USER_AGENT'];
				$iev = '';

				if ( isset( $browser ) && ( strpos( $browser, 'MSIE' ) !== false ) ) {
					preg_match( '/MSIE (.*?);/', $browser, $matches );
					if ( count( $matches ) > 1 ) {
						$iev = floor( $matches[1] );
					}
				}
				return $content . ' class="no-js oldie ie' . $iev . ' isie" ';
			}
			return $content . ' class="no-js" ';
		}

		/**
		 * Add the Kallyas Options menu entry in the admin bar
		 * This method is deprecated, use WpkZn::addKallyasOptionsAdminBar() instead.
		 * @param $wp_admin_bar
		 * @hooked to admin_bar_menu
		 * @see functions.php
		 */
		public static function addKallyasOptionsAdminBar($wp_admin_bar){
			if ( is_user_logged_in() ) {
				if ( current_user_can( 'administrator' ) ) {
					$args = array (
						'id'    => 'kallyas-theme-options-menu-item',
						'title' => 'Kallyas Options',
						'href'  => admin_url( 'admin.php?page=zn_tp_general_options' ),
						'meta'  => array (
							'class' => 'wpk-kallyas-options-menu-item'
						)
					);
					$wp_admin_bar->add_node( $args );
				}
			}
		}

		/**
		 * Load the styles to customize the Kallyas Options menu entry in the admin bar
		 * @hooked to admin_head
		 * @hooked to wp_head
		 * @see functions.php
		 */
		public static function addKallyasOptionsStylesAdminBar(){
			?>
			<style type="text/css" id="wpk_local_adminbar_notice_styles">
				#wpadminbar .ab-top-menu .wpk-kallyas-options-menu-item:hover div,
				#wpadminbar .ab-top-menu .wpk-kallyas-options-menu-item:active div,
				#wpadminbar .ab-top-menu .wpk-kallyas-options-menu-item:focus div,
				#wpadminbar .ab-top-menu .wpk-kallyas-options-menu-item div {
					color: #eee;
					cursor: default;
					background: #222;
					position: relative;
				}
				#wpadminbar .ab-top-menu .wpk-kallyas-options-menu-item:hover div {
					color: #45bbe6 !important;
				}
				#wpadminbar .ab-top-menu .wpk-kallyas-options-menu-item > .ab-item:before {
					content: '\f111';
					top: 2px;
				}
			</style>
		<?php }

		/**
		 * Retrieve all sidebars from the theme.
		 * @since 4.0.0
		 * @return array
		 */
		public static function getThemeSidebars(){
			$sidebars = array ();
			$sidebars['defaultsidebar'] = __( 'Default Sidebar', 'zn_framework' );
			if ( $unlimited_sidebars = zget_option( 'unlimited_sidebars', 'unlimited_sidebars' ) ) {
				foreach ( $unlimited_sidebars as $sidebar ) {
					if (isset($sidebar['sidebar_name']) && !empty($sidebar['sidebar_name'])) {
						$sidebars[ $sidebar['sidebar_name'] ] = $sidebar['sidebar_name'];
					}
				}
			}
			return $sidebars;
		}

		/**
		 * Retrieve all headers from the theme.
		 * @since 4.0.0
		 * @return array
		 */
		public static function getThemeHeaders( $addnone = false ){

			$headers = array ();
			if($addnone == true){
				$headers[0] = 'None';
			}
			$headers['zn_def_header_style'] = __( 'Default style', 'zn_framework' );
			$saved_headers = zget_option( 'header_generator', 'unlimited_header_options', false, array() );
			foreach ( $saved_headers as $header ) {
				if ( isset ( $header['uh_style_name'] ) && ! empty ( $header['uh_style_name'] ) ) {
					$header_name                   = strtolower( str_replace( ' ', '_', $header['uh_style_name'] ) );
					$headers[ $header_name ] = $header['uh_style_name'];
				}
			}

			return $headers;
		}

		/**
		 * Retrieve all blog categories as an associative array: id => name
		 * @since 4.0.0
		 * @return array
		 */
		public static function getBlogCategories(){
			$args = array (
				'type'         => 'post',
				'child_of'     => 0,
				'parent'       => '',
				'orderby'      => 'id',
				'order'        => 'ASC',
				'hide_empty'   => 1,
				'hierarchical' => 1,
				'taxonomy'     => 'category',
				'pad_counts'   => false
			);
			$blog_categories = get_categories( $args );

			$categories = array ();
			foreach ( $blog_categories as $category ) {
				$categories[ $category->cat_ID ] = $category->cat_name;
			}
			return $categories;
		}

		/**
		 * Retrieve all shop categories as an associative array: id => name
		 * @requires plugin WooCommerce installed and active
		 * @since 4.0.0
		 * @return array
		 */
		public static function getShopCategories(){
			$args = array (
				'type'         => 'shop',
				'child_of'     => 0,
				'parent'       => '',
				'orderby'      => 'id',
				'order'        => 'ASC',
				'hide_empty'   => 1,
				'hierarchical' => 1,
				'taxonomy'     => 'product_cat',
				'pad_counts'   => false
			);

			$shop_categories = get_categories( $args );

			$categories = array ();
			if ( ! empty( $shop_categories ) ) {
				foreach ( $shop_categories as $category ) {
					if ( isset( $category->cat_ID ) && isset( $category->cat_name ) ) {
						$categories[ $category->cat_ID ] = $category->cat_name;
					}
				}
			}
			return $categories;
		}

		/**
		 * Retrieve the list of all Portfolio Categories
		 * @since 4.0.0
		 * @return array
		 */
		public static function getPortfolioCategories(){
			$args = array (
				'type'         => 'portfolio',
				'child_of'     => 0,
				'parent'       => '',
				'orderby'      => 'id',
				'order'        => 'ASC',
				'hide_empty'   => 1,
				'hierarchical' => 1,
				'taxonomy'     => 'project_category',
				'pad_counts'   => false
			);
			$port_categories = get_categories( $args );
			$categories = array ();
			if ( ! empty( $port_categories ) ) {
				foreach ( $port_categories as $category ) {
					if ( isset( $category->cat_ID ) && isset( $category->cat_name ) ) {
						$categories[ $category->cat_ID ] = $category->cat_name;
					}
				}
			}
			return $categories;
		}

        /**
         * Retrieve the list of tags (as links) for the specified post
         * @param int $postID
         * @param string $sep The separator
         * @return string
         */
        public static function getPostTags($postID, $sep = '')
        {
            $out = '';
            $tagsArray = array();
            $tags = wp_get_post_tags($postID, array('orderby' => 'name', 'order' => 'ASC'));
            if(empty($tags)){
                return $out;
            }
            foreach($tags as $tag){
                $tagsArray[$tag->name] = get_tag_link($tag->term_id);
            }
            foreach($tagsArray as $name => $link){
                $out .= '<a href="'.$link.'" rel="tag">'.$name.'</a>';
                if(! empty($sep)){
                    $out .= $sep;
                }
            }
            $out = rtrim($out, $sep);
            return $out;
        }

	}

}
