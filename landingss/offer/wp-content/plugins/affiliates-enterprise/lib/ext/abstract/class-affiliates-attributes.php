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

	
abstract class Affiliates_Attributes implements I_Affiliates_Attributes { protected static $IXAP82; const IXAP58 = 'paypal_email'; const IXAP83 = 'referral.amount'; const IXAP84 = 'referral.amount.method'; const IXAP85 = 'referral.rate'; const IXAP86 = 'coupons'; const IXAP27 = 'cookie.timeout.days'; public static function init() { self::$IXAP82 = array( self::IXAP58 => __( 'PayPal Email', AFFILIATES_PRO_PLUGIN_DOMAIN ), self::IXAP83 => __( 'Referral Amount', AFFILIATES_PRO_PLUGIN_DOMAIN ), self::IXAP84 => __( 'Referral Amount Method', AFFILIATES_PRO_PLUGIN_DOMAIN ), self::IXAP85 => __( 'Referral Rate', AFFILIATES_PRO_PLUGIN_DOMAIN ), self::IXAP86 => __( 'Coupons', AFFILIATES_PRO_PLUGIN_DOMAIN ), self::IXAP27 => __( 'Cookie Expiration', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); } public static function get_keys() { return self::$IXAP82; } public static function validate_key( $IXAP78 ) { if ( key_exists( $IXAP78, self::$IXAP82 ) ) { return $IXAP78; } else { return false; } } public static function validate_value( $IXAP78, $IXAP87 ) { $IXAP88 = new Affiliates_Validator(); $IXAP15 = false; switch ( $IXAP78 ) { case self::IXAP58 : $IXAP15 = $IXAP88->validate_email( $IXAP87 ); break; case self::IXAP83 : case self::IXAP85 : $IXAP15 = $IXAP88->validate_amount( $IXAP87 ); break; case self::IXAP84 : $IXAP15 = Affiliates_Referral::is_referral_amount_method( $IXAP87 ); break; case self::IXAP86 : $IXAP87 = trim( $IXAP87 ); $IXAP89 = explode( ",", $IXAP87 ); $IXAP90 = array(); foreach( $IXAP89 as $IXAP91 ) { $IXAP91 = trim( $IXAP91 ); if ( !empty( $IXAP91 ) && !in_array( $IXAP91, $IXAP90 ) ) { $IXAP90[] = $IXAP91; } } $IXAP87 = implode( ",", $IXAP90 ); if ( !empty( $IXAP87 ) ) { $IXAP15 = $IXAP87; } break; case self::IXAP27 : $IXAP87 = intval( trim( $IXAP87 ) ); if ( $IXAP87 < 0 ) { $IXAP87 = 0; } $IXAP15 = $IXAP87; break; } return $IXAP15; } } Affiliates_Attributes::init(); 