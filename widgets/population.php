<script type="text/javascript">
	var dataRef = new Firebase('https://vpc.firebaseio.com').child('dashboard/currentPopulation');
	dataRef.on('value', function(dataSnap) {
		var population = replaceNumberWithCommas(dataSnap.val());
		$('#population').text(population);
	});

	function replaceNumberWithCommas(yourNumber) {
	    //Seperates the components of the number
	    var n= yourNumber.toString().split(".");
	    //Comma-fies the first part
	    n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	    //Combines the two sections
	    return n.join(".");
	}
</script>

<div class="widget">
	<div class='draggabletitle'>Venetians (Residents)</div>
	<div class='ui-widget-content'>
		<span style='float:right;'><a href='../images/AboutPopulation.png' rel='facebox'><img class='help' src='../images/help.png' height=15 width=15 /></a><img class='close' src='../images/close.png' href='#' height=15 width=15 /></span>
		
		<br />
		
		<table>
			<tbody>
				<tr>
					<td colspan=2 style="text-align:center;">
						<br />
						<div style="text-align:center; width: 170px; height:25px; color: #ffffff; font-weight: bold; background-color: #6cbe5f; padding: 5px 0;">
							<span style="font-size:22px;" id='population'>0</span><span> &nbsp;VENETIANS</span>
						</div>
					</td>
				</tr>
				<tr>
					<a href='/widgets/population_chart.png' rel='facebox'><img width=172 height=105 src='/widgets/population_chart.png' /></a>
				</tr>
			</tbody>
		</table>
	</div>
</div>  
