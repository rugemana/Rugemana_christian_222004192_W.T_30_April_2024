<?php include 'header.php'; ?>
<?php
$ddtms = new DDTMS();
$companies = $ddtms->getAllCompanies();
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
        <h1>List of Companies</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Status</th>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($companies as $company) { ?>
                <tr>
                    <td><?php echo $company['compid']; ?></td>
                    <td><?php echo $company['comp_name']; ?></td>
                    <td><?php echo $company['comp_address']; ?></td>
                    <td><?php echo $company['comp_email']; ?></td>
                    <td><?php echo $company['comp_status']; ?></td>
                    <td>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-warning edit-btn" data-toggle="modal" data-target="#editCompanyModal<?php echo $company['compid']; ?>">Edit</button>
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteCompanyModal<?php echo $company['compid']; ?>">Delete</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCompanyModal">Add New Company</button>
</body>
</html>
<?php include 'modal.php'; ?>
<?php include 'footer.php'; ?>
