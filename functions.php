<?php
/**
 * pemscores functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pemscores
 */

if ( ! function_exists( 'pemscores_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pemscores_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on pemscores, use a find and replace
	 * to change 'pemscores' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'pemscores', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'pemscores-full-bleed', 2000, 1000, true );
	add_image_size( 'pemscores-index-img', 1000, 550, true );
	add_image_size( 'recurso-portada', 800, 800, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Header', 'pemscores' ),
		'social' => esc_html__( 'Social Media Menu', 'pemscores' ),
		'info' => esc_html__( 'Info del sitio', 'pemscores' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'pemscores_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for Custom Logo
	add_theme_support( 'custom-logo', array(
		'width' => 311,
		'height' => 56,
		'flex-width' => true,
	));

	/* Editor styles */
	add_editor_style( array( 'inc/editor-styles.css', pemscores_fonts_url() ) );
}
endif;
add_action( 'after_setup_theme', 'pemscores_setup' );


/**
 * Register custom fonts.
 */
function pemscores_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Roboto and Lora, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$sansSerif = _x( 'on', 'Roboto font: on or off', 'pemscores' );
	$serif = _x( 'on', 'Lora: on or off', 'pemscores' );

	$font_families = array();

	if ( 'off' !== $sansSerif ) {
		$font_families[] = '$roboto:400,400i,700,700i';
	}

	if ( 'off' !== $serif ) {
		$font_families[] = 'Lora:400,400i,700,700i';
	}


	if ( in_array( 'on', array($sansSerif, $serif) ) ) {

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function pemscores_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'pemscores-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'pemscores_resource_hints', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pemscores_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pemscores_content_width', 640 );
}
add_action( 'after_setup_theme', 'pemscores_content_width', 0 );


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function pemscores_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 900 <= $width ) {
		$sizes = '(min-width: 900px) 700px, 900px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) ) {
		$sizes = '(min-width: 900px) 600px, 900px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'pemscores_content_image_sizes_attr', 10, 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function pemscores_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {

	if ( !is_singular() ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 900px) 90vw, 800px';
		} else {
			$attr['sizes'] = '(max-width: 1000px) 90vw, 1000px';
		}
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'pemscores_post_thumbnail_sizes_attr', 10, 3 );




/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pemscores_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar de blog', 'pemscores' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Agregue widgets al blog.', 'pemscores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar de páginas', 'pemscores' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Agregue widgets a las páginas.', 'pemscores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Widgets de footer', 'pemscores' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Agregue widgets al footer.', 'pemscores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'pemscores_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pemscores_scripts() {
	// Enqueue Typekit Fonts: Futura and Expo Serif Pro
	wp_enqueue_style( 'pemscores-fonts', pemscores_fonts_url() );

	wp_enqueue_style( 'pemscores-style', get_stylesheet_uri() );

	wp_enqueue_script( 'pemscores-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );
	wp_localize_script( 'pemscores-navigation', 'pemscoresScreenReaderText', array(
		'expand' => __( 'Expand child menu', 'pemscores'),
		'collapse' => __( 'Collapse child menu', 'pemscores'),
	));

	wp_enqueue_script( 'pemscores-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20161201', true );

	wp_enqueue_script( 'pemscores-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script('pemscores-fitvids', get_template_directory_uri() . '/js/fitvids.js', array('jquery'),'', true);
    wp_register_script('pemscores-my-fitvids', get_template_directory_uri() . '/js/my-fitvids.js', array('pemscores-fitvids'),'', true);
    if(! is_admin() ) {
        wp_enqueue_script('pemscores-fitvids');
        wp_enqueue_script('pemscores-my-fitvids');
    }
}
add_action( 'wp_enqueue_scripts', 'pemscores_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Custom post types y taxonomies
 */
require get_template_directory() . '/inc/cpt.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load SVG icon functions.
 */
require get_template_directory() . '/inc/icon-functions.php';
