<?php include("include/layout/headers.php"); ?>
<?php include("include/database.php"); ?>
<?php include("include/functions.php"); ?>

 <?php
 
 if(isset($_REQUEST['submit']))
  {
     $id=intval($_REQUEST['id']);
     $qty=intval($_REQUEST['qty']);
     addtocart($id,$qty);
  }
  //session_destroy();
?>
 <div class="container body-content">
  <hgroup>
    <h2>Products</h2>
</hgroup>


<?php
$result =find_all_product();//Now table Will retried and stored on $result variable
while ($obj=mysqli_fetch_assoc ($result))
 {
?>
  <form method="post" action="ProteinSuppliments.php">
  <div style="float: left; margin-left: 20px;" width="50" />
  <img src="Images/<?php echo $obj['product_img_name']; ?>" width="112" height="108"/>
  <br>
      <?php echo $obj['product_name'];?><br>
      <?php echo $obj['price'];?>
  <input type="text" name="qty" value="1" size="2"> 
  <br>
  <button name="submit" value="Submit" >Add To Cart</button>
  <input type="hidden" name="id" value="<?php echo $obj['id']; ?>" />
  <!-- <input type="hidden" name="submit" value="Submit" /> -->
</form>

 
  </div>   
<?php } ?>


</div>

 
<?php include("include/layout/footer.php"); ?>