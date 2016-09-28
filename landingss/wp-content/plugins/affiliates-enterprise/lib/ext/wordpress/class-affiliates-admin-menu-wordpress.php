<?php
 class Affiliates_Admin_Menu_WordPress { const IXAP183 = 'aff-admin-menu'; const IXAP297 = 'aff-settings'; public static function init() { add_action( 'affiliates_admin_menu', array( __CLASS__, 'affiliates_admin_menu' ) ); add_action( 'affiliates_admin_menu', array( __CLASS__, 'affiliates_admin_menu_sort' ), 999 ); add_filter( 'affiliates_settings_sections', array( __CLASS__, 'affiliates_settings_sections' ) ); add_action( 'affiliates_settings_section', array( __CLASS__, 'affiliates_settings_section' ) ); add_filter( 'affiliates_help_tab_footer', array( __CLASS__, 'affiliates_help_tab_footer' ) ); add_filter( 'affiliates_help_tab_title', array( __CLASS__, 'affiliates_help_tab_title' ) ); } public static function affiliates_settings_sections( $IXAP298 ) { $IXAP298['commissions'] = __( 'Commissions', AFFILIATES_PRO_PLUGIN_DOMAIN ); return $IXAP298; } public static function affiliates_settings_section( $IXAP299 ) { if ( $IXAP299 == 'commissions' ) { self::affiliates_admin_settings(); } } public static function affiliates_admin_menu() { global $submenu; $IXAP300 = get_post_type_object( 'affiliates_banner' ); $IXAP20 = add_submenu_page( 'affiliates-admin', $IXAP300->labels->name, $IXAP300->labels->all_items, $IXAP300->cap->edit_posts, "edit.php?post_type=affiliates_banner" ); $IXAP19[] = $IXAP20; $IXAP20 = add_submenu_page( 'affiliates-admin', __( 'Notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ), __( 'Notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ), AFFILIATES_ADMINISTER_OPTIONS, 'affiliates-admin-notifications', array( __CLASS__, 'affiliates_admin_notifications' ) ); $IXAP19[] = $IXAP20; add_action( 'admin_print_styles-' . $IXAP20, 'affiliates_admin_print_styles' ); add_action( 'admin_print_scripts-' . $IXAP20, 'affiliates_admin_print_scripts' ); add_action( 'admin_print_styles-' . $IXAP20, 'affiliates_pro_admin_print_styles' ); add_action( 'admin_print_scripts-' . $IXAP20, 'affiliates_pro_admin_print_scripts' ); add_action( 'load-' . $IXAP20, array( __CLASS__, 'load_page' ) ); $IXAP20 = add_submenu_page( 'affiliates-admin', __( 'Totals', AFFILIATES_PRO_PLUGIN_DOMAIN ), __( 'Totals', AFFILIATES_PRO_PLUGIN_DOMAIN ), AFFILIATES_ACCESS_AFFILIATES, 'affiliates-admin-totals', array( 'Affiliates_Totals_WordPress', 'view' ) ); $IXAP19[] = $IXAP20; add_action( 'admin_print_styles-' . $IXAP20, 'affiliates_admin_print_styles' ); add_action( 'admin_print_scripts-' . $IXAP20, 'affiliates_admin_print_scripts' ); add_action( 'admin_print_styles-' . $IXAP20, 'affiliates_pro_admin_print_styles' ); add_action( 'admin_print_scripts-' . $IXAP20, 'affiliates_pro_admin_print_scripts' ); } public static function affiliates_admin_menu_sort() { global $submenu; if ( isset( $submenu['affiliates-admin'] )) { usort($submenu['affiliates-admin'], array( __CLASS__, 'menu_sort' ) ); } } public static function menu_sort( $IXAP215, $IXAP216 ) { global $submenu; $IXAP15 = 0; $IXAP301 = array( 'affiliates-admin' => 0, 'affiliates-admin-affiliates' => 1, 'affiliates-admin-hits' => 2, 'affiliates-admin-hits-affiliate' => 3, 'affiliates-admin-referrals' => 4, 'affiliates-admin-options' => 100, 'affiliates-admin-user-registration' => 1000, 'edit.php?post_type=affiliates_banner' => 50, 'affiliates-admin-settings' => 200, 'affiliates-admin-notifications' => 300, 'affiliates-admin-totals' => 10, 'affiliates-admin-tiers' => 2000, 'affiliates-admin-campaigns' => 2100, 'affiliates-admin-add-ons' => 9999 ); if ( isset( $IXAP215[2] ) && isset( $IXAP216[2] ) ) { if ( isset( $IXAP301[$IXAP215[2]] ) && isset( $IXAP301[$IXAP216[2]] ) ) { $IXAP15 = $IXAP301[$IXAP215[2]] - $IXAP301[$IXAP216[2]]; } } return $IXAP15; } public static function affiliates_admin_settings() { if ( !current_user_can( AFFILIATES_ADMINISTER_OPTIONS ) ) { wp_die( __( 'Access denied.', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); } echo '<div style="margin: 1em 1em 1em inherit; padding:0.31em 0.62em; background-color:#fff;">'; echo '<p>'; echo '<strong>'; echo __( 'Which method to choose &hellip;', AFFILIATES_PRO_PLUGIN_DOMAIN ); echo '</strong>'; echo '</p>'; echo '<p>'; echo __( 'The most commonly used method is <em>Referral Rate</em>, corresponding to the typical case where affiliates are granted commissions in proportion to the purchase amount.', AFFILIATES_PRO_PLUGIN_DOMAIN ); echo '</p>'; echo '<ul>'; echo '<li>'; echo '<em>' . __( 'Referral Rate', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</em>'; echo ' &mdash; '; echo __( 'The commission amount is proportional to the amount of the originating transaction.', AFFILIATES_PRO_PLUGIN_DOMAIN ); echo ' '; echo __( 'This is recommended if commissions are a percentage of sales amounts.', AFFILIATES_PRO_PLUGIN_DOMAIN ); echo ' '; echo __( 'Note that the value indicated is a rate, for example, to grant 10% commissions on sales, indicate <code>0.10</code> as the value.', AFFILIATES_PRO_PLUGIN_DOMAIN ); echo ' '; echo __( 'Also note that if the value is equal to or greater than <code>1</code>, this would grant a commission amount higher than the actual (net) purchase amount &ndash; a case which is normally not desired.', AFFILIATES_PRO_PLUGIN_DOMAIN ); echo ' '; echo __( 'Using <code>0</code> results in zero commission amounts.', AFFILIATES_PRO_PLUGIN_DOMAIN ); echo '</li>'; echo '<li>'; echo '<em>' . __( 'Referral Amount', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</em>'; echo ' &mdash; '; echo __( 'A fixed commission amount is attributed with each referral.', AFFILIATES_PRO_PLUGIN_DOMAIN ); echo '</li>'; echo '<li>'; echo '<em>' . __( 'Referral Amount Method', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</em>'; echo ' &mdash; '; echo __( 'The commission amount is calculated by a specific algorithm.', AFFILIATES_PRO_PLUGIN_DOMAIN ); echo '</li>'; echo '</ul>'; echo '</div>'; $IXAP302 = Affiliates_Referral::get_referral_amount_methods(); $IXAP176 = array(); foreach ( $IXAP302 as $IXAP178 ) { if ( is_array( $IXAP178 ) ) { $IXAP133 = implode( "::", $IXAP178 ); } else { $IXAP133 = $IXAP178; } $IXAP176[$IXAP133] = $IXAP133; } $IXAP176 = array_merge( array( '' => __( 'None', AFFILIATES_PRO_PLUGIN_DOMAIN ) ), $IXAP176 ); if ( isset( $_POST['submit'] ) ) { if ( wp_verify_nonce( $_POST[self::IXAP183], self::IXAP297 ) ) { if ( !empty( $_POST[Affiliates_Referral::IXAP13] ) ) { $IXAP303 = trim( $_POST[Affiliates_Referral::IXAP13] ); if ( $IXAP303 = Affiliates_Attributes::validate_key( $IXAP303 ) ) { update_option( Affiliates_Referral::IXAP13, $IXAP303 ); } else { $IXAP303 = ''; delete_option( Affiliates_Referral::IXAP13 ); } } else { $IXAP303 = ''; delete_option( Affiliates_Referral::IXAP13 ); } if ( !empty( $_POST[Affiliates_Referral::IXAP14] ) ) { $IXAP304 = trim( $_POST[Affiliates_Referral::IXAP14] ); if ( $IXAP304 = Affiliates_Attributes::validate_value( $IXAP303, $IXAP304 ) ) { update_option( Affiliates_Referral::IXAP14, $IXAP304 ); } else { $IXAP304 = ''; delete_option( Affiliates_Referral::IXAP14 ); } } else { $IXAP304 = ''; delete_option( Affiliates_Referral::IXAP14 ); } } } $IXAP303 = get_option( Affiliates_Referral::IXAP13, '' ); $IXAP304 = get_option( Affiliates_Referral::IXAP14, '' ); $IXAP305 = array_merge( array( '' => __( 'None', AFFILIATES_PRO_PLUGIN_DOMAIN ) ), Affiliates_Attributes::get_keys() ); unset( $IXAP305[Affiliates_Attributes::IXAP58] ); unset( $IXAP305[Affiliates_Attributes::IXAP86] ); $IXAP306 = '<select id ="' . Affiliates_Referral::IXAP13 . '" name="' . Affiliates_Referral::IXAP13 . '">'; foreach ( $IXAP305 as $IXAP78 => $IXAP87 ) { $IXAP289 = ( $IXAP78 == $IXAP303 ) ? ' selected="selected" ' : ''; $IXAP306 .= '<option value="' . $IXAP78 . '" ' . $IXAP289 . '>' . $IXAP87 . '</option>'; } $IXAP306 .= '</select>'; $IXAP307 = '<input name="' . Affiliates_Referral::IXAP14 . '" type="text" value="' . esc_attr( !is_array( $IXAP304 ) ? $IXAP304 : '' ) . '" />'; $IXAP308 = '<select name="' . Affiliates_Referral::IXAP14 . '">'; foreach ( $IXAP176 as $IXAP78 => $IXAP133 ) { $IXAP289 = ( Affiliates_Referral::get_referral_amount_method( $IXAP78 ) == Affiliates_Referral::get_referral_amount_method( $IXAP304 ) ) ? ' selected="selected" ' : ''; $IXAP308 .= '<option value="' . $IXAP78 . '" ' . $IXAP289 . '>' . $IXAP133 . '</option>'; } $IXAP308 .= '</select>'; switch ( $IXAP303 ) { case Affiliates_Attributes::IXAP84 : $IXAP309 = $IXAP308; break; default: $IXAP309 = $IXAP307; } echo '<form action="" name="options" method="post">' . '<div>' . '<p class="description">' . __( 'These settings are used to calculate commissions for affiliates in general.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' . '<p>' . sprintf( '<label title="%s" for="' . Affiliates_Referral::IXAP13 . '">', __( 'Default referral calculation', AFFILIATES_PRO_PLUGIN_DOMAIN ) ) . __( 'Method', AFFILIATES_PRO_PLUGIN_DOMAIN ) . ' ' . $IXAP306 . '</label>' . '</p>' . '<p>' . sprintf( '<label title="%s" for="' . Affiliates_Referral::IXAP14 . '">', __( 'Default referral calculation value', AFFILIATES_PRO_PLUGIN_DOMAIN ) ) . __( 'Value', AFFILIATES_PRO_PLUGIN_DOMAIN ) . ' <span id="method-value-input-container">'. $IXAP309 . '</span>' . '</label>' . '</p>' . '<p>' . wp_nonce_field( self::IXAP297, self::IXAP183, true, false ) . '<input class="button button-primary" type="submit" name="submit" value="' . __( 'Save', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>' . '</p>' . '</div>' . '</form>'; echo '<script type="text/javascript">'; echo 'if (typeof jQuery !== "undefined" ) {'; echo 'jQuery("#'.Affiliates_Referral::IXAP13.'").change(function(e){'; echo sprintf( 'if ( jQuery(this).val() == "%s" ) {', Affiliates_Attributes::IXAP84 ); echo sprintf( 'jQuery("#method-value-input-container").html(\'%s\');', $IXAP308 ); echo '} else {'; echo sprintf( 'jQuery("#method-value-input-container").html(\'%s\');', $IXAP307 ); echo '}'; echo '});'; echo '}'; echo '</script>'; affiliates_footer(); } public static function affiliates_admin_totals() { } public static function affiliates_admin_notifications() { if ( !current_user_can( AFFILIATES_ADMINISTER_OPTIONS ) ) { wp_die( __( 'Access denied.', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); } include_once( dirname( AFFILIATES_PRO_FILE ) . '/lib/ext/includes/class-affiliates-notifications.php' ); $IXAP310 = get_option( 'affiliates_notifications', null ); if ( $IXAP310 === null ) { add_option('affiliates_notifications', array(), null, 'no' ); } if ( isset( $_POST['submit'] ) ) { if ( wp_verify_nonce( $_POST[self::IXAP183], self::IXAP297 ) ) { $IXAP310[Affiliates_Notifications::IXAP311] = !empty( $_POST[Affiliates_Notifications::IXAP311] ); if ( !empty( $_POST[Affiliates_Notifications::IXAP312] ) ) { $IXAP310[Affiliates_Notifications::IXAP312] = wp_filter_nohtml_kses( $_POST[Affiliates_Notifications::IXAP312] ); } else { $IXAP310[Affiliates_Notifications::IXAP312] = Affiliates_Notifications::IXAP313; } if ( !empty( $_POST[Affiliates_Notifications::IXAP314] ) ) { $IXAP310[Affiliates_Notifications::IXAP314] = $_POST[Affiliates_Notifications::IXAP314]; } else { $IXAP310[Affiliates_Notifications::IXAP314] = Affiliates_Notifications::IXAP315; } $IXAP310[Affiliates_Notifications::IXAP316] = !empty( $_POST[Affiliates_Notifications::IXAP316] ); $IXAP310[Affiliates_Notifications::IXAP317] = !empty( $_POST[Affiliates_Notifications::IXAP317] ); if ( !empty( $_POST[Affiliates_Notifications::IXAP318] ) ) { if ( $IXAP319 = filter_var( $_POST[Affiliates_Notifications::IXAP318], FILTER_VALIDATE_EMAIL ) ) { $IXAP310[Affiliates_Notifications::IXAP318] = $IXAP319; } else { $IXAP310[Affiliates_Notifications::IXAP318] = ''; } } else { $IXAP310[Affiliates_Notifications::IXAP318] = ''; } $IXAP320 = array(); if ( !empty( $_POST['notify_admin_status_accepted'] ) ) { $IXAP320[] = AFFILIATES_REFERRAL_STATUS_ACCEPTED; } if ( !empty( $_POST['notify_admin_status_pending'] ) ) { $IXAP320[] = AFFILIATES_REFERRAL_STATUS_PENDING; } $IXAP310[Affiliates_Notifications::IXAP321] = $IXAP320; if ( !empty( $_POST[Affiliates_Notifications::IXAP322] ) ) { $IXAP310[Affiliates_Notifications::IXAP322] = wp_filter_nohtml_kses( $_POST[Affiliates_Notifications::IXAP322] ); } else { $IXAP310[Affiliates_Notifications::IXAP322] = Affiliates_Notifications::IXAP323; } if ( !empty( $_POST[Affiliates_Notifications::IXAP324] ) ) { $IXAP310[Affiliates_Notifications::IXAP324] = $_POST[Affiliates_Notifications::IXAP324]; } else { $IXAP310[Affiliates_Notifications::IXAP324] = Affiliates_Notifications::IXAP325; } $IXAP310[Affiliates_Notifications::IXAP326] = !empty( $_POST[Affiliates_Notifications::IXAP326] ); $IXAP327 = array(); if ( !empty( $_POST['notify_affiliate_status_accepted'] ) ) { $IXAP327[] = AFFILIATES_REFERRAL_STATUS_ACCEPTED; } if ( !empty( $_POST['notify_affiliate_status_pending'] ) ) { $IXAP327[] = AFFILIATES_REFERRAL_STATUS_PENDING; } $IXAP310[Affiliates_Notifications::IXAP328] = $IXAP327; if ( !empty( $_POST[Affiliates_Notifications::IXAP329] ) ) { $IXAP310[Affiliates_Notifications::IXAP329] = wp_filter_nohtml_kses( $_POST[Affiliates_Notifications::IXAP329] ); } else { $IXAP310[Affiliates_Notifications::IXAP329] = Affiliates_Notifications::IXAP330; } if ( !empty( $_POST[Affiliates_Notifications::MESSAGE] ) ) { $IXAP310[Affiliates_Notifications::MESSAGE] = $_POST[Affiliates_Notifications::MESSAGE]; } else { $IXAP310[Affiliates_Notifications::MESSAGE] = Affiliates_Notifications::IXAP331; } update_option( 'affiliates_notifications', $IXAP310 ); } } $IXAP332 = isset( $IXAP310[Affiliates_Notifications::IXAP311] ) ? $IXAP310[Affiliates_Notifications::IXAP311] : Affiliates_Notifications::IXAP333; $IXAP334 = isset( $IXAP310[Affiliates_Notifications::IXAP312] ) ? $IXAP310[Affiliates_Notifications::IXAP312] : Affiliates_Notifications::IXAP313; $IXAP335 = isset( $IXAP310[Affiliates_Notifications::IXAP314] ) ? $IXAP310[Affiliates_Notifications::IXAP314] : Affiliates_Notifications::IXAP315; $IXAP336 = isset( $IXAP310[Affiliates_Notifications::IXAP316] ) && $IXAP310[Affiliates_Notifications::IXAP316]; $IXAP337 = isset( $IXAP310[Affiliates_Notifications::IXAP317] ) && $IXAP310[Affiliates_Notifications::IXAP317]; $IXAP319 = isset( $IXAP310[Affiliates_Notifications::IXAP318] ) ? $IXAP310[Affiliates_Notifications::IXAP318] : ''; $IXAP320 = isset( $IXAP310[Affiliates_Notifications::IXAP321] ) ? $IXAP310[Affiliates_Notifications::IXAP321] : array( AFFILIATES_REFERRAL_STATUS_ACCEPTED ); $IXAP338 = isset( $IXAP310[Affiliates_Notifications::IXAP322] ) ? $IXAP310[Affiliates_Notifications::IXAP322] : Affiliates_Notifications::IXAP323; $IXAP339 = isset( $IXAP310[Affiliates_Notifications::IXAP324] ) ? $IXAP310[Affiliates_Notifications::IXAP324] : Affiliates_Notifications::IXAP325; $IXAP340 = isset( $IXAP310[Affiliates_Notifications::IXAP326] ) && $IXAP310[Affiliates_Notifications::IXAP326]; $IXAP327 = isset( $IXAP310[Affiliates_Notifications::IXAP328] ) ? $IXAP310[Affiliates_Notifications::IXAP328] : array( AFFILIATES_REFERRAL_STATUS_ACCEPTED ); $IXAP341 = isset( $IXAP310[Affiliates_Notifications::IXAP329] ) ? $IXAP310[Affiliates_Notifications::IXAP329] : Affiliates_Notifications::IXAP330; $message = isset( $IXAP310[Affiliates_Notifications::MESSAGE] ) ? $IXAP310[Affiliates_Notifications::MESSAGE] : Affiliates_Notifications::IXAP331; echo '<div class="notifications">'; echo '<div class="manage">'; echo '<h1>' . __( 'Notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h1>'; echo '<p>' . __( 'Notifications for the site administrator and affiliates can be enabled here. If the integration used provides its own notification settings, enable these through the integration&rsquo;s settings or here. Do not enable them both, as that could cause duplicate notifications to be sent.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>'; echo '<form action="" name="notifications" method="post">' . '<div>' . '<input class="button button-primary" type="submit" name="submit" value="' . __( 'Save', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>' . '<h2>' . __( 'Affiliate Registration', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h2>' . '<h3>' . __( 'Enable registration notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h3>' . '<p>' . '<label>' . '<input type="checkbox" name="' . Affiliates_Notifications::IXAP311 . '" id="' . Affiliates_Notifications::IXAP311 . '" ' . ( $IXAP332 ? ' checked="checked" ' : '' ) . '/>' . __( 'Enable registration emails', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '</p>' . '<p class="description">' . __( 'Send new affiliates an email when their user account is created.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . ' ' . __( 'This should normally be enabled, so that new affiliates receives their username and password to be able to log in and access their account.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' . '<p>' . '<label>' . __( 'Subject', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '<br/>' . '<input class="' . Affiliates_Notifications::IXAP312 . '" name="' . Affiliates_Notifications::IXAP312 . '" type="text" value="' . esc_attr( stripslashes( $IXAP334 ) ) . '" />' . '</label>' . '</p>' . '<p>' . '<label> ' . __( 'Message', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '<br/>' . '<textarea class="' . Affiliates_Notifications::IXAP314 . '" id="' . Affiliates_Notifications::IXAP314 . '" name="' . Affiliates_Notifications::IXAP314 . '" rows="10">' . htmlentities( stripslashes( $IXAP335 ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</textarea>' . '</label>' . '</p>' . '<h2>' . __( 'Referral Notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h2>' . '<h3>' . __( 'Enable notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h3>' . '<p>' . '<label>' . '<input type="checkbox" name="' . Affiliates_Notifications::IXAP316 . '" id="' . Affiliates_Notifications::IXAP316 . '" ' . ( $IXAP336 ? ' checked="checked" ' : '' ) . '/>' . __( 'Enable notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '</p>' . '<p class="description">' . __( 'Notifications will only be sent if this option is activated.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' . '<h3>' . __( 'Administrator notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h3>' . '<p>' . '<label>' . '<input type="checkbox" name="' . Affiliates_Notifications::IXAP317 . '" id="' . Affiliates_Notifications::IXAP317 . '" ' . ( $IXAP337 ? ' checked="checked" ' : '' ) . '/>' . __( 'Notify the site administrator', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '</p>' . '<p class="description">' . __( 'Notifications will be sent to the email address specified in <em>Settings > General</em>, or if indicated, to the email address specified here.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' . '<p>' . '<label>' . __( 'Administrator Email Address', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '<br/>' . sprintf( '<input class="%s" name="%s" type="text" value="%s" placeholder="%s"/>', esc_attr( Affiliates_Notifications::IXAP318 ), esc_attr( Affiliates_Notifications::IXAP318 ), esc_attr( $IXAP319 ), get_bloginfo( 'admin_email' ) ) . '</label>' . '</p>' . '<p>' . __( 'Notify when a referral is: ', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '<label>' . sprintf( '<input type="checkbox" name="notify_admin_status_accepted" %s />', in_array( AFFILIATES_REFERRAL_STATUS_ACCEPTED, $IXAP320 ) ? ' checked="checked" ' : '' ) . __( 'Accepted', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . ' ' . '<label>' . sprintf( '<input type="checkbox" name="notify_admin_status_pending" %s />', in_array( AFFILIATES_REFERRAL_STATUS_PENDING, $IXAP320 ) ? ' checked="checked" ' : '' ) . __( 'Pending', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '</p>' . '<ul class="description">' . '<li>' . __( 'Notifications on referral status updates are only sent when the status changes from <em>pending</em> to <em>accepted</em>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li>' . __( 'More than one notification may be sent if multiple statuses are enabled.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li>' . __( 'Notifications on referral status updates may not be supported by all integrations.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '</ul>' . '<p>' . '<label>' . __( 'Subject', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '<br/>' . '<input class="' . Affiliates_Notifications::IXAP322 . '" name="' . Affiliates_Notifications::IXAP322 . '" type="text" value="' . esc_attr( stripslashes( $IXAP338 ) ) . '" />' . '</label>' . '</p>' . '<p>' . '<label> ' . __( 'Message', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '<br/>' . '<textarea class="message" id="' . Affiliates_Notifications::IXAP324 . '" name="' . Affiliates_Notifications::IXAP324 . '" rows="10">' . htmlentities( stripslashes( $IXAP339 ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</textarea>' . '</label>' . '</p>' . '<h3>' . __( 'Affiliate notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h3>' . '<p>' . '<label>' . '<input type="checkbox" name="' . Affiliates_Notifications::IXAP326 . '" id="' . Affiliates_Notifications::IXAP326 . '" ' . ( $IXAP340 ? ' checked="checked" ' : '' ) . '/>' . __( 'Notify the affiliates', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '</p>' . '<p class="description">' . __( 'Notifications will be sent to affiliates when credited with a referral.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' . '<p>' . __( 'Notify when a referral is: ', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '<label>' . sprintf( '<input type="checkbox" name="notify_affiliate_status_accepted" %s />', in_array( AFFILIATES_REFERRAL_STATUS_ACCEPTED, $IXAP327 ) ? ' checked="checked" ' : '' ) . __( 'Accepted', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . ' ' . '<label>' . sprintf( '<input type="checkbox" name="notify_affiliate_status_pending" %s />', in_array( AFFILIATES_REFERRAL_STATUS_PENDING, $IXAP327 ) ? ' checked="checked" ' : '' ) . __( 'Pending', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '</p>' . '<ul class="description">' . '<li>' . __( 'Notifications on referral status updates are only sent when the status changes from <em>pending</em> to <em>accepted</em>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li>' . __( 'More than one notification may be sent if multiple statuses are enabled.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li>' . __( 'Notifications on referral status updates may not be supported by all integrations.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '</ul>' . '<p>' . '<label>' . __( 'Subject', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '<br/>' . '<input class="' . Affiliates_Notifications::IXAP329 . '" name="' . Affiliates_Notifications::IXAP329 . '" type="text" value="' . esc_attr( stripslashes( $IXAP341 ) ) . '" />' . '</label>' . '</p>' . '<p>' . '<label> ' . __( 'Message', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '<br/>' . '<textarea class="' . Affiliates_Notifications::MESSAGE . '" id="' . Affiliates_Notifications::MESSAGE . '" name="' . Affiliates_Notifications::MESSAGE . '" rows="10">' . htmlentities( stripslashes( $message ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</textarea>' . '</label>' . '</p>' . '<p>' . wp_nonce_field( self::IXAP297, self::IXAP183, true, false ) . '<input class="button button-primary" type="submit" name="submit" value="' . __( 'Save', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>' . '</p>' . '</div>' . '</form>' . '</div>'; echo '</div>'; affiliates_footer(); } public static function load_page() { $IXAP342 = get_current_screen(); if ( isset( $IXAP342->id ) ) { switch ( $IXAP342->id ) { case 'affiliates_page_affiliates-admin-notifications' : $IXAP342->add_help_tab( array( 'id' => 'affiliates-admin-notifications-affiliate-registration', 'title' => __( 'Affiliate Registration', AFFILIATES_PRO_PLUGIN_DOMAIN ) , 'content' => self::get_notifications_help_affiliate_registration() ) ); $IXAP342->add_help_tab( array( 'id' => 'affiliates-admin-notifications-referral-notifications', 'title' => __( 'Referral Notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ) , 'content' => self::get_notifications_help_referral_notifications() ) ); break; } } } private static function get_notifications_help_affiliate_registration() { return '<div class="manage">' . '<h2>' . __( 'Affiliates Registration', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h2>' . '<h3>' . __( 'Message format and tokens', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h3>' . '<p class="description">' . __( 'The message format is HTML and line breaks must be indicated by <code>&lt;br/&gt;</code>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '<p class="description">' . __( 'These default tokens can be used in the subjects and the messages:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '<ul>' . '<li><code>[site_title]</code> : '. wp_specialchars_decode( get_bloginfo( 'blogname' ), ENT_QUOTES ) . '</li>' . '<li><code>[site_url]</code> : '. htmlentities( get_bloginfo( 'url' ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</li>' . '<li><code>[site_login_url]</code> : '. htmlentities( wp_login_url(), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</li>' . '<li><code>[username]</code> : ' . __( 'The username for the new affiliate user account.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li><code>[password]</code> : '. __( 'The password for the new affiliate user account.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li><code>[user_id]</code> : '. __( 'The ID of the new affiliate user account. This is the user ID, not the affiliate ID.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li><code>[blogname]</code> : '. __( 'Same as [site_title].', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '</ul>' . '</p>' . '<h3>' . __( 'Default subject and message', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h4>' . '<p class="description">' . __( 'Subject:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' . '<pre>' . htmlentities( stripslashes( Affiliates_Notifications::IXAP313 ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</pre>' . '<p class="description">' . __( 'Message:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' . '<pre>' . htmlentities( stripslashes( Affiliates_Notifications::IXAP315 ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</pre>' . '</div>' . self::get_help_tab_footer(); } private static function get_notifications_help_referral_notifications() { return '<div class="manage">' . '<h3>' . __( 'Message format and tokens', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h3>' . '<p class="description">' . __( 'The message format is HTML and line breaks must be indicated by <code>&lt;br/&gt;</code>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '<p class="description">' . __( 'These default tokens can be used in the subjects and the messages:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '<ul>' . '<li><code>[site_title]</code> : '. wp_specialchars_decode( get_bloginfo( 'blogname' ), ENT_QUOTES ) . '</li>' . '<li><code>[site_url]</code> : '. htmlentities( get_bloginfo( 'url' ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</li>' . '<li><code>[affiliate_id]</code> : ' . __( 'The referring affiliate&rsquo;s ID', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li><code>[affiliate_email]</code> : '. __( 'The referring affiliate&rsquo;s email address', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li><code>[affiliate_name]</code> : '. __( 'The referring affiliate&rsquo;s name', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li><code>[referral_status]</code> : '. __( 'The current referral status', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li><code>[referral_amount]</code> : '. __( 'The referral amount', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li><code>[referral_currency_id]</code> : '. __( 'The referral currency ID', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li><code>[referral_type]</code> : '. __( 'The referral type (an internal reference)', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '<li><code>[referral_reference]</code> : '. __( 'The referral reference (an internal reference normally related to the originating transaction)', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' . '</ul>' . '</p>' . '<p class="description">' . __( 'Integration-specific data tokens can also be used in the subject and message.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' . '<h4>' . __( 'Default subjects and messages', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h4>' . '<p class="description">' . __( 'Administrator subject:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' . '<pre>' . htmlentities( Affiliates_Notifications::IXAP323, ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</pre>' . '<p class="description">' . __( 'Administrator message:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' . '<pre>' . htmlentities( stripslashes( Affiliates_Notifications::IXAP325 ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</pre>' . '<p class="description">' . __( 'Affiliate subject:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' . '<pre>' . htmlentities( Affiliates_Notifications::IXAP330, ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</pre>' . '<p class="description">' . __( 'Affiliate message:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' . '<pre>' . htmlentities( stripslashes( Affiliates_Notifications::IXAP331 ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</pre>' . '</div>' . self::get_help_tab_footer(); } private static function get_help_tab_footer() { $IXAP18 = '<div class="affiliates-documentation">'; if ( AFFILIATES_PLUGIN_NAME == 'affiliates-enterprise' ) { $IXAP18 .= sprintf( '<a href="%s">%s</a>', esc_attr( 'http://docs.itthinx.com/document/affiliates-enterprise/' ), esc_html( __( 'Online documentation', AFFILIATES_PRO_PLUGIN_DOMAIN ) ) ); } else { $IXAP18 .= sprintf( '<a href="%s">%s</a>', esc_attr( 'http://docs.itthinx.com/document/affiliates-pro/' ), esc_html( __( 'Online documentation', AFFILIATES_PRO_PLUGIN_DOMAIN ) ) ); } $IXAP18 .= '</div>'; return $IXAP18; } public static function affiliates_help_tab_footer( $IXAP18 ) { return self::get_help_tab_footer(); } public static function affiliates_help_tab_title( $IXAP81 ) { $IXAP81 = '<h3>'; if ( AFFILIATES_PLUGIN_NAME == 'affiliates-enterprise' ) { $IXAP81 .= __( 'Affiliates Enterprise', AFFILIATES_PRO_PLUGIN_DOMAIN ); } else { $IXAP81 .= __( 'Affiliates Pro', AFFILIATES_PRO_PLUGIN_DOMAIN ); } $IXAP81 .= '</h3>'; return $IXAP81; } } Affiliates_Admin_Menu_WordPress::init(); 