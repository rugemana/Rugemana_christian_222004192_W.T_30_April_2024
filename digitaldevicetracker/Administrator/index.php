<?php 
include 'header.php';

// Get company ID from session
$companyId = $_SESSION['comp_id'];

// Fetch devices by company ID
$resultDevices = $ddtms->getDevicesByCompanyId($companyId);

// Fetch number of users
$numUsers = $ddtms->getNumUsers($companyId);

// Fetch number of borrowed books
$numBorrowedBooks = $ddtms->getNumBorrowedBooks($companyId);

// Fetch number of available books
$numAvailableBooks = $ddtms->getNumAvailableBooks($companyId);

// Fetch number of returned books
$numReturnedBooks = $ddtms->getNumReturnedBooks($companyId);

// Fetch number of requests
$numRequests = $ddtms->getNumRequests($companyId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Devices</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
         <center><h1>Welcome back mr/mrs, <?php echo $_SESSION['user_lname']; ?> Administrator Dashboard</h1></center>
        <div class="row">
            <div class="col-12" style="margin-top: 30px;">
                <div class="card-deck">

                    <!-- Card for displaying number of devices -->
                    <div class="card">
                        <a href="list_devices.php">
                        <div class="card-body">
                            <h5 class="card-title">Devices</h5>
                            <p class="card-text"><?php echo isset($resultDevices['data']) ? count($resultDevices['data']) : 0; ?></p>

                        </div>
                        </a>
                    </div>

                    <!-- Card for displaying number of users -->
                    <div class="card">
                        <a href="list-users.php">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                            <p class="card-text"><?php echo $numUsers; ?></p>
                        </div>
                        </a>
                    </div>

                    <!-- Card for displaying number of borrowed books -->
                    <div class="card">
                        <a href="list-AvailableNotReturned.php">
                        <div class="card-body">
                            <h5 class="card-title">Borrowed Books</h5>
                            <p class="card-text"><?php echo $numBorrowedBooks; ?></p>
                        </div>
                        </a>
                    </div>

                </div>
            </div><br>

        
            <div class="col-12" style="margin-top: 30px;">
                <div class="card-deck">

                    <!-- Card for displaying number of available books -->
                    <div class="card">
                        <a href="">
                        <div class="card-body">
                            <h5 class="card-title">Available Books</h5>
                            <p class="card-text"><?php echo $numAvailableBooks; ?></p>
                        </div>
                        </a>
                    </div>

                    <!-- Card for displaying number of returned books -->
                    <div class="card">
                        <a href="list-AvailableReturned.php">
                        <div class="card-body">
                            <h5 class="card-title">Returned Books</h5>
                            <p class="card-text"><?php echo $numReturnedBooks; ?></p>
                        </div>
                        </a>
                    </div>

                    <!-- Card for displaying number of requests -->
                    <div class="card">
                        <a href="list-AvailableRequest.php">
                        <div class="card-body">
                            <h5 class="card-title">Requests</h5>
                            <p class="card-text"><?php echo $numRequests; ?></p>
                        </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include 'modal.php';
include 'footer.php';
?>
