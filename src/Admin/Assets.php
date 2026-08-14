<?php
/**
 * Admin Assets.
 *
 * @package WWCopyPermalink
 */

declare(strict_types=1);

namespace WWCopyPermalink\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles loading admin assets.
 */
final class Assets {

	/**
	 * Register hooks.
	 *
	 * @return void
	 */
	public function register(): void {

		add_action(
			'admin_enqueue_scripts',
			array( $this, 'enqueue_assets' )
		);
	}

	/**
	 * Enqueue assets only on supported admin screens.
	 *
	 * @return void
	 */
	public function enqueue_assets(): void {

		$screen = get_current_screen();

		if ( ! $screen ) {
			return;
		}

		/*
		 * Only load on list tables.
		 */
		if ( 'edit' !== $screen->base ) {
			return;
		}

		/*
		 * Only public post types.
		 */
		$post_type = $screen->post_type;

		if ( empty( $post_type ) ) {
			return;
		}

		if ( ! is_post_type_viewable( $post_type ) ) {
			return;
		}

		$this->enqueue_styles();
		$this->enqueue_scripts();
	}

	/**
	 * Enqueue styles.
	 *
	 * @return void
	 */
	private function enqueue_styles(): void {

		wp_enqueue_style(
			'ww-copy-permalink',
			WWCP_PLUGIN_URL . 'assets/css/admin.css',
			array(),
			WWCP_VERSION
		);
	}

	/**
	 * Enqueue scripts.
	 *
	 * @return void
	 */
	private function enqueue_scripts(): void {

		wp_enqueue_script(
			'ww-copy-permalink',
			WWCP_PLUGIN_URL . 'assets/js/admin.js',
			array(),
			WWCP_VERSION,
			true
		);

		wp_localize_script(
			'ww-copy-permalink',
			'WWCopyPermalink',
			array(
				'copied' => esc_html__( 'Permalink copied!', 'ww-copy-permalink' ),
				'failed' => esc_html__( 'Unable to copy permalink.', 'ww-copy-permalink' ),
			)
		);
	}
}
