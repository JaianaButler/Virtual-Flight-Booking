<!--*** PAGE 1: BASE PAGE FOR BOOKING ***-->

<!-- *** User gives information to book flight. Button directs to bookflightDB.php ***-->
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>Tangled Web Travel Agent &mdash; Flight Booking</title>
	<link rel="stylesheet" href="./css/bookflightstyle.css">
	<link rel="stylesheet" href="./css/pagestyle.css">
</head>
<body>
<div class="container">
	<div class="image-section"><h1 class="title">Atlanta Flights</h1></div>

	<div class="bar"></div>

	<div class="shader">
		<div class="content">
			<div id="book-flight" class="center-div">
				<form action="bookflightDB.php" method="post">
					<h1 class="sub-title">Flight Booking</h1>
					<table align="center">
						<tr>
							<td class="td-bold">Airline:</td>
							<td>
								<select name="airline"> 
									<option value="american">American Airlines</option>
									<option value="delta">Delta Airlines</option>
									<option value="southwest">Southwest Airlines</option>
								</select>
							</td>
						</tr>

						<tr>
							<td class="td-bold">Destination:</td>
							<td>
								<select name="dest">
									<option value="sandiego">San Diego, CA</option>
									<option value="neworleans">New Orleans, LA</option>
									<option value="miami">Miami, FL</option>
									<option value="lasvegas">Las Vegas, NV</option>
								</select>
							</td>
						</tr>

						<tr>
							<td class="td-bold">Tickets:</td>
							<td>
								<select name="tickets">
									<option value="1">1 Adult</option>
									<option value="2">2 Adults</option>
									<option value="3">3 Adults</option>
									<option value="4">4 Adults</option>
									<option value="5">5 Adults</option>
								</select>
							</td>
						</tr>
					</table>

					<input type="submit" id="next-button" value="Next &raquo">
				</form>

			</div> <!-- bookflight -->
		</div> <!-- content -->
	</div> <!-- shader -->

	<div class="bar"></div>
</div> <!-- container -->

</body>

</html>