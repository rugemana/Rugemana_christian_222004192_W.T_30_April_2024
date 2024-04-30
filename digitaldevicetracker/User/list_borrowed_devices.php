<?php
include 'header.php';

// Check if user ID is set
if(isset($_SESSION['user_id'])) {
    // Get user ID
    $userId = $_SESSION['user_id'];
    
    // Fetch borrowed devices for the user
    $result = $ddtms->getBorrowedDevicesByUserId($userId);

    // Check if result status is true and data is not empty
    if($result['status'] && !empty($result['data'])) {
        $borrowedDevices = $result['data'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Borrowed Devices</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>List of Borrowed Devices</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Device Name</th>
                    <th>Description</th>
                    <th>Borrowed Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($borrowedDevices as $device) { ?>
                <tr>
                    <td><?php echo $device['id']; ?></td>
                    <td><?php echo $device['device_name']; ?></td>
                    <td><?php echo $device['description']; ?></td>
                    <td><?php echo $device['borrowed_at']; ?></td>
                    <td><?php echo $device['return_date']; ?></td>
                    <td><?php echo $device['t_status']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
    } else {
        // No borrowed devices found for the user
        echo "<p>No borrowed devices found for the user.</p>";
    }
} else {
    // User ID is not set
    echo "<p>User ID is not set.</p>";
}
?>
