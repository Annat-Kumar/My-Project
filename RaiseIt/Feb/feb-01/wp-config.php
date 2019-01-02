<?php
define('WP_CACHE', false);

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

define('DB_NAME', 'acstratc_rifdev');



/** MySQL database username */

define('DB_USER', 'acstratc_rifdb');



/** MySQL database password */

define('DB_PASSWORD', 'BT+t[6PnD=GO');



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

define('AUTH_KEY',         '#vU~%!#uz}Pzo_W)e9>Ug&1&X4zkJw=>nR={Tc_{PocJ((c6@G6ZKc3yNbY2qXz<');

define('SECURE_AUTH_KEY',  '(ooc0I+$-v1?SGIbuRpUJ*NplALuuBcO(mR({%nKPr)xr:/z/=xYfd]TtKD96;ig');

define('LOGGED_IN_KEY',    '%V!.dL_TCsrEO?L _2:dcq7Bjx6f0*;&<t%C_Z8f&_Kc2WG|X_{*i<CbiY4A0y[d');

define('NONCE_KEY',        '??AWF=h|v_&+`.oqy[C)jOd]x UZr=I7&&P;n3/A?,4I_tg_Ex6!+/!+37l{}6~!');

define('AUTH_SALT',        'ri2Oy}r/a!xw&kmdp|cM^Pb_|%[AyrVGmgj|/7jfF||tHu4+Iao.7 *n!st&-i)3');

define('SECURE_AUTH_SALT', 'WlFwZPHT62|0J,Ov6 TMTr.8L vC (H5Ozun&AcCgaX}^D<]bRn1w;S0gU:C[fnX');

define('LOGGED_IN_SALT',   '|Re@:~YgH3_iL[qiQ_!sAzlaMwscf=*E1O3MO@flrTl$+)O=cJXh,;/KesdPhkTM');

define('NONCE_SALT',       '7^f92ny]21zxAP}#{*k#+0z,.t+E2&Qn9G{YN&EL9!vV}&tW!n3B*8CU@p6f`Rsh');



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

define('WP_MEMORY_LIMIT', '64M');


/* That's all, stop editing! Happy blogging. */



/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

	define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');








