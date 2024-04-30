<?php include 'ddtmsconnection.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Device Tracker Managment System</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <div class="title">
                 
                <h1><img src="images/logo.png" alt="Logo" height="50" width="50" style="border-radius: 50%;"> DDTMS SYSTEM</h1>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" style="color: white;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php" style="color: white;">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php" style="color: white;">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php" style="color: white;">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: white;">Add Device</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php" style="color: white;">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mydevices.php" style="color: white;">My devices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" style="color: white;">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="wrapper">