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

	
 abstract class Affiliates_Url_Renderer implements I_Affiliates_Url_Renderer { protected static $IXAP147 = 'affiliates'; protected static $IXAP148 = 'cmid'; protected static $IXAP149 = null; protected static $IXAP150 = array( 'type' => self::IXAP151, 'url' => null ); static function render_affiliate_url( $IXAP105 = array(), $IXAP92 = array() ) { $IXAP62 = ''; if ( $IXAP24 = call_user_func( array( $IXAP92['Affiliates_Affiliate'], 'get_user_affiliate_id' ) ) ) { $IXAP152 = call_user_func( self::$IXAP149, $IXAP24 ); } else { $IXAP152 = 'affiliate-id'; } if ( !isset( $IXAP105['type'] ) ) { $IXAP105['type'] = self::IXAP151; } if ( isset( $IXAP105['url'] ) ) { $IXAP153 = $IXAP105['url']; } else { $IXAP153 = ''; } switch ( $IXAP105['type'] ) { case self::IXAP154 : $IXAP62 = self::get_affiliate_url( $IXAP153, $IXAP24 ); break; case self::IXAP155 : $IXAP62 = self::get_affiliate_url( $IXAP153, $IXAP24 ); break; case self::IXAP156 : $IXAP62 = $IXAP153 . '/' . self::$IXAP147 . '/' . $IXAP152; break; case self::IXAP151 : default : if ( isset( $IXAP105['use_parameter'] ) && $IXAP105['use_parameter'] ) { $IXAP62 = $IXAP153 . '/' . self::$IXAP147 . '/' . $IXAP152; } else { $IXAP62 = self::get_affiliate_url( $IXAP153, $IXAP24 ); } break; } return $IXAP62; } public static function compose_url( $IXAP157 ) { $IXAP158 = isset( $IXAP157['scheme'] ) ? $IXAP157['scheme'] . '://' : ''; $IXAP93 = isset( $IXAP157['host'] ) ? $IXAP157['host'] : ''; $IXAP159 = isset( $IXAP157['port'] ) ? ':' . $IXAP157['port'] : ''; $IXAP95 = isset( $IXAP157['user'] ) ? $IXAP157['user'] : ''; $IXAP160 = isset( $IXAP157['pass'] ) ? ':' . $IXAP157['pass'] : ''; $IXAP160 = ( !empty( $IXAP95 ) || !empty( $IXAP160 ) ) ? "$IXAP160@" : ''; $IXAP161 = isset( $IXAP157['path'] ) ? $IXAP157['path'] : ''; $IXAP98 = isset( $IXAP157['query'] ) ? '?' . $IXAP157['query'] : ''; $IXAP162 = isset( $IXAP157['fragment'] ) ? '#' . $IXAP157['fragment'] : ''; return "$IXAP158$IXAP95$IXAP160$IXAP93$IXAP159$IXAP161$IXAP98$IXAP162"; } public static function get_affiliate_url( $IXAP163, $IXAP24, $IXAP164 = null, $IXAP35 = array() ) { $IXAP147 = self::$IXAP147; $IXAP148 = self::$IXAP148; $IXAP149 = self::$IXAP149; $IXAP158 = parse_url( $IXAP163, PHP_URL_SCHEME ); if ( empty( $IXAP158 ) ) { $prefix = ''; if ( strpos( $IXAP163, 'http://' ) !== 0 && strpos( $IXAP163, 'https://' ) !== 0 ) { $prefix = !empty( $_SERVER['HTTPS'] ) && strtolower( $_SERVER['HTTPS'] ) != 'off' ? 'https:' : 'http:'; if ( strpos( $IXAP163, '//' ) !== 0 ) { $prefix .= '//'; } } $IXAP163 = $prefix . $IXAP163; } $IXAP157 = parse_url( $IXAP163 ); if ( strpos( isset( $IXAP157['query'] ) ? $IXAP157['query'] : '', "$IXAP147=" ) === false ) { $IXAP98 = ''; if ( !empty( $IXAP157['query'] ) ) { $IXAP98 = $IXAP157['query'] . '&'; } $IXAP152 = $IXAP24; if ( !empty( $IXAP149 ) ) { $IXAP152 = call_user_func( $IXAP149, $IXAP24 ); } $IXAP98 .= sprintf( '%s=%s', $IXAP147, $IXAP152 ); if ( empty( $IXAP157['path'] ) ) { $IXAP157['path'] = '/'; } if ( !empty( $IXAP164 ) ) { $IXAP98 .= '&'; $IXAP98 .= sprintf( '%s=%s', $IXAP148, $IXAP164 ); } $IXAP157['query'] = $IXAP98; } return self::compose_url( $IXAP157 ); } } 