<?php
/**
 * Plugin Name:       Sadhaka Core
 * Description:       Quote and Practice post types plus shortcodes for the Sadhaka spiritual content site.
 * Version:           1.0.0
 * Author:            Siva
 * License:           GPL-2.0-or-later
 * Text Domain:       sadhaka-core
 */

defined( 'ABSPATH' ) || exit;

define( 'SADHAKA_CORE_VERSION', '1.0.0' );
define( 'SADHAKA_CORE_DIR', plugin_dir_path( __FILE__ ) );

require_once SADHAKA_CORE_DIR . 'includes/post-types.php';
require_once SADHAKA_CORE_DIR . 'includes/meta-boxes.php';
require_once SADHAKA_CORE_DIR . 'includes/shortcodes.php';

/**
 * Flush rewrite rules on activation/deactivation so CPT permalinks work.
 */
function sadhaka_core_activate() {
	sadhaka_register_post_types();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'sadhaka_core_activate' );

function sadhaka_core_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'sadhaka_core_deactivate' );
