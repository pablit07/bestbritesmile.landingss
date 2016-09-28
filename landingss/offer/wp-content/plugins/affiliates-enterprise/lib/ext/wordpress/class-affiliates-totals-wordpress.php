<?php
class Affiliates_Totals_WordPress extends Affiliates_Totals { const IXAP183 = 'totals-nonce'; const IXAP184 = 'totals-nonce-1'; const IXAP185 = 'totals-nonce-2'; const IXAP280 = 'set-filters'; const IXAP281 = 'set-rpp'; const IXAP282 = 'set-page'; const IXAP283 = 'totals-nonce-mp'; const IXAP284 = 'gen-mp-pp'; const IXAP285 = 10; public static function view() { global $wpdb, $wp_rewrite, $affiliates_options; global $affiliates_db; $IXAP62 = ''; $IXAP101 = date( 'Y-m-d', time() ); if ( !current_user_can( AFFILIATES_ACCESS_AFFILIATES ) ) { wp_die( __( 'Access denied.', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); } if ( isset( $_POST['action'] ) ) { switch( $_POST['action'] ) { case 'do_foo' : break; } } else if ( isset ( $_GET['action'] ) ) { switch( $_GET['action'] ) { case 'close_referrals' : $IXAP35 = array( 'tables' => array( 'referrals' => $affiliates_db->get_tablename( 'referrals' ), 'affiliates' => $affiliates_db->get_tablename( 'affiliates' ), 'affiliates_users' => $affiliates_db->get_tablename( 'affiliates_users' ), 'users' => $wpdb->users, ) ); $IXAP35 = array_merge( $_GET, $IXAP35 ); echo self::update_status( AFFILIATES_REFERRAL_STATUS_CLOSED, $IXAP35 ); die(); break; } } if ( isset( $_POST['from_date'] ) || isset( $_POST['thru_date'] ) || isset( $_POST['minimum_total'] ) || isset( $_POST['referral_status'] ) || isset( $_POST['currency_id'] ) || isset( $_POST['clear_filters'] ) || isset( $_POST['affiliate_id'] ) || isset( $_POST['affiliate_name'] ) || isset( $_POST['affiliate_user_login'] ) || isset( $_POST['show_deleted'] ) || isset( $_POST['show_inoperative'] ) ) { if ( !wp_verify_nonce( $_POST[self::IXAP183], self::IXAP280 ) ) { wp_die( __( 'Access denied.', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); } } $IXAP36 = $affiliates_options->get_option( 'totals_from_date', null ); $IXAP37 = null; $IXAP38 = $affiliates_options->get_option( 'totals_thru_date', null ); $IXAP39 = null; $IXAP40 = $affiliates_options->get_option( 'totals_minimum_total', null ); $IXAP41 = $affiliates_options->get_option( 'totals_referral_status', null ); $IXAP42 = $affiliates_options->get_option( 'totals_currency_id', null ); $IXAP24 = $affiliates_options->get_option( 'totals_affiliate_id', null ); $IXAP43 = $affiliates_options->get_option( 'totals_affiliate_name', null ); $IXAP44 = $affiliates_options->get_option( 'totals_affiliate_user_login', null ); $IXAP286 = $affiliates_options->get_option( 'totals_show_deleted', false ); $IXAP287 = $affiliates_options->get_option( 'totals_show_inoperative', false ); if ( isset( $_POST['clear_filters'] ) ) { $affiliates_options->delete_option( 'totals_from_date' ); $affiliates_options->delete_option( 'totals_thru_date' ); $affiliates_options->delete_option( 'totals_minimum_total' ); $affiliates_options->delete_option( 'totals_referral_status' ); $affiliates_options->delete_option( 'totals_currency_id' ); $affiliates_options->delete_option( 'totals_affiliate_id' ); $affiliates_options->delete_option( 'totals_affiliate_name' ); $affiliates_options->delete_option( 'totals_affiliate_user_login' ); $affiliates_options->delete_option( 'totals_show_deleted' ); $affiliates_options->delete_option( 'totals_show_inoperative' ); $IXAP36 = null; $IXAP37 = null; $IXAP38 = null; $IXAP39 = null; $IXAP40 = null; $IXAP41 = null; $IXAP42 = null; $IXAP24 = null; $IXAP43 = null; $IXAP44 = null; $IXAP286 = false; $IXAP287 = false; } else if ( isset( $_POST['submitted'] ) ) { if ( !empty( $_POST['minimum_total'] ) ) { $IXAP40 = bcadd( "0", $_POST['minimum_total'], AFFILIATES_REFERRAL_AMOUNT_DECIMALS ); $affiliates_options->update_option( 'totals_minimum_total', $IXAP40 ); } else { $IXAP40 = null; $affiliates_options->delete_option( 'totals_minimum_total' ); } if ( !empty( $_POST['referral_status'] ) && ( $IXAP41 = Affiliates_Utility::verify_referral_status_transition( $_POST['referral_status'], $_POST['referral_status'] ) ) ) { $affiliates_options->update_option( 'totals_referral_status', $IXAP41 ); } else { $IXAP41 = null; $affiliates_options->delete_option( 'totals_referral_status' ); } if ( !empty( $_POST['currency_id'] ) && ( $IXAP42 = Affiliates_Utility::verify_currency_id( $_POST['currency_id'] ) ) ) { $affiliates_options->update_option( 'totals_currency_id', $IXAP42 ); } else { $IXAP42 = null; $affiliates_options->delete_option( 'totals_currency_id' ); } if ( !empty( $_POST['affiliate_name'] ) ) { $IXAP43 = $_POST['affiliate_name']; $affiliates_options->update_option( 'totals_affiliate_name', $IXAP43 ); } else { $IXAP43 = null; $affiliates_options->delete_option( 'totals_affiliate_name' ); } if ( !empty( $_POST['affiliate_user_login'] ) ) { $IXAP44 = $_POST['affiliate_user_login']; $affiliates_options->update_option( 'totals_affiliate_user_login', $IXAP44 ); } else { $IXAP44 = null; $affiliates_options->delete_option( 'totals_affiliate_user_login' ); } $IXAP286 = isset( $_POST['show_deleted'] ); $affiliates_options->update_option( 'totals_show_deleted', $IXAP286 ); $IXAP287 = isset( $_POST['show_inoperative'] ); $affiliates_options->update_option( 'totals_show_inoperative', $IXAP287 ); if ( !empty( $_POST['from_date'] ) ) { $IXAP36 = date( 'Y-m-d', strtotime( $_POST['from_date'] ) ); $affiliates_options->update_option( 'totals_from_date', $IXAP36 ); } else { $IXAP36 = null; $affiliates_options->delete_option( 'totals_from_date' ); } if ( !empty( $_POST['thru_date'] ) ) { $IXAP38 = date( 'Y-m-d', strtotime( $_POST['thru_date'] ) ); $affiliates_options->update_option( 'totals_thru_date', $IXAP38 ); } else { $IXAP38 = null; $affiliates_options->delete_option( 'totals_thru_date' ); } if ( $IXAP36 && $IXAP38 ) { if ( strtotime( $IXAP36 ) > strtotime( $IXAP38 ) ) { $IXAP38 = null; $affiliates_options->delete_option( 'totals_thru_date' ); } } if ( !empty( $_POST['affiliate_id'] ) ) { $IXAP24 = affiliates_check_affiliate_id( $_POST['affiliate_id'] ); if ( $IXAP24 ) { $affiliates_options->update_option( 'totals_affiliate_id', $IXAP24 ); } } else if ( isset( $_POST['affiliate_id'] ) ) { $IXAP24 = null; $affiliates_options->delete_option( 'totals_affiliate_id' ); } } if ( isset( $_POST['row_count'] ) ) { if ( !wp_verify_nonce( $_POST[self::IXAP184], self::IXAP281 ) ) { wp_die( __( 'Access denied.', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); } } if ( isset( $_POST['paged'] ) ) { if ( !wp_verify_nonce( $_POST[self::IXAP185], self::IXAP282 ) ) { wp_die( __( 'Access denied.', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); } } $IXAP70 = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; $IXAP70 = remove_query_arg( 'paged', $IXAP70 ); $IXAP70 = remove_query_arg( 'action', $IXAP70 ); $IXAP70 = remove_query_arg( 'affiliate_id', $IXAP70 ); $IXAP49 = $affiliates_db->get_tablename( 'referrals' ); $IXAP47 = $affiliates_db->get_tablename( 'affiliates' ); $IXAP48 = $affiliates_db->get_tablename( 'affiliates_users' ); $IXAP62 .= '<div class="totals">' . '<div>' . '<h1>' . __( 'Totals', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h1>' . '</div>'; $IXAP187 = isset( $_POST['row_count'] ) ? intval( $_POST['row_count'] ) : 0; if ($IXAP187 <= 0) { $IXAP187 = $affiliates_options->get_option( 'totals_per_page', self::IXAP285 ); } else { $affiliates_options->update_option('totals_per_page', $IXAP187 ); } $IXAP189 = isset( $_GET['offset'] ) ? intval( $_GET['offset'] ) : 0; if ( $IXAP189 < 0 ) { $IXAP189 = 0; } $IXAP190 = isset( $_REQUEST['paged'] ) ? intval( $_REQUEST['paged'] ) : 0; if ( $IXAP190 < 0 ) { $IXAP190 = 0; } $IXAP45 = isset( $_GET['orderby'] ) ? $_GET['orderby'] : null; switch ( $IXAP45 ) { case 'affiliate_id' : case 'name' : case 'user_login' : case 'email' : case 'total' : case 'currency_id' : break; default: $IXAP45 = 'name'; } $IXAP46 = isset( $_GET['order'] ) ? $_GET['order'] : null; switch ( $IXAP46 ) { case 'asc' : case 'ASC' : $IXAP191 = 'DESC'; break; case 'desc' : case 'DESC' : $IXAP191 = 'ASC'; break; default: $IXAP46 = 'ASC'; $IXAP191 = 'DESC'; } $IXAP51 = array( " 1=%d " ); $IXAP52 = array( 1 ); if ( $IXAP24 ) { $IXAP51[] = " a.affiliate_id = %d "; $IXAP52[] = $IXAP24; } if ( $IXAP43 ) { $IXAP51[] = " a.name LIKE '%%%s%%' "; $IXAP52[] = $IXAP43; } if ( $IXAP44 ) { $IXAP51[] = " u.user_login LIKE '%%%s%%' "; $IXAP52[] = $IXAP44; } if ( $IXAP36 ) { $IXAP37 = DateHelper::u2s( $IXAP36 ); } if ( $IXAP38 ) { $IXAP39 = DateHelper::u2s( $IXAP38, 24*3600 ); } if ( $IXAP37 && $IXAP39 ) { $IXAP51[] = " r.datetime >= %s AND r.datetime < %s "; $IXAP52[] = $IXAP37; $IXAP52[] = $IXAP39; } else if ( $IXAP37 ) { $IXAP51[] = " r.datetime >= %s "; $IXAP52[] = $IXAP37; } else if ( $IXAP39 ) { $IXAP51[] = " r.datetime < %s "; $IXAP52[] = $IXAP39; } if ( $IXAP41 ) { $IXAP51[] = " r.status = %s "; $IXAP52[] = $IXAP41; } if ( $IXAP42 ) { $IXAP51[] = " r.currency_id = %s "; $IXAP52[] = $IXAP42; } if ( !empty( $IXAP51 ) ) { $IXAP51 = " WHERE " . implode( " AND ", $IXAP51 ); } else { $IXAP51 = ''; } $IXAP53 = ''; if ( $IXAP40 ) { $IXAP53 .= " HAVING SUM(r.amount) >= %s "; $IXAP52[] = $IXAP40; } $IXAP198 = $affiliates_db->get_value( "
			SELECT COUNT(*) FROM (
			SELECT r.affiliate_id
			FROM $IXAP49 r
			LEFT JOIN $IXAP47 a ON r.affiliate_id = a.affiliate_id
			LEFT JOIN $IXAP48 au ON a.affiliate_id = au.affiliate_id
			LEFT JOIN $wpdb->users u on au.user_id = u.ID
			$IXAP51 
			GROUP BY r.affiliate_id, r.currency_id
			$IXAP53
			) tmp
			", $IXAP52 ); if ( $IXAP198 > $IXAP187 ) { $IXAP199 = true; } else { $IXAP199 = false; } $IXAP19 = ceil ( $IXAP198 / $IXAP187 ); if ( $IXAP190 > $IXAP19 ) { $IXAP190 = $IXAP19; } if ( $IXAP190 != 0 ) { $IXAP189 = ( $IXAP190 - 1 ) * $IXAP187; } $IXAP55 = $affiliates_db->get_objects( "
			SELECT a.*, u.user_login, SUM(r.amount) as total, r.currency_id
			FROM $IXAP49 r
			LEFT JOIN $IXAP47 a ON r.affiliate_id = a.affiliate_id
			LEFT JOIN $IXAP48 au ON a.affiliate_id = au.affiliate_id
			LEFT JOIN $wpdb->users u on au.user_id = u.ID
			$IXAP51
			GROUP BY r.affiliate_id, r.currency_id
			$IXAP53
			ORDER BY $IXAP45 $IXAP46 LIMIT $IXAP187 OFFSET $IXAP189
			", $IXAP52 ); $IXAP76 = array( 'affiliate_id' => __( 'Id', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'name' => __( 'Affiliate', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'email' => __( 'Email', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'user_login' => __( 'Username', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'total' => __( 'Total', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'currency_id' => __( 'Currency', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); $IXAP62 .= '<div class="totals-overview">'; $IXAP68 = ""; if ( !empty( $IXAP36 ) ) { $IXAP68 .= "&from_date=" . urlencode( $IXAP36 ); } if ( !empty( $IXAP38 ) ) { $IXAP68 .= "&thru_date=" . urlencode( $IXAP38 ); } if ( !empty( $IXAP40 ) ) { $IXAP68 .= "&minimum_total=" . urlencode( $IXAP40 ); } if ( !empty( $IXAP41 ) ) { $IXAP68 .= "&referral_status=" . urlencode( $IXAP41 ); } if ( !empty( $IXAP42 ) ) { $IXAP68 .= "&currency_id=" . urlencode( $IXAP42 ); } if ( !empty( $IXAP24 ) ) { $IXAP68 .= "&affiliate_id=" . urlencode( $IXAP24 ); } if ( !empty( $IXAP43 ) ) { $IXAP68 .= "&affiliate_name=" . urlencode( $IXAP43 ); } if ( !empty( $IXAP44 ) ) { $IXAP68 .= "&affiliate_user_login=" . urlencode( $IXAP44 ); } if ( !empty( $IXAP45 ) ) { $IXAP68 .= "&orderby=" . urlencode( $IXAP45 ); } if ( !empty( $IXAP46 ) ) { $IXAP68 .= "&order=" . urlencode( $IXAP46 ); } $IXAP69 = esc_url( AFFILIATES_PRO_PLUGIN_URL . 'lib/ext/includes/generate-mass-payment-file.php' ); $IXAP62 .= '<div class="manage">'; $IXAP62 .= "<p>"; $IXAP62 .= "<a target='_blank' title='" . __( 'Export to File', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "' " . "class='button generate export' " . "href='" . $IXAP69 . "?action=generate_mass_payment_file&service=export" . $IXAP68 . "'>" . "<img class='icon' alt='" . __( 'Generate', AFFILIATES_PRO_PLUGIN_DOMAIN) . "' src='". AFFILIATES_PRO_PLUGIN_URL ."images/export.png'/>" . "<span class='label'>" . __( 'Export', AFFILIATES_PRO_PLUGIN_DOMAIN) . "</span>" . "</a>"; $IXAP62 .= "<a target='_blank' title='" . __( 'Generate a Mass Payment File', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "' " . "class='button generate paypal' " . "href='" . $IXAP69 . "?action=generate_mass_payment_file&service=paypal" . $IXAP68 . "'>" . "<img class='icon' alt='" . __( 'Generate', AFFILIATES_PRO_PLUGIN_DOMAIN) . "' src='". AFFILIATES_PRO_PLUGIN_URL ."images/export.png'/>" . "<span class='label'>" . __( 'Mass Payment File', AFFILIATES_PRO_PLUGIN_DOMAIN) . "</span>" . "</a>"; $IXAP62 .= "<a title='" . __( 'Click to close these referrals', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "' " . "class='button close-referrals' " . "href='" . esc_url( $IXAP70 ) . "&action=close_referrals" . $IXAP68 . "'>" . "<img class='icon' alt='" . __( 'Close referrals', AFFILIATES_PRO_PLUGIN_DOMAIN) . "' src='". AFFILIATES_PRO_PLUGIN_URL ."images/closed.png'/>" . "<span class='label'>" . __( 'Close Referrals', AFFILIATES_PRO_PLUGIN_DOMAIN) . "</span>" . "</a>"; $IXAP62 .= "</p>"; $IXAP62 .= '<ul>'; $IXAP62 .= '<li>'; $IXAP62 .= __( '<strong>Export</strong> : Export the current totals listing to a file.', AFFILIATES_PRO_PLUGIN_DOMAIN ); $IXAP62 .= '</li>'; $IXAP62 .= '<li>'; $IXAP62 .= __( '<strong>Mass Payment File</strong> : Export the current totals for mass payment compatible with the PayPal file format<sup>*</sup>.', AFFILIATES_PRO_PLUGIN_DOMAIN ); $IXAP62 .= '</li>'; $IXAP62 .= '<li>'; $IXAP62 .= '</ul>'; $IXAP62 .= '<p style="font-size:0.92em">'; $IXAP62 .= sprintf( __( "<sup>*</sup>Note that the PayPal Mass Payment <a target='_blank' href='%s'>File Format</a> allows only one currency type per Mass Payment file.", AFFILIATES_PRO_PLUGIN_DOMAIN ), "https://www.paypal.com/cgi-bin/webscr?cmd=_batch-payment-format-outside" ); $IXAP62 .= ' '; $IXAP62 .= __( 'Use the <em>Currency</em> filter to restrict the listing to one currency.', AFFILIATES_PRO_PLUGIN_DOMAIN ); $IXAP62 .= ' '; $IXAP62 .= __( 'Where a specific PayPal email address is on file for an affiliate, it will be used.', AFFILIATES_PRO_PLUGIN_DOMAIN ); $IXAP62 .= '</p>'; $IXAP62 .= '</div>'; $IXAP75 = array( AFFILIATES_REFERRAL_STATUS_ACCEPTED => __( 'Accepted', AFFILIATES_PLUGIN_DOMAIN ), AFFILIATES_REFERRAL_STATUS_CLOSED => __( 'Closed', AFFILIATES_PLUGIN_DOMAIN ), AFFILIATES_REFERRAL_STATUS_PENDING => __( 'Pending', AFFILIATES_PLUGIN_DOMAIN ), AFFILIATES_REFERRAL_STATUS_REJECTED => __( 'Rejected', AFFILIATES_PLUGIN_DOMAIN ), ); $IXAP288 = '<label class="referral-status-filter" for="referral_status">' . __('Referral Status', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>'; $IXAP288 .= '<select class="referral-status-filter" name="referral_status">'; $IXAP288 .= '<option value="" ' . ( empty( $IXAP41 ) ? ' selected="selected" ' : '' ) . '>--</option>'; foreach ( $IXAP75 as $IXAP78 => $IXAP133 ) { $IXAP289 = $IXAP78 == $IXAP41 ? ' selected="selected" ' : ''; $IXAP288 .= '<option ' . $IXAP289 . ' value="' . esc_attr( $IXAP78 ) . '">' . $IXAP133 . '</option>'; } $IXAP288 .= '</select>'; $IXAP290 = $affiliates_db->get_objects( "SELECT DISTINCT(currency_id) FROM $IXAP49 WHERE currency_id IS NOT NULL" ); $IXAP291 = '<label class="currency-id-filter" for="currency_id">' . __( 'Currency', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>'; $IXAP291 .= '<select class="currency-id-filter" name="currency_id">'; $IXAP291 .= '<option value="" ' . ( empty( $IXAP42 ) ? ' selected="selected" ' : '' ) . '>--</option>'; foreach ( $IXAP290 as $IXAP292 ) { $IXAP289 = $IXAP292->currency_id == $IXAP42 ? ' selected="selected" ' : ''; $IXAP291 .= '<option ' . $IXAP289 . ' value="' . esc_attr( $IXAP292->currency_id ) . '">' . $IXAP292->currency_id . '</option>'; } $IXAP291 .= '</select>'; $IXAP62 .= '<div class="filters">' . '<label class="description" for="setfilters">' . __( 'Filters', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '<form id="setfilters" action="" method="post">' . '<p>' . $IXAP288 . '<label class="minimum-total-filter" for="minimum_total">' . __( 'Minimum Total', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '<input class="minimum-total-filter" name="minimum_total" type="text" value="' . esc_attr( $IXAP40 ) . '"/>' . $IXAP291 . '</p>' . '<p>' . '<label class="affiliate-id-filter" for="affiliate_id">' . __( 'Affiliate Id', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '<input class="affiliate-id-filter" name="affiliate_id" type="text" value="' . esc_attr( $IXAP24 ) . '"/>' . '<label class="affiliate-name-filter" for="affiliate_name">' . __( 'Affiliate Name', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '<input class="affiliate-name-filter" name="affiliate_name" type="text" value="' . $IXAP43 . '"/>' . '<label class="affiliate-user-login-filter" for="affiliate_user_login">' . __( 'Affiliate Username', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '<input class="affiliate-user-login-filter" name="affiliate_user_login" type="text" value="' . $IXAP44 . '" />' . '</p>' . '<p>' . '<label class="from-date-filter" for="from_date">' . __( 'From', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '<input class="datefield from-date-filter" name="from_date" type="text" value="' . esc_attr( $IXAP36 ) . '"/>'. '<label class="thru-date-filter" for="thru_date">' . __( 'Until', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '<input class="datefield thru-date-filter" name="thru_date" type="text" class="datefield" value="' . esc_attr( $IXAP38 ) . '"/>'. '</p>
					<p>' . wp_nonce_field( self::IXAP280, self::IXAP183, true, false ) . '<input class="button" type="submit" value="' . __( 'Apply', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>' . '<input class="button" type="submit" name="clear_filters" value="' . __( 'Clear', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>' . '<input type="hidden" value="submitted" name="submitted"/>' . '</p>' . '</form>' . '</div>'; $IXAP62 .= '
			<div class="page-options">
				<form id="setrowcount" action="" method="post">
					<div>
						<label for="row_count">' . __('Results per page', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '<input name="row_count" type="text" size="2" value="' . esc_attr( $IXAP187 ) .'" />
						' . wp_nonce_field( self::IXAP281, self::IXAP184, true, false ) . '
						<input class="button" type="submit" value="' . __( 'Apply', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>
					</div>
				</form>
			</div>
			'; if ( $IXAP199 ) { $IXAP200 = new Affiliates_Pagination( $IXAP198, null, $IXAP187 ); $IXAP62 .= '<form id="posts-filter" method="post" action="">'; $IXAP62 .= '<div>'; $IXAP62 .= wp_nonce_field( self::IXAP282, self::IXAP185, true, false ); $IXAP62 .= '</div>'; $IXAP62 .= '<div class="tablenav top">'; $IXAP62 .= $IXAP200->pagination( 'top' ); $IXAP62 .= '</div>'; $IXAP62 .= '</form>'; } $IXAP62 .= '
			<table class="wp-list-table widefat fixed" cellspacing="0">
			<thead>
				<tr>
				'; foreach ( $IXAP76 as $IXAP78 => $IXAP79 ) { $IXAP105 = array( 'orderby' => $IXAP78, 'order' => $IXAP191 ); $IXAP143 = $IXAP78; if ( !in_array($IXAP78, array( 'edit', 'remove', 'links' ) ) ) { if ( strcmp( $IXAP78, $IXAP45 ) == 0 ) { $IXAP207 = strtolower( $IXAP46 ); $IXAP143 = "$IXAP78 manage-column sorted $IXAP207"; } else { $IXAP143 = "$IXAP78 manage-column sortable"; } $IXAP79 = '<a href="' . esc_url( add_query_arg( $IXAP105, $IXAP70 ) ) . '"><span>' . $IXAP79 . '</span><span class="sorting-indicator"></span></a>'; } $IXAP62 .= "<th scope='col' class='$IXAP143'>$IXAP79</th>"; } $IXAP62 .= '</tr>
			</thead>
			<tbody>
			'; if ( count( $IXAP55 ) > 0 ) { for ( $IXAP80 = 0; $IXAP80 < count( $IXAP55 ); $IXAP80++ ) { $IXAP15 = $IXAP55[$IXAP80]; $name_suffix = ''; $IXAP293 = ''; if ( $IXAP294 = ( strcmp( $IXAP15->status, 'deleted' ) == 0 ) ) { $IXAP293 = ' deleted '; $name_suffix .= " " . __( '(removed)', AFFILIATES_PRO_PLUGIN_DOMAIN ); } $IXAP295 = ''; if ( $IXAP296 = ! ( ( $IXAP15->from_date <= $IXAP101 ) && ( $IXAP15->thru_date == null || $IXAP15->thru_date >= $IXAP101 ) ) ) { $IXAP295 = ' inoperative '; $name_suffix .= " " . __( '(inoperative)', AFFILIATES_PRO_PLUGIN_DOMAIN ); } $IXAP62 .= '<tr class="' . $IXAP293 . $IXAP295 . ( $IXAP80 % 2 == 0 ? 'even' : 'odd' ) . '">'; $IXAP62 .= "<td class='affiliate-id'>"; if ( affiliates_encode_affiliate_id( $IXAP15->affiliate_id ) != $IXAP15->affiliate_id ) { $IXAP62 .= '<span class="encoded-hint" title="' . affiliates_encode_affiliate_id( $IXAP15->affiliate_id ) . '">' . $IXAP15->affiliate_id . '</span>'; } else { $IXAP62 .= $IXAP15->affiliate_id; } $IXAP62 .= "</td>"; $IXAP62 .= "<td class='affiliate-name'>" . stripslashes( wp_filter_nohtml_kses( $IXAP15->name ) ) . $name_suffix . "</td>"; $IXAP62 .= "<td class='affiliate-email'>" . $IXAP15->email . "</td>"; $IXAP62 .= "<td class='affiliate-user-login'>" . $IXAP15->user_login . "</td>"; $IXAP62 .= "<td class='total'>$IXAP15->total</td>"; $IXAP62 .= "<td class='currency-id'>$IXAP15->currency_id</td>"; $IXAP62 .= '</tr>'; } } else { $IXAP62 .= '<tr><td colspan="' . count( $IXAP76 ) . '">' . __( 'There are no results.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</td></tr>'; } $IXAP62 .= '</tbody>'; $IXAP62 .= '</table>'; if ( $IXAP199 ) { $IXAP200 = new Affiliates_Pagination($IXAP198, null, $IXAP187); $IXAP62 .= '<div class="tablenav bottom">'; $IXAP62 .= $IXAP200->pagination( 'bottom' ); $IXAP62 .= '</div>'; } $IXAP62 .= '</div>'; $IXAP62 .= '</div>'; echo $IXAP62; affiliates_footer(); } } 