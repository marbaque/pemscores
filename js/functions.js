(function($){
	$('figure.wp-caption.aligncenter').removeAttr('style');
	$('img.aligncenter').wrap('<figure class="centered-image" />');

	// Agregar el icono de lupa a los input fields de busqueda
	$('.search-field').before('<i class="fa fa-search" aria-hidden="true"></i>');
	$('input[name="ofsearch"]').before('<i class="fa fa-search" aria-hidden="true"></i>');
	$('#bbp_search').before('<i class="fa fa-search" aria-hidden="true"></i>');

	// Quitar tab de pedidos (orders) del perfil de buddypress
	// $('#orders-personal-li').remove(); 
	// con la traducción el id cambia
	$('#pedidos-personal-li').remove();
	
	/*
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	if ( true === supportsInlineSVG() ) {
		document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
	}
})(jQuery);
