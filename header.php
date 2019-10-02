<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pemscores
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php echo file_get_contents('https://www.uned.ac.cr/menu/menu_1366.html'); ?>
</div> <!-- El menu inst esta roto, este /div es para cerrar el div class="nav_uned" -->

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Omitir e ir al contenido', 'pemscores' ); ?></a>

	<?php if ( get_header_image() && is_front_page() ) : ?>
	<figure class="header-image">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</figure><!-- .header-image -->
	<?php endif; // End header image check. ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">

			<?php the_custom_logo(); ?>
			<div class="site-branding__text">
			<?php
			if ( is_front_page() ) : ?>
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
			</div><!-- .site-branding__text -->
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				
				<svg width="20px" height="10px" viewBox="0 0 20 10">
						<g id="chevron-down" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon id="Path" fill="#fff" fill-rule="nonzero" points="1.61394061 0.210647783 0.386059386 1.78935222 10 9.26686158 19.6139406 1.78935222 18.3860594 0.210647783 10 6.73313842"></polygon>
						</g>
				</svg>
				<span>Contenidos</span>
			</button>
			<?php wp_nav_menu( array( 
				'theme_location' => 'primary', 
				'menu_id' => 'primary-menu'
				) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<div id="content" class="site-content">