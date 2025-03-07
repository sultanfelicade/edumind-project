<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title ? $title : 'Dashboard'; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="@sweetalert2/theme-bulma/bulma.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="icon" href="https://icon2.cleanpng.com/lnd/20240924/rx/2e11cfbf550f445d3131b646b8c800.webp" type="image/webp">

  <style>
    body {
      font-family: 'Playfair Display', serif;
      font-weight: 400;
    }
  </style>

</head>

<body>
<?php if ($_SESSION['role'] == 'admin'): ?>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <!-- <a class="navbar-brand" href="#">Founder</a> -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../../dashboard/admin/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../dashboard/admin/addUser.php">Add User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../dashboard/admin/user.php">User</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Account
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../../dashboard/admin/profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="../../config/logout.php" onclick="logout(event);">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<?php endif; ?>


<!-- user -->
<?php if ($_SESSION['role'] == 'user'): ?>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../../dashboard/user/index.php"><i class="fa-solid fa-house"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../dashboard/user/matkul.php"><i class="fa-regular fa-bookmark"></i> Matkul</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../dashboard/user/dumb.php"><i class="fa-solid fa-pen-nib"></i> Dump</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-book"></i>  All Material
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../../dashboard/user/materiAll.php">Materi</a></li>
              <li><a class="dropdown-item" href="../../dashboard/user/submateriAll.php" >SubMateri</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-regular fa-address-card"></i> Account
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../../dashboard/user/profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="../../config/logout.php" onclick="logout(event);" >Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <i class="fa-solid fa-person-through-window "></i>
    </div>
  </nav>
<?php endif; ?>