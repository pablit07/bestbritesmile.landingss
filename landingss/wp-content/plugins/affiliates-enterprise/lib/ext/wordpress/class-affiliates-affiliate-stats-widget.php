<?php
 class Affiliates_Affiliate_Stats_Widget extends WP_Widget { function __construct() { parent::__construct( false, $name = 'Affiliates Affiliate Stats' ); } function widget( $args, $IXAP239 ) { if ( !affiliates_user_is_affiliate() ) { return; } extract( $args ); $IXAP81 = isset( $IXAP239['title'] ) ? apply_filters( 'widget_title', $IXAP239['title'] ) : ''; $IXAP240 = $args['widget_id']; echo $before_widget; if ( !empty( $IXAP81 ) ) { echo $before_title . $IXAP81 . $after_title; } $IXAP241 = '-' . $IXAP240; $IXAP105 = array( 'is_widget' => true ); $IXAP105 = array_merge( $IXAP105, $IXAP239 ); echo $this->render_affiliate_stats( $IXAP105, $IXAP240 ); echo $after_widget; } function update( $IXAP242, $IXAP243 ) { $IXAP244 = $IXAP243; if ( !empty( $IXAP242['title'] ) ) { $IXAP244['title'] = strip_tags( $IXAP242['title'] ); } else { unset( $IXAP244['title'] ); } $IXAP245 = array( 'show_totals_accepted', 'show_totals_pending', 'show_totals_closed', 'show_totals_rejected' ); foreach ( $IXAP245 as $IXAP235 ) { if ( !empty( $IXAP242[$IXAP235] ) ) { $IXAP244[$IXAP235] = true; } else { unset( $IXAP244[$IXAP235] ); } } return $IXAP244; } function form( $IXAP239 ) { $IXAP81 = isset( $IXAP239['title'] ) ? esc_attr( $IXAP239['title'] ) : ''; ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', AFFILIATES_PRO_PLUGIN_DOMAIN ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $IXAP81; ?>" />
		</p>
		<?php
 $IXAP226 = isset( $IXAP239['show_totals_accepted'] ) ? $IXAP239['show_totals_accepted'] : false; echo '<input type="checkbox" ' . ( $IXAP226 ? ' checked="checked" ' : '' ) . ' name="' . $this->get_field_name( 'show_totals_accepted' ) . '" id="' . $this->get_field_id( 'show_totals_accepted' ) . '"/>'; echo '<label for="' . $this->get_field_name( 'show_totals_accepted' ) . '">' . __( 'Show totals for accepted referrals', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>'; echo '<br/>'; $IXAP227 = isset( $IXAP239['show_totals_pending'] ) ? $IXAP239['show_totals_pending'] : false; echo '<input type="checkbox" ' . ( $IXAP227 ? ' checked="checked" ' : '' ) . ' name="' . $this->get_field_name( 'show_totals_pending' ) . '" id="' . $this->get_field_id( 'show_totals_pending' ) . '"/>'; echo '<label for="' . $this->get_field_name( 'show_totals_pending' ) . '">' . __( 'Show totals for pending referrals', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>'; echo '<br/>'; $IXAP228 = isset( $IXAP239['show_totals_closed'] ) ? $IXAP239['show_totals_closed'] : false; echo '<input type="checkbox" ' . ( $IXAP228 ? ' checked="checked" ' : '' ) . ' name="' . $this->get_field_name( 'show_totals_closed' ) . '" id="' . $this->get_field_id( 'show_totals_closed' ) . '"/>'; echo '<label for="' . $this->get_field_name( 'show_totals_closed' ) . '">' . __( 'Show totals for closed referrals', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>'; echo '<br/>'; $IXAP229 = isset( $IXAP239['show_totals_rejected'] ) ? $IXAP239['show_totals_rejected'] : false; echo '<input type="checkbox" ' . ( $IXAP229 ? ' checked="checked" ' : '' ) . ' name="' . $this->get_field_name( 'show_totals_rejected' ) . '" id="' . $this->get_field_id( 'show_totals_rejected' ) . '"/>'; echo '<label for="' . $this->get_field_name( 'show_totals_rejected' ) . '">' . __( 'Show totals for rejected referrals', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>'; } public static function render_affiliate_stats( $IXAP105 = array() ) { global $affiliates_db; $IXAP62 = ''; $IXAP24 = Affiliates_Affiliate_WordPress::get_user_affiliate_id(); if ( $IXAP24 === false ) { return $IXAP62; } wp_enqueue_style( 'affiliates' ); wp_enqueue_style( 'affiliates-pro' ); $IXAP47 = $affiliates_db->get_tablename( 'affiliates' ); $IXAP49 = $affiliates_db->get_tablename( 'referrals' ); $IXAP112 = $affiliates_db->get_tablename( 'hits' ); $IXAP117 = affiliates_get_affiliate_visits( $IXAP24 ); $IXAP114 = affiliates_get_affiliate_hits( $IXAP24 ); $IXAP222 = affiliates_get_affiliate_referrals( $IXAP24 ); if ( $IXAP117 > 0 ) { $IXAP223 = round( $IXAP222 / $IXAP117, I_Affiliates_Stats_Renderer::IXAP224 ); } else { $IXAP223 = 0; } $IXAP62 .= '<div class="visits">' . sprintf( _n( '%d Visit', '%d Visits', $IXAP117, AFFILIATES_PRO_PLUGIN_DOMAIN ), $IXAP117 ) . '</div>'; $IXAP62 .= '<div class="hits">' . sprintf( _n( '%d Hit', '%d Hits', $IXAP114, AFFILIATES_PRO_PLUGIN_DOMAIN ), $IXAP114 ) . '</div>'; $IXAP62 .= '<div class="referrals">' . sprintf( _n( '%d Referral', '%d Referrals', $IXAP222, AFFILIATES_PRO_PLUGIN_DOMAIN ), $IXAP222 ) . '</div>'; $IXAP62 .= '<div class="ratio">' . sprintf( __( '%.3f Ratio', AFFILIATES_PRO_PLUGIN_DOMAIN ), $IXAP223 ) . '</div>'; $IXAP225 = isset( $IXAP105['show_totals'] ) ? ( $IXAP105['show_totals'] !== 'false' ) : true; $IXAP226 = isset( $IXAP105['show_totals_accepted'] ) ? ( $IXAP105['show_totals_accepted'] === true || $IXAP105['show_totals_accepted'] === 'true' ) : false; $IXAP227 = isset( $IXAP105['show_totals_pending'] ) ? ( $IXAP105['show_totals_pending'] === true || $IXAP105['show_totals_pending'] === 'true' ) : false; $IXAP228 = isset( $IXAP105['show_totals_closed'] ) ? ( $IXAP105['show_totals_closed'] === true || $IXAP105['show_totals_closed'] === 'true' ) : false; $IXAP229 = isset( $IXAP105['show_totals_rejected'] ) ? ( $IXAP105['show_totals_rejected'] === true || $IXAP105['show_totals_rejected'] === 'true' ) : false; if ( $IXAP225 && ( $IXAP226 || $IXAP227 || $IXAP228 || $IXAP229 ) ) { $IXAP231 = $affiliates_db->get_objects( "SELECT SUM(amount) AS total, currency_id FROM $IXAP49 WHERE affiliate_id = %d AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL GROUP BY currency_id", $IXAP24, AFFILIATES_REFERRAL_STATUS_ACCEPTED ); $IXAP232 = $affiliates_db->get_objects( "SELECT SUM(amount) AS total, currency_id FROM $IXAP49 WHERE affiliate_id = %d AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL GROUP BY currency_id", $IXAP24, AFFILIATES_REFERRAL_STATUS_PENDING ); $IXAP233 = $affiliates_db->get_objects( "SELECT SUM(amount) AS total, currency_id FROM $IXAP49 WHERE affiliate_id = %d AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL GROUP BY currency_id", $IXAP24, AFFILIATES_REFERRAL_STATUS_CLOSED ); $IXAP234 = $affiliates_db->get_objects( "SELECT SUM(amount) AS total, currency_id FROM $IXAP49 WHERE affiliate_id = %d AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL GROUP BY currency_id", $IXAP24, AFFILIATES_REFERRAL_STATUS_REJECTED ); $IXAP62 .= '<div class="totals">'; $IXAP62 .= '<table cellpadding="0" cellspacing="0">'; $IXAP62 .= '<thead>'; $IXAP62 .= '<tr>'; $IXAP62 .= "<th scope='col' class='total'>" . __( 'Total', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; $IXAP62 .= "<th scope='col' class='amount'>" . __( 'Amount', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; $IXAP62 .= "<th scope='col' class='currency'>" . __( 'Currency', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; $IXAP62 .= '</tr>'; $IXAP62 .= '</thead>'; $IXAP62 .= '<tbody>'; if ( $IXAP226 ) { if ( count( $IXAP231 ) == 0 ) { $IXAP231[] = (object) array( 'total' => '--', 'currency_id' => '--' ); } foreach ( $IXAP231 as $IXAP235 ) { $IXAP62 .= '<tr>'; $IXAP62 .= "<td class='total accepted'>" . __( 'Accepted', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; $IXAP62 .= "<td class='amount'>$IXAP235->total</td>"; $IXAP62 .= "<td class='currency'>$IXAP235->currency_id</td>"; $IXAP62 .= '</tr>'; } } if ( $IXAP227 ) { if ( count( $IXAP232 ) == 0 ) { $IXAP232[] = (object) array( 'total' => '--', 'currency_id' => '--' ); } foreach ( $IXAP232 as $IXAP235 ) { $IXAP62 .= '<tr>'; $IXAP62 .= "<td class='total pending'>" . __( 'Pending', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; $IXAP62 .= "<td class='amount'>$IXAP235->total</td>"; $IXAP62 .= "<td class='currency'>$IXAP235->currency_id</td>"; $IXAP62 .= '</tr>'; } } if ( $IXAP228 ) { if ( count( $IXAP233 ) == 0 ) { $IXAP233[] = (object) array( 'total' => '--', 'currency_id' => '--' ); } foreach ( $IXAP233 as $IXAP235 ) { $IXAP62 .= '<tr>'; $IXAP62 .= "<td class='total closed'>" . __( 'Closed', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; $IXAP62 .= "<td class='amount'>$IXAP235->total</td>"; $IXAP62 .= "<td class='currency'>$IXAP235->currency_id</td>"; $IXAP62 .= '</tr>'; } } if ( $IXAP229 ) { if ( count( $IXAP234 ) == 0 ) { $IXAP234[] = (object) array( 'total' => '--', 'currency_id' => '--' ); } foreach ( $IXAP234 as $IXAP235 ) { $IXAP62 .= '<tr>'; $IXAP62 .= "<td class='total rejected'>" . __( 'Rejected', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; $IXAP62 .= "<td class='amount'>$IXAP235->total</td>"; $IXAP62 .= "<td class='currency'>$IXAP235->currency_id</td>"; $IXAP62 .= '</tr>'; } } $IXAP62 .= '</tbody>'; $IXAP62 .= '</table>'; $IXAP62 .= '</div>'; } return $IXAP62; } }?>