<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>CityDashboard: Venice</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<!-- Facebox (popup overlays) -->
		<link href="defunkt-facebox/src/facebox.css" media="screen" rel="stylesheet" type="text/css"/>

		<!-- JQuery -->
		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/ui-lightness/jquery-ui.css" type="text/css" />	
		<script type="text/javascript">google.load("jquery", "1.7.1"); google.load("jqueryui", "1.8.16"); function init() { //NOOP }</script>  	
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

		<link rel="stylesheet" href="./css/style.css" type="text/css" />
		<link rel="stylesheet" href="./css/styles_gridster.css" type="text/css" />
		<link rel="stylesheet" href="./css/main.css" type="text/css" />

		<!-- Gridster (widget tiling) -->
		<link rel="stylesheet" type="text/css" href="./gridster/gridster/dist/jquery.gridster.css">
		<script src="./gridster/gridster/dist/jquery.gridster.min.js" type="text/javascript" charset="utf-8"></script>

		<!-- Firebase -->
		<script src="https://cdn.firebase.com/v0/firebase.js"></script>

		<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script> 
		<script type="text/javascript" src="http://www.google.com/jsapi"></script> 		
		<script src="defunkt-facebox/src/facebox.js" type="text/javascript"></script>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('a[rel*=facebox]').facebox({
					loadingImage: 'defunkt-facebox/src/loading.gif',
					closeImage: 'defunkt-facebox/src/closelabel.png'
				})
			})
		</script>

		<script src="./gridster/gridster/dist/jquery.gridster.js"></script>
		<script type="text/javascript">
			jQuery(function(){ //DOM Ready
      		jQuery(".gridster ul").gridster({
          		widget_margins: [1, 1],
          		widget_base_dimensions: [195, 195]
      		}).data('gridster');
			
	  		});
		</script>																	

		<script type='text/javascript'>
			$(document).ready(function() {	
				$("#customize").click(function() {
					$('.close').toggle();
				});
			})
		</script>

		<script type='text/javascript'>
			var tideRef = new Firebase('https://vpc.firebaseio.com').child('dashboard/tideInfo');
			tideRef.on('value', function(dataSnap) {
				var current_tide_height = dataSnap.val().current_height;
				if (current_tide_height >= 0.90) {
					current_tide_height = current_tide_height.toString().replace(/\./, ',');
					$('#actv_announcement').show();
				}
			});
		</script>

		<script type="text/javascript">
			$(document).ready(function(){
				var fogRef = new Firebase('https://vpc.firebaseio.com').child('dashboard/displayFogNotice');
				fogRef.on('value', function(dataSnap) {
					var display_notice = dataSnap.val();
					if (display_notice == 1)
						$('#fog_notice').show();
					else
						$('#fog_notice').hide();
				});
			});
		</script>

		<!-- Google Analytics -->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-46593123-1', 'veniceprojectcenter.org');
		  ga('send', 'pageview');

		</script>

	</head>

	<body>
		<div id="panelbg"></div>

		<div id="panel" style='width: 1200px; margin: 0 auto;'>
			<div id="headerbar">
				<table style="width: 100%; ">
					<tr>
						<td rowspan="2" id="location_name"><a href="#" id="bShowOptionsTop">Venice</a></td>
						<td colspan="2" style='width: 100%;'><div style="margin-right:-100px;" id="clock"><? include('./widgets/time.php'); ?></div></td>
					</tr>
					<tr><td id="location_latlon">45.44 N, 12.33 E</td>
						<td />
						<td><a href='#' onclick='return false;'><img style="margin-right:10px;" id="customize" src='./images/customize_button.png' /></a></td>
					</tr>
				</table>
			</div>

			<div id="widgets">
				<div id='fog_notice' style='display:none;'>
					Attention! &nbsp;Some Actv boat lines may be disrupted due to the fog! &nbsp;<a style='text-decoration:underline;' href='http://www.actv.it/en/movinginvenice/emergencyserviceinfoggyconditionsandduringhightide' target='_new'>View Details...</a>
				</div>

				<div id='actv_announcement' style='display:none;'>
					Attention! &nbsp;Some Actv boat lines may be disrupted due to high tide levels. &nbsp;<a style='text-decoration:underline;' href='http://www.actv.it/sites/default/files/acquaalta%202(1).jpg' target='_new'>View Details...</a>
				</div>
					
				<div class="gridster">
				    <ul>
						<li data-row="1" data-col="1" data-sizex="2" data-sizey="2"><? include("./widgets/ships_in_port.php"); ?></li>
						<li data-row="1" data-col="3" data-sizex="2" data-sizey="2"><? include("./widgets/aircraft_movements.php"); ?></li>
				        <li data-row="1" data-col="5" data-sizex="2" data-sizey="2"><? include("./widgets/tourists.php"); ?></li>

				        <li data-row="3" data-col="1" data-sizex="2" data-sizey="1"><? include("./widgets/photos.php"); ?></li>
						<li data-row="3" data-col="3" data-sizex="2" data-sizey="1"><? include("./widgets/webcams.php"); ?></li>
						<li data-row="3" data-col="5" data-sizex="1" data-sizey="1"><? include("./widgets/tide_forecast.php"); ?></li>
						<li data-row="3" data-col="6" data-sizex="1" data-sizey="1"><? include("./widgets/population.php"); ?></li>

						<li data-row="4" data-col="1" data-sizex="2" data-sizey="1"><? include("./widgets/weather_forecast.php"); ?></li>
						<li data-row="4" data-col="3" data-sizex="2" data-sizey="2"><? include("./widgets/actv_facebook.php"); ?></li>
						<li data-row="4" data-col="5" data-sizex="2" data-sizey="2"><? include("./widgets/twitter.php"); ?></li>

				        <li data-row="5" data-col="1" data-sizex="1" data-sizey="1"><? include("./widgets/news.php"); ?></li>
						<li data-row="5" data-col="2" data-sizex="1" data-sizey="2"><? include("./widgets/events.php"); ?></li>

						<li data-row="6" data-col="1" data-sizex="1" data-sizey="1"><? include("./widgets/trending_news_topics.php"); ?></li>				
				    </ul>
				</div>

				<div style='height: 40px; width: 1px;' class='draggable'></div>
			</div>
			
			<div id='logos'>
				<div style="float: left; padding: 5px 0;">
					<span>A <a href='http://veniceprojectcenter.org/' target='_new' style='text-decoration:underline;'>Venice Project Center</a> 25<sup>th</sup> Anniversary Project</span>
				</div>

				<a href="http://veniceprojectcenter.org/" target='_new'><img src="images/vpc.png" style="height:30px; padding-left:20px;" alt="Venice Project Center"></a>
				<a href="http://www.wpi.edu" target="_new"><img src="images/wpi.gif" style="width: 87px; height: 30px; padding-left: 20px; border: 0px solid white" alt="WPI"></a>	
				<a href="http://ucl.ac.uk/" target="_new"><img src="http://citydashboard.org/images/logoucl.png" style="width: 87px; height: 30px; padding-left: 20px; border: 0px solid white" alt="UCL"></a>
				<div style='float: right; text-align:right; padding: 5px 0;'>
					<a href="http://www.comune.venezia.it/" target="_new"><img src="images/venice.png" style="height: 30px; padding-left: 20px; border: 0px solid white" alt="Comune di Venezia"></a>	
				</div>
			</div>
		</div>
	</body>
</html>

