<?php
    include_once('includes/page_utils.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>

    <link rel="stylesheet" type="text/css" href="style.css" media="screen,projection" />
    <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Lighter-Tracks.com</title>


    <script src="https://maps.googleapis.com/maps/api/js"></script>
	<script>

		/*var locations = [
			['<div id="infowindow-div"><b>Location:</b> Bradford, OH</div>', 40.1153010,-84.4592700, 1],
			['<div id="infowindow-div"><b>Location:</b> Los Angeles, CA</div>', 34.060339,-118.240356, 2],
			['<div id="infowindow-div"><b>Location:</b> York, PA</div>', 39.961777,-76.728172, 3],
			['<div id="infowindow-div"><b>Location:</b> Columbus, OH</div>', 39.958965,-82.996216, 4],
			['<div id="infowindow-div"><b>Location:</b> Muncie, IN</div>', 40.190857,-85.385399, 5]
        ];*/
        <?php
        $a = new Map();
        $a->put_pointers();
        ?>

		function initialize() {

			var map = new google.maps.Map(document.getElementById('map_canvas'), {

		      zoom: 4,
		      center: new google.maps.LatLng(39.317715,-96.970139),
		      mapTypeId: google.maps.MapTypeId.ROADMAP

		    });

		    var infowindow = new google.maps.InfoWindow({

		    	maxWidth: 200

		    });

		    var marker, i;

		    for (i = 0; i < locations.length; i++) {

		    	marker = new google.maps.Marker({
		        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
		        map: map
		    
		      });

		    google.maps.event.addListener(marker, 'click', (function(marker, i) {
		        	
	        	return function() {
	        		infowindow.setContent(locations[i][0]);
	        		infowindow.open(map, marker);
	        	}
		        
		    })(marker, i));

		    }
		
		}

		google.maps.event.addDomListener(window, 'load', initialize);

	</script>

</head>
<body>

	<div id="container">

		<div id="header">
			<h1>Lighter-Tracks.com</h1>
		</div>

		<div id="map_canvas"></div>

			<ul id="navigation">
				<li class="active">Home</li>
				<li> <a href="shop.html">Shop</a></li>
				<li> <a href="index.php">My Lighters</a></li>
				<li> <a href="index.php">Groups</a></li>
				<li> <a href="index.php">Top 50</a></li>
				<li> <a href="index.php">T.O.S</a></li>
				<li> <a href="index.php">Login</a></li>
			</ul>

		<div id="tracking-stats">

			<h2>Step 1:</h2>

			<i>Enter the Lighters "LID#" and your "Zip Code" to start a new location!</i>

			<br/><br/>

			<form id="frm1" action="form_action.asp">
			<b>LID#:</b><br/> <input type="text" name="LID"><br/><br/>
			<b>ZIP#:</b><br/> <input type="text" name="ZipCode"><br/><br/><br/>
			<a href="shop.html" class="css_btn_class" onclick="myTrackSubmit()">Track This Lighter!</a>
			</form>

			<script>
			function myTrackSubmit() {
			    document.getElementById("frm1").submit();
			}
			</script>

			<br/><br/>

		</div>

		<div id="subcontent">

		<h3>Lighter Messages</h3>

				<div id="msg-user">Logan45308</div>
				<div id="msg">Hello this is a test message! This will be like a personal "Wall" for each lighter! Friends who share the same lighters can chat on here and share pictures / party locations / phone numbers / and much more!</div>
				<br style="clear: left;" />

				<div id="msg-user">User12341</div>
				<div id="msg">Hi! 1st! :D</div>
				<br style="clear: left;" />

		</div>

		<div id="footer">

			Released under the <a href="http://creativecommons.org/licenses/by/2.0/uk/">Creative Commons Attribution 2.0</a> license.<br/>
			<a href="http://validator.w3.org/check/referer">Valid XHTML 1.0 Strict</a>

		</div>

	</div>

</body>
</html>
