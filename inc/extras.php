<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package pemscores
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pemscores_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
		$classes[] = 'archive-view';
	}

	// Add a class telling us if the sidebar is in use.
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'has-sidebar';
	} else {
		$classes[] = 'no-sidebar';
	}

	// Add a class telling us if the page sidebar is in use.
	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$classes[] = 'has-page-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'pemscores_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function pemscores_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'pemscores_pingback_header' );


//Edit the Dashboard Footer
function change_admin_footer(){
	 echo '<span id="footer-note">Desarrollado por <a href="http://multimedia.uned.ac.cr/" target="_blank">Multimedia UNED</a>.</span>';
	}
add_filter('admin_footer_text', 'change_admin_footer');

// Editor styles
/**
 * Enqueue block editor style
 */
function legit_block_editor_styles() {
	wp_enqueue_style( 'legit-editor-styles', get_theme_file_uri( '/inc/editor-styles.css' ), false, '1.0', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'legit_block_editor_styles' );