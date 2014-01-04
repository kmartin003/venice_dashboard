<?
//error_reporting(E_ALL); ini_set('display_errors', 1);
	require_once 'firebaseLib.php';

	// Create connection
	$con = mysqli_connect("localhost","venicetw_dashuse","N6-is)Jd8MK1","venicetw_dashboard");

	// Check connection
	if (mysqli_connect_errno($con)) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}

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
	    $ships_so_far = intval($row['total_ships']);
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
		$exp_ships = intval($row['exp_ships']);
	}
	mysqli_close($con);

	$url = 'https://vpc.firebaseio.com';
	$fb = new fireBase($url);

	$fb->set('/dashboard/ships/ships_in_port', $ships_so_far);
	$fb->set('/dashboard/ships/passengers', $passengers_so_far);
	$fb->set('/dashboard/ships/crew', $crew_so_far);
	$fb->set('/dashboard/ships/tourists', $tourists_so_far);
	$fb->set('/dashboard/ships/ships_expected', $exp_ships);
	$fb->set('/dashboard/ships/tourists_expected', $exp_tourists);
?>