<?php 
	session_start();
	$airline = "";
	$dest = "";
	$tickets = "";

	/*** book_id can be the username set at login but using a placeholder for now ***/
	/*** Can only log one flight and rental into the DB per book_id thus per user***/
	$_SESSION["book_id"] = "user1"; 

	$current_avail_seats = "";
?>
<!-- *** PAGE 2: AFTER SELECTING FLIGHT DETAILS *** -->

<!-- *** Checks if tickets for flight available. If not avail, then displays msg and allow user to go back to bookflight.php *** -->
<!-- *** If tickets available, asks user to confirm info, after which the user is directed to Confirmation.php *** -->

<!DOCTYPE html>

<html>
<head lang="en">
	<meta charset="UTF-8">
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

		$_SESSION['airline'] = $_POST["airline"];
		$_SESSION['dest'] = $_POST["dest"];
		$_SESSION['tickets'] = $_POST["tickets"];
		$book_id = $_SESSION["book_id"];

	?>

	<div class="container">
		<div class="image-section"><h1 class="title">Atlanta Flights</h1></div>
		<div class="bar"></div>

		<div class="shader">
			<div class="content">
				<?php	
					//Check if seats available
					$query = "SELECT * FROM " . $_SESSION['airline'] . " WHERE dest='" . $_SESSION['dest'] ."'";
					$result = mysqli_query($conn, $query);

					if(!$result){
						echo "Could not run query: " . mysqli_error();
						exit;
					}else{
						//Retrieve avail seats from table for specific dest
						$row = mysqli_fetch_row($result);
						$_SESSION['current_avail_seats'] = $row[2];

						//Check if # of tickets being booked still available
						if($_SESSION['tickets'] <= $_SESSION['current_avail_seats']){ 
							//Enough tickets available
							echo "<h1>Please confirm the information for this flight</h1>";

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

							//Confirm and go to confirmation.php
							echo "<a href='confirmation.php'><input type='button' id='confirm-button' value='Confirm flight'></a>";

							//Go back to bookflight.php
							echo "<a href='bookflight.php'><input type='button' id='go-back-button' value='&laquo Go back'></a>";
							

							echo "</div>";
							
						}else{
							//Not enough tickets avail or sold out
							echo "<h1 class='sub-title'>Oops! We were unable to process this flight</h1>";
							echo "<h3>The number of tickets you wish to purchase is over the capacity of available seats for this flight</h3>";

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
									echo "<td class='td-bold'>Current available seats:</td>";
									echo "<td>" . $_SESSION['current_avail_seats'] . "</td>";
								echo "</tr>";

							echo "</table>";
							echo "</div>";

							echo "<a href='bookflight.php'><input type='button' id='go-back-button' value='&laquo Go back'></a>";
						}
					}
					$conn->close();
				?>
			</div> <!--content-->
		</div> <!--shader-->
		<div class="bar"></div>	
	</div> <!--container-->
</body>

</html>