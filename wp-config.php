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
define('DB_NAME', 'book-in-hat_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'czH+!S$B1QgL5b2eiU^he9GB#Eit4UdH/W@Wg4sR5p@LySp((Z8D(=[t9#M%23b^');
define('SECURE_AUTH_KEY',  'SzfrhCKten<(7NTVyb1/bOfw:Tw}mdsy9rY]jb0Gj4ZZ1r&faxWY(({qnj3o#(+G');
define('LOGGED_IN_KEY',    'sm6%(z_.tz!DWISfm%aIHtEfsIH@kumcWy7UGI$?O: 9G*{.Ip(KNH8wGz:O5B1K');
define('NONCE_KEY',        'oQdh,=G[&lQ]x;Z{$8{TQ8R<i8io+b-![Zy .zbbZry8o2wQJ76]uJ9#cu7~po}S');
define('AUTH_SALT',        '#`i0RR:B2y<{pDno|jg4T, r6V>l9x5G^E-E#!a@G,FdR,^N(leRvDFTFSQpjAfc');
define('SECURE_AUTH_SALT', 'Q1h(3/$X>*rm,%&^D)l~~Q|l`>d pv@5C~=S3!{:,s2@R@6D2!_40Qj7TR1/wibH');
define('LOGGED_IN_SALT',   '[GexuTRbbaw=5]SF}r];6`t(s>60,Kkr5`MH-p}MB 9oAd$y4>w`f|gkR^FgSs)9');
define('NONCE_SALT',       'Vz*+qWY:7&vceZ6OBK+clF*YX>Ja=?|xx/ApaI>AO~[=nfsL3$)r47>bT[e&aj1~');

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
