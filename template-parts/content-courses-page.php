<?php
/**
 * Template part for displaying archive of courses.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pemscores
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content post-content">
		<?php
			the_content();
		?>
	</div><!-- .entry-content .post-content -->

	<?php //get_sidebar( 'page' ); ?>

</article><!-- #post-## -->
