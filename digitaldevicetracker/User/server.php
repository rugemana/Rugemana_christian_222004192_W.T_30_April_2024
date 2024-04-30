<?php
include 'ddtms.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if(isset($_POST['requestBorrow'])){
        if (isset($_POST['device_id'], $_POST['borrower_reason'], $_POST['return_date'])) {
            $user_id = $_SESSION['user_id'];
            $device_id = $_POST['device_id'];
            $borrower_reason = $_POST['borrower_reason'];
            $return_date = $_POST['return_date'];

            $ddtms = new DDTMS();

            $result = $ddtms->requestToBorrow($user_id, $device_id, $borrower_reason, $return_date);

            if ($result['status'] === 'success') {
                echo '<script>alert("' . $result['message'] . '");</script>';
                echo '<script>window.location.href = "index.php";</script>';
            } else {
                echo '<script>alert("' . $result['message'] . '");</script>';
                echo '<script>window.location.href = "index.php";</script>';
            }
        } else {
            echo "<script>alert('All fields are required for borrow request');</script>";
        }
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
        echo "<script>window.history.back();</script>";
        exit();
    }
}
?>
