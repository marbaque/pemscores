wp.domReady( () => {

	wp.blocks.registerBlockStyle( 'core/table', [ 
		{
			name: 'agenda',
      label: 'Tabla para programa',
			isDefault: false,
		}
	]);
} );