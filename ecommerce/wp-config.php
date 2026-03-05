<?php
define( 'WP_CACHE', true );






/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ezylo_db' );

/** Database username */
define( 'DB_USER', 'ezylo_user' );

/** Database password */
define( 'DB_PASSWORD', '1234' );

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
define( 'AUTH_KEY',         'ivydwxtdyxv4fz0izue7olwi57qppnghengn9vhiyt5djyfilqkmnwvtxsbmaytn' );
define( 'SECURE_AUTH_KEY',  'uy9hettshpwgkc8qg8ruhzoeomfy1bikfvcgcqst0q19cnsmaizptsxhfvijkb39' );
define( 'LOGGED_IN_KEY',    'uoejb2vd1msfc7wfvuzpkwedf9knzjfqljvru3xcodkj7pdvczizlp24ws8duyb6' );
define( 'NONCE_KEY',        'w919grigqvocmyl6b2od68b5ps2vsf1tog0cqzm5uct9hriz1x6sp4aqwvgp9blr' );
define( 'AUTH_SALT',        'upzp2qiqiornv9eyf3sqxh2xu8atwoc5v3jotinvukewbcy84g1xcpcbek5b4rm4' );
define( 'SECURE_AUTH_SALT', '4plwi10bs6dglpifjtosjc15tc7t6mzghg8hhzwwlcm9ytg0ymktmtjusodj2f11' );
define( 'LOGGED_IN_SALT',   'v8wgacjedn9kk8rwifpr4unl8sjieupjnzdlw1exa3evlfvxooz6bwzvhz6yf8tc' );
define( 'NONCE_SALT',       'ricx00u5zsdw1rg3hxg9uqilvle8gg4btnjjnpa3l2vtjxigewkowlhv9rrcxglu' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wplkaqiv_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
