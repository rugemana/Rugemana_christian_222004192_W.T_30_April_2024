<?php
include '../db_connection.php';
$conn=getDBConnection();
class DDTMS {
    private $pdo;
    private $conn;
    public function __construct() {
        $this->pdo = getDBConnection();
        $this->conn = getDBConnection();
    }
    public function getBorrowedDevicesByUserId($userId) {
        try {
            // Prepare SQL query to retrieve borrowed devices by user ID
            $sql = "SELECT d.*,t.*,t.status as t_status, d.id, d.device_name, d.serial_number, t.borrowed_at, t.return_date 
                    FROM devices d 
                    INNER JOIN transactions t ON d.id = t.device_id 
                    WHERE t.user_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$userId]);

            // Fetch borrowed devices as associative array
            $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array("status" => true, "message" => "Borrowed devices retrieved successfully", "data" => $devices);
        } catch (PDOException $e) {
            // Handle database error
            return array("status" => false, "message" => "Failed to retrieve borrowed devices. Error: " . $e->getMessage(), "data" => null);
        }
    }

    public function getAvailableDevicesByCompanyId($companyId) {
        try {
            // Prepare SQL query to retrieve available devices for the company
            $sql = "SELECT * FROM devices as d where d.comp_id = ? ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$companyId]);

            // Fetch available devices as associative array
            $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array("status" => true, "message" => "Available devices retrieved successfully", "data" => $devices);
        } catch (PDOException $e) {
            // Handle database error
            return array("status" => false, "message" => "Failed to retrieve available devices. Error: " . $e->getMessage(), "data" => null);
        }
    }


    // Method to request to borrow a device
    public function requestToBorrow($user_id, $device_id, $borrower_reason, $return_date) {
        try {
            // Check if the device is already booked
            $bookingExists = $this->isDeviceBooked($device_id);
            
            if ($bookingExists) {
                // Device is already booked, return an error message
                return ['status' => 'error', 'message' => 'Device is already booked.'];
            }

            // Prepare the SQL statement to insert the borrow request into the transactions table
            $sql = "INSERT INTO transactions (user_id, device_id, borrower_reason, returned_at, status) VALUES (?, ?, ?, ?, 'pending')";
            $stmt = $this->pdo->prepare($sql);
            // Execute the SQL statement with the provided values
            $stmt->execute([$user_id, $device_id, $borrower_reason, $return_date]);
            // Check if the borrow request was successfully inserted
            if ($stmt->rowCount() > 0) {
                // Borrow request inserted successfully
                return ['status' => 'success', 'message' => 'Borrow request submitted successfully'];
            } else {
                // Failed to insert borrow request
                return ['status' => 'error', 'message' => 'Failed to submit borrow request'];
            }
        } catch (PDOException $e) {
            // Handle database error
            return ['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    // Method to check if the device is already booked
    private function isDeviceBooked($device_id) {
        $sql = "SELECT * FROM transactions WHERE device_id = ? AND status = 'Appending'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$device_id]);
        return $stmt->rowCount() > 0;
    }

    public function CheckupDeviceIdReturned($device_id, $status) {
        try {
            // Prepare the SQL statement to check if device ID is returned
            $sql = "SELECT * FROM transactions WHERE device_id = ? AND status = ?";
            $stmt = $this->pdo->prepare($sql);
            // Execute the SQL statement with the provided values
            $stmt->execute([$device_id, $status]);
            // Check if there are any rows returned
            if ($stmt->rowCount() > 0) {
                // Device ID is returned
                return ['status' => true, 'message' => 'Device ID is returned', 'data' => null];
            } else {
                // Device ID is not returned
                return ['status' => false, 'message' => 'Device ID is not returned', 'data' => null];
            }
        } catch (PDOException $e) {
            // Handle database error
            return ['status' => false, 'message' => 'Database error: ' . $e->getMessage(), 'data' => null];
        }
    }

    public function getUserById($userId) {
        try {
            $sql = "SELECT * FROM users WHERE userid = :userId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return ['status' => true, 'data' => $user];
            } else {
                return ['status' => false, 'message' => 'User not found'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    private function isEmailExistsForOtherAdmins($email, $adminId) {
        try {
            $sql = "SELECT userid FROM users WHERE email=? and userid!=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$email, $adminId]);
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return true;
        }
    }

    public function updateAdministrator($adminId, $firstName, $lastName, $email, $address, $phone, $companyId, $password, $role) {
        try {
            if ($this->isEmailExistsForOtherAdmins($email, $adminId)>1) {
                return array("status" => false, "message" => "Email already exists for another administrator", "data" => null);
            }

            $sql = "UPDATE users SET fname=?, lname=?, email=?, address=?, phone=?, comp_id=?, password=?, role=? WHERE userid=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$firstName, $lastName, $email, $address, $phone, $companyId, $password, $role, $adminId]);


            if ($stmt->rowCount() > 0) {
                return array("status" => true, "message" => "Administrator updated successfully", "data" => null);
            } else {
                return array("status" => false, "message" => "No changes made or administrator not found", "data" => null);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array("status" => false, "message" => "Failed to update administrator. Error: " . $e->getMessage(), "data" => null);
        }
    }


}
$ddtms = new DDTMS();
?>
