<?php 
include 'header.php';
$ddtms = new DDTMS();
$administrators = $ddtms->getAdminUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Administrators</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <br><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAdminModal">Add New Administrator</button>
        <h1>List of Administrators</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($administrators as $admin) { ?>
                <tr>
                    <td><?php echo $admin['userid']; ?></td>
                    <td><?php echo $admin['fname']; ?></td>
                    <td><?php echo $admin['lname']; ?></td>
                    <td><?php echo $admin['email']; ?></td>
                    <td><?php echo $admin['address']; ?></td>
                    <td><?php echo $admin['phone']; ?></td>
                    <td>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-warning edit-btn" data-toggle="modal" data-target="#editAdministratorModal<?php echo $admin['userid']; ?>">Edit</button>
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteAdministratorModal<?php echo $admin['userid']; ?>">Delete</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script>
        function deleteAdmin(adminId) {
            if (confirm("Are you sure you want to delete this administrator?")) {
                // Send AJAX request to delete the administrator
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            alert(xhr.responseText);
                            // Reload the page after successful deletion
                            location.reload();
                        } else {
                            alert('Failed to delete the administrator.');
                        }
                    }
                };
                xhr.open('POST', 'delete_admin.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('adminId=' + adminId);
            }
        }
    </script>
</body>
</html>
<?php include 'modal.php'; ?>
<?php include 'footer.php'; ?>
