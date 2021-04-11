<template>
	<input type="text" class="form-control" placeholder="Address" name="clientAddress" id="clientAddress">
</template>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=GlemZKtl0pFMRauPjlnh//Y1BaUCSDe98sw06QxRt08=&libraries=places&callback=initMap" async defer"></script>

<script>
	export default {
		mounted() {
			this.initMap();
		},
		methods: {
			initMap() {
	   			var input = document.getElementById('clientAddress');
			   	var autocomplete = new google.maps.places.Autocomplete(input);
			   	autocomplete.addListener('place_changed', function() {
			       	var place = autocomplete.getPlace();
			       	document.getElementById('location-snap').
			       	innerHTML = place.formatted_address;  
			       	document.getElementById('lat-span').
				    innerHTML = place.geometry.location.lat();
			       	document.getElementById('lon-span').
			       	innerHTML = place.geometry.location.lng();
		   		});
			}
		}
	}
</script>