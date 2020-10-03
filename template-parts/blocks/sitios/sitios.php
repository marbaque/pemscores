<?php

/**
 * Agenda Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'sitios-' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'sitios-container';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$className .= ' align' . $block['align'];
}

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<?php if (have_rows('mu_sitios')) : ?>
		<?php while (the_repeater_field('mu_sitios')) : ?>
			<div class="item-sitio">

				<?php $link = get_sub_field('mu_enlace'); ?>

				<a href="<?php echo $link; ?>">
					<div class="portada-sitio">

						<?php
						$image = get_sub_field('mu_portada');
						$size = 'large'; // (thumbnail, medium, large, full or custom size)
						if ($image) {
							echo wp_get_attachment_image($image, $size);
						} else {
							echo '<img src="' . get_stylesheet_directory_uri()  . '/template-parts/blocks/sitios/sitio-uned.png' . '" alt="Parte del logo de la uned">';
						}
						?>
					</div>
				</a>

				<div class="texto-sitio">

					<h3 class="nombre-sitio">
						<a href="<?php echo $link; ?>">
							<?php the_sub_field('mu_nombre'); ?>
						</a>
					</h3>

					<?php if (get_sub_field('mu_info')) : ?>
						<p><?php echo the_sub_field('mu_info'); ?></p>
					<?php endif; ?>

					<?php if (get_sub_field('mu_fecha')) : ?>
						<p class="mu-fecha">
							<svg width="21px" height="24px" viewBox="0 0 21 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<title>calendar-day-duotone</title>
								<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<g id="calendar-day-duotone" fill="#000000" fill-rule="nonzero">
										<path d="M0,9 L0,21.75 C0,22.9926407 1.00735931,24 2.25,24 L18.75,24 C19.9926407,24 21,22.9926407 21,21.75 L21,9 L0,9 Z M9,17.25 C9,17.6642136 8.66421356,18 8.25,18 L3.75,18 C3.33578644,18 3,17.6642136 3,17.25 L3,12.75 C3,12.3357864 3.33578644,12 3.75,12 L8.25,12 C8.66421356,12 9,12.3357864 9,12.75 L9,17.25 Z M14.25,6 L15.75,6 C16.1642136,6 16.5,5.66421356 16.5,5.25 L16.5,0.75 C16.5,0.335786438 16.1642136,0 15.75,0 L14.25,0 C13.8357864,0 13.5,0.335786438 13.5,0.75 L13.5,5.25 C13.5,5.66421356 13.8357864,6 14.25,6 Z M5.25,6 L6.75,6 C7.16421356,6 7.5,5.66421356 7.5,5.25 L7.5,0.75 C7.5,0.335786438 7.16421356,0 6.75,0 L5.25,0 C4.83578644,0 4.5,0.335786438 4.5,0.75 L4.5,5.25 C4.5,5.66421356 4.83578644,6 5.25,6 Z" id="Shape" opacity="0.4"></path>
										<path d="M21,5.25 L21,9 L0,9 L0,5.25 C0,4.00735931 1.00735931,3 2.25,3 L4.5,3 L4.5,5.25 C4.5,5.66421356 4.83578644,6 5.25,6 L6.75,6 C7.16421356,6 7.5,5.66421356 7.5,5.25 L7.5,3 L13.5,3 L13.5,5.25 C13.5,5.66421356 13.8357864,6 14.25,6 L15.75,6 C16.1642136,6 16.5,5.66421356 16.5,5.25 L16.5,3 L18.75,3 C19.9926407,3 21,4.00735931 21,5.25 Z" id="Path"></path>
									</g>
								</g>
							</svg>
							<?php echo the_sub_field('mu_fecha'); ?>
						</p>
					<?php endif; ?>
				</div>


			</div>
		<?php endwhile; ?>
	<?php endif; ?>

</div>