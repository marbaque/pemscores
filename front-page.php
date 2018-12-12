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



<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<div class="paginas-destacadas">
			<?php

			$pagina1 = get_field('pagina_1');

			if( $pagina1 ):

				// override $post
				$post = $pagina1;
				setup_postdata( $post );

				?>
			    <div class="pagina">
			    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			    	<div class="excerpt"><?php the_excerpt(); ?></div>
			    </div>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

			<?php endif; ?>

			<?php

			$pagina2 = get_field('pagina_2');

			if( $pagina2 ):

				// override $post
				$post = $pagina2;
				setup_postdata( $post );

				?>
			    <div class="pagina">
			    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="excerpt"><?php the_excerpt(); ?></div>
			    </div>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

			<?php endif; ?>

			<?php

			$pagina3 = get_field('pagina_3');

			if( $pagina3 ):

				// override $post
				$post = $pagina3;
				setup_postdata( $post );

				?>
			    <div class="pagina">
			    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="excerpt"><?php the_excerpt(); ?></div>
			    </div>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

			<?php endif; ?>
		</div><!-- .paginas-destacadas-->

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
