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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'seokbangguri' );

/** Database password */
define( 'DB_PASSWORD', 'dlaoehdrodtmxj1!' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '[(k=yVVrte8:!.Q2t=i5=)N:Qq_Y3.;`v]{y{EveNs-[[T*OhEpa.{6D1t73P;SY' );
define( 'SECURE_AUTH_KEY',  '[b{dE:Tv<,Uo}vD|2xDUZe}hWk.az`@Jl ]KWarq;=gjkUQh|R]V/vyhFCwV5X5_' );
define( 'LOGGED_IN_KEY',    '_a3kQ.,yC!UciPj4!3p3)w`Hx!<6FIzjD}{ubD/E@T5U?eiY,C0p+!l556[1J.AX' );
define( 'NONCE_KEY',        'Kg__%O:|]*j7S&J`^G@7PXm}pv(8hHo@!jq}6q!TtHFWDw^@>)rA[*X+t0x:DvMp' );
define( 'AUTH_SALT',        'tnuC(PLe1887X539<7{i]+.%-()rRWEEZ:,q6[t;A;%(3u91@(&Kx8Kj.O4.VJpY' );
define( 'SECURE_AUTH_SALT', 'oD,T4@t7GFA=_x}=/JBS[$jW.$aOMN8WMsC4FU+]W30@3{D&;3s{zUepWAn,`xiP' );
define( 'LOGGED_IN_SALT',   '5QN=.Cltn!TXCA6Al[f` 7f,;W4K75S$vO#ep{EkrorYz(N2i5LK(gDn,V$EbR{M' );
define( 'NONCE_SALT',       'H8Vd; _D|=QF:=uwdXX?<BEkK LaI0pxWMUTo}9+!jtJ_BQ+G0PhT9nFsG<n&K>Q' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
