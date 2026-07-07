<?php
/**
 * Sadhaka Child theme functions.
 */

defined( 'ABSPATH' ) || exit;

function sadhaka_child_enqueue_styles() {
	wp_enqueue_style(
		'sadhaka-child',
		get_stylesheet_uri(),
		array( 'astra-theme-css' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'sadhaka_child_enqueue_styles' );
