(function ($) {
	
jQuery(document).ready(function() {

	// init
	google.maps.event.addDomListener(window, 'load', initMap);
	var map;
	var activeInfoWindow;

	function initMap() {

	    // AJAX - get POIs from WordPress DB
    	var data = { action: 'look_up_pois' };
		$.post(home_url + '/wp-admin/admin-ajax.php', data, function(response) {
			addPOIs($.parseJSON(response));
		});

		// create map
		var mapCenter = {lat: 41.9, lng: 12.5};
		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 2,
			center: mapCenter,
    		styles: map_style,
    		scrollwheel: false
		});
	}


	// add POIs to map
	function addPOIs(pois) {

		var marker;
		var infoWindow;
		var marker_image = stylesheet_dir + '/img/dot-small.png';
		for (i = 0; i < pois.length; i++) {

			// popup
	        var contentString = '<div id="#infoWindow" class="info-window">'+
						            '<h2>' + pois[i].poi_name + '</h2>'+
						            '<div class="info-window-content">'+
							            '<p>' + pois[i].poi_excerpt + '</p>'+
							            '<a href="' + pois[i].poi_link + '">Read more</a>'+
						            '</div>'+
					            '</div>';
	        infoWindow = new google.maps.InfoWindow({
	        	content: contentString
	        });

			// create marker
			var point = new google.maps.LatLng(pois[i].poi_lat, pois[i].poi_long);
			marker = new google.maps.Marker({
				position: point,
				map: map,
				icon: marker_image,
				infoWindow: infoWindow // slightly non-standard, adding the infoWindow to the marker object
			});

			// add listener
		    addListener(marker);
		}
	}


	// add marker listener
	function addListener(marker) {
		google.maps.event.addListener(marker, 'click', function() {

			if (activeInfoWindow) activeInfoWindow.close();
			marker.infoWindow.open(marker.get('map'), marker);
			activeInfoWindow = marker.infoWindow;
		});
	}
	
	var mapContainer = $('.map').closest('.container');
	var containerHeight = mapContainer.height();

	var mapParent = $('.map').closest('.fix-12-12');
	var parentWidth = mapParent.width();
	if (parentWidth > 1114) parentWidth = 1114;

	var w = parentWidth;
	var h = Math.floor(w*0.75);

	console.log(w + " x " + h);
	//$('.map').width(w);
	$('.map').css('width', '100%');
	$('.map').height(h);







});

}(jQuery));