<html>
<head>
	<title>Delete Order</title>
	<meta charset ="utf-8" />
</head>

<body>
    
<?php
// connect to database
include "inc_dbconnect.php";

// user has clicked submit button on Delete Order
if (isset($_POST['order_id']))
{
	$order_id = htmlspecialchars($_POST['order_id']);
	echo "Order ID: " . $order_id . "<br/>";
	echo "Test1";
}
//user has clicked update hyperlink on Delete Order
else if (isset($_GET['order_id']))
{
	$order_id = htmlspecialchars($_GET['order_id']);
	echo "Order ID: " . $order_id . "<br/>";
}
 
// Attempt delete query execution
$sql = "DELETE FROM orders WHERE order_id = '$order_id'";
if(mysqli_query($DBConnection, $sql)){
    echo "Records were deleted successfully. <br/>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($DBConnection);
}
 
// Close connection
mysqli_close($DBConnection);

?>
<a href="ViewOrder.php">View Orders</a>		
</body>
</html>
