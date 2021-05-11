<?php

/**
 * Template for displaying overview tab of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/tabs/overview.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined('ABSPATH') || exit();
?>

<?php global $course; ?>

<div class="course-description" id="learn-press-course-description">

	<?php
	/**
	 * @deprecated
	 */
	do_action('learn_press_begin_single_course_description');

	/**
	 * @since 3.0.0
	 */
	do_action('learn-press/before-single-course-description');

	echo $course->get_content();

	/**
	 * @since 3.0.0
	 */
	do_action('learn-press/after-single-course-description');

	/**
	 * @deprecated
	 */
	do_action('learn_press_end_single_course_description');
	?>

	<?php if (get_field('lp_referencias')) : ?>

		<!-- Custom tab panel Referencias -->
		<div class="accordion tab-referencias">

			<button class="accordion-control">Referencias</button>
			<div class="accordion-panel">
				<?php the_field('lp_referencias'); ?>
			</div>

		</div>

	<?php endif; ?>

	<?php if (get_field('lp_creditos')) : ?>

		<!-- Custom tab panel Creditos -->
		<div class="accordion tab-creditos">
			<button class="accordion-control">Créditos</button>
			<div class="accordion-panel">
				<?php the_field('lp_creditos'); ?>
			</div>

		</div>

	<?php endif; ?>

</div>