<? 
	include('newsReader.php'); 
	$articles = array(fetch_news(0), fetch_news(1), fetch_news(2), fetch_news(3));
?>

<script type='text/javascript'>
	var articles = <? echo json_encode($articles); ?>;
	var article_count = articles.length;
	var article_index = 0;

	$(function() {
	    switchNewsArticle();
	});

	setInterval(function() {
		switchNewsArticle();
	}, 10000);

	function switchNewsArticle() {
		var cur_article = articles[article_index];

		$('#article_title').text(cur_article.title);
		$('#article_title').attr("href", cur_article.link);
		$('#article_img').attr("src", cur_article.image);

		if (++article_index > article_count - 1)
			article_index = 0;
	}
</script>

<div class="widget">
	<div class='draggabletitle'>News (<a href=http://www.ilgazzettino.it/>Il Gazzettino</a>)</div>
	<div class='ui-widget-content'>
		<span style='float:right;'><img class='help' src='../images/help.png' href='#' height=15 width=15 /><img class='close' src='../images/close.png' href='#' height=15 width=15 /></span>
		
		<br />
		<h4>
			<a href="" id="article_title">
				<!-- Article Title -->
			</a>
		</h4>
		<img id="article_img" src="" align="left" style="padding-right:6px;padding-bottom:6px; width:90%;" />
	</div>
</div>  