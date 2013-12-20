<script type='text/javascript'>
	var webcams = [{ "name": "San Marco Cam 1" , "url": "http://93.62.201.235/maree/WEBCAM/smarcoweb1.jpg" }, 
				   { "name": "San Marco Cam 2" , "url": "http://93.62.201.235/maree/WEBCAM/smarcoweb2.jpg" }, 
				   { "name": "San Marco Cam 3" , "url": "http://93.62.201.235/maree/WEBCAM/smarcoweb3.jpg" }, 
				   { "name": "Rialto Cam 1"    , "url": "http://93.62.201.235/maree/WEBCAM/rialtoweb1.jpg" }, 
				   { "name": "Rialto Cam 2"    , "url": "http://93.62.201.235/maree/WEBCAM/rialtoweb2.jpg" }, 
				   { "name": "Murano Cam 1"    , "url": "http://93.62.201.235/maree/WEBCAM/muranoweb1.jpg" }, 
				   { "name": "Murano Cam 2"    , "url": "http://93.62.201.235/maree/WEBCAM/muranoweb2.jpg" }, 
				   { "name": "Murano Cam 3"    , "url": "http://93.62.201.235/maree/WEBCAM/muranoweb3.jpg" }, 
				   { "name": "Salute Cam 1"    , "url": "http://93.62.201.235/maree/WEBCAM/saluteweb1.jpg" }, 
				   { "name": "Salute Cam 2"    , "url": "http://93.62.201.235/maree/WEBCAM/saluteweb2.jpg" }];

	var cam_count = webcams.length;
	var start_index = Math.floor(Math.random() * cam_count) + 1;
	var cachedCams = new Array();

	$(function(){
		for (var i = 0; i < cam_count; i++) {
			cachedCams[i] = new Image();
			cachedCams[i].src = webcams[i].url;
		}
	    updateFeeds();
	});

	setInterval(function() {
		updateFeeds();
	}, 10000);

	function updateFeeds() {
		start_index = (start_index + 3) % cam_count;

		var webcam_1 = webcams[start_index - 1];
		var webcam_2 = webcams[start_index % cam_count];
		var webcam_3 = webcams[(start_index + 1) % cam_count];

	    $("#webcam1").attr("src", webcam_1.url);
		$("#cam_url1").attr("href", webcam_1.url);
		$("#cam_name1").text(webcam_1.name);

	    $("#webcam2").attr("src", webcam_2.url);
		$("#cam_url2").attr("href", webcam_2.url);
		$("#cam_name2").text(webcam_2.name);

	    $("#webcam3").attr("src", webcam_3.url);
		$("#cam_url3").attr("href", webcam_3.url);
		$("#cam_name3").text(webcam_3.name);
	}
</script>

<div class="widget">
	<div class='draggabletitle'>Webcams (<a href='http://93.62.201.235/maree/WEBCAM/'>Centro Maree</a>)</div>
	<div class='ui-widget-content' style="text-align:center;">
		<span style='float:right;'><img class='help' src='../images/help.png' href='#' height=15 width=15 /><img class='close' src='../images/close.png' href='#' height=15 width=15 /></span>
		<br /><br />
		<table border=0>
			<tr>
				<td><a id='cam_url1' rel='facebox' href=''><img id='webcam1' height=125 width=123 src='' alt='' title='' /></a></td>
				<td><a id='cam_url2' rel='facebox' href=''><img id='webcam2' height=125 width=123 src='' alt='' title='' /></a></td>
				<td><a id='cam_url3' rel='facebox' href=''><img id='webcam3' height=125 width=123 src='' alt='' title='' /></a></td>
			</tr>
			<tr>
				<td id='cam_name1' style="font-size:10px;"></td>
				<td id='cam_name2' style="font-size:10px;"></td>
				<td id='cam_name3' style="font-size:10px;"></td>
			</tr>
		</table>
	</div>
</div>  