<?php 
	session_start();
?>
<!-- *** PAGE 3: AFTER CONFIRMING DETAILS; OPTIONAL CAR RENTAL --->

<!-- *** Flight info is logged into flight_book table in the database on this page *** -->

<!-- *** Allows user to choose whether to add a car rental -->
<!-- *** Car rental rent_id and type can be added to the car_rentals table and inventory after the form is processed on this page when we attempt to Add to Cart *** -->
<!-- *** Flight and (if chosen) car rental can be added to INVENTORY and CART after this page*** -->
<!-- *** book_id and rent_id can be used as items to indicate a booking and rental was ordered in the inventory *** -->

<!-- *** Can allow user to navigate to main page or view cart from here*** -->
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>Tangled Web Travel Agent &mdash; Flight Booking</title>
	<link rel="stylesheet" href="./css/bookflightstyle.css">
	<link rel="stylesheet" href="./css/pagestyle.css">
</head>
<body>
	<?php
		$host = "127.0.0.1";
		$user = "root";
		$pass = "Happy100";
		$db = "booking";

		//Create connection
		$conn = new mysqli($host, $user, $pass, $db);
		//Check connection
		if($conn->connect_error){
			die("Connction failed: " . $conn->connect_error);
		}
	?>

<div class="container">
	<div class="image-section"><h1 class="title">Atlanta Flights</h1></div>

	<div class="bar"></div>

	<div class="shader">
		<div class="content">
				<form action=" " method="post"> <!-- ***NOTE: form action not yet assigned so rental can be added on inventory page *** -->
					<?php
						//Log flight info into the flight_book table in the DB
						$sql = "INSERT INTO flight_book VALUES ('" . $_SESSION['book_id'] . "', '" . $_SESSION['airline'] . "', '" . $_SESSION['dest'] . "', '" . $_SESSION['tickets'] . "')";

						if($conn->query($sql) === TRUE){ //Check if query successful
							
							//Decrement number of avail tickets in airline table
							$_SESSION['current_avail_seats'] = $_SESSION['current_avail_seats'] - $_SESSION['tickets'];

							$query = "UPDATE " . $_SESSION['airline'] . " SET seats_avail='" . $_SESSION['current_avail_seats'] . "' WHERE dest='" . $_SESSION['dest'] . "'";
							$conn->query($query);

							//Display complete flight info
							echo "<h1 class='sub-title'>Flight succesfully processed!</h1>";
							echo "<h3>Your flight from Atlanta to " . $_SESSION['dest'] . "</h3>";

							echo "<div>";
							echo "<table align='center'>";
								echo "<tr>";
									echo "<td class='td-bold'>Airline: </td>";
									echo "<td>" . $_SESSION['airline'] . "</td>";
								echo "</tr>";

								echo "<tr>";
									echo "<td class='td-bold'>Flight to:</td>";
									echo "<td>" . $_SESSION['dest'] . "</td>";
								echo "</tr>";

								echo "<tr>";
									echo "<td class='td-bold'>Number of tickets:</td>";
									echo "<td>" . $_SESSION['tickets'] . "</td>";
								echo "</tr>";
							echo "</table>";
						?>
						<!-- Optional car rental -->
						<h3>Would you like to add a rental car to your order?</h3>

						<div id="rental-div" class="center-div">
							<p>
								<input type="radio" class="radio" name="rental_radio" onClick="handleClick(this)" value="false" checked />
								<label for="nrental_radio">No thanks</label>
							</p>

							<p>	
								<input type="radio" class="radio" name="rental_radio" onClick="handleClick(this)" value="true"/>
								<label for="yrental_radio">Yes</label>
							</p>
						
							<select name="rental" id="rental_select" disabled>
								<option>Select a car type</option>";
								<option value="suv">SUV</option>
								<option value="compact">Compact</option>
								<option value="midsize">Midsize</option>
								<option value="luxury">Luxury</option>
							</select>
						</div>

						<input type="submit" id="add-to-cart-button" value="Add to Cart">

						<?php 
							echo "</div>";
						}else{
							echo "<h1>Error: Flight failed to process</h1>";
							echo "<h3>Please try again later</h3>";

							echo "<a href='bookflight.php'><input type='button' id='go-back-button' value='&laquo Go back'></a>";
						}
						$conn->close();
						?>

				</form>
		</div> <!-- content -->
	</div> <!-- shader -->

	<div class="bar"></div>
</div> <!-- container -->

<script type="text/javascript">
	function handleClick(myRadio){
		if(myRadio.value=="true"){
			document.getElementById("rental_select").disabled = false;
		}else{
			document.getElementById("rental_select").disabled = true;	
		}
	}
</script>
</body>


</html>