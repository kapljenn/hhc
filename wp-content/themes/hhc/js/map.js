(function ($) {
	
jQuery(document).ready(function() {

	// init
	google.maps.event.addDomListener(window, 'load', initMap);
	var map;

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

		for (i = 0; i < pois.length; i++) {

			// create point
			var point = new google.maps.LatLng(pois[i].poi_lat, pois[i].poi_long);
			var marker = new google.maps.Marker({
				position: point,
				map: map,
				title: 'Hello World!'
			});
		}
	}




});

}(jQuery));
