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
define( 'DB_NAME', 'wp_intimatetalestest_db' );

/** Database username */
define( 'DB_USER', 'wp_intimatetalestest_user' );

/** Database password */
define( 'DB_PASSWORD', 'wp_intimatetalestest_pw' );

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
define( 'AUTH_KEY',          'wtr1PeZ2jmB~^RfE$~Uc=Gf+gi(zd3*T#$C_Hb360jM(L4yhc0lykU%@ZIZOz6Lr' );
define( 'SECURE_AUTH_KEY',   'VjXF,h?Dyl=JjfT1CGk:ioQ*ZZ,h!kmus)LNI?#6`|JdNCZ>q=PBL3Ob/[Hk52Ju' );
define( 'LOGGED_IN_KEY',     'FiP!M`M(bNnOff_ea.p#Bv2[ueh}mpiA7mJu>{]qE-cD<F4do`;ehimtC=~o_axd' );
define( 'NONCE_KEY',         'azP#/qlM)[Uy{ar*HlOM+YFswTfl{];[w9Q}hQtccWv<r_4Lkz4xzQDX/~@0(iEb' );
define( 'AUTH_SALT',         '&P q!H#Wr!5&lGRF 0{lqsX7ev=}G?bV(Utx:SOlP+/7+m%0>[_8pp@@VWC|aNZ>' );
define( 'SECURE_AUTH_SALT',  '$a1kd{og2Oc~MX[Fu`nb<!BW~=:B/3;y,MZ}#_c=JukdGPP=Y1C@?sC73R#v%zCN' );
define( 'LOGGED_IN_SALT',    '6wfzt?!wMNt&{2P$*+xZ5bOn:V-Bh.fZ(:gDS(nns5(3[_f$?<^Q(Hwi,A[]&qQ]' );
define( 'NONCE_SALT',        'cTs]vJ34u.J.(Fil0v.qZ>qx}!IlVKMSGKJ>VyTe|^8gh{z0TC%L+tA$EJ|Oyc6)' );
define( 'WP_CACHE_KEY_SALT', 'A,[D2]oyC,y|Cp7K[ehC2~/(&f/5nCjeS@&#g&Squx3{TP8Vg%<Af1R+xJsUyKV7' );


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
	define( 'WP_DEBUG', true );
	define( 'WP_DEBUG_LOG', true );
	define( 'WP_DEBUG_DISPLAY', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
