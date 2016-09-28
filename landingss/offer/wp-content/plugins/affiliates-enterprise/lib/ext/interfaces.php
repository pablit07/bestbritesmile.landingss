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

	
 interface I_Affiliates_Database { public function create_tables( $IXAP7 = null, $IXAP444 = null ); public function drop_tables(); public function start_transaction(); public function commit(); public function rollback(); public function get_tablename( $name ); public function get_value( $IXAP98 ); public function get_objects( $IXAP98 ); public function query( $IXAP98 ); } interface I_Affiliates_Affiliate { public static function get_affiliate( $IXAP24 ); public static function get_user_affiliate_id( $IXAP9 = null ); } interface I_Affiliates_Affiliates { } interface I_Affiliates_Affiliate_Profile { } interface I_Affiliates_Attributes { } interface I_Affiliates_Referral { public function add_referrals( $IXAP252, $post_id, $IXAP246 = '', $IXAP212 = null, $IXAP248 = null, $IXAP28 = null, $IXAP42 = null, $IXAP247 = null, $IXAP249 = null, $IXAP250 = null, $IXAP251 = false ); public function suggest( $post_id, $IXAP246 = '', $IXAP212 = null, $IXAP28 = null, $IXAP42 = null, $IXAP247 = null ); public function suggest_by_attribute( $IXAP253, $IXAP254, $post_id, $IXAP246 = '', $IXAP212 = null, $IXAP248 = null, $IXAP28 = null, $IXAP42 = null, $IXAP247 = null, $IXAP249 = null, $IXAP251 = false ); public function update( $IXAP274 ); } interface I_Affiliates_Renderer { const IXAP175 = 'code'; const IXAP166 = 'html'; const IXAP154 = 'append'; const IXAP151 = 'auto'; const IXAP155 = 'parameter'; const IXAP156 = 'pretty'; } interface I_Affiliates_Link_Renderer extends I_Affiliates_Renderer { static function render_affiliate_link( $IXAP105 = array(), $IXAP167 = null ); } interface I_Affiliates_Stats_Renderer extends I_Affiliates_Renderer { const IXAP188 = 10; const IXAP224 = 3; const IXAP182 = 'stats-summary'; const IXAP221 = 'stats-referrals'; static function render_affiliate_stats( $IXAP105 = array() ); } interface I_Affiliates_Graph_Renderer extends I_Affiliates_Renderer { static function render_graph( $IXAP105 = array() ); static function render_hits( $IXAP105 = array() ); static function render_visits( $IXAP105 = array() ); static function render_referrals( $IXAP105 = array() ); static function render_totals( $IXAP105 = array() ); } interface I_Affiliates_Totals { } interface I_Affiliates_Url_Renderer extends I_Affiliates_Renderer { static function render_affiliate_url( $IXAP105 = array() ); } interface I_Affiliates_Affiliate_Stats_Renderer { const IXAP188 = 10; } interface I_Affiliates_Validator { static function validate_amount( $IXAP28 ); static function validate_email( $IXAP32 ); }