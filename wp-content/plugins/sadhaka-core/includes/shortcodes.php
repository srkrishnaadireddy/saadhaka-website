<?php
/**
 * Shortcodes:
 *   [sadhaka_random_quote]                         — one random quote (rotates per page load)
 *   [sadhaka_practices level="beginner" count="5"] — practice recommendation list
 */

defined( 'ABSPATH' ) || exit;

function sadhaka_random_quote_shortcode() {
	$q = new WP_Query(
		array(
			'post_type'      => 'sadhaka_quote',
			'posts_per_page' => 1,
			'orderby'        => 'rand',
			'no_found_rows'  => true,
		)
	);
	if ( ! $q->have_posts() ) {
		return '';
	}
	$q->the_post();
	$author = get_post_meta( get_the_ID(), 'quote_author', true );
	$source = get_post_meta( get_the_ID(), 'quote_source', true );

	$html  = '<blockquote class="sadhaka-quote">';
	$html .= '<p>' . wp_kses_post( get_the_content() ) . '</p>';
	if ( $author ) {
		$html .= '<cite>— ' . esc_html( $author );
		if ( $source ) {
			$html .= ', <em>' . esc_html( $source ) . '</em>';
		}
		$html .= '</cite>';
	}
	$html .= '</blockquote>';
	wp_reset_postdata();
	return $html;
}
add_shortcode( 'sadhaka_random_quote', 'sadhaka_random_quote_shortcode' );

function sadhaka_practices_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'level'     => '',
			'tradition' => '',
			'count'     => 5,
		),
		$atts,
		'sadhaka_practices'
	);

	$args = array(
		'post_type'      => 'sadhaka_practice',
		'posts_per_page' => (int) $atts['count'],
		'orderby'        => 'rand',
		'no_found_rows'  => true,
	);
	if ( $atts['level'] ) {
		$args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery
			array(
				'key'   => 'practice_level',
				'value' => sanitize_text_field( $atts['level'] ),
			),
		);
	}
	if ( $atts['tradition'] ) {
		$args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery
			array(
				'taxonomy' => 'sadhaka_tradition',
				'field'    => 'slug',
				'terms'    => sanitize_title( $atts['tradition'] ),
			),
		);
	}

	$q = new WP_Query( $args );
	if ( ! $q->have_posts() ) {
		return '<p>' . esc_html__( 'No practices found yet.', 'sadhaka-core' ) . '</p>';
	}

	$html = '<ul class="sadhaka-practices">';
	while ( $q->have_posts() ) {
		$q->the_post();
		$level    = get_post_meta( get_the_ID(), 'practice_level', true );
		$duration = get_post_meta( get_the_ID(), 'practice_duration', true );
		$badge    = trim( implode( ' · ', array_filter( array( ucfirst( $level ), $duration ) ) ) );

		$html .= '<li class="sadhaka-practice">';
		$html .= '<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>';
		if ( $badge ) {
			$html .= ' <span class="sadhaka-practice-badge">' . esc_html( $badge ) . '</span>';
		}
		if ( has_excerpt() ) {
			$html .= '<p>' . esc_html( get_the_excerpt() ) . '</p>';
		}
		$html .= '</li>';
	}
	$html .= '</ul>';
	wp_reset_postdata();
	return $html;
}
add_shortcode( 'sadhaka_practices', 'sadhaka_practices_shortcode' );
