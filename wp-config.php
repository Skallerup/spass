<?php

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
ini_set('memory_limit','512M');
define('WP_MEMORY_LIMIT', '512M');
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'spotium-wp-GiBg0A4a');
/** MySQL database username */
define('DB_USER', 'root');
/** MySQL database password */
define('DB_PASSWORD', 'root');
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
define('AUTH_KEY',         'r-k:$y9{}Bymcasy>DTZu%OA+m[D.uWUlJnVQ?GYLY| .)34G>$2nxs=DnZcLP1T');
define('SECURE_AUTH_KEY',  'X?D+>w+`Rj~S!<[u/P.082pgXUsNA*SR Sr5`!+}3[ByzjQ%PHU;|}}wx$C L| 4');
define('LOGGED_IN_KEY',    ':X1R0i{`ylnX2E$IO$oP|@uXEQ3&_4E*6yI>-hPQ$(Sc,x2q>Z_1#MSU+OuvqJ.I');
define('NONCE_KEY',        'v+OZj21w],~ahq}?(t/<1!mNbubO(8+g{-;K_)g`8xn{h_kD>/Er!tv)?Qp6QLA`');
define('AUTH_SALT',        'R+Zab9hB(`X+@a-.C?JK| gzyA<:=$@XxPi%R ;o1Et7<{;hYn$)`RFC:]lH$QJ*');
define('SECURE_AUTH_SALT', 'Tw(=_%kh&3~D1hQ,oNw2(sGkli&+4b36czfY~?V%h-dVg&2>NE|B0YQ)QhRpXC-u');
define('LOGGED_IN_SALT',   'ovV/i3AMc3`~^RZj2,VzBje8z^<f=|Ydk2/hh-SF9J>-Uam^3>4Zm==sI4dp-z|s');
define('NONCE_SALT',       'pYvlu]6U] ^i^Vt.Q-EN)@VHAtH-N~6]E~xva/B>$V&PPT6;`+)|-xeT]>|Faxe0');
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'fl_';
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define('WPLANG', 'da_DK');
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
