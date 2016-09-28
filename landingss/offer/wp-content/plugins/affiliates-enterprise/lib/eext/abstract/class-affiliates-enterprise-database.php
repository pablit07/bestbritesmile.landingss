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

	
 abstract class Affiliates_Enterprise_Database implements I_Affiliates_Enterprise_Database { private $implementation; private $host; private $database; private $user; private $password; protected $affiliates_db_impl; public function __construct( $IXAP92, $IXAP93 = null, $IXAP94 = null, $IXAP95 = null, $IXAP96 = null ) { $this->implementation = $IXAP92; $this->host = $IXAP93; $this->database = $IXAP94; $this->user = $IXAP95; $this->password = $IXAP96; } public function create_tables( $IXAP7 = null, $IXAP8 = null ) { $this->affiliates_db_impl->create_tables( $IXAP7, $IXAP8 ); $IXAP97 = ''; if ( ! empty( $IXAP7 ) ) { $IXAP97 = "DEFAULT CHARACTER SET $IXAP7"; } if ( ! empty( $IXAP8 ) ) { $IXAP97 .= " COLLATE $IXAP8"; } $IXAP488 = $this->get_tablename( 'affiliates_relations' ); if ( $this->get_value( "SHOW TABLES LIKE '" . $IXAP488 . "'" ) != $IXAP488 ) { $IXAP98 = "CREATE TABLE " . $IXAP488 . " (
				from_affiliate_id bigint(20) unsigned NOT NULL,
				to_affiliate_id   bigint(20) unsigned NOT NULL,
				type              varchar(10) NOT NULL DEFAULT '" . AFFILIATES_RELATIONS_TYPE_REFERRAL . "',
				from_date         date NOT NULL,
				thru_date         date default NULL,
				status            varchar(10) NOT NULL DEFAULT '" . AFFILIATES_RELATIONS_STATUS_ACTIVE . "',
				PRIMARY KEY       (from_affiliate_id, to_affiliate_id, type, from_date),
				INDEX             aff_rel_ttsf (to_affiliate_id, type, status, from_date),
				INDEX             aff_rel_tf (to_affiliate_id, from_affiliate_id, type, status, from_date)
			) $IXAP97;"; $this->query( $IXAP98 ); } $IXAP479 = $this->get_tablename( 'campaigns' ); if ( $this->get_value( "SHOW TABLES LIKE '" . $IXAP479 . "'" ) != $IXAP479 ) { $IXAP98 = "CREATE TABLE " . $IXAP479 . " (
				campaign_id  BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				affiliate_id BIGINT(20) UNSIGNED NOT NULL,
				name         VARCHAR(100) DEFAULT NULL,
				description  LONGTEXT DEFAULT NULL,
				from_date    DATE DEFAULT NULL,
				thru_date    DATE DEFAULT NULL,
				type         VARCHAR(10) DEFAULT NULL,
				status       VARCHAR(10) DEFAULT NULL,
				PRIMARY KEY  (campaign_id),
				INDEX        aff_cmp_aid (affiliate_id)
				) $IXAP97;"; $this->query( $IXAP98 ); } } public function drop_tables() { $IXAP488 = $this->get_tablename( 'affiliates_relations' ); $IXAP98 = "DROP TABLE IF EXISTS " . $IXAP488 . ";"; $this->query( $IXAP98 ); $IXAP479 = $this->get_tablename( 'campaigns' ); $IXAP98 = "DROP TABLE IF EXISTS " . $IXAP479 . ";"; $this->query( $IXAP98 ); $this->affiliates_db_impl->drop_tables(); } } 