<?php
include 'ddtms.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['AddDevice'])) {
        if(isset($_SESSION['comp_id'])) {
            $ddtms = new DDTMS();
            $deviceName = $_POST['device_name'];
            $serialNumber = $_POST['serial_number'];
            $description = $_POST['description'];
            $compId = $_SESSION['comp_id'];
            
            $result = $ddtms->addDevice($compId, $deviceName, $serialNumber, $description);
            
            if ($result['status']) {
                echo '<script>alert("Device added successfully");</script>';
                echo '<script>window.location.href = "index.php";</script>';
            } else {
                echo '<script>alert("Failed to add device: ' . $result['message'] . '");</script>';
                echo '<script>window.location.href = "index.php";</script>';
            }
        } else {
            echo '<script>alert("Session comp_id not set");</script>';
            echo '<script>window.location.href = "login.php";</script>';
        }
    }else if (isset($_POST['confirm_request_borrow'])) {
        // Handle confirming borrower's request
        $device_id=$_POST['device_id'];
        $result = $ddtms->confirmBorrowRequest($device_id);
        // Set message based on result
        if ($result['status'] === true) {
            $message = "Borrower's request confirmed successfully";
        } else {
            $message = "Failed to confirm borrower's request: " . $result['message'];
        }
        // Show alert with the message
        echo "<script>alert('$message');</script>";
        // Redirect to index.php
        echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 500);</script>";
    } elseif (isset($_POST['cancel_request_borrow'])) {
        // Handle canceling borrower's request
        $device_id=$_POST['device_id'];
        $result = $ddtms->cancelBorrowRequest($device_id);
        // Set message based on result
        if ($result['status'] === true) {
            $message = "Borrower's request canceled successfully";
        } else {
            $message = "Failed to cancel borrower's request: " . $result['message'];
        }
        // Show alert with the message
        echo "<script>alert('$message');</script>";
        // Redirect to index.php
        echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 500);</script>";
    }else if (isset($_POST['confirm_returned_borrow'])) {
        // Retrieve device ID from the form
        $device_id = $_POST['device_id'];

        // Create an instance of your DDTMS class
        $ddtms = new DDTMS();

        // Call the method to confirm the returned borrow request
        $result = $ddtms->confirmReturnedBorrowRequest($device_id);

        // Set message based on result
        if ($result['status'] === 'success') {
            $message = "Borrower's returned request confirmed successfully";
        } else {
            $message = "Failed to confirm borrower's returned request: " . $result['message'];
        }

       // Show alert with the message
        echo "<script>alert('$message');</script>";
        // Redirect to index.php
        echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 500);</script>";
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
        $result = $ddtms->updateAdministrator($adminId, $firstName, $lastName, $email, $address, $phone, $companyId, $password, $role);

        if ($result['status']) {
            echo "<script>alert('" . $result['message'] . "');</script>";
        } else {
            echo "<script>alert('Failed to update administrator. Error: " . $result['message'] . "');</script>";
        }
         echo "<script>setTimeout(function() { window.location.href = 'myAccount.php'; }, 500);</script>";
    }
    else{
        echo "<script>alert('Invalid request');</script>";
        //echo "<script>window.history.back();</script>";
        exit();
    }
}
?>
