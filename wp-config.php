<?php
define( 'WP_CACHE', true );




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
define( 'DB_NAME', 'salmvqjr_dgkads' );

/** Database username */
define( 'DB_USER', 'salmvqjr_dgkads' );

/** Database password */
define( 'DB_PASSWORD', '[(oS(!9pV4D09SL)' );

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
define( 'AUTH_KEY',         'g7q0iznu1pg3c7iaupjorblrqgicmp8lzdqrk7nsu5byuazt7jx6rb3ciuvxztnv' );
define( 'SECURE_AUTH_KEY',  'qdaub2ilna84r8e6ujemv6uigsdnjqqfqeqxdund8xlyv0inn8eushtvlop4gxer' );
define( 'LOGGED_IN_KEY',    'o3sxavyvecpxmplbhfaedaglmfnlqljmzyelucdp6bevhhu55sionzkezhozwyrv' );
define( 'NONCE_KEY',        'grt4ahxbushgcvk4lrymwbxfzxp37kknb73wdbbqve0rfavnsysvmahcniiunzf5' );
define( 'AUTH_SALT',        'les9ofzqpbovkwxmicihftuaecork3wnvkb0uvvsvnusos7u8ibk8dttk8jnnmj6' );
define( 'SECURE_AUTH_SALT', 'uvehbcfd5loxt0yd3y2b4fvk0fttyxmfliuiukwqhsoe6nzylubrt7craezyiauu' );
define( 'LOGGED_IN_SALT',   'v5uave6hu72sp1gfsidf3xjqg0v7ph9btcxuecr1ggxqcb3sobr5yd6ozlqxmkry' );
define( 'NONCE_SALT',       'ayf0bitkzgowxpkuhcppeq2r5bt1nzklhd4qqjrcmulx2otrqzzlpnif0z5auzal' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '';

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
