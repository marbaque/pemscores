<?php
/**
 * Template for displaying instructor of course within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/loop/course/instructor.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course = LP_Global::course();
?>

<span class="course-instructor">
	<?php echo $course->get_instructor_html(); ?>
</span>

<!-- Agregado por Mario para AcadMuni -->

<div class="lp-course-tags">
	<?php $term_list = get_the_term_list( get_the_ID(), 'course_category', '', ' ', '' ); ?>

	<?php if ( $term_list ) {
		printf( '<div class="cat-links">%s</div>', $term_list );
	}

	$tags = get_the_term_list( get_the_ID(), 'course_tag', 'Etiquetas: ', ', ', '' );
	if( $tags ) {
		printf(
			'<div class="course-tags">%s</span>',	
			$tags
		);
	}	
	?>
</div>
