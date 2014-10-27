
<?php include("include/layout/headers.php"); ?>
<?php include("include/functions.php"); ?>
<?php 
if(isset($_REQUEST['remove']))
	{
		remove_product($_REQUEST['getid']);
	}
	else if(isset($_REQUEST['empty']))
	{
		unset($_SESSION['cart']);
	}
	else if(isset($_REQUEST['update']))
	{
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$id=$_SESSION['cart'][$i]['id'];
			$q=intval($_REQUEST['product'.$id]);
			if($q>0 && $q<=999){
				$_SESSION['cart'][$i]['qty']=$q;
			}
			else{
				$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
			}
		}
	}

?>

<form name="form1" method="post" action="view_cart1.php">
	<div style="margin:0px auto; width:600px;" >
    <div style="padding-bottom:10px">
    	<h1 align="center">Your Shopping Cart</h1>
    <!-- <input type="button" value="Continue Shopping" onclick="window.location='products.php'" /> -->
    </div>
    	<div style="color:#F00"><?php if(isset($msg)) echo $msg; else echo ""; ?></div>
    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
    	<?php
			if(isset($_SESSION['cart'])){
            	echo '<tr bgcolor="#FFFFFF" style="font-weight: bold"><td>Serial</td><td>Name</td><td>Price</td><td>Qty</td><td>Amount</td><td>Options</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$id=$_SESSION['cart'][$i]['id'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pname=find_product_by_name($id)
					//if($q==0) continue;
			?>
            		<tr bgcolor="#FFFFFF"><td><?php echo $i+1; ?></td><td><?php echo $pname; ?></td>
                    <td>$ <?php echo get_price($id); ?></td>
                    <td><input type="text" name="product<?php echo $id; ?>" value="<?php echo $q; ?>" maxlength="3" size="2" /></td>                    
                    <td>$ <?php echo get_price($id)*$q; ?></td>
                    <td><button type="submit" name="remove" value="Remove">Remove</button></td></tr>
<input type="hidden" name="getid" value="<?php echo $id; ?>">            
            <?php					
				}
			?>
				<tr><td><b>Order Total: INR<?php echo get_order_total(); ?></b></td><td colspan="5" align="right"><button type="submit" name="empty" value="Empty">Clear cart</button><button type="submit" name="update" value="Update">Update cart</button><input type="button" value="Place Order" onclick="window.location='billing.php'"></td></tr>
			<?php
            }
			else{
				echo "<tr bgColor='#FFFFFF'><td>There are no items in your shopping cart!</td>";
			}
		?>
        </table>
    </div>

</form>
</body>
</html>

<?php include("include/layout/footer.php"); ?>