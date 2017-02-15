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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'OH7@NRN18J$jEI6Zxe[[aJK(@~3(-3?kft.QbBx%ElTHG/9)$nj!.uiO|9bDat3!');
define('SECURE_AUTH_KEY',  '</yWgLH7hAleJCDS<{was9w)@8&v4b}u/AS&,^pjLLI!ZdPTHtoa}z/*,g1<Bv1f');
define('LOGGED_IN_KEY',    '1B9te_HO>Levo{<H^;|mkx>gwDRkT.-x#-t]gW9bnm3,hBBaL!vVcWwhKBcCP^Ur');
define('NONCE_KEY',        'xv8aoaJvq/p,X}sBH(AEj2ew.>ZwVK1$up8C(A|R)j:_,M7SBW2%Y%RJzd}gCw-M');
define('AUTH_SALT',        't]_=byfmY^?k~oKNkjO-e0y []%KQ.cxUN5<c>&%m0*-ChCTJM6z&WFjK_<&9%,E');
define('SECURE_AUTH_SALT', '4TK`[k;|5s!{GP.L;d_P[^Q>5<#J<j0N#^b3])4J.V/lT2knU)TaCFWg@dyGY0Mj');
define('LOGGED_IN_SALT',   '55)&u<|t Xk #y9h!X<8h~G?Iy&9H|C60{;>),9sc`rH~W UkEjsw`T}#v(54|SO');
define('NONCE_SALT',       'LH8OnI;@{0$Vj fz=f-.pb#DP~0fQ5z+KO:C`h{txt9_ ddZZ^hiG~vbE; }/#1&');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
