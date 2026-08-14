<?php
/**
 * Permalink Helper.
 *
 * @package WWCopyPermalink
 */

declare(strict_types=1);

namespace WWCopyPermalink\Helpers;

use WP_Post;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Resolves the correct URL for a post.
 */
final class Permalink {


	/**
	 * Get URL for a post.
	 *
	 * @param WP_Post $post Current post object.
	 *
	 * @return string
	 */
	public function get_url(
		WP_Post $post
	): string {

		/*
		 * Published content.
		 */
		if (
			'publish' === $post->post_status
		) {

			return (string) get_permalink(
				$post
			);
		}

		/*
		 * Preview URL for editable content.
		 */
		if (
			current_user_can(
				'edit_post',
				$post->ID
			)
		) {

			return (string) get_preview_post_link(
				$post
			);
		}

		return '';
	}
}
