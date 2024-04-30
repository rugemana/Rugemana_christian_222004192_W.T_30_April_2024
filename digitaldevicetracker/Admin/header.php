<?php
include 'server.php';
if (!isset($_SESSION['user_role']) && $_SESSION['user_role'] != 'Admin') {
    // User is not logged in as a buyer, redirect to the login page
    echo '<script>window.alert("Please log in as a Admin first."); window.location.href = "../login.php";</script>';
    exit();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Device Tracking System</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Kv9a9+60qMwqsvhruE/IYoEdA5KLCnKwA1+PP4tqD/bO25eMfiQYEcZZq5L2Y4rWVdr/3oNr5Zodv9i4tBjkLA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="../images/logo.jpeg" alt="Logo" height="50" width="50" style="border-radius: 50%;">DDTMS SYSTEM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" style="color: white;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_camponies.php" style="color: white;">Campanies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list-administrators.php" style="color: white;">Administrators</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="myAccount.php" style="color: white;">My Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" style="color: white;">Logout</a> <!-- Added Logout link -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">



