<?php
 class Affiliates_Referrals_Export { private $charset = 'UTF-8'; public function __construct() { $this->charset = get_option( 'blog_charset' ); } public function __set( $name, $IXAP87 ) { switch( $name ) { case 'charset' : $this->charset = $IXAP87; break; } } public function __get( $name ) { $IXAP15 = null; switch( $name ) { case 'charset' : $IXAP15 = $this->charset; break; } return $IXAP15; } public function request() { $IXAP56 = date( 'Y-m-d-H-i-s', time() ); header( 'Content-Description: File Transfer' ); if ( !empty( $this->charset ) ) { header( 'Content-Type: text/tab-separated-values; charset=' . $this->charset ); } else { header( 'Content-Type: text/tab-separated-values' ); } header( "Content-Disposition: attachment; filename=\"affiliates-export-$IXAP56.tsv\"" ); $this->entries(); echo "\n"; } private function entries() { global $wpdb, $affiliates_db, $affiliates_options; $IXAP47 = $affiliates_db->get_tablename( 'affiliates' ); $IXAP48 = $affiliates_db->get_tablename( 'affiliates_users' ); $IXAP25 = $affiliates_db->get_tablename( 'affiliates_attributes' ); $IXAP49 = $affiliates_db->get_tablename( 'referrals' ); $IXAP112 = $affiliates_db->get_tablename( 'hits' ); $posts_table = $wpdb->prefix . 'posts'; $IXAP101 = date( 'Y-m-d', time() ); $IXAP76 = array( 'referral_id' => __( 'Referral ID', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'reference' => __( 'Reference', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'amount' => __( 'Amount', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'currency_id' => __( 'Currency', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'status' => __( 'Status', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'type' => __( 'Type', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'datetime' => __( 'Date', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'description' => __( 'Description', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'post_id' => __( 'Post ID', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'post_title' => __( 'Post', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'ip' => __( 'IP', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'affiliate_id' => __( 'Affiliate ID', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'name' => __( 'Affiliate', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'user_id' => __( 'User ID', AFFILIATES_PRO_PLUGIN_DOMAIN ), ); if ( AFFILIATES_PLUGIN_NAME == 'affiliates-enterprise' ) { $IXAP76['campaign_id'] = __( 'Campaign ID', AFFILIATES_PRO_PLUGIN_DOMAIN ); } $IXAP76['data'] = __( 'Data', AFFILIATES_PRO_PLUGIN_DOMAIN ); $IXAP30 = count( $IXAP76 ); $IXAP80 = 0; foreach( $IXAP76 as $IXAP78 => $IXAP133 ) { echo $IXAP133; $IXAP80++; if ( $IXAP80 < $IXAP30 ) { echo "\t"; } } echo "\n"; $IXAP36 = $affiliates_options->get_option( 'referrals_from_date', null ); $IXAP38 = $affiliates_options->get_option( 'referrals_thru_date', null ); $IXAP24 = $affiliates_options->get_option( 'referrals_affiliate_id', null ); $IXAP247 = $affiliates_options->get_option( 'referrals_status', null ); $IXAP471 = $affiliates_options->get_option( 'referrals_search', null ); $IXAP472 = $affiliates_options->get_option( 'referrals_search_description', null ); $IXAP473 = $affiliates_options->get_option( 'referrals_expanded', null ); $IXAP474 = $affiliates_options->get_option( 'referrals_expanded_description', null ); $IXAP475 = $affiliates_options->get_option( 'referrals_expanded_data', null ); $IXAP287 = $affiliates_options->get_option( 'referrals_show_inoperative', null ); $IXAP51 = " WHERE 1=%d "; $IXAP52 = array( 1 ); if ( $IXAP36 ) { $IXAP37 = DateHelper::u2s( $IXAP36 ); } if ( $IXAP38 ) { $IXAP39 = DateHelper::u2s( $IXAP38, 24*3600 ); } if ( $IXAP36 && $IXAP38 ) { $IXAP51 .= " AND datetime >= %s AND datetime < %s "; $IXAP52[] = $IXAP37; $IXAP52[] = $IXAP39; } else if ( $IXAP36 ) { $IXAP51 .= " AND datetime >= %s "; $IXAP52[] = $IXAP37; } else if ( $IXAP38 ) { $IXAP51 .= " AND datetime < %s "; $IXAP52[] = $IXAP39; } if ( $IXAP24 ) { $IXAP51 .= " AND r.affiliate_id = %d "; $IXAP52[] = $IXAP24; } if ( $IXAP247 ) { $IXAP51 .= " AND r.status = %s "; $IXAP52[] = $IXAP247; } if ( $IXAP471 ) { if ( $IXAP472 ) { $IXAP51 .= " AND ( r.data LIKE '%%%s%%' OR r.description LIKE '%%%s%%' ) "; $IXAP52[] = $IXAP471; $IXAP52[] = $IXAP471; } else { $IXAP51 .= " AND r.data LIKE '%%%s%%' "; $IXAP52[] = $IXAP471; } } $IXAP98 = $wpdb->prepare("
			SELECT r.*, a.affiliate_id, a.name
			FROM $IXAP49 r
			LEFT JOIN $IXAP47 a ON r.affiliate_id = a.affiliate_id
			LEFT JOIN $posts_table p ON r.post_id = p.ID
			$IXAP51
			", $IXAP52 + $IXAP52 ); $IXAP55 = $wpdb->get_results( $IXAP98, OBJECT ); foreach( $IXAP55 as $IXAP15 ) { $IXAP90 = array(); $IXAP90[] = $IXAP15->referral_id; $IXAP90[] = $IXAP15->reference; $IXAP90[] = $IXAP15->amount; $IXAP90[] = $IXAP15->currency_id; $IXAP90[] = $IXAP15->status; $IXAP90[] = $IXAP15->type; $IXAP90[] = $IXAP15->datetime; $IXAP90[] = stripslashes( $IXAP15->description ); $IXAP90[] = $IXAP15->post_id; $IXAP90[] = stripslashes( get_the_title( $IXAP15->post_id ) ); $IXAP90[] = $IXAP15->ip; $IXAP90[] = $IXAP15->affiliate_id; $IXAP90[] = stripslashes( $IXAP15->name ); $IXAP90[] = $IXAP15->user_id; if ( AFFILIATES_PLUGIN_NAME == 'affiliates-enterprise' ) { $IXAP90[] = $IXAP15->campaign_id; } $IXAP212 = $IXAP15->data; if ( empty( $IXAP212 ) ) { $IXAP90[] = ''; } else { $IXAP212 = unserialize( $IXAP212 ); if ( $IXAP212 ) { if ( is_array( $IXAP212 ) ) { foreach ( $IXAP212 as $IXAP78 => $IXAP213 ) { $IXAP81 = __( $IXAP213['title'], $IXAP213['domain'] ); $IXAP81 = stripslashes( wp_filter_nohtml_kses( $IXAP81 ) ); $IXAP90[] = $IXAP81 . ' : ' . stripslashes( $IXAP213['value'] ); } } else if ( is_string( $IXAP212 ) ) { $IXAP90[] = stripslashes( $IXAP212 ); } else { $IXAP90[] = stripslahes( var_export( $IXAP212, true ) ); } } } $IXAP30 = count( $IXAP90 ); for ( $IXAP80 = 0; $IXAP80 < $IXAP30; $IXAP80++ ) { echo $IXAP90[$IXAP80]; echo "\t"; } echo "\n"; } } public static function init() { add_action( 'init', array(__CLASS__,'wp_init' ) ); add_filter( 'affiliates_admin_referrals_secondary_actions', array( __CLASS__, 'affiliates_admin_referrals_secondary_actions' ) ); } public static function affiliates_admin_referrals_secondary_actions( $IXAP62 ) { $IXAP62 .= '<div style="display:inline">'; $IXAP62 .= '<form style="display:inline" id="export-referrals" action="" method="post">'; $IXAP62 .= sprintf( '<input class="button" type="submit" value="%s" />', __( 'Export', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); $IXAP62 .= '<input type="hidden" name="action" value="export-referrals" />'; $IXAP62 .= wp_nonce_field( 'export-referrals', 'export-nonce', true, false ); $IXAP62 .= '</form>'; $IXAP62 .= '</div>'; return $IXAP62; } public static function wp_init() { if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'export-referrals' && wp_verify_nonce( $_REQUEST['export-nonce'], 'export-referrals' ) ) { if ( !current_user_can( AFFILIATES_ADMINISTER_AFFILIATES ) ) { wp_die( __( 'Access denied.', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); } $IXAP458 = new Affiliates_Referrals_Export(); $IXAP458->request(); die; } } } Affiliates_Referrals_Export::init(); 