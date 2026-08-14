/**
 * ============================================================
 * WW Copy Permalink
 * Admin JavaScript
 * ============================================================
 */

(() => {
	'use strict';


	/**
	 * Copy text to clipboard.
	 *
	 * @param {string} text Text to copy.
	 *
	 * @returns {Promise<boolean>}
	 */
	async function copyText(text) {

		if (!text) {
			return false;
		}


		/*
		 * Modern Clipboard API.
		 */
		if (
			navigator.clipboard &&
			window.isSecureContext
		) {

			try {

				await navigator.clipboard.writeText(text);

				return true;

			} catch (error) {

				// Continue with fallback.
			}
		}


		/*
		 * Legacy fallback.
		 */
		const textarea = document.createElement('textarea');


		textarea.value = text;

		textarea.setAttribute(
			'readonly',
			''
		);

		textarea.style.position = 'fixed';

		textarea.style.left = '-9999px';


		document.body.appendChild(textarea);


		textarea.select();


		let copied = false;


		try {

			copied = document.execCommand('copy');

		} catch (error) {

			copied = false;
		}


		textarea.remove();


		return copied;
	}


	/**
	 * Show notification.
	 *
	 * @param {string} message Message.
	 * @param {boolean} error Error state.
	 */
	function showNotice(
		message,
		error = false
	) {

		let notice = document.getElementById(
			'wwcp-notice'
		);


		if (!notice) {

			notice = document.createElement('div');

			notice.id = 'wwcp-notice';

			notice.setAttribute(
				'role',
				'status'
			);

			document.body.appendChild(notice);
		}


		notice.textContent = message;


		notice.classList.toggle(
			'is-error',
			error
		);


		notice.classList.add(
			'is-visible'
		);


		clearTimeout(
			notice.timeout
		);


		notice.timeout = setTimeout(
			() => {

				notice.classList.remove(
					'is-visible'
				);

			},
			2500
		);
	}


	/**
	 * Handle copy action.
	 */
	document.addEventListener(
		'click',
		async (event) => {


			const button = event.target.closest(
				'.wwcp-copy-permalink'
			);


			if (!button) {
				return;
			}


			event.preventDefault();


			const permalink = button.dataset.permalink || '';


			const result = await copyText(
				permalink
			);


			if (result) {

				showNotice(
					WWCopyPermalink.copied
				);

			} else {

				showNotice(
					WWCopyPermalink.failed,
					true
				);
			}

		}
	);

})();
