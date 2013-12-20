<? $photos = glob('./widgets/photos/*'); ?>		

<script type='text/javascript'>
	var photos = <? echo json_encode($photos); ?>;
	var photos_count = photos.length;
	var start = Math.floor(Math.random() * photos_count) + 1;
	var cachedImgs = new Array();

	$(function() {
		for (var i = 0; i < photos_count; i++) {
			cachedImgs[i] = new Image();
			cachedImgs[i].src = photos[i];
		}
	    updateImages();
	});

	setInterval(function() {
		updateImages();
	}, 10000);

	function updateImages() {
		start = (start + 3) % photos_count;
		var new_img1 = photos[start - 1];
		var new_img2 = photos[start % photos_count];
		var new_img3 = photos[(start + 1) % photos_count];
	    $("#img1").attr("src", new_img1);
		$("#img_url1").attr("href", new_img1);
	    $("#img2").attr("src", new_img2);
		$("#img_url2").attr("href", new_img2);
	    $("#img3").attr("src", new_img3);
		$("#img_url3").attr("href", new_img3);
	}
</script>

<div class="widget">
	<div class='draggabletitle'>Photos Taken Today (<a href=http://www.flickr.com/>Flickr</a>)</div>
	<div class='ui-widget-content'>
		<span style='float:right;'><img class='help' src='../images/help.png' href='#' height=15 width=15 /><img class='close' src='../images/close.png' href='#' height=15 width=15 /></span>
		<div style="text-align:center;">
			<br />
			<table border=0 style="margin-top:16px;">
				<tr>
					<td><a id='img_url1' rel='facebox' href=''><img id='img1' height=122 width=122 src='' alt='' title='' /></a></td>
					<td><a id='img_url2' rel='facebox' href=''><img id='img2' height=122 width=122 src='' alt='' title='' /></a></td>
					<td><a id='img_url3' rel='facebox' href=''><img id='img3' height=122 width=122 src='' alt='' title='' /></a></td>
				</tr>
			</table>
		</div>
	</div>	
</div> 