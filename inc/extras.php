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
	if ( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-recursos' ) ) {
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
// Dar a taxonomias de recursos el mismo template de archivo de recursos archive-recurso.php
/* * ********************************************************************* */
add_filter('template_include', function( $template ) {
	if ( is_tax('course_category') || is_tag('course_tag') ) {
		$locate = locate_template('page-capacitacion.php', false, false);
		if (!empty($locate)) {
			$template = $locate;
		}
	}
	if ( 	is_tax('temas') || 
				is_tax('cobertura') || 
				is_tax('tipo_recurso') || 
				is_tax('tipo_medio') || 
				is_tax('organizacion_tag') || 
				is_tax('autor_tag') || 
				is_tax('interaccion') ) {

		$locate = locate_template('archive-recurso.php', false, false);
		if (!empty($locate)) {
			$template = $locate;
		}
	}

	return $template;
});

//tamaño del excerpt
function wpse_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpse_excerpt_length', 999 );


//Usar gutenberg en lecciones
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
* registro-academia
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
add_filter( 'login_headertext', 'my_login_logo_url_title' );

 
/* 
Redireccionar despues de login
La página de perfil de Learnpress debe tener el permalink 'perfil-academia'
Si cambia este nombre, entonces debe cambiar también el permalink de la página en cuestión 
*/

function admin_default_page() {
  return '/perfil-academia';
}
add_filter('login_redirect', 'admin_default_page');


// Desactivar Gutenberg en recursos
add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type)
{
    // Use your post type key instead of 'product'
    if ($post_type === 'recurso') return false;
    return $current_status;
}


// Quitar admin bar de buddypress
add_action( 'init', 'remove_admin_bar_user', 10001 );
function remove_admin_bar_user() {

	if ( current_user_can( 'administrator' ) || current_user_can( 'editor' ) || current_user_can( 'author' ) || current_user_can( 'especialista_ifcmdl' ) ) {
		
		show_admin_bar( true );
	
	} else {
		
		show_admin_bar( false );
	}
}

// Permitir subir otros tipos de archivos a recursos u otros tipos de contenidos
//.doc, .docx (Microsoft Word Document)
add_filter('upload_mimes','add_custom_mime_types');

function add_custom_mime_types($mimes){
	return array_merge($mimes,array (
		'doc'	=>	'application/msword',
		'docx'	=>	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'ppt'	=>	'application/vnd.ms-powerpoint',
		'pptx'	=>	'application/vnd.openxmlformats-officedocument.presentationml.presentation',
		'pps'	=>	'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
		'dotx'	=>	'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
	));
}


/**
 * Disable all colors within Gutenberg.
 */
function pemscores_gutenberg_disable_all_colors() {
	add_theme_support( 'editor-color-palette' );
	add_theme_support( 'disable-custom-colors' );
}
add_action( 'after_setup_theme', 'pemscores_gutenberg_disable_all_colors' );

// Google analytics
function pemscores_google_analytics() { ?>
  <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-64250561-45"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-64250561-45');
	</script>
  <?php
  }
  
add_action( 'wp_head', 'pemscores_google_analytics', 10 );

//Quita las metaboxes de areas y licencias en curso y seccion
function remove_tags_fields() {
	remove_meta_box( 'tagsdiv-organizacion_tag' , 'recurso' , 'side' );
	remove_meta_box( 'tagsdiv-autor_tag' , 'recurso' , 'side' );
	remove_meta_box( 'coberturadiv' , 'recurso' , 'side' );
	remove_meta_box( 'tagsdiv-tipo_recurso' , 'recurso' , 'side' );
	remove_meta_box( 'tagsdiv-tipo_medio' , 'recurso' , 'side' );
	remove_meta_box( 'tagsdiv-interaccion' , 'recurso' , 'side' );
	remove_meta_box( 'tagsdiv-temas' , 'recurso' , 'side' );
}
add_action( 'admin_menu' , 'remove_tags_fields' );

// Desabilitar debates nuevos para participantes
// Solo los keymasters pueden postear temas nuevos
function buddydev_bbp_restrict_topic_creation( $can ) {
		
	$forum_id = 2289;//change your forum id
	
	if ( ! bbp_is_user_keymaster() &&  bbp_is_single_forum() ) {
		$can = false;
		
	}
	
	return $can;
	

}
add_filter( 'bbp_current_user_can_publish_topics', 'buddydev_bbp_restrict_topic_creation' );

function buddydev_restrict_from_posting_topic( $forum_id ) {
	
	$restricted_forum_id = 2289;
	
	if ( ! bbp_is_user_keymaster() ) {
		//set error on bbpress and it will not allow creating topic
		//not the best idea but I personaly don't like the way bbpress does not provide any forum info at other places to hook
		bbp_add_error( 403, __( 'No puede crear nuevos temas' ) );
		
	}
}
add_action( 'bbp_new_topic_pre_extras', 'buddydev_restrict_from_posting_topic' );

// Flush permalinks every hour 
add_action('my_hourly_event', 'do_this_hourly');
 
function my_activation() {
    if ( !wp_next_scheduled( 'my_hourly_event' ) ) {
        wp_schedule_event(time(), 'hourly', 'my_hourly_event');
    }
}
 
add_action('wp', 'my_activation');
 
function do_this_hourly() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
