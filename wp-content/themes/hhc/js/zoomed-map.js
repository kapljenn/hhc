(function ($) {
	
jQuery(document).ready(function() {

	// iPad detection
	var is_iPad = navigator.userAgent.match(/iPad/i) != null;

	// zoom level
	var zoom_level = 10;
	if (is_iPad) zoom_level = 1;

	// init
	if ($('.zoomed-map').length > 0) google.maps.event.addDomListener(window, 'load', initMap);
	var map;
	var infoWindow;
	var activeInfoWindow;

	function initMap() {

		// create map
		var mapCenter = {lat: 51.135421, lng: -1.937301};
		map = new google.maps.Map(document.getElementById('zoomed_map'), {
			zoom: zoom_level,
			center: mapCenter,
    		//styles: map_style,
    		scrollwheel: false
		});

		addOffice();
	}


	// add POIs to map
	function addOffice() {

		var marker;

		// popup
        var contentString = '<div id="#infoWindow" class="info-window">'+
					            '<h2>Hope & Homes for Children</h2>'+
					            '<div class="info-window-content">'+
						            '<p>East Clyffe,<br>Salisbury,<br>Wiltshire SP3 4LZ</p>'+
					            '</div>'+
				            '</div>';
        infoWindow = new google.maps.InfoWindow({
        	content: contentString
        });

        // get marker colour
		var marker_image = stylesheet_dir + '/img/dot-purple.png';

		// create marker
		var point = new google.maps.LatLng(51.135421, -1.937301);
		marker = new google.maps.Marker({
			position: point,
			map: map,
			icon: marker_image,
			infoWindow: infoWindow // slightly non-standard, adding the infoWindow to the marker object
		});

		// add listener
	    addListener(marker);

	    // open the info window by default
		infoWindow.open(map,marker);
	}


	// add marker listener
	function addListener(marker) {
		google.maps.event.addListener(marker, 'click', function() {

			if (activeInfoWindow) activeInfoWindow.close();
			marker.infoWindow.open(marker.get('map'), marker);
			activeInfoWindow = marker.infoWindow;
		});
	}
	

	// map resize function
	function sizeMap() {
		var mapContainer = $('#zoomed_map').closest('.container');
		var containerHeight = mapContainer.height();

		var mapParent = $('#zoomed_map').closest('.fix-12-12');
		var parentWidth = mapParent.width();
		if (parentWidth > 1114) parentWidth = 1114;

		var w = parentWidth;
		var h = Math.floor(w*0.75);

		//console.log(w + " x " + h);
		//$('.map').width(w);
		//$('.map').css('width', '100%');
		$('#zoomed_map').height(h);
	}


	// window resize events
	function mapResizeActions() {
		sizeMap();
	};
	var resizeTimer;
	$(window).resize(function() {
	    clearTimeout(resizeTimer);
	    resizeTimer = setTimeout(mapResizeActions, 100);
	});
	if ($('.zoomed-map').length > 0) {
		mapResizeActions();
	}





});

}(jQuery));
