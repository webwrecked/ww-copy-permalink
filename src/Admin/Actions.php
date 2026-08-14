<?php
/**
 * Admin Row Actions.
 *
 * @package WWCopyPermalink
 */

declare(strict_types=1);

namespace WWCopyPermalink\Admin;

use WP_Post;

use WWCopyPermalink\Helpers\Permalink;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles Copy Permalink row action.
 */
final class Actions {

	private Permalink $permalink;

	public function __construct() {

		$this->permalink = new Permalink();
	}

	/**
	 * Register hooks.
	 *
	 * @return void
	 */
	public function register(): void {

		add_filter(
			'post_row_actions',
			array(
				$this,
				'add_copy_permalink_action',
			),
			10,
			2
		);

		add_filter(
			'page_row_actions',
			array(
				$this,
				'add_copy_permalink_action',
			),
			10,
			2
		);
	}


	/**
	 * Add Copy Permalink action.
	 *
	 * @param array   $actions Existing actions.
	 * @param WP_Post $post    Current post.
	 *
	 * @return array
	 */
	public function add_copy_permalink_action(
		array $actions,
		WP_Post $post
	): array {

		/*
		 * Permission check.
		 */
		if (
			! current_user_can(
				'edit_post',
				$post->ID
			)
		) {
			return $actions;
		}

		/*
		 * Ignore unsupported post types.
		 */
		if (
			! is_post_type_viewable(
				$post->post_type
			)
		) {
			return $actions;
		}

		$url = $this->permalink->get_url(
			$post
		);

		if ( empty( $url ) ) {
			return $actions;
		}

		$actions['wwcp_copy_permalink'] = sprintf(
			'<a href="#" class="wwcp-copy-permalink" data-permalink="%1$s">%2$s</a>',
			esc_attr( $url ),
			esc_html__(
				'Copy Permalink',
				'ww-copy-permalink'
			)
		);

		return $actions;
	}
}
