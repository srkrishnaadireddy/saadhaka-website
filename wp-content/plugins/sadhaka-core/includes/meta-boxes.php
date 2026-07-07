<?php
/**
 * Meta fields: quote author/source; practice level, duration.
 * Registered via register_post_meta so they appear in the block editor sidebar
 * (with a plugin like "Meta Field Block") and the REST API. Simple classic
 * meta boxes are also provided for convenience.
 */

defined( 'ABSPATH' ) || exit;

function sadhaka_register_meta() {
	$meta = array(
		'sadhaka_quote'    => array( 'quote_author', 'quote_source' ),
		'sadhaka_practice' => array( 'practice_level', 'practice_duration' ),
	);
	foreach ( $meta as $post_type => $keys ) {
		foreach ( $keys as $key ) {
			register_post_meta(
				$post_type,
				$key,
				array(
					'show_in_rest'      => true,
					'single'            => true,
					'type'              => 'string',
					'sanitize_callback' => 'sanitize_text_field',
					'auth_callback'     => function () {
						return current_user_can( 'edit_posts' );
					},
				)
			);
		}
	}
}
add_action( 'init', 'sadhaka_register_meta' );

function sadhaka_add_meta_boxes() {
	add_meta_box( 'sadhaka_quote_meta', __( 'Quote Details', 'sadhaka-core' ), 'sadhaka_quote_meta_box', 'sadhaka_quote', 'side' );
	add_meta_box( 'sadhaka_practice_meta', __( 'Practice Details', 'sadhaka-core' ), 'sadhaka_practice_meta_box', 'sadhaka_practice', 'side' );
}
add_action( 'add_meta_boxes', 'sadhaka_add_meta_boxes' );

function sadhaka_quote_meta_box( $post ) {
	wp_nonce_field( 'sadhaka_meta', 'sadhaka_meta_nonce' );
	$author = get_post_meta( $post->ID, 'quote_author', true );
	$source = get_post_meta( $post->ID, 'quote_source', true );
	echo '<p><label>' . esc_html__( 'Author', 'sadhaka-core' ) . '</label><br />';
	echo '<input type="text" class="widefat" name="quote_author" value="' . esc_attr( $author ) . '" /></p>';
	echo '<p><label>' . esc_html__( 'Source (book, talk…)', 'sadhaka-core' ) . '</label><br />';
	echo '<input type="text" class="widefat" name="quote_source" value="' . esc_attr( $source ) . '" /></p>';
}

function sadhaka_practice_meta_box( $post ) {
	wp_nonce_field( 'sadhaka_meta', 'sadhaka_meta_nonce' );
	$level    = get_post_meta( $post->ID, 'practice_level', true );
	$duration = get_post_meta( $post->ID, 'practice_duration', true );
	$levels   = array( 'beginner', 'intermediate', 'advanced' );
	echo '<p><label>' . esc_html__( 'Level', 'sadhaka-core' ) . '</label><br /><select class="widefat" name="practice_level">';
	echo '<option value="">' . esc_html__( '— Select —', 'sadhaka-core' ) . '</option>';
	foreach ( $levels as $l ) {
		echo '<option value="' . esc_attr( $l ) . '"' . selected( $level, $l, false ) . '>' . esc_html( ucfirst( $l ) ) . '</option>';
	}
	echo '</select></p>';
	echo '<p><label>' . esc_html__( 'Duration (e.g., 15 min)', 'sadhaka-core' ) . '</label><br />';
	echo '<input type="text" class="widefat" name="practice_duration" value="' . esc_attr( $duration ) . '" /></p>';
}

function sadhaka_save_meta( $post_id ) {
	if ( ! isset( $_POST['sadhaka_meta_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['sadhaka_meta_nonce'] ), 'sadhaka_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( array( 'quote_author', 'quote_source', 'practice_level', 'practice_duration' ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'save_post', 'sadhaka_save_meta' );
