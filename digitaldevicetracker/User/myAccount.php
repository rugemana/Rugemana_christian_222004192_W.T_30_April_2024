<?php
include 'header.php';

// Get user ID from session or wherever it's stored
$userId = $_SESSION['user_id'];

// Fetch user details using the user ID
$resultUser = $ddtms->getUserById($userId);

// Check if user details fetched successfully
if ($resultUser['status']) {
    $user = $resultUser['data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>My Account</h1>
        <div class="row">
            <div class="col-md-6">
                <form action="server.php" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                    <input type="hidden" name="comp_id" value="<?php echo $user['comp_id']; ?>">
                    <input type="hidden" name="role" value="<?php echo $user['role']; ?>">
                    <input type="hidden" name="password" value="<?php echo $user['password']; ?>">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $user['fname']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $user['lname']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                    </div>
            </div> <!-- End of first column -->

            <div class="col-md-6">
                <!-- Additional fields -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="updateMyAcoount">Update</button>
            </form>
        </div> <!-- End of second column -->
    </div> <!-- End of row -->
</div> <!-- End of container -->
</body>
</html>

<?php
} else {
    echo "<p>{$resultUser['message']}</p>";
}

include 'footer.php';
?>
