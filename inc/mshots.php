<?php
/**
 * Capturas de pantalla:
 * This shortcode will allow you to create a snapshot of a remote website and post it
 * on your WordPress site.
 *
 * [snapshot url="http://www.wordpress.org" alt="WordPress.org" width="400" height="300"]
 */

add_shortcode( 'snapshot', function ( $atts ) {
	$atts = shortcode_atts( array(
		'alt'    => '',
		'url'    => 'http://www.wordpress.org',
		'width'  => '600',
		'height' => '440'
	), $atts );
	$params = array(
		'w' => $atts['width'],
		'h' => $atts['height'],
	);
	$url = urlencode( $atts['url'] );
	$src = 'https://s.wordpress.com/mshots/v1/' . $url . '?' . http_build_query( $params, null, '&' );

	$cache_key = 'snapshot_' . md5( $src );
	$data_uri = get_transient( $cache_key );
	if ( ! $data_uri ) {
		$response = wp_remote_get( $src );
		if ( 200 === wp_remote_retrieve_response_code( $response ) ) {
			$image_data = wp_remote_retrieve_body( $response );
			if ( $image_data && is_string( $image_data ) ) {
				$src = $data_uri = 'data:image/jpeg;base64,' . base64_encode( $image_data );
				set_transient( $cache_key, $data_uri, DAY_IN_SECONDS );
			}
		}
	}

	return '<img src="' . esc_attr( $src ) . '" alt="' . esc_attr( $atts['alt'] ) . '"/>';
} );
