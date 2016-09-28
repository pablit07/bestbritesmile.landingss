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

	
abstract class Affiliates_Referral implements I_Affiliates_Referral { const IXAP13 = 'aff_def_ref_calc_key'; const IXAP14 = 'aff_def_ref_calc_value'; private $referral = null; private static $IXAP176 = array(); public static function init() { self::register_referral_amount_method( array( __CLASS__, 'example_referral_amount_method' ) ); } public static function example_referral_amount_method( $IXAP24 = null, $IXAP177 = null ) { $IXAP15 = "0"; if ( isset( $IXAP177['base_amount'] ) ) { $IXAP15 = bcmul( "0.1", $IXAP177['base_amount'] ); } return $IXAP15; } public static function register_referral_amount_method( $IXAP178 ) { $IXAP15 = false; if ( is_string( $IXAP178 ) ) { $IXAP178 = explode( "::", $IXAP178 ); if ( count( $IXAP178 ) == 1 ) { $IXAP178 = $IXAP178[0]; } } if ( in_array( $IXAP178, self::$IXAP176 ) ) { $IXAP15 = true; } else if ( ( ( is_array( $IXAP178 ) && ( count( $IXAP178 ) == 2 ) && method_exists( $IXAP178[0], $IXAP178[1] ) ) ) || ( is_string( $IXAP178 ) && function_exists( $IXAP178 ) ) ) { $IXAP28 = bcadd( "0", call_user_func( $IXAP178, null, null ) ); if ( $IXAP28 !== false ) { self::$IXAP176[] = $IXAP178; $IXAP15 = true; } } return $IXAP15; } public static function get_referral_amount_methods() { return self::$IXAP176; } public static function is_referral_amount_method( $IXAP178 ) { return self::get_referral_amount_method( $IXAP178 ); } public static function get_referral_amount_method( $IXAP178 ) { $IXAP179 = @unserialize( $IXAP178 ); if ( $IXAP179 !== false ) { $IXAP178 = $IXAP179; } if ( is_string( $IXAP178 ) ) { $IXAP178 = explode( "::", $IXAP178 ); if ( count( $IXAP178 ) == 1 ) { $IXAP178 = $IXAP178[0]; } } if ( in_array( $IXAP178, self::$IXAP176 ) ) { return $IXAP178; } else { return false; } } } Affiliates_Referral::init(); 