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
<?php echo file_get_contents('cintillo_uned_azul/cintillo_uned_simple.html'); ?>
<!-- El menu inst esta roto, este /div es para cerrar el div class="nav_uned" -->

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Omitir e ir al contenido', 'pemscores' ); ?></a>

	<?php if ( get_header_image() && is_front_page() ) : ?>
	<figure class="header-image">
		<?php $header_image_data = get_theme_mod( 'header_image_data' ); ?>
		<?php echo wp_get_attachment_image( $header_image_data->attachment_id, 'full' ); ?>
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

				<?php echo pemscores_get_svg( array( 'icon' => 'chevron-down', 'fallback' => true ) ); ?>
				<span>Contenidos</span>
			</button>
			<?php wp_nav_menu( array( 
				'theme_location' => 'primary', 
				'menu_id' => 'primary-menu'
				) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<div id="content" class="site-content">
