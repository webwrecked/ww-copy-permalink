<?php
/**
 * Plugin Name:       WW Copy Permalink
 * Plugin URI:        https://github.com/sac2811/ww-copy-permalink
 * Description:       Adds a Copy Permalink action to posts, pages, and public custom post types in the WordPress admin.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            DevCraft
 * Author URI:        https://sac2811.github.io
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ww-copy-permalink
 * Domain Path:       /languages
 *
 * @package WWCopyPermalink
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/*
|--------------------------------------------------------------------------
| Plugin Constants
|--------------------------------------------------------------------------
*/

define( 'WWCP_VERSION', '1.0.0' );

define( 'WWCP_PLUGIN_FILE', __FILE__ );

define( 'WWCP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

define( 'WWCP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'WWCP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


/*
|--------------------------------------------------------------------------
| Autoloading
|--------------------------------------------------------------------------
*/

if ( file_exists( WWCP_PLUGIN_PATH . 'vendor/autoload.php' ) ) {

	require_once WWCP_PLUGIN_PATH . 'vendor/autoload.php';

} else {

	spl_autoload_register(
		static function ( string $class ): void {

			$prefix = 'WWCopyPermalink\\';

			if ( strpos( $class, $prefix ) !== 0 ) {
				return;
			}

			$relative_class = substr(
				$class,
				strlen( $prefix )
			);

			$file = WWCP_PLUGIN_PATH .
				'src/' .
				str_replace(
					'\\',
					DIRECTORY_SEPARATOR,
					$relative_class
				) .
				'.php';

			if ( file_exists( $file ) ) {
				require_once $file;
			}
		}
	);
}


/*
|--------------------------------------------------------------------------
| Activation
|--------------------------------------------------------------------------
*/

register_activation_hook(
	__FILE__,
	array(
		'WWCopyPermalink\Core\Activator',
		'activate',
	)
);


/*
|--------------------------------------------------------------------------
| Deactivation
|--------------------------------------------------------------------------
*/

register_deactivation_hook(
	__FILE__,
	array(
		'WWCopyPermalink\Core\Deactivator',
		'deactivate',
	)
);


/*
|--------------------------------------------------------------------------
| Start Plugin
|--------------------------------------------------------------------------
*/

add_action(
	'plugins_loaded',
	static function (): void {

		if ( class_exists( 'WWCopyPermalink\Core\Plugin' ) ) {

			$plugin = new WWCopyPermalink\Core\Plugin();

			$plugin->run();
		}
	}
);
