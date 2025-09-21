<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'k}[9#-h$&mk,t)x+CwEIg)/(cMx/PtO0kt4hjJJ4]1,R%7$;Ba3!_6.P,SD1J)!L' );
define( 'SECURE_AUTH_KEY',   ')+G4,Zp8G-/{ccSek^>JI^*erR~Tm_bWs[#e>!m(HFTkOjZR@ b:{>q=vv0r5+Eh' );
define( 'LOGGED_IN_KEY',     '}W<t$K&`QW`o5$#v~riC0#v0o*|rLZ@~CCd3szMP)2dSn5D(<)b-*DN~3o7U_S)~' );
define( 'NONCE_KEY',         '[1,MM@Ydds>rjPWS2DvcaAQimT#FVQ+^v~&{Bo7{|A0 Rdopk>^4~B_W6f$5/?0m' );
define( 'AUTH_SALT',         ':zqc4Z#0]C]%pMueDkGiUUx{*1dU}xl)HT!75mznKI4-*KcM&-rN{DOe@?=35.tB' );
define( 'SECURE_AUTH_SALT',  'VvK_l,H36&wAilnA#r#v6N7w[EzB)0M#to:E4TcM6C%=K[a8F|y.#fO!kQ,_p:zp' );
define( 'LOGGED_IN_SALT',    '1V_(zyz(Y*JugPSq. r#tI>mS{>jw[gXd6sm9bh.C/XA?U{be$^b7[t#+v{Z}FQ%' );
define( 'NONCE_SALT',        's.A0*,N*u#hVJVw^@LfR-xTV<D3F?fdeWT1gH&NPUev6YY<H$grDV{wSLzlmNAy?' );
define( 'WP_CACHE_KEY_SALT', 'CJ}+ChW-4%v~UA=yJ>R5U5D;3O8RBq2G`.14_.QSHK)pZ0s#</vWfazbDjmK^) .' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
