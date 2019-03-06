<?php
/**
 * The page sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pemscores
 */

if ( ! is_active_sidebar( 'sidebar-2' ) || is_post_type_archive( 'lp-course' ) || is_page( 'perfil' )  )
{
	return;
}
?>

<aside id="page-secondary" class="widget-area page-sidebar" role="complementary">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside><!-- #secondary -->
