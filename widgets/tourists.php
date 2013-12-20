<script type="text/javascript">
	$(document).ready(function(){
		var passengerRef = new Firebase('https://vpc.firebaseio.com').child('dashboard/flights/passengerRef');
		passengerRef.on('value', function(dataSnap) {
			var venice_airport_arrivals = dataSnap.val();
			
			var air_arrivals = Math.floor(venice_airport_arrivals + venice_airport_arrivals * 0.389);
			var cruise_arrivals = 0;
			var max_occupancy = 23733;
			var estimated_hotels = Math.floor(max_occupancy * month_multiplier(new Date().getMonth() + 1) * day_multiplier(new Date().getDay()));

			var air_overnights = Math.floor((1262000/3450000) * air_arrivals);
			var train_overnights = Math.floor((1347000/5879000) * estimated_hotels);
			var auto_overnights = Math.floor((268000/5879000) * estimated_hotels);
			var coach_overnights = Math.floor((365000/5879000) * estimated_hotels);
			var bus_overnights = Math.floor((120000/5879000) * estimated_hotels);
			var cruise_overnights = Math.floor(((514000+329000)/239000) * cruise_arrivals);
			var boat_overnights = 0;

			var air_daytrips = 0;
			var train_daytrips = Math.floor(((450000+6670000)/1347000) * train_overnights);
			var auto_daytrips = Math.floor((751000/268000) * auto_overnights);
			var coach_daytrips = Math.floor(((547000+1787000)/365000) * coach_overnights);
			var bus_daytrips = Math.floor(((1110000+600000)/120000) * bus_overnights);
			var cruise_daytrips = 0;
			var boat_daytrips = Math.floor((466000+160000+2235000)/(450000+6670000+751000+547000+1787000+1110000+600000+466000+160000+2235000) * (train_daytrips + auto_daytrips + coach_daytrips + bus_daytrips + cruise_daytrips));

			var train_arrivals = Math.floor((509000/1347000) * train_overnights + train_overnights + train_daytrips);
			var auto_arrivals = Math.floor((95000/268000) * auto_overnights + auto_overnights + auto_daytrips);
			var coach_arrivals = Math.floor((131000/365000) * coach_overnights + coach_overnights + coach_daytrips);
			var bus_arrivals = Math.floor((44000/120000) * bus_overnights + bus_overnights + bus_daytrips);
			var boat_arrivals = boat_daytrips;

			var total_arrivals = air_arrivals + cruise_arrivals + train_arrivals + auto_arrivals + bus_arrivals + coach_arrivals + boat_arrivals;
			var total_overnights = air_overnights + cruise_overnights + train_overnights + auto_overnights + bus_overnights + coach_overnights + boat_overnights;
			var total_daytrips = air_daytrips + cruise_daytrips + train_daytrips + auto_daytrips + bus_daytrips + coach_daytrips + boat_daytrips;

			$('#air_arrivals').text(replaceNumberWithCommas(air_arrivals));
			$('#air_overnights').text(replaceNumberWithCommas(air_overnights));
			$('#air_daytrips').text(replaceNumberWithCommas(air_daytrips));

			$('#train_arrivals').text(replaceNumberWithCommas(train_arrivals));
			$('#train_overnights').text(replaceNumberWithCommas(train_overnights));
			$('#train_daytrips').text(replaceNumberWithCommas(train_daytrips));

			$('#car_arrivals').text(replaceNumberWithCommas(auto_arrivals));
			$('#car_overnights').text(replaceNumberWithCommas(auto_overnights));
			$('#car_daytrips').text(replaceNumberWithCommas(auto_daytrips));

			$('#coach_arrivals').text(replaceNumberWithCommas(coach_arrivals));
			$('#coach_overnights').text(replaceNumberWithCommas(coach_overnights));
			$('#coach_daytrips').text(replaceNumberWithCommas(coach_daytrips));

			$('#bus_arrivals').text(replaceNumberWithCommas(bus_arrivals));
			$('#bus_overnights').text(replaceNumberWithCommas(bus_overnights));
			$('#bus_daytrips').text(replaceNumberWithCommas(bus_daytrips));

			$('#cruise_arrivals').text(replaceNumberWithCommas(cruise_arrivals));
			$('#cruise_overnights').text(replaceNumberWithCommas(cruise_overnights));
			$('#cruise_daytrips').text(replaceNumberWithCommas(cruise_daytrips));

			$('#boat_arrivals').text(replaceNumberWithCommas(boat_arrivals));
			$('#boat_overnights').text(replaceNumberWithCommas(boat_overnights));
			$('#boat_daytrips').text(replaceNumberWithCommas(boat_daytrips));

			$('#arrivals_total').text(replaceNumberWithCommas(total_arrivals));
			$('#overnights_total').text(replaceNumberWithCommas(total_overnights));
			$('#daytrips_total').text(replaceNumberWithCommas(total_daytrips));

			$('#tourists_today').text(replaceNumberWithCommas(total_arrivals));
		});

		function month_multiplier(month) {
			if (month == 1)
				return 0.54;
			if (month == 2)
				return 0.69;
			if (month == 3)
				return 0.87;
			if (month == 4)
				return 0.90;
			if (month == 5)
				return 0.87;
			if (month == 6)
				return 0.90;
			if (month == 7)
				return 0.85;
			if (month == 8)
				return 0.80;
			if (month == 9)
				return 0.80;
			if (month == 10)
				return 0.69;
			if (month == 11)
				return 0.59;
			if (month == 12)
				return 0.44;
			return 0.70;
		}

		function day_multiplier(day) {
			if (day == 0 || day == 5 || day == 6) // weekend
				return 1;
			else // weekday
				return 0.46;
		}

		function replaceNumberWithCommas(yourNumber) {
		    //Seperates the components of the number
		    var n= yourNumber.toString().split(".");
		    //Comma-fies the first part
		    n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		    //Combines the two sections
		    return n.join(".");
		}
	});
</script>

<div class="widget">
	<div class='draggabletitle'>Tourists (est.)</div>
	<div class='ui-widget-content'>
		<span style='float:right;'><a href='../images/AboutTourists.png' rel='facebox'><img class='help' src='../images/help.png' height=15 width=15 /></a><img class='close' src='../images/close.png' href='#' height=15 width=15 /></span>
		<br />
		<table>
			<tbody>
				<tr>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						&nbsp;
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Total Arrivals</b>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Overnights</b>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Day Trippers</b>
					</td>
				</tr>

				<tr>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Air <br />(VCE + TSF)</b>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #EE7C0E; padding: 5px 0;">
							<div id='air_arrivals'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #73b158; padding: 5px 0;">
							<div id='air_overnights'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #0098D4; padding: 5px 0;">
							<div id='air_daytrips'>0</div>
						</div>
					</td>
				</tr>

				<tr>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Train</b>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='train_arrivals'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='train_overnights'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='train_daytrips'>0</div>
						</div>
					</td>
				</tr>

				<tr>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Car</b>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='car_arrivals'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='car_overnights'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='car_daytrips'>0</div>
						</div>
					</td>
				</tr>

				<tr>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Coach</b>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='coach_arrivals'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='coach_overnights'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='coach_daytrips'>0</div>
						</div>
					</td>
				</tr>

				<tr>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Bus</b>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='bus_arrivals'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='bus_overnights'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='bus_daytrips'>0</div>
						</div>
					</td>
				</tr>

				<tr>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Cruise</b>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #ac3e1f; padding: 5px 0;">
							<div id='cruise_arrivals'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #73b158; padding: 5px 0;">
							<div id='cruise_overnights'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #0098D4; padding: 5px 0;">
							<div id='cruise_daytrips'>0</div>
						</div>
					</td>
				</tr>

				<tr>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Boat</b>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='boat_arrivals'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='boat_overnights'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='boat_daytrips'>0</div>
						</div>
					</td>
				</tr>
			
				<tr><td>&nbsp;</td></tr>

				<tr>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<b>Total</b>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='arrivals_total'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='overnights_total'>0</div>
						</div>
					</td>
					<td style="width: 95px; text-align: center; padding: 3px; vertical-align: top; font-size: 11px;">
						<div style="width: 95px; color: #ffffff; font-weight: bold; background-color: #777777; padding: 5px 0;">
							<div id='daytrips_total'>0</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<br />

		<div style="margin-left:71px; text-align:center; width: 298px; height:25px; color: #ffffff; font-weight: bold; background-color: #6b6b95; padding: 5px 0;">
			<span id='tourists_today' style="font-size:25px;">0</span><span> &nbsp;&nbsp; TOURIST ARRIVALS TODAY</span>
		</div>
	</div>	
</div>