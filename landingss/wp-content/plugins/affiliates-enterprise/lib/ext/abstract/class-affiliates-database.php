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

	
 abstract class Affiliates_Database implements I_Affiliates_Database { private $implementation; private $host; private $database; private $user; private $password; public function __construct( $IXAP92, $IXAP93 = null, $IXAP94 = null, $IXAP95 = null, $IXAP96 = null ) { $this->implementation = $IXAP92; $this->host = $IXAP93; $this->database = $IXAP94; $this->user = $IXAP95; $this->password = $IXAP96; } public function create_tables( $IXAP7 = null, $IXAP8 = null ) { $IXAP97 = ''; if ( ! empty( $IXAP7 ) ) { $IXAP97 = "DEFAULT CHARACTER SET $IXAP7"; } if ( ! empty( $IXAP8 ) ) { $IXAP97 .= " COLLATE $IXAP8"; } $IXAP25 = $this->get_tablename( 'affiliates_attributes' ); if ( $this->get_value( "SHOW TABLES LIKE '" . $IXAP25 . "'" ) != $IXAP25 ) { $IXAP98 = "CREATE TABLE " . $IXAP25 . " (
				affiliate_id BIGINT(20) UNSIGNED NOT NULL,
				attr_key     VARCHAR(100) NOT NULL,
				attr_value   LONGTEXT DEFAULT NULL,
				PRIMARY KEY  (affiliate_id, attr_key),
				INDEX        aff_attr_akv (affiliate_id, attr_key, attr_value(100)),
				INDEX        aff_attr_ka (attr_key, affiliate_id),
				INDEX        aff_attr_kva (attr_key, attr_value(100), affiliate_id)
			) $IXAP97;"; $this->query( $IXAP98 ); } } public function drop_tables() { $IXAP25 = $this->get_tablename( 'affiliates_attributes' ); $IXAP98 = "DROP TABLE IF EXISTS " . $IXAP25 . ";"; $this->query( $IXAP98 ); } } 