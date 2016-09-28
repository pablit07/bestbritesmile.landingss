<?php
class Affiliates_Relations_WordPress extends Affiliates_Relations { public static function view_relations( $IXAP24 ) { global $affiliates_db; $IXAP70 = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; $IXAP45 = isset( $_GET['orderby'] ) ? $_GET['orderby'] : null; $IXAP539 = null; switch ( $IXAP45 ) { case 'from_affiliate_id' : case 'to_affiliate_id' : case 'type' : case 'thru_date' : case 'status' : break; case 'from_affiliate_name' : $IXAP539 = $IXAP45; $IXAP45 = 'fa.name'; break; case 'to_affiliate_name' : $IXAP539 = $IXAP45; $IXAP45 = 'ta.name'; break; case 'from_date' : $IXAP539 = $IXAP45; $IXAP45 = "ar.from_date"; break; default: $IXAP45 = 'from_affiliate_id'; } $IXAP46 = isset( $_GET['order'] ) ? $_GET['order'] : null; switch ( $IXAP46 ) { case 'asc' : case 'ASC' : $IXAP191 = 'DESC'; break; case 'desc' : case 'DESC' : $IXAP191 = 'ASC'; break; default: $IXAP46 = 'ASC'; $IXAP191 = 'DESC'; } $IXAP62 = ''; $IXAP62 .= '<div class="manage-affiliates">' . '<div>' . '<h2>' . __( 'Affiliate Relations', AFFILIATES_ENTERPRISE_PLUGIN_DOMAIN ) . '</h2>' . '</div>'; $IXAP62 .= '<div class="affiliates-relations-overview">'; $IXAP76 = array( 'from_affiliate_id' => __( 'From Id', AFFILIATES_ENTERPRISE_PLUGIN_DOMAIN ), 'from_affiliate_name' => __( 'From', AFFILIATES_ENTERPRISE_PLUGIN_DOMAIN ), 'to_affiliate_id' => __( 'To Id', AFFILIATES_ENTERPRISE_PLUGIN_DOMAIN ), 'to_affiliate_name' => __( 'To', AFFILIATES_ENTERPRISE_PLUGIN_DOMAIN ), 'from_date' => __( 'Valid from', AFFILIATES_ENTERPRISE_PLUGIN_DOMAIN ), ); $IXAP62 .= '
			<table id="" class="wp-list-table widefat fixed" cellspacing="0">
			<thead>
				<tr>
				'; foreach ( $IXAP76 as $IXAP78 => $IXAP79 ) { $IXAP105 = array( 'orderby' => $IXAP78, 'order' => $IXAP191 ); $IXAP143 = $IXAP78; if ( !in_array($IXAP78, array( 'edit', 'remove', 'links' ) ) ) { if ( $IXAP78 == $IXAP45 || $IXAP78 == $IXAP539 ) { $IXAP207 = strtolower( $IXAP46 ); $IXAP143 = "$IXAP78 manage-column sorted $IXAP207"; } else { $IXAP143 = "$IXAP78 manage-column sortable"; } $IXAP79 = '<a href="' . esc_url( add_query_arg( $IXAP105, $IXAP70 ) ) . '"><span>' . $IXAP79 . '</span><span class="sorting-indicator"></span></a>'; } $IXAP62 .= "<th scope='col' class='$IXAP143'>$IXAP79</th>"; } $IXAP62 .= '</tr>
			</thead>
			<tbody>
			'; $IXAP47 = $affiliates_db->get_tablename( "affiliates" ); $IXAP488 = $affiliates_db->get_tablename( "affiliates_relations" ); $IXAP540 = $affiliates_db->get_objects( "SELECT *, fa.name as from_affiliate_name, ta.name as to_affiliate_name FROM $IXAP488 ar
			LEFT JOIN $IXAP47 fa ON from_affiliate_id = fa.affiliate_id
			LEFT JOIN $IXAP47 ta ON to_affiliate_id = ta.affiliate_id
			WHERE from_affiliate_id = %d OR to_affiliate_id = %d
			ORDER BY $IXAP45 $IXAP46", $IXAP24, $IXAP24 ); if ( !empty( $IXAP540 ) ) { $IXAP80 = 0; foreach ( $IXAP540 as $IXAP541 ) { $IXAP515 = affiliates_get_affiliate( $IXAP541->from_affiliate_id ); $IXAP542 = affiliates_get_affiliate( $IXAP541->to_affiliate_id ); $IXAP293 = ''; $IXAP295 = ''; $IXAP62 .= '<tr class="' . $IXAP293 . $IXAP295 . ( $IXAP80 % 2 == 0 ? 'even' : 'odd' ) . '">'; $IXAP62 .= '<td>' . wp_filter_kses( $IXAP541->from_affiliate_id ) . '</td>'; $IXAP62 .= '<td>' . stripslashes( wp_filter_nohtml_kses( $IXAP515['name'] ) ) . '</td>'; $IXAP62 .= '<td>' . wp_filter_kses( $IXAP541->to_affiliate_id ) . '</td>'; $IXAP62 .= '<td>' . stripslashes( wp_filter_nohtml_kses( $IXAP542['name'] ) ) . '</td>'; $IXAP62 .= '<td>' . wp_filter_kses( $IXAP541->from_date ) . '</td>'; $IXAP62 .= '</tr>'; $IXAP80++; } } else { $IXAP62 .= '<tr><td colspan="' . count( $IXAP76 ) . '">' . __('There are no results.', AFFILIATES_ENTERPRISE_PLUGIN_DOMAIN ) . '</td></tr>'; } $IXAP62 .= '</tbody>'; $IXAP62 .= '</table>'; $IXAP62 .= '</div>'; $IXAP62 .= '</div>'; echo $IXAP62; } }