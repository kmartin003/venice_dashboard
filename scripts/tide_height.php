
<?
	require_once("./tide_functions.php");
	require_once('firebaseLib.php');

	$url = 'https://vpc.firebaseio.com';
	$fb = new fireBase($url);

	$current_level = getCurrentTideLevel();
	$fb->set('/dashboard/current_tide_level', $current_level);

	$next_peak = getNextPeak();
	$fb->set('/dashboard/next_tide_peak', $next_peak);

	$next_significant_tide = getNextSignificantTide();
	if (!is_null($next_significant_tide))
		$fb->set('/dashboard/next_significant_tide', $next_significant_tide);
	else
		$fb->set('/dashboard/next_significant_tide', "");
?>