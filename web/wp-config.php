<?php
$_ENV = 'development';
$_ROOT_DIR = __DIR__ . DIRECTORY_SEPARATOR;
$_WEB_DIR = $_ROOT_DIR . 'wp';
$_CONTENT_DIR = 'app';
$WP_HOME = 'http://www.intimate-tales.test';

/**
 * Database
 */
define( 'DB_NAME', 'wp_intimatetalestest_db' );
define( 'DB_USER', 'wp_intimatetalestest_user' );
define( 'DB_PASSWORD', 'wp_intimatetalestest_pw' );
define( 'DB_HOST', '127.0.0.1' );

define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 */
define('AUTH_KEY',         '8K9}Y`]E*m-o!,DvntN}-9g{y_sfp~$:j2e-}K<&1bZ- L6JVaebxKeO7]c/{EK4');
define('SECURE_AUTH_KEY',  'n[&c^l{zn<oh$Y#-N?O7y{<L]=+Sj/]Gp66%:p::p#($O.JE6N#^vmm,bLuS*]^_');
define('LOGGED_IN_KEY',    '|KF|t&<P ISINR=$H)sqnn{+Wk$iPvsprS`:smZ}1@-IBB9F#oe:/+BIi0rMtw(V');
define('NONCE_KEY',        '+QBU:<Zb$V(p&#xY=W`nHDP0k5,U1|z+DOYs^]kMRS}e-BHlC 0yw&GE-1%k>haQ');
define('AUTH_SALT',        'A,LHIX^wyC%`cb5wG6AQe&nE5A}BEse;DL97mm_4:q^nx>LoM,.Q.(_s(b-|LjXw');
define('SECURE_AUTH_SALT', '+>N)qg(x-]XAKU2Vdi_BfjK[X:M|5k>!7+>} #{/ih>c1]y X}P5|8e:_xeA]=CK');
define('LOGGED_IN_SALT',   'y+CC}r:`UrTW$#$6~r|_rqk3.db(*P[ck=c[[%j)+,7s(meaPI#!We>D Z;.t2)o');
define('NONCE_SALT',       'y-f3-NJxCkJ:|qL&4B+Q[KrI)s7^,AL !D/:f?KF5gYp9R5OPEOIJM/m1kY1AHVW');

$table_prefix = 'wp_';

/**
 * Set up our global environment constant and load its config first
 * Default: production
 */
define('WP_ENV', $_ENV ?: 'production');

/**
 * Infer WP_ENVIRONMENT_TYPE based on WP_ENV
 */
if (in_array(WP_ENV, ['production', 'staging', 'development', 'local'])) {
    define('WP_ENVIRONMENT_TYPE', WP_ENV);
}

/**
 * URLs
 */
define('WP_HOME', $WP_HOME);
define('WP_SITEURL', "{$WP_HOME}/wp");

/**
 * Debug
 */
define('SAVEQUERIES', true);
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', true);
define('WP_DEBUG_LOG', true);
define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
define('SCRIPT_DEBUG', true);
define('DISALLOW_INDEXING', true);

ini_set('display_errors', '1');

// Enable plugin and theme updates and installation from the admin
define('DISALLOW_FILE_MODS', false);


/**
 * Custom Content Directory
 */
define('CONTENT_DIR', $_CONTENT_DIR);
define('WP_CONTENT_DIR', "{$_ROOT_DIR}{$_CONTENT_DIR}");
define('WP_CONTENT_URL', "{$WP_HOME}/{$_CONTENT_DIR}");

/**
 * Custom Media Directory
 */

define('MEDIA_DIR', $_CONTENT_DIR. '/media');
define('WP_MEDIA_DIR', "{$_ROOT_DIR}{$_CONTENT_DIR}/media");
define('WP_MEDIA_URL', "{$WP_HOME}/{$_CONTENT_DIR}/media");

/**
 * Absolute path to the Vendor directory.
 */
define('VENDOR_DIR', $_ROOT_DIR. '/vendor');

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', $_WEB_DIR );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
