<?php # DISPLAY SHOPPING CART PAGE.
session_start();
# Set page title and display header section.
include('../Includes/session-cart.php');

# Check if form has been submitted for update.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # Update changed quantity field values.
  foreach ($_POST['qty'] as $item_id => $item_qty) {
    # Ensure values are integers.
    $id = (int) $item_id;
    $qty = (int) $item_qty;

    # Change quantity or delete if zero.
    if ($qty == 0) {
      unset($_SESSION['cart'][$id]);
    } elseif ($qty > 0) {
      $_SESSION['cart'][$id]['quantity'] = $qty;
    }
  }
}

# Initialize grand total variable.
$total = 0;

# Display the cart if not empty.
if (!empty($_SESSION['cart'])) {
  # Connect to the database.
  ob_start();
  require('../Includes/connect_db.php');
  ob_end_clean(); // discard the output 'Connected to the database successfully!'

  # Retrieve all items in the cart from the 'products' database table.
  $q = "SELECT * FROM products WHERE item_id IN (";
  foreach ($_SESSION['cart'] as $id => $value) {
    $q .= $id . ',';
  }
  $q = substr($q, 0, -1) . ') ORDER BY item_id ASC';
  $r = mysqli_query($link, $q);

  # Display body section with a form and a table.
  echo '<section class="h-100 h-custom" style="background-color:rgb(251, 234, 234);">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-5">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h3 class="fw-bold mb-0 text-black">Shopping Cart</h3>
                  </div>
                  <hr class="my-4">
					<form action="cart.php" method="post">';
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    # Calculate sub-totals and grand total.
    $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
    $total += $subtotal;

    # Display the row/s:
    echo "<div class=\"row mb-3 d-flex justify-content-between align-items-center\">
           <div class=\"col-md-3 col-lg-3 col-xl-3\">
			<img src=\"{$row['item_img']}\"
                 class=\"img-fluid rounded-3\" 
				 alt=\"product\">
		    </div>
			<div class=\"col-md-3 col-lg-3 col-xl-3\">
             <h6 class=\"text-black mb-0\">{$row['item_name']}</h6>
            </div>
			<div class=\"col-md-3 col-lg-3 col-xl-2 d-flex\">
             <input type=\"text\" size=\"3\" name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\"></td>
			</div>
			<div class=\"col-md-3 col-lg-2 col-xl-2\">
			<h6 class=\"mb-0\"> &pound " . number_format($subtotal, 2) . "</h6> 
			</div>
			</div>
		
			";

  }

  # Close the database connection.
  mysqli_close($link);

  # Display the total.
  echo ' </div>
           </div>
              <div class="col-lg-4 bg-grey">
                <div class="p-5">
                  <h3 class="fw-bold mb-3 mt-2 pt-1">Summary</h3>
                  <hr class="my-4">
                  <div class="border rounded p-3 mb-4 bg-white">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small text-muted">Order value</span>
                    <span class="small text-muted">&pound; ' . number_format($total, 2) . '</span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small text-muted">Delivery</span>
                    <span class="small text-muted">' . ($total > 50 ? 'Free' : '£2.99') . '</span>
                  </div>
                </div>
              <h5 class="text-uppercase mb-3 text-right border-y-2 border-black py-2">Total:  &pound; ' . number_format($total + ($total > 50 ? 0 : 2.99), 2) . '</h5>
              <a href="checkout.php?total=' . ($total + ($total > 50 ? 0 : 2.99)) . '" class="btn btn-dark btn-block w-100">Proceed to checkout</a>
              <a href="user.php" class="btn btn-outline-dark btn-block w-100">Continue Shopping</a>
            </div>
          </div>
        </div>
      </div>
  </form>';
  echo '</div></div></div></div>'; // Close row and container
} else
# Or display a message.
{
  echo '<section class="h-100 h-custom" style="background-color:rgb(251, 234, 234);">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-5 text-center">
                            <h1 class="fw-bold mb-4 text-black">Your Shopping Cart is Empty</h1>
                            <p class="text-muted mb-4">It looks like you haven\'t added any items yet. Explore our products to find something you love!</p>
                            <a href="user.php" class="btn btn-dark btn-lg">Browse Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>';
}


# Display footer section.
include('../Includes/footer.php');

?>