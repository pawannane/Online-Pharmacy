<?php
session_start();

$con=mysqli_connect("localhost", "root","mysql", "online_pharmacy");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

//code for Cart
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	//code for adding product in cart
	case "add":
		if(!empty($_POST["quantity"])) {
			$pid=$_GET["pid"];
			$result=mysqli_query($con,"SELECT * FROM product WHERE id='$pid'");
	          while($productByCode=mysqli_fetch_array($result)){
			$itemArray = array($productByCode["code"]=>array('name'=>$productByCode["name"], 'code'=>$productByCode["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode["price"], 'image'=>$productByCode["image"]));
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			}  else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	}
	break;

	// code for removing product from cart
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
    break;
    
	// code for if cart is empty
	case "empty":
		unset($_SESSION["cart_item"]);
    break;	
}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My Orders</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style.css" type="text/css" rel="stylesheet" />
        <style>
            *{
                box-sizing: border-box;
            }

            body {
              margin: 0 auto;
            }

            .navbar {
              overflow: hidden;
              background-color: #333;
              font-family: Arial, Helvetica, sans-serif;
            }

            .navbar a {
              float: left;
              font-size: 16px;
              color: white;
              text-align: center;
              padding: 14px 16px;
              text-decoration: none;
            }

            .navbar a:hover {
              background-color: red;
            }

            h2{
                text-align: center;
            }

            .checkout{
                color: green;
                float: right;
                text-decoration: none;
                background-color: #ffffff;
                border: green 1px solid;
                padding: 5px 10px;
                border-radius: 3px;
                margin: 10px 0px;
            }

        </style>
    </head>
    <body>
        <div class="navbar">
            <a href="index.html">Home</a>
            <a href="profile.php">My Profile</a>
            <a href="orders.php">My Orders</a>
            <a href="new_login.php">Login</a>
            <a href="about.html">About Us</a>
            </div>
        <hr><h2>My Products</h2><hr>

        <!-- Cart -->
        <div id="shopping-cart">
        <div class="txt-heading">Shopping Cart</div>

        <a id="btnEmpty" href="orders.php?action=empty">Empty Cart</a>
        <?php
        if(isset($_SESSION["cart_item"])){
            $total_quantity = 0;
            $total_price = 0;
        ?>	
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
        <tr>
        <th style="text-align:left;">Name</th>
        <th style="text-align:left;">Code</th>
        <th style="text-align:right;" width="5%">Quantity</th>
        <th style="text-align:right;" width="10%">Unit Price</th>
        <th style="text-align:right;" width="10%">Price</th>
        <th style="text-align:center;" width="5%">Remove</th>
        </tr>	
        <?php		
            foreach ($_SESSION["cart_item"] as $item){
                $item_price = $item["quantity"]*$item["price"];
            ?>
                <tr>
                <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
                <td><?php echo $item["code"]; ?></td>
                <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                <td  style="text-align:right;"><?php echo "₹ ".$item["price"]; ?></td>
                <td  style="text-align:right;"><?php echo "₹ ". number_format($item_price,2); ?></td>
                <td style="text-align:center;"><a href="orders.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="pics/icon-delete.png" alt="Remove Item" /></a></td>
                </tr>
                <?php
                $total_quantity += $item["quantity"];
                $total_price += ($item["price"]*$item["quantity"]);
            }
            ?>

        <tr>
        <td colspan="2" align="right">Total:</td>
        <td align="right"><?php echo $total_quantity; ?></td>
        <td align="right" colspan="2"><strong><?php echo "₹ ".number_format($total_price, 2); ?></strong></td>
        <td></td>
        </tr>
        </tbody>
        </table>		
          <?php
        } else {
        ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php 
        }

        $_SESSION["total_quantity"] = $total_quantity;
        $_SESSION["item_name"] = $item["name"];
        $_SESSION["item_price"] = $item_price;
        $_SESSION["total_price"] = $total_price;

        ?>
        <a class="checkout" href="checkout_form.php">Checkout</a>
        </div>
        <br>


        <!-- Products -->
        <div id="product-grid">
          <div class="txt-heading">Products</div>
          <?php
          $product= mysqli_query($con,"SELECT * FROM product ORDER BY id ASC");
          if (!empty($product)) { 
            while ($row=mysqli_fetch_array($product)) {
            
          ?>
            <div class="product-item">
              <form method="post" action="orders.php?action=add&pid=<?php echo $row["id"]; ?>">
                <div class="product-image"><img src="<?php echo $row["image"]; ?>"></div>
                <div class="product-tile-footer">
                    <div class="product-title"><?php echo $row["name"]; ?></div>
                    <div class="product-price"><?php echo "₹".$row["price"]; ?></div>
                    <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                </div>
              </form>
            </div>
          <?php
                }
             } else {
                echo "No Records.";
            }
          ?>
        </div>
        
    </body>
</html>
