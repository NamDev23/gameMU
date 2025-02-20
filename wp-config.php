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

 * * ABSPATH

 *

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

// define('WP_HOME', 'http://127.0.0.1:8000');

// define('WP_SITEURL', 'http://127.0.0.1:8000');

if (!session_id()) {
    session_start();
}

define('DB_NAME', 'gamingse');


/** Database username */

define('DB_USER', 'root');


/** Database password */

define('DB_PASSWORD', '123123aB');


/** Database hostname */

define('DB_HOST', '127.0.0.1');


/** Database charset to use in creating database tables. */

define('DB_CHARSET', 'utf8mb4');


/** The database collate type. Don't change this if in doubt. */

define('DB_COLLATE', '');


if (!defined('WP_CLI')) {

    define('WP_SITEURL', 'http://127.0.0.1:8000');

    define('WP_HOME',    'http://127.0.0.1:8000');
}




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

define('AUTH_KEY',         'PJTtbk4csEzvtJOsoYUXVeBgx5ay2D3ryDn1quOyIpQREbKZHX6XmZ1qbx2yI9PP');

define('SECURE_AUTH_KEY',  'iDfYkCJytRufaOVZdLS87fSBUcZPpowOCDljSZzqd19xuKeGQWFObGRpKBEl85qg');

define('LOGGED_IN_KEY',    'IJfo5gzGqp1n5GOUB0iV9nx68b1xlXlth078Wy0bIgVDUxQf54Cc72234fEkPgE4');

define('NONCE_KEY',        'bDCSdyf3qCV7KMVsqWg6jnOpvjPOJIPRla5qo4U5dRdkL6lVd3d5VIS3Bjh8ecfu');

define('AUTH_SALT',        'ZFJ9JXcI230oTgCRddkk7ZyaIWds8IFdXvgpcTNgKofhb4tWFmW0MpjVR0IAc67O');

define('SECURE_AUTH_SALT', 'ZGTPEfdDWpKfF5H1HVHMMRO4VniAdVvV4LHunmQci5oF8BRELMz67gRVAzRNgigV');

define('LOGGED_IN_SALT',   '4mJEmQUZY58iZkfp6rbYJsgEt7WRdxF6YZwBlIgmQtAdSH1CJTuYfQNENRgAIYci');

define('NONCE_SALT',       'qTVqPB2aejZnELC1p4UHQMrc2ynsgFRHeCVoUwNBvRFJ9UWC5GDOGFEfkiGzZZn3');


/**#@-*/


/**

 * WordPress database table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

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

 * @link https://wordpress.org/support/article/debugging-in-wordpress/

 */

// define('WP_DEBUG', false);

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if (! defined('ABSPATH')) {

    define('ABSPATH', __DIR__ . '/');
}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';
