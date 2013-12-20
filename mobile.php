<? 
	// Set up mysql connection
	//mysqli_connect("localhost","venicetw_dashuse","N6-is)Jd8MK1","venicetw_dashboard"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>CityDashboard: Venice</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

			<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script> 
			<script type="text/javascript" src="http://www.google.com/jsapi"></script> 		
			<script type="text/javascript">google.load("jquery", "1.7.1"); google.load("jqueryui", "1.8.16"); function init() { //NOOP }</script>  	
			<script type='text/javascript'>var city = "london"; var mapmode = false; var blobmode = false;</script>
			<script type="text/javascript" src="/main.js?v=2&t=1371561947"></script>
			<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
			<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
			<script src="./gridster/gridster/dist/jquery.gridster.min.js" type="text/javascript" charset="utf-8"></script>

			<link href="defunkt-facebox/src/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
			<script src="defunkt-facebox/src/facebox.js" type="text/javascript"></script>

			  <script type="text/javascript">
    			jQuery(document).ready(function($) {
      				$('a[rel*=facebox]').facebox({
        				loadingImage : 'defunkt-facebox/src/loading.gif',
        				closeImage   : 'defunkt-facebox/src/closelabel.png'
     				 })
    				})
  			  </script>

			<script type="text/javascript">
		  		var _gaq = _gaq || [];
		  		_gaq.push(['_setAccount', 'UA-424605-10']);
		  		_gaq.push(['_trackPageview']);

		  		(function() {
					var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
					ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  		});
			</script> 	
			<script src="./gridster/gridster/dist/jquery.gridster.js"></script>
			<script type="text/javascript">
				jQuery(function(){ //DOM Ready
	      		jQuery(".gridster ul").gridster({
	          		widget_margins: [1, 1],
	          		widget_base_dimensions: [195, 195]
	      		}).data('gridster').disable();
				
	  		});
			</script>			


	

		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/ui-lightness/jquery-ui.css" type="text/css" />	
		<link rel="stylesheet" href="./css/style_mobile.css" type="text/css" />
		<link rel="stylesheet" href="./css/styles_gridster_mobile.css" type="text/css" />
		<link rel="stylesheet" type="text/css" href="./gridster/gridster/dist/jquery.gridster.css">
	</head>
<body>

	<div id="widgets">

<?
	include('./scripts/tide_height.php');
	if (getTideHeight() >= 0.90) {
		echo "<div style=\"margin-bottom:10px; width: 100%; color: #ffffff; font-weight: bold; background-color: #c13e3e; padding: 5px 0; text-align:center;\">
	Attention! &nbsp;Some Actv boat lines may be disrupted due to high tide levels. &nbsp;<a style='text-decoration:underline;' href='http://www.actv.it/sites/default/files/acquaalta%202(1).jpg' target='_new'>View Details...</a>
</div>";
	}
?>


<div class="gridster" style="zoom:0.90;">
    <ul>
	<li data-row="1" data-col="1" data-sizex="2" data-sizey="1"><? include("./widgets_mobile/actv_boats.php"); ?></li>
	<li data-row="2" data-col="1" data-sizex="2" data-sizey="1"><? include("./widgets_mobile/tide_forecast.php"); ?></li>
	<li data-row="3" data-col="1" data-sizex="2" data-sizey="1"><? include("./widgets_mobile/trending_news_topics.php"); ?></li>
    <li data-row="4" data-col="1" data-sizex="2" data-sizey="1"><? include("./widgets_mobile/news.php"); ?></li>
	<li data-row="5" data-col="1" data-sizex="2" data-sizey="1"><? include("./widgets_mobile/aircraft_movements.php"); ?></li>
	<li data-row="6" data-col="1" data-sizex="2" data-sizey="1"><? include("./widgets_mobile/ships_in_port.php"); ?></li>
    <li data-row="7" data-col="1" data-sizex="2" data-sizey="2"><? include("./widgets_mobile/tourists.php"); ?></li>
	<li data-row="9" data-col="1" data-sizex="2" data-sizey="1"><? include("./widgets_mobile/population.php"); ?></li>
	<li data-row="10" data-col="1" data-sizex="2" data-sizey="2"><? include("./widgets_mobile/weather_forecast.php"); ?></li>
	<li data-row="12" data-col="1" data-sizex="2" data-sizey="2"><? include("./widgets_mobile/twitter.php"); ?></li>
	<li data-row="14" data-col="1" data-sizex="2" data-sizey="2"><? include("./widgets_mobile/actv_facebook.php"); ?></li>
    </ul>
</div>

	
</body>
</html>

