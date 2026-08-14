<?php
/**
 * Internationalization Loader.
 *
 * @package WWCopyPermalink
 */

declare(strict_types=1);

namespace WWCopyPermalink\I18n;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles plugin translations.
 */
final class Loader {

	/**
	 * Register translation hooks.
	 *
	 * @return void
	 */
	public function register(): void {

		add_action(
			'plugins_loaded',
			array( $this, 'load_textdomain' )
		);
	}

	/**
	 * Load plugin text domain.
	 *
	 * @return void
	 */
	public function load_textdomain(): void {

		load_plugin_textdomain(
			'ww-copy-permalink',
			false,
			dirname( plugin_basename( WWCP_PLUGIN_FILE ) ) . '/languages'
		);
	}
}
