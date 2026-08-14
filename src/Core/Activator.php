<?php
/**
 * Plugin Activator.
 *
 * @package WWCopyPermalink
 */

declare(strict_types=1);

namespace WWCopyPermalink\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles plugin activation.
 */
final class Activator {

	/**
	 * Run activation tasks.
	 *
	 * @return void
	 */
	public static function activate(): void {

		/*
		 * Currently no activation actions are required.
		 *
		 * This method exists for future upgrades and
		 * follows WordPress plugin architecture standards.
		 */
	}
}
