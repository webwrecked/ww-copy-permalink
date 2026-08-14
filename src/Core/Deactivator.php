<?php
/**
 * Plugin Deactivator.
 *
 * @package WWCopyPermalink
 */

declare(strict_types=1);

namespace WWCopyPermalink\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles plugin deactivation.
 */
final class Deactivator {

	/**
	 * Run deactivation tasks.
	 *
	 * @return void
	 */
	public static function deactivate(): void {

		/*
		 * Currently no deactivation actions are required.
		 *
		 * This method exists for future cleanup tasks.
		 */
	}
}
