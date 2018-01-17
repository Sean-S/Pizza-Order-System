<!DOCTYPE html>
<head>
	<title>Pizza Order Receipt</title>
	<meta charset="utf-8">
</head>

<body>
<?php
	
	// connect to database
	include "inc_dbconnect.php";
	
	$SQLString="SELECT * FROM orders ORDER BY order_id";
	
	//execute SQL query
	$QueryResult = mysqli_query($DBConnection, $SQLString);
	if ($QueryResult === FALSE)
	{
		echo "<p>There was an error when executing the query.<br >\n";
		
	}
	else if (mysqli_num_rows($QueryResult)==0)	//check if no results in resultset
		echo "<p>There are no orders to display.</p>\n";
	else //records returned in resultset
	{
			//create header row for display table
			echo "<table border='1' cellspacing='0'>\n";
			echo"<tr><th>Order ID</th>" .
				"<th>Student</th>" .
				"<th>First Name</th>" .
				"<th>Last Name</th>" .
				"<th>Email</th>" .
				"<th>Address</th>" .
				"<th>Phone</th>" .
				"<th>Price</th>" .
				"<th>Size</th>" .
				"<th>Anchovies</th>" .
				"<th>Pineapple</th>" .
				"<th>Pepperoni</th>" .
				"<th>Peppers</th>" .
				"<th>Olives</th>" .
				"<th>Onion</th>" .
				"<th>&nbsp;</th></tr>\n";
				
			
			//while there are records in the resultset
			while ($order=mysqli_fetch_assoc($QueryResult))
			{
				//output current row of reseultset in a table
				echo "<tr><td>" . $order['order_id'] . "</td>" .
					"<td>" . $order['student'] . "</td>" .
					"<td>" . $order['firstname'] . "</td>" .
					"<td>" . $order['lastname'] . "</td>" .
					"<td>" . $order['email'] . "</td>" .
					"<td>" . $order['address'] . "</td>" .
					"<td>" . $order['phone'] . "</td>" .
					"<td>" . $order['price'] . "</td>" .
					"<td>" . $order['size'] . "</td>" .
					"<td>" . $order['anchovies'] . "</td>" .
					"<td>" . $order['pineapple'] . "</td>" .
					"<td>" . $order['pepperoni'] . "</td>" .
					"<td>" . $order['peppers'] . "</td>" .
					"<td>" . $order['olives'] . "</td>" .
					"<td>" . $order['onion'] . "</td>" .
					"<td><a href=\"UpdateOrder.php?order_id=" .
						$order['order_id'] . "\">Update</a></td>" .	//Update Hyperlink
					"<td><a href=\"DeleteOrder.php?order_id=" .
						$order['order_id'] . "\">Delete</a></td>" .	//Delete Hyperlink
					"</tr>\n";
			}
			echo "</table>\n";
	}
	
	
?>
<a href="OrderPizza.html">Return to homepage.</a>
</body>
</html>
