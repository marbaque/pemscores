<?php
/**
 * Custom Blocks con ACF
 *
 */

// Registrar bloques para ACF
add_action('acf/init', 'my_acf_init_block_types');

function my_acf_init_block_types()
{

	// Check function exists.
	if (function_exists('acf_register_block_type')) {

		// registrar un bloque de agenda
		acf_register_block_type(array(
			'name'              => 'agenda',
			'title'             => __('Agenda de visita'),
			'description'       => __('Un bloque para agenda de visitas.'),
			'render_template'   => 'template-parts/blocks/agenda/agenda.php',
			'enqueue_style' 	=> get_stylesheet_directory_uri()  . '/template-parts/blocks/agenda/agenda.css',
			'category'          => 'formatting',
			'icon'              => 'calendar-alt',
			'keywords'          => array('agenda', 'evento'),
		));

		// register a testimonial block.
		acf_register_block_type(array(
			'name'              => 'testimonial',
			'title'             => __('Testimonio'),
			'description'       => __('Un bloque personalizado para testimonios.'),
			'render_template'   => 'template-parts/blocks/testimonial/testimonial.php',
			'enqueue_style' 	=> get_stylesheet_directory_uri()  . '/template-parts/blocks/testimonial/testimonial.css',
			'category'          => 'formatting',
			'icon'              => 'admin-comments',
			'keywords'          => array('testimonial', 'quote'),
		));

		// Register a site block
		acf_register_block_type(array(
			'name'              => 'sitios',
			'title'             => __('Galería de sitios'),
			'description'       => __('Un bloque personalizado para sitios.'),
			'render_template'   => 'template-parts/blocks/sitios/sitios.php',
			'enqueue_style' 	=> get_stylesheet_directory_uri()  . '/template-parts/blocks/sitios/sitios.css',
			'category'          => 'formatting',
			'icon'              => 'store',
			'keywords'          => array('posts', 'gallery'),
		));
	}
}