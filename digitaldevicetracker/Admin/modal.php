<!-- Modal -->
        <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCompanyModalLabel">Add New Company</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form to add new company -->
                        <form action="server.php" method="POST">
                            <div class="form-group">
                                <label for="comp_name">Company Name:</label>
                                <input type="text" class="form-control" id="comp_name" name="comp_name" required>
                            </div>
                            <div class="form-group">
                                <label for="comp_address">Company Address:</label>
                                <input type="text" class="form-control" id="comp_address" name="comp_address" required>
                            </div>
                            <div class="form-group">
                                <label for="comp_email">Company Email:</label>
                                <input type="email" class="form-control" id="comp_email" name="comp_email" required>
                            </div>
                            <div class="form-group">
                                <label for="comp_status">Company Status:</label>
                                <input type="text" class="form-control" id="comp_status" name="comp_status" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="addCompany" value="addCompany">Submit</button>
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Edit Company Modal -->
<div class="modal fade" id="editCompanyModal<?php echo $company['compid']; ?>" tabindex="-1" role="dialog" aria-labelledby="editCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCompanyModalLabel">Edit Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to edit company -->
                <form action="server.php" method="POST">
                    <input type="hidden" id="edit_comp_id" name="edit_comp_id">
                    <div class="form-group">
                        <label for="edit_comp_name">Company Name:</label>
                        <input type="text" class="form-control" id="edit_comp_name" name="edit_comp_name" value="<?php echo $company['comp_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_comp_address">Company Address:</label>
                        <input type="text" class="form-control" id="edit_comp_address" name="edit_comp_address" value="<?php echo $company['comp_address']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_comp_email">Company Email:</label>
                        <input type="email" class="form-control" id="edit_comp_email" name="edit_comp_email" value="<?php echo $company['comp_email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_comp_status">Company Status:</label>
                        <input type="text" class="form-control" id="edit_comp_status" name="edit_comp_status" value="<?php echo $company['comp_status']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="editCompany" value="editCompany">Save Changes</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Company Modal -->
<div class="modal fade" id="deleteCompanyModal<?php echo $company['compid']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCompanyModalLabel">Delete Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Display company information and confirmation message -->
                <p>Are you sure you want to delete the following company?</p>
                <p><strong>Name:</strong> <span id="delete_comp_name"><?php echo $company['comp_name']; ?></span></p>
                <p><strong>Address:</strong> <span id="delete_comp_address"><?php echo $company['comp_name']; ?></span></p>
                <p><strong>Email:</strong> <span id="delete_comp_email"><?php echo $company['comp_email']; ?></span></p>
                <p><strong>Status:</strong> <span id="delete_comp_status"><?php echo $company['comp_status']; ?></span></p>
                <!-- Form to confirm delete company -->
                <form action="server.php" method="POST">
                    <input type="hidden" id="delete_comp_id" name="delete_comp_id">
                    <button type="submit" class="btn btn-danger" name="deleteCompany" value="deleteCompany">Delete</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAdminModalLabel">Add New Administrator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- User registration form -->
                <form action="../Admin/server.php" method="post">
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
                                    $ddtms = new DDTMS();
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
                            
                            <input type="hidden" name="role" value="Administrator">
                        </div>
                        <div class="col-md-10">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary" name="register">Save Administrator</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editAdministratorModal<?php echo $admin['userid']; ?>" tabindex="-1" role="dialog" aria-labelledby="editAdministratorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAdministratorModalLabel">Edit Administrator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit Administrator Form -->
                <form action="../Admin/server.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" placeholder="Enter first name" name="fname" value="<?php echo $admin['fname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" value="<?php echo $admin['address']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $admin['email']; ?>" required>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" placeholder="Enter last name" name="lname" value="<?php echo $admin['lname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" placeholder="Enter phone number" name="phone" value="<?php echo $admin['phone']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Campany Name</label>
                                <select class="form-control" name="comp_id" required>
                                    <option value="<?php echo $admin['compid']; ?>" selected><?php echo $admin['comp_name']; ?></option>
                                    <?php
                                    $ddtms = new DDTMS();
                                    $companies = $ddtms->getAllCompanies();
                                    foreach ($companies as $company) {
                                        echo '<option value="' . $company['compid'] . '">' . $company['comp_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <input type="hidden" class="form-control" id="password" placeholder="Enter password" name="password" value="<?php echo $admin['password']; ?>">
                            <input type="hidden" class="form-control" id="userid" placeholder="Enter password" name="userid" value="<?php echo $admin['userid']; ?>">
                            <input type="hidden" name="role" value="Administrator">
                        </div>
                        <div class="col-md-10">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary" name="updateAdministrator">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

