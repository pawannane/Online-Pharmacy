<?php
// session_start();
// $con=mysqli_connect("localhost", "root","mysql", "online_pharmacy");
// if(mysqli_connect_errno()){
// echo "Connection Fail".mysqli_connect_error();
// }

// if ($_POST["p1"]){
//     $pid = 1;
// }elseif($_POST["p2"]){
//     $pid = 2;
// }elseif($_POST["p3"]){
//     $pid = 3;
// }elseif($_POST["p4"]){
//     $pid = 4;
// }

// //code for Cart
// if(!empty($_GET["action"])) {
// switch($_GET["action"]) {
// 	//code for adding product in cart
// 	case "add":
// 		if(!empty($_POST["quantity"])) {
// 			$result=mysqli_query($con,"SELECT * FROM product WHERE id='$pid'");
// 	          while($productByCode=mysqli_fetch_array($result)){
// 			$itemArray = array($productByCode["code"]=>array('name'=>$productByCode["name"], 'code'=>$productByCode["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode["price"], 'image'=>$productByCode["image"]));
// 			if(!empty($_SESSION["cart_item"])) {
// 				if(in_array($productByCode["code"],array_keys($_SESSION["cart_item"]))) {
// 					foreach($_SESSION["cart_item"] as $k => $v) {
// 							if($productByCode["code"] == $k) {
// 								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
// 									$_SESSION["cart_item"][$k]["quantity"] = 0;
// 								}
// 								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
// 							}
// 					}
// 				} else {
// 					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
// 				}
// 			}  else {
// 				$_SESSION["cart_item"] = $itemArray;
// 			}
// 		}
// 	}
// 	break;
// }
// }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Online Pharmacy</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <style>
                    *{
                    box-sizing: border-box;
                    }

                    body{
                    margin: 0 auto;
                    }

                    .navbar{
                    overflow: hidden;
                    background-color: #333;
                    font-family: Arial, Helvetica, sans-serif;
                    }

                    .navbar a{
                    float: left;
                    font-size: 16px;
                    color: white;
                    text-align: center;
                    padding: 14px 16px;
                    text-decoration: none;
                    }

                    .navbar a:hover{
                    background-color: red;
                    }

                    img{
                        width: 100%;
                    }

                    .card {
                        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                        max-width: 300px;
                        margin: auto;
                        text-align: center;
                        font-family: arial;
                    }

                    .price {
                        color: grey;
                        font-size: 22px;
                    }

                    .card button {
                        border: none;
                        outline: 0;
                        padding: 12px;
                        color: white;
                        background-color: #000;
                        text-align: center;
                        cursor: pointer;
                        width: 100%;
                        font-size: 18px;
                    }

                    .card button:hover {
                        opacity: 0.7;
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

        <div>
            <figure><img src="pics/op5.jpg"/></figure>
		</div>
		
		<!-- <iframe width="0" height="0" border="0" name="dummyframe" id="dummyframe"></iframe> -->

        <form action="orders.php?action=add&pid=<?php echo $row["id"];?>" method="post">
            <table class="card" cellpadding="100" border="2">
                <td>
                    <img src="pics/zandubam.jfif" style="width:100%">
                        <h1>Zandu Balm</h1>
                        <p class="price">&#8377;50</p>
                        <p><button name="p1">Add to Cart</button></p>
                </td>
    
                <td>
                    <img src="pics/crocin.jfif" style="width:100%">
                    <h1>Crocin</h1>
                    <p class="price">&#8377;120</p>
                    <p><button name="p2">Add to Cart</button></p>
                </td>
    
                <td>
                    <img src="pics/dolo.jfif" style="width:100%">
                    <h1>Dolo-650</h1>
                    <p class="price">&#8377;110</p>
                    <p><button name="p3">Add to Cart</button></p>
                </td>
    
                <td>
                    <img src="pics/vapourrub.jfif" style="width:100%">
                    <h1>Vicks VapoRub</h1>
                    <p class="price">&#8377;50</p>
                    <p><button name="p4">Add to Cart</button></p>
                </td>
            </table>
          </form>
          <p>Copyrights &copy; 2020 <a href="index.html">Online Pharmacy</a></p>
    </body>
</html>
