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
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Omitir e ir al contenido', 'pemscores' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">

			<?php $blog_info = get_bloginfo( 'name' ); ?>

			<div class="site-branding__text">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-logo"><?php the_custom_logo(); ?></div>

				<?php else: ?>
					<?php if ( ! empty( $blog_info ) ) : ?>
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>
					<?php endif; ?>

					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) :
						?>
							<p class="site-description">
								<?php echo $description; ?>
							</p>
					<?php endif; ?>

				<?php endif; ?>

			</div><!-- .site-branding__text -->
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'pemscores' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<?php if ( is_front_page() || is_post_type_archive('recurso') ): ?>

		<?php if ( get_header_image() ) : ?>
		<div class="hero-banner custom-image" style="background-image: url(<?php header_image(); ?>);" aria-role="banner">
		<?php else : ?>
			<div class="hero-banner" aria-role="banner">
		<?php endif; // End header image check. ?>

		<div class="home-search">
			<h2><?php echo __( 'Buscar recursos', 'pemscores'); ?></h2>

			<form role="search" method="get" id="searchform" class="search-form searchandfilter" action="<?php echo get_site_url(); ?>">
				<div>
					<!-- <label for="s">Search for:</label> -->
					<input type="text" class="search-field" value="" name="s" id="s" placeholder="Buscar recursos, capacitación, ..." />
					<!-- <input type="hidden" value="1" name="sentence" /> -->
					<input type="hidden" value="recurso,lp_course" name="post_type" />
					<!-- <input type="hidden" value="product_cat" name="magazines,books" /> -->
					<input type="hidden" id="searchsubmit" value="Search" />

				</div>
			</form>

		</div>

		</div><!-- .hero-banner -->

	<?php endif; // End fornt-page check. ?>


	<div id="content" class="site-content">
		<?php
		if ( has_post_thumbnail() ) : ?>
		<div class="full-bleed">
			<figure class="featured-image">
				<?php
				the_post_thumbnail('pemscores-full-bleed');
				?>
			</figure><!-- .featured-image -->
			<?php if ( is_singular('lp_course') ): ?>
				<?php the_title( '<h1 class="course-title">', '</h1>' ); ?>
			<?php endif; ?>
		</div><!-- .full-bleed -->
		<?php endif; ?>

		<?php
			if( function_exists('bcn_display') && !is_singular('lp_course') ) {
				echo '<div class="migajas">';
				bcn_display();
				echo '</div>';
			}
			?>
