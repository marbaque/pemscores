<?php
/**
 * Template for displaying next/prev item in course.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) or die();

if ( ! isset( $prev_item ) && ! isset( $next_item ) ) {
	return;
}
?>

<div class="post-navigation">
	<?php if ( $prev_item ) { ?>
        <div class="nav-previous">

            <a href="<?php echo $prev_item->get_permalink(); ?>">
				<span class="meta-nav"><?php echo esc_html_x( 'Prev', 'course-item-navigation', 'learnpress' ); ?></span>
				<span class="post-title"><?php echo $prev_item->get_title(); ?></span>
            </a>
        </div>
	<?php } ?>

	<?php if ( $next_item ) { ?>
        <div class="nav-next">

            <a href="<?php echo $next_item->get_permalink(); ?>">
				<span class="meta-nav"><?php echo esc_html_x( 'Next', 'course-item-navigation', 'learnpress' ); ?></span>
				<span class="post-title"><?php echo $next_item->get_title(); ?></span>
            </a>
        </div>
	<?php } ?>
</div>
<?php
/*
	'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Siguiente', 'pemscores' ) . '</span> ' .
		'<span class="screen-reader-text">' . __( 'Entrada siguiente:', 'pemscores' ) . '</span> ' .
		'<span class="post-title">%title</span>',
	'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Anterior', 'pemscores' ) . '</span> ' .
		'<span class="screen-reader-text">' . __( 'Entrada anterior:', 'pemscores' ) . '</span> ' .
		'<span class="post-title">%title</span>',
*/

?>
