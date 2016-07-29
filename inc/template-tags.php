<?php

/**
 * Returns the featured image, custom header or false in this priority order.
 *
 * @return false|string
 */
function primer_get_custom_header() {
	$post_id = get_queried_object_id();

	$image_size = (int) get_theme_mod( 'full_width' ) === 1 ? 'hero-2x' : 'hero';

	if ( has_post_thumbnail( $post_id ) ) {
		$image = get_the_post_thumbnail_url( $post_id, $image_size );

		if ( getimagesize( $image ) ) {
			return $image;
		}
	}

	$custom_header = get_custom_header();
	if ( ! empty( $custom_header->attachment_id ) ) {
		$image = wp_get_attachment_image_url( $custom_header->attachment_id, $image_size );

		if ( getimagesize( $image ) ) {
			return $image;
		}
	}

	$header_image = get_header_image();
	return $header_image;
}