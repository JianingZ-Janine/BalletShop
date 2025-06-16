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
</head>

<style>
  .card {
    margin-top: 30px;
    margin-bottom: 20px;
  }
</style>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img src="../Images/logo.jpg" alt="Logo" width="30" height="30"
        class="d-inline-block align-text-top">
      Pirouette UK | Admin </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="../admin/create.php">Create <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../admin/read.php">Read</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../admin/update.php">Update</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../admin/delete.php">Delete</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="user.php"><i class="fa fa-user fa-fw" aria-hidden="true"></i> <?php
          echo "Admin- {$_SESSION['first_name']} {$_SESSION['last_name']}";
          ?></a>
        </li>
        <li class="nav-item">
          <a href="../Includes/logout.php" class="nav-link">Log Out</a>
        </li>
      </ul>
    </div>
  </nav>