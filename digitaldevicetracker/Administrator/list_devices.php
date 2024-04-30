<?php 
include 'header.php';
$companyId=$_SESSION['comp_id'];
$result = $ddtms->getDevicesByCompanyId($companyId);
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
        <h1>List of Devices</h1>
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addDeviceModal">Add New Device</button>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($result['status']) {
                    $devices = $result['data'];
                    ?>
                    <?php foreach ($devices as $device) { ?>
                    <tr>
                        <td><?php echo $device['id']; ?></td>
                        <td><?php echo $device['device_name']; ?></td>
                        <td><?php echo $device['description']; ?></td>
                        <td><?php echo $device['comp_name']; ?></td>
                        <td>
                        <button type="button" class="btn btn-warning edit-btn" data-toggle="modal" data-target="#editDeviceModal<?php echo $device['id']; ?>">Edit</button>
                        <button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteDeviceModal<?php echo $device['id']; ?>">Delete</button></td>
                        <?php include 'modal.php'; ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "<p>{$result['message']}</p>";
    
}
include 'modal.php';
include 'footer.php';
?>
