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
<aside id="secondary" class="widget-area widgets-recursos" role="complimentary">

	<div class="widget">
		<div class="widget-inner">
			<h2 class="widget-title"><?= echo __( 'Filtrar', 'pemscores' ); ?></h2>
			<?php echo do_shortcode('[searchandfilter fields="temas,cobertura,tipo_recurso,tipo_medio" headings="Ejes temáticos:,Cobertura:,Tipo de recurso:,Tipo de medio:" show_count="1,1,1,1" operators=”OR” empty_search_url="/recursos/" search_placeholder="Palabras clave" submit_label="Filtrar"]'); ?>
		</div>
	</div>	
	<?php dynamic_sidebar( 'sidebar-3' ); ?>
</aside> <!-- secondary -->