<?php
// Include the header file
include 'welcomeheader.php';
?>
<div class="container mt-4">
    <h2>User Registration Form</h2>
    <form action="Admin/server.php" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="fname" placeholder="Enter your first name" name="fname" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter your address" name="address" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Campany Name</label>
                    <select class="form-control" name="comp_id" required>
                        <option selected disabled>Select Company....</option>
                        <?php
                        $companies = $ddtms->getAllCompanies();
                        foreach ($companies as $company) {
                            echo '<option value="' . $company['compid'] . '">' . $company['comp_name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lname" placeholder="Enter your last name" name="lname" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter your phone number" name="phone" required>
                </div>
                 <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
                </div>

                <input type="hidden" name="role" value="user">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="register">Register</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
// Include the footer file
include 'footer.php';
?>
