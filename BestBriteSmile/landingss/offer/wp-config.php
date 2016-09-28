<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('WP_CACHE', false); //Added by WP-Cache Manager
//define( 'WPCACHEHOME', '' ); //Added by WP-Cache Manager

define('DB_NAME', 'ssoffer');

/** MySQL database username */
define('DB_USER', 'ssoffer');

/** MySQL database password */
define('DB_PASSWORD', '7@y^mz?$dq%2');


/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'dlg(C#zctl=J#0|6PT?ZJmZ1bPa|@Pb^D#8vaqrGjFXG:g;_C6^U7LKXsVj2/<WVk6U1kvb?5');
define('SECURE_AUTH_KEY',  '');
define('LOGGED_IN_KEY',    'NKFSM*wlmoWQxDE-4n/HUuKKSrm*lj6p3ze6z;82e5G^GG~)>6^17Se?4fkH*esL');
define('NONCE_KEY',        'L2-je)=ALSUmj6bam5YH;hyQxmz\`C~dOse5)NK#V2uqrt(rzP7Iu3:)_@IoUGklLTxN<A0y?PY<K0y');
define('AUTH_SALT',        'ZeJN\`Pm8y7Q4l-|txXYOAIKIs*1fp!!S~WH1hJ@DF6|pI\`nPT97hco#MLH<l/O)L=N6-EOd');
define('SECURE_AUTH_SALT', 'c4uQ*Qu/V45h#5C6oY8\`ZSOsx@/y>IC:pfWC\`W)gV)T^j3CuLu#_I=*c~8#|18=*wEqxfC');
define('LOGGED_IN_SALT',   'TMV#w>tc=mVxr2eeN*K4AZF:a4@Q*XrEur2sw(uFkf!c53Fi4Z)dH-|nU0Y)\`aejFzv29');
define('NONCE_SALT',       '0b;jHS_/6#6*$;>!l#C^bWfL@lrAf_F<-USXrd4gHS6zTkG@m\`c:/ChG80B<o_=gC*jw|JVNSiX-?vAJ/8');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG',         true);
define('WP_DEBUG_LOG',     true);
define('WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
