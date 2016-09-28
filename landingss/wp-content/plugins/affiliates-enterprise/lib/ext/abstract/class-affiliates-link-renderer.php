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

	
 abstract class Affiliates_Link_Renderer implements I_Affiliates_Link_Renderer { protected static $IXAP165 = array( 'render' => self::IXAP166, 'content' => null, 'type' => self::IXAP151, 'url' => null, 'a_class' => null, 'a_id' => null, 'a_style' => null, 'a_title' => null, 'a_name' => null, 'a_rel' => null, 'a_rev' => null, 'a_target' => null, 'a_type' => null, 'img_alt' => null, 'img_class' => null, 'img_height' => null, 'img_id' => null, 'img_name' => null, 'img_src' => null, 'img_title' => null, 'img_width' => null, 'attachment_id' => null, 'size' => 'full' ); public static function render_affiliate_link( $IXAP105 = array(), $IXAP167 = null, $IXAP92 = array() ) { $IXAP62 = ''; $IXAP163 = call_user_func( array( $IXAP92['Affiliates_Url_Renderer'], 'render_affiliate_url'), $IXAP105 ); if ( empty( $IXAP167 ) ) { if ( !empty( $IXAP105['content'] ) ) { $IXAP167 = $IXAP105['content']; } else { $IXAP167 = $IXAP163; } } $IXAP168 = array(); $IXAP169 = array(); foreach ( $IXAP105 as $IXAP78 => $IXAP87 ) { if ( strpos($IXAP78, "a_") === 0 ) { if ( $IXAP87 !== null ) { $IXAP168[substr( $IXAP78, 2 )] = $IXAP87; } } else if ( strpos($IXAP78, "img_") === 0 ) { if ( $IXAP87 !== null ) { switch ( $IXAP78 ) { case 'img_height' : if ( preg_match( "/(\d+)(px|\%)?/", $IXAP87, $IXAP29 ) ) { $IXAP170 = intval( $IXAP29[1] ); if ( isset( $IXAP29[2] ) ) { $IXAP171 = $IXAP29[2] == "px" ? "px" : "%"; } else { $IXAP171 = ""; } $IXAP169['height'] = $IXAP170 . $IXAP171; } break; case 'img_width' : if ( preg_match( "/(\d+)(px|\%)?/", $IXAP87, $IXAP29 ) ) { $IXAP172 = intval( $IXAP29[1] ); if ( isset( $IXAP29[2] ) ) { $IXAP173 = $IXAP29[2] == "px" ? "px" : "%"; } else { $IXAP173 = ""; } $IXAP169['width'] = $IXAP172 . $IXAP173; } break; default : $IXAP169[substr( $IXAP78, 4 )] = $IXAP87; } } } } if ( !empty( $IXAP170 ) && !empty( $IXAP172 ) ) { $IXAP174 = array( $IXAP172, $IXAP170 ); } else if ( isset( $IXAP105['size'] ) ) { if ( in_array( $IXAP105['size'], $IXAP92['image_sizes'] ) ) { $IXAP174 = $IXAP105['size']; } else { $IXAP174 = self::$IXAP165['size']; } } $IXAP62 = '<a href="' . $IXAP163 . '"'; foreach( $IXAP168 as $IXAP78 => $IXAP87 ) { $IXAP62 .= ' ' . $IXAP78 . '="' . call_user_func( $IXAP92['esc_attr'], $IXAP87 ) . '"'; } $IXAP62 .= '>'; if ( isset( $IXAP105['attachment_id'] ) ) { $IXAP62 .= call_user_func( $IXAP92['image_retriever'], $IXAP105['attachment_id'], $IXAP174, false, $IXAP169 ); } else if ( isset( $IXAP105['img_src'] ) ) { $IXAP62 .= "<img "; foreach ( $IXAP169 as $IXAP78 => $IXAP87 ) { $IXAP62 .= " $IXAP78=" . '"' . call_user_func( $IXAP92['esc_attr'], $IXAP87 ) . '"'; } $IXAP62 .= ' />'; } else if ( isset( $IXAP105['content'] ) ) { $IXAP62 .= $IXAP105['content']; } else { $IXAP62 .= $IXAP167; } $IXAP62 .= '</a>'; if ( isset( $IXAP105['render'] ) && ( $IXAP105['render'] == self::IXAP175 ) ) { $IXAP62 = htmlentities( $IXAP62, ENT_COMPAT, get_bloginfo( 'charset' ) ); } return $IXAP62; } }