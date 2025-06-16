<?php
# Access session.
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Pirouette UK | Dancewear</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/bb3ef965c3.js" crossorigin="anonymous"></script>

  <style>
    .card {
      margin-top: 100px;
      margin-bottom: 20px;
    }

    .banner-fixed {
      position: fixed;
      top: 56px;
      /* Height of Bootstrap fixed-top navbar */
      left: 0;
      width: 100%;
      z-index: 1039;
      /* Just below the navbar (1040) */
      background-color: rgb(244, 214, 220);
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#"><img src="../Images/logo.jpg" alt="Logo" width="30" height="30"
        class="d-inline-block align-text-top"> Pirouette UK</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Products <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sales</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Gifts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Support</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About us</a>
        </li>
      </ul>
      <!-- Right side of the Navbar: user,cart,wishlist-->

      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="user.php"><i class="fa fa-user fa-fw" aria-hidden="true"></i> <?php
          echo "{$_SESSION['first_name']} {$_SESSION['last_name']}";
          ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">
            <i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> Shopping Cart
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fa fa-heart fa-fw" aria-hidden="true"></i> Wishlist
          </a>
        </li>
        <li class="nav-item">
          <a href="../Includes/logout.php" class="nav-link">Log Out</a>
        </li>
      </ul>
    </div>
  </nav>
  <!--Display Free Delivery Option-->
  <div class="banner banner-fixed">
    <p class="text-dark text-center mb-0 font-weight-medium">Free delivery on orders over £50!</p>
  </div>
</body>

</html>