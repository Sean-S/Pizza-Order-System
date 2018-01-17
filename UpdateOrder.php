<html>
<head>  
	<meta charset = "utf-8">
	<title>Update Order</title>
</head> 

<body> 
<?php
echo "Update Order";
$ShowForm = FALSE;
$fields = array('order_id', 'student', 'firstName', 'lastName',
				'address', 'emailAddress', 'phoneNo', 'totalPrice',
				'pizzaSize', 'addAnchovies', 'addPineapple', 'addPepperoni',
				'addPeppers', 'addOlives', 'addOnion');
$order = array();
foreach ($fields as $field)
	$order[$field] = "";

// user has clicked submit button on Update Order
if (isset($_POST['order_id']))
{
	$order_id = htmlspecialchars($_POST['order_id']);
	echo $order_id;
}
//user has clicked update hyperlink on Update Order
else if (isset($_GET['order_id']))
{
	$order_id = htmlspecialchars($_GET['order_id']);
	echo $order_id;
}

if (!empty($order_id))
{
	// connect to database
	include "inc_dbconnect.php";
	
	$SQLString = "SELECT * FROM orders WHERE order_id = '$order_id'";
	
	//execute SELECT query
	$QueryResult = mysqli_query($DBConnection, $SQLString);
	if ($QueryResult === FALSE)
	{
		echo "<p>There was an error retrieving the record.<br >\n";
			"The error was " .
			(mysqli_error($DBConnection)) .
			".<br />\nThe query was '" .
			($SQLString) ."'</p>\n";
		
	}
	else if (mysqli_num_rows($QueryResult)==0)	//check if no results in resultset
	{	
		echo "<p>$order_id is an invalid ID</p>\n";
	}
	else
	{
		//fetch result set and store in $order array
		$order = mysqli_fetch_assoc($QueryResult);
		echo "DEBUG PRINT: Fetched record <br/> \n";
		var_dump($order);
		if (isset($_POST['submit']))//has form data been submitted
		{
			echo "DEBUG PRINT 60: Form submitted with UPDATE data. <br/> \n";
			// validate data TODO put in function
			foreach ($fields as $field)
			{
				$order[$field] = trim($_POST[$field]);
			}
		if ($ShowForm===FALSE)
		{
			echo "DEBUG PRINT : ShowForm: FALSE <br/> \n";
			
		//sanitise data entered by user TODO put into sanitise function
		$firstName = mysqli_real_escape_string($DBConnection, $_POST['firstName']);
		$lastName = mysqli_real_escape_string($DBConnection, $_POST['lastName']);
		$address = mysqli_real_escape_string($DBConnection, $_POST['address']);
		$emailAddress = mysqli_real_escape_string($DBConnection, $_POST['emailAddress']);
		$phoneNo = mysqli_real_escape_string($DBConnection, $_POST['phoneNo']);
		$totalPrice = mysqli_real_escape_string($DBConnection, $_POST['totalPrice']);
		$pizzaSize = mysqli_real_escape_string($DBConnection, $_POST['pizzaSize']);
		
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
				$addAnchovies = 'n'; 
			} 
			else
				{
					$addAnchovies = mysqli_real_escape_string($DBConnection, $_POST['addAnchovies']);
				}
		
		//check if addPineapple is selected
		if (!isset($_POST['addPineapple']))
			{		
				$addPineapple = 'n'; 
			} 
			else
				{
					$addPineapple = mysqli_real_escape_string($DBConnection, $_POST['addPineapple']);
				}
		
		//check if addPepperoni is selected
		if (!isset($_POST['addPepperoni']))
			{		
				$addPepperoni = 'n'; 
			} 
			else
				{
					$addPepperoni = mysqli_real_escape_string($DBConnection, $_POST['addPepperoni']);
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
				$addOlives = 'n'; 
			} 
			else
				{
					$addOlives = mysqli_real_escape_string($DBConnection, $_POST['addOlives']);
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
			
		
		
		// build SQL UPDATE command string
		$SQLString = "UPDATE orders 
					  SET
					  order_id = '$order_id', student = '$student', firstName = '$firstName',
					  lastName = '$lastName', address = '$address', email = '$emailAddress',
					  phone = '$phoneNo', price = '$totalPrice', size = '$pizzaSize',
					  anchovies = '$addAnchovies', pineapple = '$addPineapple', pepperoni = '$addPepperoni',
					  peppers = '$peppers', olives = '$addOlives', onion = '$onion'
					  WHERE order_id = '" .$order_id. "'";
					  
		echo "DEBUG PRINT 87: UPDATE SQL: $SQLString <br/> \n";
		
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
			echo "<p>The pizza update was saved.</p>\n";
		}
	}
}
else
{
	$ShowForm = TRUE;
	echo "DEBUG PRIBT 104 : Set ShowForm: TRUE <br/> \n";
}
}

}
else
{
	// in case invalid order ID entered
	echo "<p>You must select a order to update.</p>\n";
	$ShowForm=FALSE;
	echo "DEBUG PRINT 114: ShowForm: FALSE <br/> \n";
}
if ($ShowForm===TRUE)
{
//include "OrderPizza.html";
?>
<h2 id="heading">Pizzas Order Form</h2>
    <form action="UpdateOrder.php" method="post" >
	<tr><td align='right'>Order ID</td><td align='left'><?php echo $order['order_id']; ?>
			<input type='hidden' name='order_id' value='<?php echo $order['order_id']; ?>' /></td></tr>
      <h3>What pizzaSize of Pizza Would You Like? </h3>
     
        Small
        <input id="small" type="radio" name="pizzaSize" value="small" onChange="redraw()"/>
        Medium
        <input id="medium" type="radio" name="pizzaSize" value="medium" onChange="redraw()" />
        Large
        <input id="large" type="radio" name="pizzaSize" value="large" onChange="redraw()" value='<?php echo $order['pizzaSize'];?>' checked/>
   

      <br>
      <h3>Add Extra Toppings</h3>
    
        addAnchovies
        <input id="addAnchovies" type="checkbox" name="addAnchovies" onChange="redraw()"  value='<?php echo $order['anchovies']; ?>' checked/>
       
        addPineapple
        <input id="addPineapple" type="checkbox" name="addPineapple" onChange="redraw()"  value='<?php echo $order['pineapple']; ?>' checked/>
        
        Pepperoni
        <input id="addPepperoni" type="checkbox" name="addPepperoni"  onChange="redraw()"  value='<?php echo $order['pepperoni']; ?>' checked/>
       
        Olives
        <input id="addOlives" type="checkbox" name="addOlives"  onChange="redraw()"  value='<?php echo $order['olives']; ?>' checked/>
        
        Onion
        <input id="onion" type="checkbox" name="addOnion" onChange="redraw()"  value='<?php echo $order['onion']; ?>' checked/>
        
        Peppers
        <input id="peppers" type="checkbox" name="addPeppers" onChange="redraw()"  value='<?php echo $order['peppers']; ?>' checked/>
   
   
   
   
   
     <h3>Total totalPrice is: €<span id="totalPricetext">18</span></h3>
	 <input name="totalPrice" id="totaltotalPrice" type="hidden" value = '<?php echo $order['price']; ?>' />
     
      
        <h3>Enter your  details</h3>
        First Name:
        <input name="firstName" id="cname" type="text" required value='<?php echo $order['firstname']; ?>'/>
        <br/>
        <br/>
		Last Name:
        <input name="lastName" id="cname" type="text" required value='<?php echo $order['lastname']; ?>'/>
        <br/>
        <br/>
        Address:
        <textarea name="address" id = "cemailAddress" type="text"rows="5" cols="30" required><?php echo $order['address'];?></textarea>
        <br/>
        <br/>
        Email Address:
        <input name="emailAddress" type="address" required value='<?php echo $order['email']; ?>'/>
        <br/>
        <br/>
       
        <br/>
        Phone Number:
        <input name="phoneNo" id="phoneNo" type="text" required value='<?php echo $order['phone']; ?>'/>
		 <br/>
         <br/>
		
		Tick here if you are student:
        <input type="checkbox" id="studentdiscount" name="student" value="y" onChange="redraw()"  value='<?php echo $order['student']; ?>'/>
  
      <br/>
      <button type="submit" name = "submit" value="submit" >Update order</button>
    </form>
    
<?php
}
?>
<a href="ViewOrder.php">View Orders</a>		
</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                          
