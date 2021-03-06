(function( $ ) {
	'use strict';

	/*
	*  new_map
	*
	*  This function will render a Google Map onto the selected jQuery element
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	$el (jQuery element)
	*  @return	n/a
	*/

	function new_map( $el ) {

		// var
		var $markers = $el.find('.marker');


		// vars
		var args = {
			zoom      : 16,
			center    : new google.maps.LatLng(0, 0),
			mapTypeId : google.maps.MapTypeId.ROADMAP,
			styles    : [
				{
					"featureType":"water",
					"elementType":"geometry",
					"stylers": [
						{"color":"#e9e9e9"},
						{"lightness":17}
					]
				},
				{
					"featureType":"landscape",
					"elementType":"geometry",
					"stylers": [
						{"color":"#f5f5f5"},
						{"lightness":20}
					]
				},
				{
					"featureType":"road.highway",
					"elementType":"geometry.fill",
					"stylers": [
						{"color":"#ffffff"},
						{"lightness":17}
					]
				},
				{
					"featureType":"road.highway",
					"elementType":"geometry.stroke",
					"stylers": [
						{"color":"#ffffff"},
						{"lightness":29},
						{"weight":0.2}
					]
				},{
					"featureType":"road.arterial",
					"elementType":"geometry",
					"stylers": [
						{"color":"#ffffff"},
						{"lightness":18}
					]
				},{
					"featureType":"road.local",
					"elementType":"geometry",
					"stylers": [
						{"color":"#ffffff"},
						{"lightness":16}
					]
				},
				{
					"featureType":"poi",
					"elementType":"geometry",
					"stylers": [
						{"color":"#f5f5f5"},
						{"lightness":21}
					]
				},
				{
					"featureType":"poi.park",
					"elementType":"geometry",
					"stylers": [
						{"color":"#dedede"},
						{"lightness":21}
					]
				},
				{
					"elementType":"labels.text.stroke",
					"stylers": [
						{"visibility":"on"},
						{"color":"#ffffff"},
						{"lightness":16}
					]
				},
				{
					"elementType":"labels.text.fill",
					"stylers": [
						{"saturation":36},
						{"color":"#333333"},
						{"lightness":40}
					]
				},
				{
					"elementType":"labels.icon",
					"stylers":[
						{"visibility":"off"}
					]
				},
				{
					"featureType":"transit",
					"elementType":"geometry",
					"stylers":[
						{"color":"#f2f2f2"},
						{"lightness":19}
					]
				},
				{
					"featureType":"administrative",
					"elementType":"geometry.fill",
					"stylers":[
						{"color":"#fefefe"},
						{"lightness":20}
					]
				},
				{
					"featureType":"administrative",
					"elementType":"geometry.stroke",
					"stylers":[
						{"color":"#fefefe"},
						{"lightness":17},
						{"weight":1.2}
					]
				}
			]
		};


		// create map
		var map = new google.maps.Map( $el[0], args);


		// add a markers reference
		map.markers = [];


		// add markers
		$markers.each(function(){

			add_marker( $(this), map );

		});


		// center map
		center_map( map );


		// return
		return map;

	}

	/*
	*  add_marker
	*
	*  This function will add a marker to the selected Google Map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	$marker (jQuery element)
	*  @param	map (Google Map object)
	*  @return	n/a
	*/

	function add_marker( $marker, map ) {

		// var
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

		// create marker
		var marker = new google.maps.Marker({
			position	: latlng,
			icon        : networkPartnersVars.markerIcon,
			map			: map
		});

		// add to array
		map.markers.push( marker );

		// if marker contains HTML, add it to an infoWindow
		if( $marker.html() ){

			// show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function() {
				if ( infoWindow ) {
					infoWindow.close();
				}
				// create info window
				infoWindow = new google.maps.InfoWindow({
					content		: $marker.html()
				});
				infoWindow.open( map, marker );
			});
		}

	}

	/*
	*  center_map
	*
	*  This function will center the map, showing all markers attached to this map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	map (Google Map object)
	*  @return	n/a
	*/

	function center_map( map ) {

		// vars
		var bounds = new google.maps.LatLngBounds();

		// loop through all markers and create bounds
		$.each( map.markers, function( i, marker ){

			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

			bounds.extend( latlng );

		});

		// only 1 marker?
		if( map.markers.length == 1 )
		{
			// set center of map
			map.setCenter( bounds.getCenter() );
			map.setZoom( 16 );
		}
		else
		{
			// fit to bounds
			//map.setCenter( bounds.getCenter() );
			//map.setZoom( 8 ); // Change the zoom value as required
			//map.fitBounds( bounds ); // This is the default setting which I have uncommented to stop the World Map being repeated

			// Fit to Cape Town since the network is wide spread, most partners are in cape town.
			var capeTown = new google.maps.LatLng( -33.918861, 18.423300 );
			map.setCenter( capeTown );
			map.setZoom( 10 );
		}

	}

	var map = null;
	var infoWindow = null;

	$( document ).ready( function() {
		// Open links in new windows.
		$( '.ptam-block-post-grid-image a' ).click( function() {
			console.log('Triggered');
			if ( '#' !== this.href[this.href.length -1] ) {
				window.open( this.href );
			}
			return false;
		} );

		// Change cursor if not linked anywhere.
		$( '.ptam-block-post-grid-image a img' ).hover( function() {
			if ( '#' == this.parentElement.href[this.parentElement.href.length -1] ) {
				$( this.parentElement ).addClass( 'no-link' );
				$( this ).addClass( 'no-link' );
			}
		} );

		// Display network partner maps if available on page.
		$( '.acf-map' ).each( function() {
			// create map
			map = new_map( $( this ) );
		} );
	} );
})( jQuery );
