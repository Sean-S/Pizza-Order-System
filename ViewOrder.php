<!DOCTYPE html>
<head>  
    <meta charset = "utf-8">
        <title>View Order</title>
</head> 
<body> 
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') //form has been submitted by POST method
{
		// connect to database
		include "inc_dbconnect.php";
		
		//Generate unique order_id
		$order_id = uniqid();
	
		// Check connection
		if($DBConnection === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		
		//sanitise data entered by user TODO put into sanitise function
		$firstname = mysqli_real_escape_string($DBConnection, $_POST['firstName']);
		$lastname = mysqli_real_escape_string($DBConnection, $_POST['lastName']);
		$email = mysqli_real_escape_string($DBConnection, $_POST['emailAddress']);
		$address = mysqli_real_escape_string($DBConnection, $_POST['address']);
		$phone = mysqli_real_escape_string($DBConnection, $_POST['phoneNo']);
		$price = mysqli_real_escape_string($DBConnection, $_POST['totalPrice']);
		$size = mysqli_real_escape_string($DBConnection, $_POST['pizzaSize']);
		
		//Student Discount
		//check if discount is selected
			if (!isset($_POST['student']))
			{		
				$student = 'n'; 
			} 
			else
				{
					$student = mysqli_real_escape_string($DBConnection, $_POST['student']);
				}
		
		//check if addAnchovies is selected
		if (!isset($_POST['addAnchovies']))
			{		
				$anchovies = 'n'; 
			} 
			else
				{
					$anchovies = mysqli_real_escape_string($DBConnection, $_POST['addAnchovies']);
				}
		
		//check if addPineapple is selected
		if (!isset($_POST['addPineapple']))
			{		
				$pineapple = 'n'; 
			} 
			else
				{
					$pineapple = mysqli_real_escape_string($DBConnection, $_POST['addPineapple']);
				}
		
		//check if addPepperoni is selected
		if (!isset($_POST['addPepperoni']))
			{		
				$pepperoni = 'n'; 
			} 
			else
				{
					$pepperoni = mysqli_real_escape_string($DBConnection, $_POST['addPepperoni']);
				}
		
		//check if addPeppers is selected
		if (!isset($_POST['addPeppers']))
			{		
				$peppers = 'n'; 
			} 
			else
				{
					$peppers = mysqli_real_escape_string($DBConnection, $_POST['addPeppers']);
				}
				
		//check if addPeppers is selected
		if (!isset($_POST['addOlives']))
			{		
				$olives = 'n'; 
			} 
			else
				{
					$olives = mysqli_real_escape_string($DBConnection, $_POST['addOlives']);
				}
				
		//check if addOnion is selected
		if (!isset($_POST['addOnion']))
			{		
				$onion = 'n'; 
			} 
			else
				{
					$onion = mysqli_real_escape_string($DBConnection, $_POST['addOnion']);
				}
			
		
		
		// build SQL INSERT command string
		$SQLString = "INSERT INTO orders (order_id, student, firstname, lastname, email,
											  address, phone, price, size, anchovies,
											  pineapple, pepperoni, peppers, olives, onion)
					  VALUES ('$order_id', '$student', '$firstname', '$lastname', '$email',
							  '$address', '$phone', '$price', '$size', '$anchovies',
							  '$pineapple', '$pepperoni', '$peppers', '$olives', '$onion')";
					  
		echo "DEBUG PRINT: SQL INSERT String: $SQLString \n";
		
		//execute query
		$QueryResult = mysqli_query($DBConnection, $SQLString);
		
		if ($QueryResult === FALSE)
			// only display error number at debug time
			echo "<p>There was an error saving the record.<br />\n" .
								"The error was " .
								(mysqli_error($DBConnection)) . 
								".<br />\nThe query was '" .
								($SQLString) . "'</p>\n";
		else
		{
			echo "<p>The pizza order was saved.</p>\n";
			//Display all the order details 
			include "Receipt.html.php";
		}
}
else
{
echo "<p>Form was not submitted.</p>\n";
}


?>
</body>
</html>
