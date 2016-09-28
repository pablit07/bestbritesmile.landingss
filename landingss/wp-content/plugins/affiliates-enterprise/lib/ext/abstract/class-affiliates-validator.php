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

	
class Affiliates_Validator implements I_Affiliates_Validator { public static function validate_amount( $IXAP28 ) { $IXAP15 = null; if ( preg_match( "/([0-9,]+)?(\.[0-9]+)?/", $IXAP28, $IXAP29 ) ) { if ( isset( $IXAP29[1] ) ) { $IXAP30 = str_replace(",", "", $IXAP29[1] ); } else { $IXAP30 = "0"; } if ( isset( $IXAP29[2] ) ) { $IXAP31 = substr( $IXAP29[2], 1, AFFILIATES_REFERRAL_AMOUNT_DECIMALS ); } else { $IXAP31 = "0"; } if ( isset( $IXAP29[0] ) && sizeof( $IXAP29 > 1 ) && ( isset( $IXAP29[1] ) || isset( $IXAP29[2] ) ) ) { $IXAP15 = $IXAP30 . "." . $IXAP31; } } return $IXAP15; } public static function validate_email( $IXAP32 ) { $IXAP15 = false; $IXAP33 = filter_var( $IXAP32, FILTER_VALIDATE_EMAIL ); if ( ( $IXAP33 !== false ) && ( $IXAP33 === $IXAP32 ) ) { $IXAP15 = $IXAP33; } return $IXAP15; } } 