<script type="text/javascript">

	function colorsForTide(tide_level) {
		var tide_colors = new Array();

		var red = "#c13e3e";      // >= +1.40m
		var orange = "#ee7c0e";   // +1.10m -> +1.39m
		var yellow = "#ffd300";   // +0.80m -> +1.09m
		var green = "#6cbe5f";    // -0.50m -> +0.79m
		var white = "#ffffff";    // -0.90m -> -0.51m
		var blue = "#0098d4";     // < -0.90m

		var background_color = "";
		var text_color = white;
		if (tide_level >= 1.40) {
			background_color = red;
		} else if (tide_level >= 1.10 && tide_level <= 1.39) {
			background_color = orange;
		} else if (tide_level >= 0.80 && tide_level <= 1.09) {
			background_color = yellow;
			text_color = "#000000";
		} else if (tide_level >= -0.50 && tide_level <= 0.79) {
			background_color = green;
		} else if (tide_level >= -0.90 && tide_level <= -0.51) {
			background_color = white;
		} else {
			background_color = blue;
		}

		tide_colors['background_color'] = background_color;
		tide_colors['text_color'] = text_color;

		return tide_colors;
	}

	var tideRef = new Firebase('https://vpc.firebaseio.com').child('dashboard/current_tide_level');
	tideRef.on('value', function(dataSnap) {
		var current_tide_height = dataSnap.val().tide_level;
		var direction = dataSnap.val().direction;
		if (direction == 1)
			$('#tide_direction').html("&#8593;");
		else
			$('#tide_direction').html("&#8595;");
		var current_tide_colors = colorsForTide(current_tide_height);
		$('#current_tide_height').text(current_tide_height);
		$('#current_tide_height').css({ 'color': current_tide_colors['text_color'], 'background-color': current_tide_colors['background_color'] });
	});

	var tideRef = new Firebase('https://vpc.firebaseio.com').child('dashboard/next_tide_peak');
	tideRef.on('value', function(dataSnap) {
		var next_tide_height = dataSnap.val().tide_level;
		var next_tide_time = dataSnap.val().time;
		var next_tide_colors = colorsForTide(next_tide_height);
		$('#next_tide_height').text(next_tide_height);
		$('#next_tide_time').text(next_tide_time);
		$('#next_tide_height').css({ 'color': next_tide_colors['text_color'], 'background-color': next_tide_colors['background_color'] });
	});

	var tideRef = new Firebase('https://vpc.firebaseio.com').child('dashboard/next_significant_tide');
	tideRef.on('value', function(dataSnap) {
		if (dataSnap.val() != "") {
			var next_significant_tide = dataSnap.val().tide_level;
			var next_significant_tide_time = dataSnap.val().time;
			var next_tide_colors = colorsForTide(next_significant_tide);
//alert(next_significant_tide);
			/*$('#next_tide_height').text(next_tide_height);
			$('#next_tide_time').text(next_tide_time);
			$('#next_tide_height').css({ 'color': next_tide_colors['text_color'], 'background-color': next_tide_colors['background_color'] });*/
		} else {
			//alert("0");
		}
	});
</script>

<div class="widget">
	<div class='draggabletitle'>Tides (<a href='http://www.comune.venezia.it/flex/cm/pages/ServeBLOB.php/L/IT/IDPagina/1748' target='_new'>Centro Maree</a>)</div>
	<div class='ui-widget-content'>
		<span style='float:right;'><a href='../images/AboutTides.png' rel='facebox'><img class='help' src='../images/help.png' height=15 width=15 /></a><img class='close' src='../images/close.png' href='#' height=15 width=15 /></span>
		<a rel='facebox' href='http://www.comune.venezia.it/flex/AppData/Local/bollettino_grafico.jpg'>
			<img src="http://www.comune.venezia.it/flex/AppData/Local/bollettino_grafico.jpg" width="100%" height=75 />
		</a>

		<div style="line-height:13px; text-align:center; width: 175px; height:28px; color: #ffffff; font-weight: bold; background-color: #6cbe5f; padding: 3px 0; padding-top:8px; ">
			<b style='font-size:23px;'><span id="current_tide_height">0,0</span> m <span id='tide_direction'>&#8593;</span></b><br>
			<span style="font-size:10px; font-weight:normal; text-align:center; color:#555555;"><b>Tide Level @ Punta Salute</b></span>
		</div>

		<div style="line-height:13px; margin-top:5px; text-align:center; width: 175px; height:28px; font-weight: bold; background-color: #6cbe5f; padding: 3px 0; padding-top:8px;">
			<b style='font-size:23px; color:#ffffff;'><span id='next_tide_height'>0</span> m @ <span id='next_tide_time'>00:00</span></b><br>
			<span style="color: #555555; font-size:10px; font-weight:normal;"><b>Next High Tide</b></span>
		</div>
	</div>
</div>