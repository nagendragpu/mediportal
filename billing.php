<?php include("include/layout/headers.php"); ?>
<?php include("include/database.php"); ?>
<?php include("include/functions.php"); ?>
<?php
if(isset($_REQUEST['order']))
{		global $connection;
		$name=$_REQUEST['name'];
		$email=$_REQUEST['email'];
		$address=$_REQUEST['address'];
		$phone=$_REQUEST['phone'];
		$query="insert into customers values('','$name','$email','$address','$phone')";
		$result=mysqli_query($connection,$query);
		$customerid=mysqli_insert_id($connection);
		$date=date('Y-m-d');
		$query="insert into orders values('','$date','$customerid')";
		$result=mysqli_query($connection,$query);
		$orderid=mysqli_insert_id($connection);
		
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['id'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			$query="insert into order_detail values ($orderid,$pid,$q,$price)";
			mysqli_query($connection,$query);
		}
		die('Thank You! your order has been placed!');
	}
?>

<form method="post" action="billing.php">
	<div align="center">
        <h1 align="center">Billing Info</h1>
        <table border="0" cellpadding="2px">
        	<tr><td>Order Total:</td><td><?php echo get_order_total(); ?></td></tr>
            <tr><td>Your Name:</td><td><input type="text" name="name" /></td></tr>
            <tr><td>Address:</td><td><input type="text" name="address" /></td></tr>
            <tr><td>Email:</td><td><input type="text" name="email" /></td></tr>
            <tr><td>Phone:</td><td><input type="text" name="phone" /></td></tr>
            <tr><td>&nbsp;</td><td><input type="submit" name="order" value="Order" /></td></tr>
        </table>
	</div>
</form>
<?php include("include/layout/footer.php"); ?>