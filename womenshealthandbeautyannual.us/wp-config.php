<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'womenshealthandbeautyannual');

/** MySQL database username */
define('DB_USER', 'womenshealthandb');

/** MySQL database password */
define('DB_PASSWORD', 'F}n)HE)@@$fq');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'xX247#`9CU4oQ:}R Iomf9/x`8KcC8ESu`o>;1Xx0|NY|1bFqJX:~T-M~u*{Uykl');
define('SECURE_AUTH_KEY',  '0/bsqVsNH7U)XY9H1(XVj]qlgBk8zH04h^Rf}}^xnq%/oZW%8q5(0XUIGXK3pPA9');
define('LOGGED_IN_KEY',    '!p_85Y<G%ZA?73BU!!?:8{LZ~o`@bo19nZ^ozeT4bs(yv2zUQy[ 94bMzb/hZ%B{');
define('NONCE_KEY',        'LQp.[tB-Hu_SDTlG}x*,.e=A#q)gqrVHVXiZ^ZT&WanTfFJ@aR:$V>+YHLy7C.M&');
define('AUTH_SALT',        '|F?Y&}eH3!p::Sl+_!W9VY!hr?]ddwkR`RxTQ7e^sJ*u[Ha <ez_r5b8NR:?HM$I');
define('SECURE_AUTH_SALT', '(5QMl#t&{V!tKRX1vdE_XuNR__wo=UiAURn2.;jt4{X2_SE4@53^Tccu+l8[Ya?H');
define('LOGGED_IN_SALT',   '4hd!n:Dhaq3cim4N.jgx,-^[7J541nJI;pV5E~0Vdgztp0p{.x=:YH}raT3KQO?y');
define('NONCE_SALT',       ']A3I;a$t:5T9nl!2z4&LM3?*q+eP2ba/)I1-Im<(B)jW@WO.!N>[}F}3m24~6*=g');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
