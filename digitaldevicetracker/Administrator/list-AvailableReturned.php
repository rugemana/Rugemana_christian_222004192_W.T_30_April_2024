<?php 
include 'header.php';
$companyId = $_SESSION['comp_id'];

// Fetch available devices for borrowing
$result = $ddtms->getDevicesBorrowsReturned($companyId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Devices Borrows Returned</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>List of Devices Borrows Returned</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Device Name</th>
                    <th>Serial Number</th>
                    <th>Borrower Name</th>
                    <th>Date Borrowed</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($result['status']) {
                    $devices = $result['data'];
                    foreach ($devices as $device) {
                        ?>
                        <tr>
                            <td><?php echo $device['transaction_id']; ?></td>
                            <td><?php echo $device['device_name']; ?></td>
                            <td><?php echo $device['serial_number']; ?></td>
                            <td><?php echo $device['lname']; ?></td>
                            <td><?php echo $device['borrowed_at']; ?></td>
                            <td><?php echo $device['returned_at']; ?></td>
                            <td><?php echo $device['t_status']; ?></td>
                        </tr>
                        <?php 
                    }
                } else {
                    echo "<tr><td colspan='7'>{$result['message']}</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
include 'modal.php';
include 'footer.php';
?>
