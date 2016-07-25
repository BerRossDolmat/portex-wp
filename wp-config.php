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
//define('WP_HOME', 'localhost' );
define('WP_SITEURL', '');
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'portex-nda');

/** MySQL database username */
define('DB_USER', 'DRudnev');

/** MySQL database password */
define('DB_PASSWORD', 'DRudnev');

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
define('AUTH_KEY',         'i%9&/7?G~]Y5$<-3)!3|2w/*|?PQH]XlJk%;9C@8}A?qnA|0GO7uz@GqOES|XtsJ');
define('SECURE_AUTH_KEY',  '!3!K.?1gy)[wP1QuZ=[QbP/v2OtibI)l}U_hJf,fHs3Q`4l~-&d^yXM mDmi]lY(');
define('LOGGED_IN_KEY',    'sS*C=;P$+elj-8BnjZC8](Yvn62]efNd-y9%k:=pGKI*P=$1RK_I*=f<1qmpC<3N');
define('NONCE_KEY',        'G$1x,30Uy^PZ`i%er,A<QJ0lZ)4b6H<{Kx1P;][DNJhguvw,elEp8@K*u 2K~J%O');
define('AUTH_SALT',        'YGZu3->}^b6[+r$,9M|-@)e<_-}3k}([lI`/=~vIHy<T%p=s90c?SA6?0rf|OJrV');
define('SECURE_AUTH_SALT', '8hov%#.PllqY=-rKe&L~R#@g2G2!(Xr%P9jmp*VMG!8W?M/Xhx8%k.l^*kW-TdNJ');
define('LOGGED_IN_SALT',   'OKcj;#bK5xHopd)cE: w>mp)cV#i@%WKUZEq~Y]vR+`=WlS DdQx7Y=_? lr,F6Q');
define('NONCE_SALT',       ']^e7BMpG|C3`2]/}E80RD.3E^bfdiJ 2.YC{j(98v9|TlcB9qf5dKnRsLNq_}3Do');

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
