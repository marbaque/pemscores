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
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<?php echo pemscores_get_svg( array( 'icon' => 'list' ) ); ?>
				<span class="skip-link screen-reader-text"><?php esc_html_e( 'Primary Menu</span>', 'pemscores' ); ?></span>
			</button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<?php if ( !is_front_page() && is_page() || is_singular('lp_course') ) : ?>
		
		<?php if ( has_post_thumbnail() ): ?>			
			<div class="full-bleed featured-image">
				<?php
					the_post_thumbnail('pemscores-full-bleed');
					?>
			</div><!-- .full-bleed -->
		<?php endif; ?>

		<?php if ( is_singular('lp_course') ): ?>
			<div class="course-title_wrap"><?php the_title( '<h1 class="course-title">', '</h1>' ); ?></div>
		<?php endif; ?>

		<?php if ( !is_singular('lp_course') && !is_buddypress() ): ?>
			<header class="page-header">
				<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
		<?php endif; ?>

	<?php endif; ?>

	<?php if ( is_front_page() ): ?>

		<section class="hero-banner" aria-role="banner">
			
		<h1 class="hero-title">Academia Municipal</h1>
			
			<section class="search-section">
				<div class="home-search">

					<?php
					// The standard search form
					$form = get_search_form( false );
					
					// Let's add a hidden input field
					$form = str_replace( '<input type="submit"', '<input type="hidden" name="post_type" value="recurso"><input type="submit"', $form );
					
					// Display our modified form
					echo $form;
					?>

				</div>
			</section>

		</section><!-- .hero-banner -->

	<?php endif; // End fornt-page check. ?>


	<div id="content" class="site-content">
