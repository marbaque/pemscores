<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pemscores
 */

?>

	</div><!-- #content -->

	<div class="footer-container">
		<div class="footer-widgets__wrap">

			<?php get_sidebar( 'footer' ); ?>

			<?php
			// Make sure there is a social menu to display.
			if ( has_nav_menu( 'social' ) ): ?>
			<nav class="social-menu">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>' . pemscores_get_svg( array( 'icon' => 'chain' ) ),
						'items_wrap' => '<p class="title">' . __( 'Academia Municipal', 'pemscores') . '</p><ul class="%2$s">%3$s</ul>'
					) );
				?>
			</nav><!-- .social-menu -->
		<?php endif; ?>
		</div><!-- .footer-widgets__wrap -->
	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-footer__wrap">

			<div class="site-info">
				<nav class="info-menu">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'info',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
						) );
					?>
				</nav><!-- .social-menu -->
			</div><!-- .site-info -->
		</div><!-- .site-footer__wrap -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
