<?php
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
define( 'DB_NAME', 'node' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3307' );

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
define( 'AUTH_KEY',         'mSG1R<vyf>Z>R?bl/NKfZIuVC#( POflBdA4/u~cnoN6pqm4&6=AhW0QW0Ai9/d&' );
define( 'SECURE_AUTH_KEY',  '_1QbG$Rp5b9I$e;=8(.~=fbJ^3U|KIC#3n/e[8M&x..bBl!dv4[hLwkAoy,WcTQ>' );
define( 'LOGGED_IN_KEY',    'O8PIY#ZC^8$Eb|S6.RKxbaf2 N:]V?xm$xu1^UtY2QJORT}+O{x81kh%mY >}` z' );
define( 'NONCE_KEY',        '),]Tr@:29y94p CY`D.%k`lQYxsD[<4}yV6#umjL|<VVX/|wFpd]=bR4u(G9TDZM' );
define( 'AUTH_SALT',        'e]GCAS+Ik*jLmzfje+r[+xCZd6?mFLv.zk!5|N7?2$JJ(t!PY-bp#ug8l;HqW*&E' );
define( 'SECURE_AUTH_SALT', 'C6b$+9d]t])2WrE.o?~@_pZ;+Ll4:t33dEVn]9^u+/j.XuOo*ii,76y%k7Sahupe' );
define( 'LOGGED_IN_SALT',   'Od<_U_rwj!0[H;x_/!2?I@y)CHpIp0jEYrtb($+}m_QbR*O [eVc/5HF39M6[~p.' );
define( 'NONCE_SALT',       'Nz(P`1e}%aVmK$5&D4:J&00&WI)*.nrc#Iuap!s-)Uu^L{ m_ig#+:sOU.SAA8@Y' );

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
