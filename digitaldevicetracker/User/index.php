<?php
include 'header.php';
$companyId = $_SESSION['comp_id'];

// Fetch available devices for the company
$result = $ddtms->getAvailableDevicesByCompanyId($companyId);

// Function to update device return info
function updateDeviceReturnInfo($device_id, $status)
{
    $ddtms = new DDTMS();
    $result = $ddtms->CheckupDeviceIdReturned($device_id, $status);
    return $result['status'];
}
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
        <h1>List of Available Devices</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($result['status']) {
                    $i=0;
                    $devices = $result['data'];
                    if(empty($devices)) {
                        echo "<tr><td colspan='4'>No available devices</td></tr>";
                    } else {
                        foreach ($devices as $device) {
                            $result = updateDeviceReturnInfo($device['id'], 'confirmed');
                            $result2 = updateDeviceReturnInfo($device['id'], 'pending');
                            if(!$result && !$result2) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $device['id']; ?></td>
                                    <td><?php echo $device['device_name']; ?></td>
                                    <td><?php echo $device['description']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#requestBorrowModal<?php echo $device['id']; ?>">Request to Borrow</button>
                                    </td>
                                </tr>
                                <?php 
                            }
                            include 'modal.php';
                        }
                    }
                    if($i==0){
                        echo "<tr><td colspan='4'><center>No available devices</center></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>{$result['message']}</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php

include 'footer.php';
?>
