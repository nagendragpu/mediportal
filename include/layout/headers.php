<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="device-width, initial-scale=1.0">
  <title>welcome</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet" type ="text/css" media = "all">
  <script src="js/respond.js"></script>
 </head>
 <body>
 <!--javascript-->
 	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
 	<script src="js/bootstrap.min.js"></script>

 <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.php" class="navbar-brand">MediPack Portal</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li></li>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="About.html">About</a></li>
                        <li><a href="Contact">Contact</a></li>
                        <li><a href="ProductList">Products</a></li>
                        <li><a href="view_cart1.php" id="cartCount">Cart (
  
                        <?php session_start();

                          if(isset($_SESSION['cart']))
                          {
                            $max=count($_SESSION['cart']);
                           echo $max;
                          }
                          else
                          {
                            echo 0;
                          }
                        ?>
                         )</a></li>
                    </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="Account/Register">Register</a></li>
                  
                            <li><a href="Account/Login">Log in</a></li>
                        </ul>            
                </div>
            </div>
        </div>

       <div id="TitleContent" style="text-align: center">
            <a href="index.php">
                <img id="Image1" src="Images/logo.png" style="border-style:None;" />
            </a>  
            <br />  
        </div>

        <div id="CategoryMenu" style="text-align: center">       
                    <b style="font-size: large; font-style: normal">
                      <a href="ProteinSuppliments.php">
                          Protein Suppliments
                      </a>
                    </b>
                  |  
                    <b style="font-size: large; font-style: normal">
                      <a href="/Category/Fitness">
                          Fitness
                      </a>
                    </b>
                  |  
                    <b style="font-size: large; font-style: normal">
                      <a href="/Category/Health food & Drinks">
                          Health food & Drinks
                      </a>
                    </b>
                  |  
                    <b style="font-size: large; font-style: normal">
                      <a href="/Category/Health Devices">
                          Health Devices
                      </a>
                    </b>
                  |  
                    <b style="font-size: large; font-style: normal">
                      <a href="/Category/Beauty">
                          Beauty
                      </a>
                    </b>             
        </div>
