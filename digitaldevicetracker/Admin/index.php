<?php include 'header.php'; ?>
<?php
$companies = $ddtms->getAllCompanies();
$numCompanies = count($companies);
$numAdministrators = $ddtms->getAdminUsers();
$numAdministrators =count($numAdministrators);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Companies</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
       <center> <h1>Welcome back, <?php echo $_SESSION['user_lname']; ?> Admin Dashboard</h1></center>

        <!-- Card Deck for displaying company and administrator counts -->
        <div class="card-deck" style="margin-top: 30px;">
            <!-- Card for number of companies -->
            <div class="card">
                <a href="list_camponies.php">
                <div class="card-body">
                    <h5 class="card-title">Number of Companies</h5>
                    <p class="card-text"><?php echo $numCompanies; ?></p>
                </div>
                </a>
            </div>

            <!-- Card for number of administrators -->
            <div class="card">
                <a href="list-administrators.php">
                <div class="card-body">
                    <h5 class="card-title">Number of Administrators</h5>
                    <p class="card-text"><?php echo $numAdministrators; ?></p>
                </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
<?php include 'modal.php'; ?>
<?php include 'footer.php'; ?>
