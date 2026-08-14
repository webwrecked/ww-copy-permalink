<?php
/**
 * Main Plugin Class.
 *
 * @package WWCopyPermalink
 */

declare(strict_types=1);

namespace WWCopyPermalink\Core;

use WWCopyPermalink\Admin\Actions;
use WWCopyPermalink\Admin\Assets;
use WWCopyPermalink\Admin\Notices;
use WWCopyPermalink\I18n\Loader;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main plugin controller.
 */
final class Plugin {

	/**
	 * Start plugin.
	 *
	 * @return void
	 */
	public function run(): void {

		$this->register_i18n();

		if ( is_admin() ) {
			$this->register_admin_components();
		}
	}


	/**
	 * Register translation loader.
	 *
	 * @return void
	 */
	private function register_i18n(): void {

		$i18n = new Loader();

		$i18n->register();
	}


	/**
	 * Register admin components.
	 *
	 * @return void
	 */
	private function register_admin_components(): void {

		$components = array(
			new Assets(),
			new Actions(),
			new Notices(),
		);

		foreach ( $components as $component ) {

			if ( method_exists( $component, 'register' ) ) {

				$component->register();
			}
		}
	}
}
