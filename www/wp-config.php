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
define('DB_NAME', 'create_ned');

/** MySQL database username */
define('DB_USER', 'create_ned');

/** MySQL database password */
define('DB_PASSWORD', 'create');

/** MySQL hostname */
define('DB_HOST', 'localhost:8889');

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
define('AUTH_KEY',         'd|0)g{#*-L;67T2=!-~/PKVaBV|CUPt5X9+Bfr0,>7Mg=JT3du0QvVCxG2hwD]Vu');
define('SECURE_AUTH_KEY',  'TQPLD.G KPsc9]dIXu(8*{~3Dze2Ryk}EKfJ/&-.Q|v[TcP;o@>^+&@QSQf:4dfD');
define('LOGGED_IN_KEY',    'I<*(}Lq(fm`],ZLWlnJLYC]Pj2oRn#]j^an|onUCwSgMEKsn)k(7@}@E(#+4$$Yl');
define('NONCE_KEY',        '~M,/{[F1$9^fMC6M|}Ue)wn+[8|I[F*fNHp] x)X[StT/uk&Xp#v)Y>?mH7fT#t9');
define('AUTH_SALT',        ')M(cBwR(1_yjNW*sg,2K#SD7104]k}BNo_PD9s]P59=gD@9&U-CiX3c/|e~`]zZm');
define('SECURE_AUTH_SALT', '>7974-OkJjRn7<tSM`%YF$Y+:T@h~}>-i/s|6-Uq+t8OTFf*i^mgGtV~vC-Bn]@-');
define('LOGGED_IN_SALT',   'kJwj*++Je<xOd>.b= i!L@M|3}zXhXL^{1uJsBz2vCAfr3kRz_i2)%~N#^k-Bz S');
define('NONCE_SALT',       '|-sE.LSe:#{oUCu-G}eN|)Du&:}~4*6`[a7| @&[jv(WqJRQ;1qYc/rP,midX&zm');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'create_ned_';

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
