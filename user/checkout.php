<?php
include('../Includes/session-cart.php');

# Check for passed total and cart
if (isset($_GET['total']) && ($_GET['total'] > 0) && (!empty($_SESSION['cart']))) {

    # Open database connection.
    ob_start();
    require('../Includes/connect_db.php');
    ob_end_clean(); // discard the output 'Connected to the database successfully!'

    // Use the total sent from the cart page (already includes delivery if needed)
    $final_total = floatval($_GET['total']);

    # Store user and order details in 'orders' database table.
    $q = "INSERT INTO orders (user_id,total,order_date) VALUES (" . $_SESSION['user_id'] . ", $final_total, NOW())";
    $r = mysqli_query($link, $q);
    # Get the current order id.
    $order_id = mysqli_insert_id($link);



    # get all the items in the cart.
    $q = "SELECT * FROM products WHERE item_id IN (";
    foreach ($_SESSION['cart'] as $id => $value) {
        $q .= $id . ',';
    }
    $q = substr($q, 0, -1) . ') ORDER BY item_id ASC';
    $r = mysqli_query($link, $q);



    # Insert each item in the cart into the 'order_contents' database table.
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        $query = "INSERT INTO order_contents (order_id, item_id, quantity, price) 
        VALUES 
        (" . $order_id . "," . $row['item_id'] . "," . $_SESSION['cart'][$row['item_id']]['quantity'] . "," . $_SESSION['cart'][$row['item_id']]['price'] . ")";
        $result = mysqli_query($link, $query);
    }
    if (!$result) {
        die("<div class='container' style='margin-top:140px;'><div class='alert alert-danger'>Order contents insert error: " . mysqli_error($link) . "</div></div>");
    }


    # close database connection.
    mysqli_close($link);

    # Display the order number. 
    echo '
<div class="container" style="margin-top: 140px;">
  <div class="alert alert-secondary" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <p>Thank you for your order. Your order number is <strong>' . $order_id . '</strong>.</p>
    <p>We will contact you shortly to arrange delivery.</p>
    <a href="user.php">Continue Shopping</a> | <a href="cart.php">View Your Cart</a>
  </div>
</div>';

    # Clear the cart.
    $_SESSION['cart'] = NULL;
}

# Or display an error message.
else {
    echo '
    <div class="container" style="margin-top: 140px;">
  <div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <p>There was an error processing your order. Please try again.</p>
    <a href="user.php">Continue Shopping</a> | <a href="cart.php">View Your Cart</a>
  </div>
</div>';
}
?>