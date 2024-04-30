<?php
include 'header.php';
$companyId = $_SESSION['comp_id'];

// Fetch all users
$resultUsers = $ddtms->getAllUsers($companyId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Users</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>List of All Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if($resultUsers['status'] && !empty($resultUsers['data'])): ?>
                    <?php foreach($resultUsers['data'] as $user): ?>
                        <tr>
                            <td><?php echo $user['userid']; ?></td>
                            <td><?php echo $user['lname']; ?></td>
                            <td><?php echo $user['fname']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No users found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
include 'modal.php';
include 'footer.php';
?>
