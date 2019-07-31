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

		<section class="fp-content">
			<?php
			while ( have_posts() ) : the_post();

				the_content();

			endwhile; // End of the loop.
			?>
		</section>

		<section class="paginas-destacadas">
			<div class="paginas-inner">

			<?php

			$pagina1 = get_field('pagina_1');
			$desc1 = get_field('descripcion_1');

			if( $pagina1 ):

				// override $post
				$post = $pagina1;
				setup_postdata( $post );

				?>
				<div class="pagina">

					<h3>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_title(); ?>
						</a>
					</h3>
				
				<?php if ($desc1): ?>
					<p><?= $desc1; ?></p>
				<?php else: ?>
					<div class="excerpt"><?php the_excerpt(); ?></div>
				<?php endif; ?>
				
				<a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo __('Leer más', 'pemscores') . pemscores_get_svg( array( 'icon' => 'arrow-right' , 'fallback' => true ) ); ?></a>
				</div>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

			<?php endif; ?>

			<?php

			$pagina2 = get_field('pagina_2');
			$desc2 = get_field('descripcion_2');

			if( $pagina2 ):

				// override $post
				$post = $pagina2;
				setup_postdata( $post );

				?>
				<div class="pagina">
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					
					<?php if ($desc2): ?>
						<p><?= $desc2; ?></p>
					<?php else: ?>
						<div class="excerpt"><?php the_excerpt(); ?></div>
					<?php endif; ?>
				
				<a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo __('Leer más', 'pemscores') . pemscores_get_svg( array( 'icon' => 'arrow-right' , 'fallback' => true ) ); ?></a>
				</div>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

			<?php endif; ?>

			<?php

			$pagina3 = get_field('pagina_3');
			$desc3 = get_field('descripcion_3');

			if( $pagina3 ):

				// override $post
				$post = $pagina3;
				setup_postdata( $post );

				?>
			    <div class="pagina">
			    	<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					
					<?php if ($desc3): ?>
						<p><?= $desc3; ?></p>
					<?php else: ?>
						<div class="excerpt"><?php the_excerpt(); ?></div>
					<?php endif; ?>

					<a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo __('Leer más', 'pemscores') . pemscores_get_svg( array( 'icon' => 'arrow-right' , 'fallback' => true ) ); ?></a>
			    </div>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

			<?php endif; ?>
			</div>
		</section><!-- .paginas-destacadas-->

		<section class="cursos-destacados">
			<?php

				$args = array(
				    'post_type' => 'lp-course'
				);

				// Custom query.
				$query = new WP_Query( $args );

				// Check that we have query results.
				if ( $query->have_posts() ) {

				    // Start looping over the query results.
				    while ( $query->have_posts() ) {

				        $query->the_post();

				        get_template_part( 'template-parts/content', get_post_format() );

				    }

				}

				// Restore original post data.
				wp_reset_postdata();

				?>
		</section><!-- .cursos-destacados -->

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
