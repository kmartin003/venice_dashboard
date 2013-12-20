<script>
	var flightsRef = new Firebase('https://vpc.firebaseio.com').child('dashboard/flights');
	flightsRef.on('value', function(dataSnap) {
		var capacity = dataSnap.val().capacityRef;
		var flights = dataSnap.val().flightsRef;
		var passengers = dataSnap.val().passengerRef;
		$('#capacityRef').text(replaceNumberWithCommas(capacity));
		$('#flightsRef').text(replaceNumberWithCommas(flights));
		$('#passengerRef').text(replaceNumberWithCommas(passengers));

		var treviso_tourists = Math.floor(passengers * 0.389);
		var treviso_passengers = Math.floor((capacity / passengers) * treviso_tourists);
		var treviso_flights = Math.floor((flights / capacity) * treviso_passengers);
		$('#treviso_tourists').text(replaceNumberWithCommas(treviso_tourists));
		$('#treviso_passengers').text(replaceNumberWithCommas(treviso_passengers));
		$('#treviso_flights').text(replaceNumberWithCommas(treviso_flights));
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
	<div class='draggabletitle'>Aircraft Movements (<a href='http://www.flightradar24.com'>Venice Airport</a>)</div>
	<div class='ui-widget-content'>
		<span style='float:right;'><img class='help' src='../images/help.png' href='#' height=15 width=15 /><img class='close' src='../images/close.png' href='#' height=15 width=15 /></span>
		<table style="margin:0 auto;">
			<tbody>
				<tr>
					<td style="width: 120px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						Venice Flights Today
						<div style="width: 120px; color: #ffffff; font-weight: bold; background-color: #4f4fb0; padding: 5px 0;">
							<div id='flightsRef'>0</div>
						</div>
					</td>
					<td style="width: 120px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						Passengers
						<div style="width: 120px; color: #ffffff; font-weight: bold; background-color: #4f4fb0; padding: 5px 0;">
							<div id='capacityRef'>0</div>
						</div>
					</td>
					<td style="width: 120px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Tourists via VCE</b>
						<div style="width: 120px; color: #ffffff; font-weight: bold; background-color: #EE7C0E; padding: 5px 0;">
							<div id='passengerRef'>0</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<br />
		
		<iframe scrolling="no" src="http://www.flightradar24.com/simple_index.php?lat=45.44&lon=12.36&z=10&clean=1" width="370px" height="250px"></iframe>

		<br />

		<table style="margin:0 auto;">
			<tbody>
				<tr>
					<td style="width: 120px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						Treviso Flights Today
						<div style="width: 120px; color: #ffffff; font-weight: bold; background-color: #4f4fb0; padding: 5px 0;">
							<div id='treviso_flights'>0</div>
						</div>
					</td>
					<td style="width: 120px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						Passengers
						<div style="width: 120px; color: #ffffff; font-weight: bold; background-color: #4f4fb0; padding: 5px 0;">
							<div id='treviso_passengers'>0</div>
						</div>
					</td>
					<td style="width: 120px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Tourists via TSF</b>
						<div style="width: 120px; color: #ffffff; font-weight: bold; background-color: #EE7C0E; padding: 5px 0;">
							<div id='treviso_tourists'>0</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div> 