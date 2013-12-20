<?
	// Delete current photos on disk
	$files = glob('../widgets/photos/*.jpg'); 
	foreach($files as $file)
		if (is_file($file))
			unlink($file);

	// Get the latest 20 photos from Flickr API (via Yahoo! Pipes)
	$flickr_api_url = "http://pipes.yahoo.com/pipes/pipe.run?_id=3964a81d9e13be551a61605ffc8f092c&_render=php";
	$flickr_feed = unserialize(file_get_contents($flickr_api_url));
	$photos_array = $flickr_feed['value']['items'];
	$imgs = 0;
	foreach ($photos_array as $photo) { // Loop through and save each to the server
		$img_url = $photo['content'];
		file_put_contents("../widgets/photos/" . basename($img_url), file_get_contents($img_url));
		if (++$imgs > 15)
			break;
	}

	echo "<p>Images loaded</p>";
?>		