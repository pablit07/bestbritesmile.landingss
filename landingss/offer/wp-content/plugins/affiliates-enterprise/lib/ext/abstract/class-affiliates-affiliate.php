<?php
	
/**
 * Copyright (c) "kento" Karim Rahimpur www.itthinx.com
 * 
 * This code is provided subject to the license granted.
 *
 * UNAUTHORIZED USE AND DISTRIBUTION IS PROHIBITED.
 *
 * See COPYRIGHT.txt and LICENSE.txt
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * This header and all notices must be kept intact.
 */

	
	
/**
 * Copyright (c) "kento" Karim Rahimpur www.itthinx.com
 * 
 * This code is provided subject to the license granted.
 *
 * UNAUTHORIZED USE AND DISTRIBUTION IS PROHIBITED.
 *
 * See COPYRIGHT.txt and LICENSE.txt
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * This header and all notices must be kept intact.
 */

	
 abstract class Affiliates_Affiliate implements I_Affiliates_Affiliate { public static function get_affiliate( $IXAP24 ) { global $affiliates_db; $IXAP47 = $affiliates_db->get_tablename( 'affiliates' ); $IXAP29 = $affiliates_db->get_objects( "SELECT * FROM $IXAP47 WHERE affiliate_id = %d", $IXAP24 ); if ( !empty( $IXAP29 ) ) { return $IXAP29[0]; } else { return null; } } public static function get_affiliate_user_id( $IXAP24 ) { global $affiliates_db; $IXAP47 = $affiliates_db->get_tablename( 'affiliates' ); $IXAP48 = $affiliates_db->get_tablename( 'affiliates_users' ); return $affiliates_db->get_value( "SELECT $IXAP48.user_id FROM $IXAP48 LEFT JOIN $IXAP47 ON $IXAP48.affiliate_id = $IXAP47.affiliate_id WHERE $IXAP48.affiliate_id = %d AND $IXAP47.status ='active'", intval( $IXAP24 ) ); } public static function get_user_affiliate_id( $IXAP9 = null ) { global $affiliates_db; $IXAP15 = false; if ( $IXAP9 !== null ) { $IXAP47 = $affiliates_db->get_tablename( 'affiliates' ); $IXAP48 = $affiliates_db->get_tablename( 'affiliates_users' ); if ( $IXAP24 = $affiliates_db->get_value( "SELECT $IXAP48.affiliate_id FROM $IXAP48 LEFT JOIN $IXAP47 ON $IXAP48.affiliate_id = $IXAP47.affiliate_id WHERE $IXAP48.user_id = %d AND $IXAP47.status ='active'", intval( $IXAP9 ) ) ) { $IXAP15 = $IXAP24; } } return $IXAP15; } public static function get_attribute( $IXAP24, $IXAP78 ) { global $affiliates_db; $IXAP87 = null; if ( $IXAP78 = Affiliates_Attributes::validate_key( $IXAP78 ) ) { $IXAP25 = $affiliates_db->get_tablename( "affiliates_attributes" ); $IXAP87 = $affiliates_db->get_value( "SELECT attr_value FROM $IXAP25 WHERE affiliate_id = %d AND attr_key = %s", intval( $IXAP24 ), $IXAP78 ); } global $affiliates_attribute_filter; if ( !empty( $affiliates_attribute_filter ) && is_array( $affiliates_attribute_filter ) ) { foreach( $affiliates_attribute_filter as $IXAP99 ) { $IXAP87 = call_user_func( $IXAP99, $IXAP87, $IXAP24, $IXAP78 ); } } return $IXAP87; } public static function register_attribute_filter( $IXAP99 ) { global $affiliates_attribute_filter; if ( empty( $affiliates_attribute_filter ) ) { $affiliates_attribute_filter = array(); } $affiliates_attribute_filter[] = $IXAP99; } } 