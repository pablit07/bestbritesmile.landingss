<?php
 require_once( dirname( __FILE__ ) . '/class-affiliates-campaign.php' ); require_once( dirname( __FILE__ ) . '/class-affiliates-pixel.php' ); Affiliates_Campaign::set_affiliate_id_encoder( 'affiliates_encode_affiliate_id' ); Affiliates_Campaign::set_base_url( get_bloginfo( 'url' ) ); Affiliates_Campaign::set_pname( get_option( 'aff_pname', AFFILIATES_PNAME ) ); Affiliates_Campaign::set_cname( 'cmid' ); 