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
			
			<h2 class="widget-title"><?= __( 'Filtrar recursos', 'pemscores' ); ?></h2>
			
			<?php echo do_shortcode('[searchandfilter fields="search,temas,cobertura,tipo_recurso,tipo_medio" headings=",Ejes temáticos:,Cobertura:,Tipo de recurso:,Tipo de medio:" show_count=",1,1,1,1" operators=”OR” empty_search_url="/recursos/" search_placeholder="Palabras clave" submit_label="Filtrar"]'); ?>
			
			<a class="clean-search" href="/recursos/">
				<i class="fa fa-refresh" aria-hidden="true"></i>
				<?= __( 'Limpiar', 'pemscores'); ?>
			</a>

		</div>
	</div>
	
	<?php
		if ( is_active_sidebar( 'sidebar-3' )  )
			{
				dynamic_sidebar( 'sidebar-3' );
			}	
	?>

</aside> <!-- secondary -->