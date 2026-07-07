<?php
/**
 * Registers Quote and Practice custom post types and the Tradition taxonomy.
 */

defined( 'ABSPATH' ) || exit;

function sadhaka_register_post_types() {

	register_post_type(
		'sadhaka_quote',
		array(
			'labels'       => array(
				'name'          => __( 'Quotes', 'sadhaka-core' ),
				'singular_name' => __( 'Quote', 'sadhaka-core' ),
				'add_new_item'  => __( 'Add New Quote', 'sadhaka-core' ),
				'edit_item'     => __( 'Edit Quote', 'sadhaka-core' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'quotes' ),
			'menu_icon'    => 'dashicons-format-quote',
			'supports'     => array( 'title', 'editor', 'thumbnail' ),
			'show_in_rest' => true, // Block editor + REST API.
		)
	);

	register_post_type(
		'sadhaka_practice',
		array(
			'labels'       => array(
				'name'          => __( 'Practices', 'sadhaka-core' ),
				'singular_name' => __( 'Practice', 'sadhaka-core' ),
				'add_new_item'  => __( 'Add New Practice', 'sadhaka-core' ),
				'edit_item'     => __( 'Edit Practice', 'sadhaka-core' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'practices' ),
			'menu_icon'    => 'dashicons-heart',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
			'show_in_rest' => true,
		)
	);

	register_taxonomy(
		'sadhaka_tradition',
		array( 'sadhaka_quote', 'sadhaka_practice', 'post' ),
		array(
			'labels'       => array(
				'name'          => __( 'Traditions', 'sadhaka-core' ),
				'singular_name' => __( 'Tradition', 'sadhaka-core' ),
			),
			'public'       => true,
			'hierarchical' => true,
			'rewrite'      => array( 'slug' => 'tradition' ),
			'show_in_rest' => true,
		)
	);
}
add_action( 'init', 'sadhaka_register_post_types' );
