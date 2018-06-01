
		</main>

		<footer class="footer">

			<div class="container">

				<div class="footer-social">
					
					<ul class="social-list list-inline">
							
						<li><a href="<?php echo the_config('facebook_link'); ?>" target="_blank"><i class="fa fa-facebook text-muted fa-fw fa-2x"></i></a></li>

						<li><a href="<?php echo the_config('googleplus_link'); ?>" target="_blank"><i class="fa fa-google-plus text-muted fa-fw fa-2x"></i></a></li>

						<li><a href="<?php echo the_config('youtube_link'); ?>" target="_blank"><i class="fa fa-youtube-play text-muted fa-fw fa-2x"></i></a></li>

						<li><a href="<?php echo the_config('twitter_link'); ?>" target="_blank"><i class="fa fa-twitter text-muted fa-fw fa-2x"></i></a></li>

						<li><a href="<?php echo the_config('instagram_link'); ?>" target="_blank"><i class="fa fa-instagram text-muted fa-fw fa-2x"></i></a></li>

						<li><a href="<?php echo the_config('pinterest_link'); ?>" target="_blank"><i class="fa fa-pinterest text-muted fa-fw fa-2x"></i></a></li>

					</ul>

				</div>

				<div class="footer-copyright">

					<p>&copy; <?php echo date('Y').' '.the_config('site_name'); ?>. All Rights Reserved</p>

				</div>

			</div>

		</footer>

        <script type="text/javascript" src="<?php echo base_url('build/js/master-scripts.js?v=1.').strtotime('now'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('build/js/scripts.js?v=1.').strtotime('now'); ?>"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo the_config('gmap_apikey'); ?>"></script>

        <?php
        if(isset($origin) and isset($city)) {
        	if($origin->latitude != null and $origin->longitude != null and $city->latitude != null and $city->longitude != null) {
        	$from_lat = ($origin->latitude != null) ? $origin->latitude : 0;
        	$from_lon = ($origin->longitude != null) ? $origin->longitude : 0;
        	$to_lat = ($city->latitude != null) ? $city->latitude : 0;
        	$to_lon = ($city->longitude != null) ? $city->longitude : 0;
        ?>
	        <script>
				var map;
				var mapOptions = {
					zoom: 2,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				function initialize() {
					map = new google.maps.Map(document.getElementById("map"), mapOptions);
					var userCoor = [
						["<?php echo $origin->name.', '.country_name($origin->country); ?>", <?php echo $from_lat; ?>, <?php echo $from_lon; ?>],
						["<?php echo $city->name.', '.country_name($city->country); ?>", <?php echo $to_lat; ?>, <?php echo $to_lon; ?>]
					];
					var userCoorPath = [
						new google.maps.LatLng(<?php echo $from_lat; ?>, <?php echo $from_lon; ?>),
						new google.maps.LatLng(<?php echo $to_lat; ?>, <?php echo $to_lon; ?>)
					]
					var userCoordinate = new google.maps.Polyline({
						path: userCoorPath,
						strokeColor: "#FF0000",
						strokeOpacity: 1,
						strokeWeight: 2
					});
					userCoordinate.setMap(map);
					var bounds = new google.maps.LatLngBounds();
					var points = userCoordinate.getPath().getArray();
					for (var n = 0; n < points.length ; n++){
				        bounds.extend(points[n]);
				    }
				    map.fitBounds(bounds);
					var infowindow = new google.maps.InfoWindow();
					var marker, i;
					for (i = 0; i < userCoor.length; i++) { 
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(userCoor[i][1], userCoor[i][2]),
							map: map
						});

						google.maps.event.addListener(marker, 'click', (function(marker, i) {
							return function() {
								infowindow.setContent(userCoor[i][0]);
								infowindow.open(map, marker);
							}
						})(marker, i));
					}
				}
				google.maps.event.addDomListener(window, 'load', initialize);
			</script>
		<?php } } ?>
		
    </body>

</html>