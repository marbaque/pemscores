<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pemscores
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php

			if ( is_home() && ! is_front_page() ) : ?>
				<header class="">
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();


else :

	get_template_part( 'template-parts/content', 'none' );
	return;

endif;
