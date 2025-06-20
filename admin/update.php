<?php
session_start();
include('../Includes/nav.php');
if ( $_SERVER [ 'REQUEST_METHOD' ] == 'POST' ) {
    require('connect_db.php');
}

# Initialize an error array.
$errors = array();

# Check for a item name.
if (empty($_POST['item_id'])) {
    $errors[] = 'Update item ID.';
} else {
    $id = mysqli_real_escape_string($link, trim($_POST['item_id']));
}

# Check for a item name.
if (empty($_POST['item_name'])) {
    $errors[] = 'Update item name.';
} else {
    $n = mysqli_real_escape_string($link, trim($_POST['item_name']));
}

# Check for a item description.
if (empty($_POST['item_desc'])) {
    $errors[] = 'Update item description.';
} else {
    $d = mysqli_real_escape_string($link, trim($_POST['item_desc']));
}

# Check for a item img.
if (empty($_POST['item_img'])) {
    $errors[] = 'Update image address.';
} else {
    $img = mysqli_real_escape_string($link, trim($_POST['item_img']));
}

# Check for a item price.
if (empty($_POST['item_price'])) {
    $errors[] = 'Update item price.';
} else {
    $p = mysqli_real_escape_string($link, trim($_POST['item_price']));
}

if (empty($errors)) {
    $q = "UPDATE products SET item_id='$id',item_name='$n', item_desc='$d', item_img='$img', item_price='$p'  WHERE item_id='$id'";
    $r = mysqli_query($link, $q);
    if ($r) {
        header("Location: ../Includes/read.php");
    } else {
        echo "Error updating record: " . $link->error;
    }

    # Close the database connection.
    mysqli_close($link);
}
?>

<div class="container mt-5 mb-5">
<h1>Update Item</h1>
	<form action="update.php" method="post" >
      <!-- input box for item id -->
	  <label for="id">Update Item ID:</label>
	  <input type="text" 
	  id="item_id" 
	  class="form-control" 
	  name="item_id" 
	  required 
	  value="<?php if (isset($_POST['item_id'])) echo $_POST['item_id']; ?> ">

	  <!-- input box for item name  -->
	  <label for="name">Update Item Name:</label>
	  <input type="text" 
	  id="item_name" 
	  class="form-control" 
	  name="item_name" 
	  required 
	  value="<?php if (isset($_POST['item_name'])) echo $_POST['item_name']; ?> ">
	  
	  <!-- input box for item description -->  
	  <label for="description">Update Description:</label>
	  <textarea id="item_desc" 
	  class="form-control" 
	  name="item_desc" 
	  required 
	  value="<?php if (isset($_POST['item_desc'])) echo $_POST['item_desc']; ?>">
	  </textarea>
	  
	 <!-- input box for image path -->
	 <label for="image">Update Image:</label>
	 <input type="text" 
	 id="item_img" 
	 class="form-control" 
	 name="item_img" 
	 required 
	 value="<?php if (isset($_POST['item_img'])) echo $_POST['item_img']; ?>">
	 
	 <!-- input box for item price -->
	 <label for="price">Update Price:</label>
	 <input 
	 type="number" 
	 id="item_price" 
	 class="form-control" 
	 name="item_price" 
	 min="0" step="0.01" 
	 required 
	 value="<?php if (isset($_POST['item_price'])) echo $_POST['item_price']; ?>"><br>
	  <!-- submit button -->
     <input type="submit" class="btn btn-dark" value="Submit">
	</form>
</div>

<?php include('../Includes/footer.php'); ?>
