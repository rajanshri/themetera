var map;
var marker;

function initializeMap(location, clickable, zoomVal)
{
	if (typeof google == "undefined") return false;

	var latlng = new google.maps.LatLng(location.lat(), location.lng());

	if (zoomVal == undefined)
		zoomVal = 16;

	var myOptions = {
		zoom: parseInt(zoomVal),
		center: latlng,
		//mapTypeId: 'ROADMAP'//MAP_TYPE
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);


	if (clickable == true)
	{
		google.maps.event.addListener(map, 'click', function(event) {
			clearOverlays();
			deleteOverlays();
			addMarker(event.latLng);
			showOverlays();
			map.setCenter(event.latLng);			jQuery('input[name="lat_long"]:first').val(event.latLng.lat()+","+event.latLng.lng()+";"+map.zoom);
			mapStatus("Location set. Don't forget to save!");			
		});

		google.maps.event.addListener(map, 'zoom_changed', function() {
    		setZoom(map.zoom);
 		});

	}

}

function mapStatus($txt)
{
	jQuery('#status').text("Status: "+$txt);
}

function parseLocationString(location_string)
{
	if (typeof google == "undefined") return false;

	var $zoom, $latLng;
	$isZoom = location_string.indexOf(';')
	if ($isZoom != -1)
	{
	 	var $parts = location_string.split(';');
	 	$zoom = $parts[1];
	 	$loc = $parts[0].split(',');
	}
	else
	{
		$zoom = 16;
		$loc = location_string.split(',');
	}
	$latLng = new google.maps.LatLng($loc[0], $loc[1]);

	return { 'latLng': $latLng, 'zoom': $zoom };
}

function showLocation($val)
{
	if (typeof google == "undefined") return false;

	$coords = parseLocationString($val);
	initializeMap($coords.latLng, true, $coords.zoom);
	addMarker($coords.latLng);
	showOverlays();
	map.setCenter($coords.latLng);

	if (!jQuery("#map_canvas").is(":visible"))
	{
		//alert("map invisible");
		jQuery("#map_canvas").fadeIn();
	}

}


function setZoom($zoomLvl)
{
	if (typeof google == "undefined") return false;

	var curr_loc = $('input[name="lat_long"]:first').val();
	var coords;

	if ($.trim(curr_loc) == '') return;

	if (curr_loc.indexOf(';')>0)
	{
		var parts = curr_loc.split(';');
		coords = parts[0];
	}
	else
		coords = $.trim(curr_loc);

	$('input[name="lat_long"]:first').val(coords+';'+$zoomLvl);
	mapStatus('To save current zoom level, just click "Save" below the map.');


}

function searchMap(address)
{
	if (typeof google == "undefined") return false;

	mapStatus('Searching "'+address+'"...');

	var geocoder = new google.maps.Geocoder();

	if (geocoder) {
		geocoder.geocode({ 'address': address }, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				initializeMap(results[0].geometry.location, true, 16);
				mapStatus('Found something!');
			}
			else {
				mapStatus(status);
			}
		});
	}

}

function makeAddress()
{
	if (typeof google == "undefined") return false;

	var $address, $address2, $location;
	$address = jQuery("input[name='_address']").val();
	$address2 = jQuery("input[name='address2']").val();
	$location = jQuery("select[name='location_id'] option:selected").text().replace(/[^á-žÁ-Ža-zA-Z0-9\s]+/g,'');
	//$location = $("input[name='location']").val().replace(/>/g, ',');
	$location = $location.replace(/[^á-žÁ-Ža-zA-Z0-9\s\,]+/g, '');
	//kobasica

	var $return = $address;
	if (jQuery.trim($address2) != "")
		$return += ", " + $address2;

	if (jQuery.trim($return) != "")
		$return += ", ";
	if ($location!='None')	{		$return += $location;	}
	return $return;
}


function makeLocationSearchString()
{	if($('#tag-name').length){
		var $name = $('#tag-name');	}	else	{		var $name = $('#name');	}
	var $parent = $('#parent');
	var name = $name.val();
	var parent_name = $parent.find('option:selected').text();
	var parent_id = $parent.find('option:selected').val();

	if (parent_id == 0 || parent_id == '' || parent_id == -1)
	{
		return name;
	}
	else
	{
		return name+', '+parent_name;
	}
}

function addMarker(location)
{
	if (typeof google == "undefined") return false;

	marker = new google.maps.Marker({
		position: location,
		map: map
	});
	//markersArray.push(marker);
}

// Removes the overlays from the map, but keeps them in the array
function clearOverlays()
{
	if (typeof google == "undefined") return false;

	if (marker)
		marker.setMap(null);
}

// Shows any overlays currently in the array
function showOverlays()
{
	if (typeof google == "undefined") return false;

	if (marker)
		marker.setMap(map);
//if (markersArray)
//	{
//		for (i in markersArray)
//			markersArray[i].setMap(map);
//	}
}

// Deletes all markers in the array by removing references to them
function deleteOverlays()
{
	clearOverlays();
	marker = null;
}