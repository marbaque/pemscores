<?php
/**
 * pemscores Theme Customizer.
 *
 * @package pemscores
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pemscores_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Custom Customizer Customizations
	 */

	// Setting for header and footer background color
	$wp_customize->add_setting( 'theme_bg_color', array(
		'default'			=> '#00519e',
		'transport'			=> 'postMessage',
		'type'				=> 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
	));

	// Control for header and footer background color.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'theme_bg_color',
				array(
					'label'		=> __( 'Color de fondo de la cabecera y del pie de página', 'pemscores'),
					'section'	=> 'colors',
					'settings'	=> 'theme_bg_color'
				)
		)
	);

	// Create interactive color setting
	$wp_customize->add_setting( 'interactive_color' ,
		array(
			'default'			=> '#ee8925',
			'transport'			=> 'postMessage',
			'type'				=> 'theme_mod',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'transport'			=> 'postMessage',
		)
	);

	// Add the controls
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'interactive_color', array(
				'label'		=> __( 'Color de interacción (links y botones)', 'pemscores' ),
				'section'	=> 'colors',
				'settings'	=> 'interactive_color'
			)
		)
	);

	// Add option to select index content
	$wp_customize->add_section( 'theme_options',
		array(
			'title'			=> __( 'Opciones de la plantilla', 'pemscores' ),
			'priority'		=> 95,
			'capability'	=> 'edit_theme_options',
			'description'	=> __( 'Cambie cuánto de una entrada se muestra en el index y en la páginas de archivos.', 'pemscores' )
		)
	);

	// Create excerpt or full content settings
	$wp_customize->add_setting(	'length_setting',
		array(
			'default'			=> 'excerpt',
			'type'				=> 'theme_mod',
			'sanitize_callback' => 'pemscores_sanitize_length', // Sanitization function appears further down
			'transport'			=> 'postMessage'
		)
	);

	// Add the controls
	$wp_customize->add_control(	'pemscores_length_control',
		array(
			'type'		=> 'radio',
			'label'		=> __( 'Mostrar en index/archivos', 'pemscores' ),
			'section'	=> 'theme_options',
			'choices'	=> array(
				'excerpt'		=> __( 'Resumen (default)', 'pemscores' ),
				'full-content'	=> __( 'Contenido completo', 'pemscores' )
			),
			'settings'	=> 'length_setting' // Matches setting ID from above
		)
	);

	// Agregar text area para información de créditos en el footer
	$wp_customize->add_setting( 'pemscores_textarea_setting_id', array(
		'capability' => 'edit_theme_options',
		'default' => 'Lorem Ipsum Dolor Sit amet',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'pemscores_textarea_setting_id', array(
		'type' => 'textarea',
		'section' => 'edit_theme_options', // // Add a default or your own section
		'label' => __( 'Texto de colofón', 'pemscores' ),
		'description' => __( 'Este es el texto de autor o créditos que va en el footer.', 'pemscores' ),
	) );

}
add_action( 'customize_register', 'pemscores_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pemscores_customize_preview_js() {
	wp_enqueue_script( 'pemscores_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'pemscores_customize_preview_js' );


/**
 * Sanitize length options:
 * If something goes wrong and one of the two specified options are not used,
 * apply the default (excerpt).
 */

function pemscores_sanitize_length( $value ) {
    if ( ! in_array( $value, array( 'excerpt', 'full-content' ) ) ) {
        $value = 'excerpt';
	}
    return $value;
}


if ( ! function_exists( 'pemscores_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see pemscores_custom_header_setup().
 */
function pemscores_header_style() {
	$header_text_color = get_header_textcolor();
	$header_bg_color = get_theme_mod( 'theme_bg_color' );
	$interactive_color = get_theme_mod('interactive_color');

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
	 */
	if ( HEADER_TEXTCOLOR != $header_text_color ) {

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
			.site-title,
			.site-title a,
			.main-navigation a,
			.main-navigation a:hover,
			.main-navigation a:active,
			.main-navigation a:focus,
			.main-navigation li:hover,
			button.dropdown-toggle,
			.menu-toggle,
			.site-footer,
			.site-footer a {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}

			.menu-toggle,
			.custom-logo-link:focus > img, .custom-logo-link:hover > img {
				outline-color: #<?php echo esc_attr( $header_text_color ); ?>;
			}

			button.menu-toggle:hover,
			button.menu-toggle:focus {
				color: <?php echo esc_attr( $header_bg_color ); ?>;
				background-color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		</style>
		<?php
	}

	/*
	 * Do we have a custom header background color?
	 */
	if ( '#00519e' != $header_bg_color ) { ?>
		<style type="text/css">
			.site-header,
			.site-footer,
			.nav-menu .sub-menu,
			.main-navigation.toggled .nav-menu {
				background-color: <?php echo esc_attr( $header_bg_color ); ?>;
			}
		</style>
	<?php
	}

	/*
	 * Do we have a custom interactive color?
	 */
	if ( '#ee8925' != $interactive_color ) { ?>
		<style type="text/css">
			a:hover,
			a:focus,
			a:active,
			.page-content a:focus, .page-content a:hover,
			.entry-content a:focus,
			.entry-content a:hover,
			.entry-summary a:focus,
			.entry-summary a:hover,
			.comment-content a:focus,
			.comment-content a:hover,
			.cat-links a,
			.wp-block-button.is-style-outline,
			aside.filters ul li label {
				color: <?php echo esc_attr( $interactive_color ); ?>;
			}

			.page-content a,
			.entry-content a,
			.entry-summary a,
			.comment-content a,
			.post-navigation .post-title,
			.comment-navigation a:hover,
			.comment-navigation a:focus,
			.posts-navigation a:hover,
			.posts-navigation a:focus,
			.post-navigation a:hover,
			.post-navigation a:focus,
			.paging-navigation a:hover,
			.paging-navigation a:focus,
			.entry-title a:hover,
			.entry-title a:focus,
			.entry-meta a:focus,
			.entry-meta a:hover,
			.entry-footer a:focus,
			.entry-footer a:hover,
			.reply a:hover,
			.reply a:focus,
			.comment-form .form-submit input:hover,
			.comment-form .form-submit input:focus,
			.widget a:hover,
			.widget a:focus {
				border-color: <?php echo esc_attr( $interactive_color ); ?>;
			}

			.comment-navigation a:hover,
			.comment-navigation a:focus,
			.posts-navigation a:hover,
			.posts-navigation a:focus,
			.post-navigation a:hover,
			.post-navigation a:focus,
			.paging-navigation a:hover,
			.paging-navigation a:focus,
			.continue-reading a:focus,
			.continue-reading a:hover,
			.cat-links a:focus,
			.cat-links a:hover,
			.reply a:hover,
			.reply a:focus,
			.comment-form .form-submit input:hover,
			.comment-form .form-submit input:focus,
			.wp-block-button:not(.is-style-outline) .wp-block-button__link,
			aside.filters ul li.checked label {
				background-color: <?php echo esc_attr( $interactive_color ); ?>;
			}

			@media screen and (min-width: 900px) {
				.no-sidebar .post-content__wrap .entry-meta a:hover,
				.no-sidebar .post-content__wrap .entry-meta a:focus {
					border-color: <?php echo esc_attr( $interactive_color ); ?>;
				}
			}
		</style>
	<?php
	}
}
endif;



