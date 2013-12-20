<?
	// Create connection
	$con = mysqli_connect("localhost","venicetw_dashuse","N6-is)Jd8MK1","venicetw_dashboard");

	// Check connection
	if (mysqli_connect_errno($con)) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
 ?>

 <?php
	// Set the time zone so that the function CURTIME() will be in the same time zone as the table it's using
	$result0 = mysqli_query($con,"SET time_zone = '+01:00'");
	 
	//Return the total number of tourists and crew that came to the city thus far today
	$result1 = mysqli_query($con,"select count(*) as total_ships, sum(Passengers) as total_tourists, sum(crew) as total_crew from ShipCap where ShipName IN (select ShipName from ShipLog WHERE Day = CURDATE() AND CURTIME() > Arrival)");
	 
	//Return the number of ships in port, the total number of tourists, and the total number of crew on those ships
	$result2 = mysqli_query($con,"select count(*) as port_ships, sum(Passengers) as current_tourists, sum(crew) as current_crew from ShipCap where ShipName IN (select ShipName from ShipLog WHERE Day = CURDATE() AND CURTIME() BETWEEN Arrival AND Departure)");

	//Return the number of ships in port, the total number of tourists, and the total number of crew on those ships
	$result3 = mysqli_query($con,"select count(*) as exp_ships, sum(Passengers) as exp_passengers, sum(crew) as exp_crew from ShipCap where ShipName IN (select ShipName from ShipLog WHERE Day BETWEEN DATE_ADD(CURDATE(), INTERVAL 1 DAY) AND DATE_ADD(CURDATE(), INTERVAL 7 DAY) || Day = CURDATE() AND Arrival > CURTIME())");

	// Calculate the total numbers thus far today
	while ($row = mysqli_fetch_array($result1)) {					
		$passengers_so_far = ($row['total_tourists'] == '' ? 0 : $row['total_tourists']);
		$crew_so_far = ($row['total_crew'] == '' ? 0 : $row['total_crew']);
		$tourists_so_far = ($passengers_so_far + $crew_so_far);		// Calculate the total number of people dropped off thus far today
	    $ships_so_far = $row['total_ships'];
	}
	 
	//Get the current numbers
	while ($row = mysqli_fetch_array($result2)) {						
		$current_tourists = ($row['current_tourists'] == '' ? 0 : $row['current_tourists']);
		$current_crew = ($row['current_crew'] == '' ? 0 : $row['current_crew']);
		$in_port = $row['port_ships'];
	}
	 
	//Get the total for the week 
	while ($row = mysqli_fetch_array($result3)) {						
		$exp_passengers = ($row['exp_passengers'] == '' ? 0 : $row['exp_passengers']);
		$exp_crew = ($row['exp_crew'] == '' ? 0 : $row['exp_crew']);
	    $exp_tourists = ($exp_passengers + $exp_crew);
		$exp_ships = $row['exp_ships'];
	}
	mysqli_close($con);
?>
  
<div class="widget">
	<div class='draggabletitle'>Ships in Port (<a href='http://www.marinetraffic.com/ais/datasheet.aspx?datasource=SHIPS_CURRENT&PORT_ID=530&PORT_NAME=VENEZIA'>Marine Traffic</a>)</div>
	<span style='float:right;'><img src='../images/help.png' href='#' height=15 width=15><img class='close' src='../images/close.png' href='#' height=15 width=15></span>
	<div class='ui-widget-content'>
		<table style="margin:0 auto;">
			<tbody>
				<tr>
					<td style="width: 80px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						Ships In Port
						<div style="width: 80px; color: #ffffff; font-weight: bold; background-color: #4f4fb0; padding: 5px 0;">
							<? echo $in_port; ?>
						</div>
					</td>
					<td style="width: 80px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						Passengers
						<div style="width: 80px; color: #ffffff; font-weight: bold; background-color: #4f4fb0; padding: 5px 0;">
							<? echo $current_tourists; ?>
						</div>
					</td>
					<td style="width: 80px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						Crew
						<div style="width: 80px; color: #ffffff; font-weight: bold; background-color: #4f4fb0; padding: 5px 0;">
							<? echo $current_crew; ?>
						</div>
					</td>
					<td style="width: 80px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Total Tourists</b>
						<div style="width: 80px; color: #ffffff; font-weight: bold; background-color: #ac3e1f; padding: 5px 0;">
							<? echo ($current_tourists + $current_crew); ?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<br />

		<!-- Embedded ships map widget -->	
		<script type="text/javascript">
	    	width='98%';          //the width of the embedded map in pixels or percentage
	    	height=250;         //the height of the embedded map in pixels or percentage
	    	border=1;           //the width of border around the map. Zero means no border
	    	notation=false;     //true or false to display or not the vessel icons and options at the left
	    	shownames=false;    //true or false to dispaly ship names on the map
	    	latitude=45.44;   //the latitude of the center of the map in decimal degrees
	    	longitude=12.33;  //the longitude of the center of the map in decimal degrees
	    	zoom=13;             //the zoom level of the map. Use values between 2 and 17
	    	maptype=2;          //use 0 for Normal map, 1 for Satellite, 2 for Hybrid, 3 for Terrain
	    	trackvessel=0;      //the MMSI of the vessel to track, if within the range of the system
	    	fleet='';           //the registered email address of a user-defined fleet to display
	    	remember=false;     //true or false to remember or not the last position of the map
		</script>
		<script type="text/javascript" src="http://www.marinetraffic.com/ais/embed.js"></script>

		<table style="margin:0 auto;">
			<tbody>
				<tr>
	            	<td style="width: 120px; text-align: center; padding: 3px; vertical-align: center; font-size: 11px;">
	                	<b>Expected This Week</b>
	              	</td>
					<td style="width: 120px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						Ships
						<div style="width: 120px; color: #ffffff; font-weight: bold; background-color: #4f4fb0; padding: 5px 0;">
							<? echo $exp_ships; ?>
						</div>
					</td>
					<td style="width: 120px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						Tourists
						<div style="width: 120px; color: #ffffff; font-weight: bold; background-color: #4f4fb0; padding: 5px 0;">
							<? echo $exp_tourists; ?>
						</div>
					</td>
	            </tr>
			</tbody>
		</table>
	</div>	
</div> 