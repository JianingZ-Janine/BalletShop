<?php
session_start();
include('../Includes/session-cart.php');
?>


<?php
# Open database connection.
ob_start();
require('../Includes/connect_db.php');
ob_end_clean(); // discard the output 'Connected to the database successfully!' 
?>

<?php
# Retrieve all products from the database.
$q = "SELECT * FROM products";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {
    # Display the body of the page.
    echo '<div class="container"> <div class="row">';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '
<div class="col-md-3 d-flex justify-content-center">
	 <div class="card" style="width: 18rem;">
	  <img src="'. $row['item_img'].'" class="card-img-top" alt="image" style="object-fit:cover;height: 240px;">
	   <div class="card-body text-center">
		<h5 class="card-title">'. $row['item_name'].'</h5>
		<p class="card-text">'. $row['item_desc'].'</p>
	 </div>
	  <div class="card-footer bg-transparent border-dark text-center">
		<p class="card-text">&pound '. $row['item_price'].'</p>
	  </div>
	  <div class="card-footer text-muted">
		<a href="added.php?id='.$row['item_id'].'" class="btn btn-light btn-block">Add to Cart</a>
	   </div>
	  </div>
	</div> 
  ';
    }
} else {
    echo '<p> Product Not Found.</p>';
}
# Close database connection.
mysqli_close($link);

include('../Includes/footer.html');
?>

