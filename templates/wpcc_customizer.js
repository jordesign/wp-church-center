(function( $ ) {

        /**
         * Connects to the Theme Customizer's color picker, and changes the bg
         * color whenever the user changes colors in the Theme Customizer.
         */
	wp.customize( 'wpcc_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'background', to );
		});
	});

}( jQuery ));