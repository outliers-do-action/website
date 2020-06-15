(function( $ ) {
	'use strict';
	$( document ).ready( function() {
		// Open links in new windows.
		$( '.ptam-block-post-grid-image a' ).click( function() {
			console.log('Triggered');
			if ( '#' !== this.href[this.href.length -1] ) {
				window.open( this.href );
			}
			return false;
		} );
	} );
})( jQuery );
