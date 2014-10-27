<?php include("include/database.php"); ?>
<?php include("include/functions.php"); ?>
<?php 


session_start();

if(isset($_POST["type"]) && $_POST["type"]=='add') //check if Add to cart button is clicked
	{
		$id=$_POST['id']; 
		$qty=number_format($_POST['qty']);
		add_to_cart($id,$qty); //This Function add_to_cart is in Function.php check there
		$_SESSION['total_item']=total_item($_SESSION['cart']); //total_item  function is in finction.php and whatever result store that in session['total item']
		$_SESSION['total_price']=total_price($_SESSION['cart']);
		header('Location: ProteinSuppliments.php');//After Storing go back to Product page
	}

if(isset($_POST["update"]) && $_POST["update"]=='update_cart')//check if update cart button is clicked
	{
		update_cart(); //check in finction.php
		$_SESSION['total_item']=total_item($_SESSION['cart']);
		$_SESSION['total_price']=total_price($_SESSION['cart']);

		header('Location: view_cart1.php');
	}

if(isset($_POST["empty"]) && $_POST["empty"]=='empty_cart')//check if empty button is clicked
	{ 

		//Session destroy will clear memory of global session variable and it will no longer available
		session_destroy();
		header('Location: view_cart1.php');
	}


?>

