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


//Editar el Dashboard Footer
function change_admin_footer(){
	 echo '<span id="footer-note">Desarrollado por <a href="http://multimedia.uned.ac.cr/" target="_blank">Multimedia UNED</a>.</span>';
	}
add_filter('admin_footer_text', 'change_admin_footer');


/* * ********************************************************************* */
// Dar a categorias del curso el mismo template de archivo de cursos page-capacitacion.php
/* * ********************************************************************* */
add_filter('template_include', function( $template ) {
	if ( is_tax('course_category') ) {
		$locate = locate_template('page-capacitacion.php', false, false);
		if (!empty($locate)) {
			$template = $locate;
		}
	}
	return $template;
});

// Quita las metaboxes de autores y organizaciones en recursos
// No sirve con gutenberg
function remove_tags_fields() {
	remove_meta_box( 'tagsdiv-autor_tag' , 'recurso' , 'side' );
	remove_meta_box( 'tagsdiv-organizacion_tag' , 'recurso' , 'side' );
	remove_meta_box( 'coberturadiv' , 'recurso' , 'side' );
	remove_meta_box( 'tagsdiv-tipo_recurso' , 'recurso' , 'side' );
	remove_meta_box( 'tagsdiv-tipo_medio' , 'recurso' , 'side' );
	remove_meta_box( 'tagsdiv-interaccion' , 'recurso' , 'side' );
}
add_action( 'admin_menu' , 'remove_tags_fields' );

//tamaño del excerpt
function wpse_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpse_excerpt_length', 999 );

//capturas de pantalla
/**
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
	$src = 'http://s.wordpress.com/mshots/v1/' . $url . '?' . http_build_query( $params, null, '&' );

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


//Usar gutenberg en recursos
add_filter('register_post_type_args', 'learnpress_cpt_add_gutenberg_support', 10, 2);

function learnpress_cpt_add_gutenberg_support ($args, $post_type)
{

    if (in_array($post_type, array(
       //'lp_course',
       'lp_lesson',
           ))){

        $args['show_in_rest'] = true;
    }

    return $args;
}


function pemscores_setup_theme_supported_features() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => __( 'strong magenta', 'themeLangDomain' ),
            'slug' => 'strong-magenta',
            'color' => '#a156b4',
        ),
        array(
            'name' => __( 'light grayish magenta', 'themeLangDomain' ),
            'slug' => 'light-grayish-magenta',
            'color' => '#d0a5db',
        ),
        array(
            'name' => __( 'very light gray', 'themeLangDomain' ),
            'slug' => 'very-light-gray',
            'color' => '#eee',
        ),
        array(
            'name' => __( 'very dark gray', 'themeLangDomain' ),
            'slug' => 'very-dark-gray',
            'color' => '#444',
        ),
    ) );
}

add_action( 'after_setup_theme', 'pemscores_setup_theme_supported_features' );

/*
*	Esconder perfil de buddypress si no esta registrado como usuario
*	las página correspondienes se deben tener el siguiente slug:
*	perfil-academia
* regsitro-academia
*/
add_action( 'template_redirect', function() {

    if( ( is_page('perfil-academia') ) ) {
        if (!is_user_logged_in() ) {
            wp_redirect( site_url( '/registro-academia' ) ); // redirect all...
            exit();
        }

    }

});

// Esconder logo del adminbar de Wp
function pemscores_admin_bar_remove_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
}
add_action( 'wp_before_admin_bar_render', 'pemscores_admin_bar_remove_logo', 0 );


// Login page personalizada
function my_login_logo() { ?>
    <style type="text/css">
			body.login {
				background-color: #ebf3fc;
			}
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo-full.png);
						height:100px;
						width:320px;
						background-size: contain;
						background-repeat: no-repeat;
	        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Redireccionar logo a inicio del sitio
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Academia Municipal';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

// Redireccionar despues de login
function admin_default_page() {
  return '/perfil-academia';
}

add_filter('login_redirect', 'admin_default_page');

// No permitir que usuarios vayan a escritorio
function disable_dashboard() {
    if (current_user_can('subscriber') && is_admin()) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('admin_init', 'disable_dashboard');


// Permitir sólo ciertos bloques para recursos
add_filter( 'allowed_block_types', 'academia_allowed_block_types', 10, 2 );

function academia_allowed_block_types( $allowed_blocks, $post ) {

	if( $post->post_type === 'recurso' ) {
		$allowed_blocks = array(
			'core/paragraph',
			'core/heading',
			'core/list'
		);
	}

	return $allowed_blocks;

}

// Cambiar 'enter title here' en recursos
function pemscores_change_title_text( $title ){
     $screen = get_current_screen();

     if  ( 'recurso' == $screen->post_type ) {
          $title = 'Nombre del recurso';
     }

     return $title;
}

add_filter( 'enter_title_here', 'pemscores_change_title_text' );
