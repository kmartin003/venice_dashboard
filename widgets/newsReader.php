<?
	function fetch_news($art_num){
		/* first grab entire xml file */
		$feed = file_get_contents('http://www.ilgazzettino.it/rss/nordest_venezia.xml');
		
		/* convert to SimpleXMLElement object */
		$feed = simplexml_load_string($feed);

		$cur_item = $feed->channel->item[$art_num];
		$item_contents = array('title'	=> (string)$cur_item->title,
							   'link'	=> (string)$cur_item->link,
							   'image'	=> (string)$cur_item->enclosure['url']);	

		return $item_contents;	
	}
?>