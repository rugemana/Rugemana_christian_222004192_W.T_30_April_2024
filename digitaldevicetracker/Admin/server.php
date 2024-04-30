<?php
include 'ddtms.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && $_POST["action"] == "login") {
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $email = $_POST["username"];
            $password = md5($_POST["password"]);
            $role = $_POST["role"];

            if (!empty($email) && !empty($password)) {
                $ddtms = new DDTMS();
                if($role=='Customer' || $role=='Administrator'){
                    $loginResult = $ddtms->loginUser($email, $password);
                }else if($role=='Admin'){
                    $loginResult = $ddtms->loginAdmin($email, $_POST["password"]);
                }
                if ($loginResult['status'] === "success") {
                    // Set session variables for each column
                    $_SESSION['user_id'] = $loginResult['user']['userid'];
                    $_SESSION['comp_id'] = $loginResult['user']['comp_id'];
                    $_SESSION['user_fname'] = $loginResult['user']['fname'];
                    $_SESSION['user_lname'] = $loginResult['user']['lname'];
                    $_SESSION['user_email'] = $loginResult['user']['email'];
                    $_SESSION['user_password'] = $loginResult['user']['password'];
                    $_SESSION['user_address'] = $loginResult['user']['address'];
                    $_SESSION['user_phone'] = $loginResult['user']['phone'];
                    $_SESSION['user_role'] = $loginResult['user']['role'];
                    // Use JavaScript to show an alert
                    $message="Login successful! Welcome, " . $loginResult['user']['lname'];
                    echo "<script>alert('$message');</script>";
                    // Redirect to the login page
                    if($role=='Customer'){
                        echo "<script>window.location.href = '../User/index.php';</script>";
                        exit(); // Make sure to exit after redirecting
                    }else if($role=='Admin'){
                        echo "<script>window.location.href = 'index.php';</script>";
                        exit(); // Make sure to exit after redirecting
                    }else if($role=='Administrator'){
                        echo "<script>window.location.href = '../Administrator/index.php';</script>";
                        exit(); // Make sure to exit after redirecting
                    }
                        
                } else {
                    echo "Login failed: " . $loginResult['message'];
                }
            } else {
                echo "Email and password are required for login";
            }
        } else {
            echo "Email and password parameters are missing";
        }
    }else if(isset($_POST['register'])) {
        if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['password'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $password = md5($_POST['password']);
            $role = $_POST['role'];
            $compid = $_POST['comp_id'];

            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                // Use JavaScript to show an alert
                echo "<script>alert('Email already exists in the database');</script>";
                // Redirect to the login page
                echo "<script>window.location.href = '../login.php';</script>";
                exit(); // Make sure to exit after redirecting
            } else {
                $user = new DDTMS();
                if ($user->register($fname, $lname, $email, $address, $phone, $password,$role,$compid)) {
                    // Use JavaScript to show an alert
                    echo "<script>alert('New user registered successfully');</script>";
                    // Redirect to the login page
                    echo "<script>window.location.href = '../login.php';</script>";
                    exit(); // Make sure to exit after redirecting
                } else {
                    echo "Error registering user";
                }
            }
        } else {
            echo "All fields are required for registration";
        }
    }else if(isset($_POST['addCompany'])) {
        $ddtms = new DDTMS();
        $comp_name = $_POST['comp_name'];
        $comp_address = $_POST['comp_address'];
        $comp_email = $_POST['comp_email'];
        $status='Active';

        $result = $ddtms->addCompany($comp_name, $comp_address, $comp_email,$status);

        if($result['status'] === 'success') {
            echo "<script>alert('" . $result['message'] . "');</script>";
            echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 500);</script>";
            exit();
        } else {
            echo "<script>alert('Failed to add the company. Error: " . $result['message'] . "');</script>";
            echo "<script>setTimeout(function() { window.history.back(); }, 500);</script>";
            exit();
        }
    }else if (isset($_POST['editCompany'])) {
        $ddtms = new DDTMS();
        $compid = $_POST['edit_comp_id'];
        $comp_name = $_POST['edit_comp_name'];
        $comp_address = $_POST['edit_comp_address'];
        $comp_email = $_POST['edit_comp_email'];
        $comp_status = $_POST['edit_comp_status'];

        $result = $ddtms->editCompany($compid, $comp_name, $comp_address, $comp_email, $comp_status);

        if ($result) {
            echo "<script>alert('" . $result['message'] . "');</script>";
        } else {
            echo "<script>alert('" . $result['message'] . "');</script>";
        }
        echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 500);</script>";
        exit();
    }else if (isset($_POST['deleteCompany'])) {
        $compid = $_POST['delete_comp_id'];

        // Call the deleteCompany method and get the result
        $result = $ddtms->deleteCompany($compid);

        // Check if the deletion was successful
        if ($result['status'] === 'success') {
            echo "<script>alert('" . $result['message'] . "');</script>";
        } else {
            echo "<script>alert('" . $result['message'] . "');</script>";
        }
        echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 500);</script>";
    }else if (isset($_POST['updateAdministrator'])) {
        $adminId = $_POST['userid'];
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $companyId = $_POST['comp_id'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $result = $ddtms->updateAdministrator($adminId, $firstName, $lastName, $email, $address, $phone, $companyId, $password, $role);

        if ($result['status']) {
            echo "<script>alert('" . $result['message'] . "');</script>";
        } else {
            echo "<script>alert('Failed to update administrator. Error: " . $result['message'] . "');</script>";
        }
         echo "<script>setTimeout(function() { window.location.href = 'list-administrators.php'; }, 500);</script>";
    }else if (isset($_POST['updateMyAcoount'])) {
        $adminId = $_POST['user_id'];
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $companyId = $_POST['comp_id'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $result = $ddtms->updateAdmin($adminId, $firstName, $lastName, $email, $address, $phone, $companyId, $password, $role);

        if ($result['status']) {
            echo "<script>alert('" . $result['message'] . "');</script>";
        } else {
            echo "<script>alert('Failed to update administrator. Error: " . $result['message'] . "');</script>";
        }
        echo "<script>setTimeout(function() { window.location.href = 'myAccount.php'; }, 500);</script>";
    }else{
        echo "<script>alert('Invalid request');</script>";
        echo "<script>window.history.back();</script>";
        exit();
    }
}
?>
