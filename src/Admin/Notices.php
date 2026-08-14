<?php
/**
 * Admin Notices.
 *
 * @package WWCopyPermalink
 */

declare(strict_types=1);

namespace WWCopyPermalink\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles admin notices.
 */
final class Notices {

	/**
	 * Register hooks.
	 *
	 * @return void
	 */
	public function register(): void {

		add_action(
			'admin_notices',
			array( $this, 'display_notices' )
		);
	}

	/**
	 * Display admin notices.
	 *
	 * @return void
	 */
	public function display_notices(): void {

		/*
		 * Reserved for future notices.
		 *
		 * Keeping this method prevents future
		 * additions from polluting other classes.
		 */
	}
}
