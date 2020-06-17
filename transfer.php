<?php

	include 'server.php';

	$user_id=$_GET['id'];
	$query= "SELECT * FROM users where id='$user_id' ";
	$result = mysqli_query($db,$query);
    $row = mysqli_fetch_array($result);
    $name = $row["name"];
    $email= $row["email"];
    $credits = $row["credits"]; 

    $query2 = "select name from users WHERE NOT(id='$user_id' )";
    $result2 = mysqli_query($db,$query2);

    if(isset($_POST['transfer'])){

			$T_credits = $_POST['credits'];
			$sender = $row['name'];
			$receiver = $_POST['receiver'];


			if($T_credits > $row["credits"])
			{
					
					$message= "<div class=\"text-display\">
									<h4>Not enough credits. Transaction failed!</h4>
								</div>" ;
					echo $message;

			}
			else{

				$query = "update users set credits=credits-" . $_POST['credits'] . " where name='" . $row['name'] . "'";
            	mysqli_query($db,$query);

            	$query = "update users set credits=credits+" . $_POST['credits'] . " where name='" . $_POST['receiver'] . "'";
            	mysqli_query($db,$query);


            	$query = "INSERT INTO transfers (sender, receiver, credits) values ('$sender' , '$receiver', $T_credits)";
   				mysqli_query($db, $query);
   				header("Location: viewUsers.php");
   			}

			
   			

   			
            


        }



?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Transfer</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
	<link href="style.css" rel="stylesheet">
	
</head>
<body>
	
	<div class="container11">
		<h5>Username: <?php echo $name ?> </h5>
		<h5>Email: <?php echo $email ?> </h5>
		<h5>Current Credits: <?php echo $credits ?> </h5>
		<br>
		<form action="#" method="post">

                
                <h5>Enter Credits: </h5>
                <input type="number" name="credits" min =0 required>
                <br><br>
                <h5>Transfer to: </h5>
                <select name="receiver" required>
                    <option value =""></option>

                <?php
                        while($receiver = mysqli_fetch_array($result2)) {
                            echo "<option value='" . $receiver['name'] . "'>" . $receiver['name'] . "</option>";
                        }
                ?>

                </select>
                <br>
            	<br>
            <input type="submit" name="transfer" value="Transfer">
        </form>
</div>





</body>
</html>