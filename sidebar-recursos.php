<?php

/**
 * The page sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pemscores
 */


?>
<aside id="secondary" class="widget-area widgets-recursos" role="complimentary">
	<!-- agregamos un widget manualmente con el shorcode para el plugin search and filter -->
	<!-- http://docs.designsandcode.com/search-filter/ -->
	<div class="widget">

		<div class="widget-inner">

			<h2 class="widget-title"><?php echo __('Buscar recursos', 'pemscores'); ?></h2>

			<?php
			// The standard search form
			$form = get_search_form(false);

			// Let's add a hidden input field
			$form = str_replace('<input type="submit"', '<input type="hidden" name="post_type" value="recurso"><input type="submit"', $form);

			// Display our modified form
			echo $form;
			?>

		</div>
	</div>

	<?php
	if (is_active_sidebar('sidebar-4')) {
		dynamic_sidebar('sidebar-4');
	}
	?>

</aside> <!-- secondary -->