<?php

	include 'server.php';
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View User Details</title>
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
			<th>Username</th>
			<th>Email</th>
			<th>Credits</th>
			<th>	</th>
		</tr>
		<?php
			
			// Check connection
			if ($db->connect_error) {
				die("Connection failed: " . $db->connect_error);
			}
			$sql = "SELECT * FROM users";
			$result = mysqli_query($db,$sql);
			if ($result->num_rows > 0) {
				// output each row
				while($row = $result->fetch_assoc()):

					
					echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["credits"] . "</td>";
                    echo "<td><a href=transfer.php?id=" . $row['id'] . ">View User</a><td>";
                    echo "</tr>";
				
						endwhile;
			}

 			else { echo "0 results"; }
			$db->close();	
		
		?>
	 </table>
	
	 	
</div>
<section class="footer"> 
	<?php
	include("footer.html")
	?>

</section>
</body>
</html>