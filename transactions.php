<?php
include 'server.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Transactions List</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
	<link href="style.css" rel="stylesheet">
	
</head>
<body>
			
<!-- Navigation -->
<section class="nav-bar">
	<?php
	include("nav-bar.html")
	?>

</section>


<div class="container">
	<table>
		<tr>
			<th>Id</th>
			<th>Sender</th>
			<th>Receiver</th>
			<th>Credits transferred</th>
		</tr>
		<?php
			
			// Check connection
			if ($db->connect_error) {
				die("Connection failed: " . $db->connect_error);
			}
			$sql = "SELECT * FROM transfers";
			$result = mysqli_query($db,$sql);
			if ($result->num_rows > 0) {
				// output each row
				while($row = $result->fetch_assoc()):

					
					echo "<tr>";
                    echo "<td>" . $row["T_id"] . "</td>";
                    echo "<td>" . $row["sender"] . "</td>";
                    echo "<td>" . $row["receiver"] . "</td>";
                    echo "<td>" . $row["credits"] . "</td>";
                    echo "</tr>";
				
						endwhile;
			}

 			else { echo "0 results"; }
			$db->close();	
		
		?>
	 </table>
	</div>


<!--- Footer -->
<section class="footer"> 
	<?php
	
	include("footer.html")
	?>

</section>