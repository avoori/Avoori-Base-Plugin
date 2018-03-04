<?php
/**
 * Output Message
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'avoo_admin_notice_your_plugin_installed' ) ) {

	function avoo_admin_notice_your_plugin_installed() {
		echo '<div id="message" class="notice notice-success is-dismissible"><p>'. esc_html__( 'Thank you for installing the Avoori Base Plugin.', 'your-text-domain' ) .'</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
	}

}

?>