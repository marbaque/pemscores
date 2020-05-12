<?php
/**
 * The page sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pemscores
 */

if ( ! is_active_sidebar( 'sidebar-3' )  )
{
	return;
}
?>

<aside id="page-secondary" class="widget-area curso-sidebar" role="complementary">
	<?php dynamic_sidebar( 'sidebar-3' ); ?>
</aside><!-- #secondary -->
