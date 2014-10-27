<?php include("include/database.php"); ?>
<?php

	function redirect_to ($new_location) {
		header("Location: " . $new_location);
		exit;
	}
	
	function mysql_prep ($string) {
		global $connection;
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}
	function password_encrypt ($password) {
		$hash_format = "$2y$10$"; // Tells PHP to use Blowfish with a "cost" of 10
		$salt_length = 22; // Tells Blowfish 22 characters or more

		$salted = generate_salt ($salt_length);
		$format_and_salt = $hash_format . $salted;
		$hash = crypt($password, $format_and_salt);
		return $hash;
	}

	function generate_salt ($length) {
		// Not 100% Unique, not 100% random, but good enough for a salt
		// MD5 returns 32 characters
		$unique_random_string = md5(uniqid(mt_rand() , true));

		// Valid Characters for a salt are [a-zA-Z0-9./]
		$base64_string = base64_encode($unique_random_string);

		// But not '+' which is valid in base64 encoding
		$modified_base64_string = str_replace ('+' , '.' , $base64_string);

		// Truncate String to the Correct Length
		$salt = substr($modified_base64_string , 0 , $length);

		return $salt;
	}

	function password_check ($password , $existing_hash) {
		// Existing Hash Contains Format and Salt at Start
		$hash = crypt($password, $existing_hash);
		if ($hash === $existing_hash) {
			return true;
		} else {
			return false;
		}
	}

	function attempt_login ($username , $password) {
		// Lookup User
		// Lookup Existing Hash
		// Compare
		$user = find_user_by_username ($username);

		if ($user) {
			// Found user, Now Check Password
			$current_hash = $user["hashed_password"];//This Value is retrieved from Database
			if  (password_check ($password , $current_hash)) {
				// Password Matches
				return $user;
			} else {
				// Password Does Not Match
				return false;
			}
		} else {
			// user Not Found
			return false;
		}

	}

	function confirm_query ($result_set) {
		if (!$result_set) {
			die ("Database Query Failed.");
		}
	}
	
	function find_user_by_username ($username) {

		global $mysqli;
		$query = "SELECT * ";
		$query .= "FROM users ";
		$query .= "WHERE username = '{$username}' ";
		$query .= "LIMIT 1";

		$result=$mysqli->query($query);
		confirm_query($result);
		if ($admin = mysqli_fetch_assoc($result)) {
			return $admin;
		} else {
			return null;
		}
	}
	function find_all_product()
	{
		global $connection;
		$query="SELECT * FROM products ORDER BY id ASC";
		$result=mysqli_query($connection,$query);
		confirm_query($result);
		return $result;
	}

	function find_product_by_id($id)
	{
		global $connection;
		$query="SELECT * FROM products where id='$id'";
		$result=mysqli_query($connection,$query);
		confirm_query($result);
		if ($row=mysqli_fetch_assoc($result)) {
			return $row;
		}else
		{
			return false;
		}
	}

	function find_product_by_name($id){
		global $connection;
		$query="select product_name from products where id='$id'";
		$result=mysqli_query($connection,$query);
		confirm_query($result);
		$row=mysqli_fetch_array($result);
		return $row['product_name'];
	}

	function get_price($id){
		global $connection;
		$query="select price from products where id='$id'";
		$result=mysqli_query($connection,$query);
		confirm_query($result);
		$row=mysqli_fetch_array($result);
		return $row['price'];
	}

	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$id=$_SESSION['cart'][$i]['id'];
			$qty=$_SESSION['cart'][$i]['qty'];
			$price=get_price($id);
			$sum+=$price*$qty;
		}
		return $sum;
	}




	//-------------------------------------------------------

		##Cart Related Functions

	
	function addtocart($id,$qty)
	{
		if($id<1 or $qty<1) return;

		$id=intval($id);
		$qty=intval($qty);
		
		if(isset($_SESSION['cart']))
		{
			if(!product_exists($id,$qty)) 
			{
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['id']=$id;
			$_SESSION['cart'][$max]['qty']=$qty;
			}
		}
		else
		{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['id']=$id;
			$_SESSION['cart'][0]['qty']=$qty;
		}
	}

	function product_exists($id,$qty)
	{
		$id=intval($id);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++)
		{
			if($id==$_SESSION['cart'][$i]['id'])
			{
			$_SESSION['cart'][$i]['qty']=$_SESSION['cart'][$i]['qty']+$qty;
			return true;
			}
		}
		return false;
	}

	function remove_product($id){
		$id=intval($id);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($id==$_SESSION['cart'][$i]['id']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}

		$filtered = array_filter($_SESSION['cart']);
		if(!empty($filtered)){
         $_SESSION['cart']=array_values($_SESSION['cart']);
		}
		else{
			unset($_SESSION['cart']);
		}
	}


	/*function update_cart()
	{
		foreach ($_SESSION['cart'] as $id => $qty)
		{
			if($_POST[$id]==0)
			{
				unset($_SESSION['cart'][$id]);
			}
			else
			{
				$_SESSION['cart'][$id]=$_POST[$id];
			}

		}
	}

	function total_item($cart)
	{
		$item_number=0;

		if (is_array($cart)) 
		{
			foreach ($cart as $id => $qty) 
			{
				$item_number+=$qty;
			}
		}

			return $item_number;
	}

	function total_price($cart)
	{
		$price=0;
		global $mysqli;

			if(is_array($cart))
			{
				foreach ($cart as $id => $qty)
				{
					$result=$mysqli->query("SELECT price FROM products where id='$id'");
						if($result)
						{
							while ($obj=mysqli_fetch_assoc ($result))
							{
								$item_price=$obj['price'];
							}
				
							$price+=$item_price * $qty;
						}
				}
			}
		return $price;
	}*/
//--------------------------------
?>


