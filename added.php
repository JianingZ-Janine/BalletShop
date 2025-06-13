<?php

include('../BalletShop/Includes/session-cart.php');

if (isset($_GET['id']))
    $id = $_GET['id'];

require('../BalletShop/Includes/connect_db.php');

$q = "SELECT * FROM products WHERE item_id = $id";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) == 1) {
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

    if (!isset($_SESSION['cart'][$id])) {
        ## Add 1+ quantity of this product to the cart.
        $_SESSION['cart'][$id]['quantity']++;
        echo '
   <div class="container">
   <div class="alert alert-secondary" role="alert">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
     </button>
     <p> Another ' . $row['item_name'] . ' has been added to your cart.</p>
     <a href="user.php"> Continue Shopping</a> | <a href="cart.php"> View Cart</a>
     </div>
     </div>
   ';
    }
     else
  {
    # Or add one of this product to the cart.
    $_SESSION['cart'][$id] = array('quantity' => 1, 'price' => $row['item_price']);
    echo '<div class="container">
			<div class="alert alert-secondary" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<p>A ' . $row["item_name"] . ' has been added to your cart</p>
			<a href="home.php">Continue Shopping</a> | <a href="cart.php">View Your Cart</a>
			</div>
		</div>';
  }
}

# Close database connection.
mysqli_close($link);
include('Includes/footer.html');
?>

