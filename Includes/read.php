<?php
include('../Includes/nav.html');
# Open database connection.
ob_start();
require('connect_db.php');
ob_end_clean(); // discard the output 'Connected to the database successfully!' 

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
	 <img src=' . $row['item_img'] . ' class="card-img-top" alt="image" style="object-fit:cover;height: 240px;">
	  <div class="card-body">
	   <h5 class="card-title text-center">' . $row['item_name'] . '</h5>
	   <p class="card-text">' . $row['item_desc'] . '</p>
     </div>
	  <ul class="list-group list-group-flush">
	   <li class="list-group-item"><h5 class="text-center">&pound' . $row['item_price'] . '</h5></li>

	   <li class="list-group-item btn">
	   <a class="btn btn-dark btn-lg btn-block" href="update.php?id=' . $row['item_id'] . '">
	   Update Item</a>
	   <a class="btn btn-danger btn-lg btn-block" href="delete.php?item_id=' . $row['item_id'] . '">
	   Delete Item</a></li>
	  </ul>
	</div>
  </div>';
    }
} else {
    echo '<p> Product Not Found.</p>';
}
# Close database connection.
mysqli_close($link);

include('../Includes/footer.html');
?>

