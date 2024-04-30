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

    public function getDevicesByCompanyId($companyId) {
        try {
            $sql = "SELECT * FROM devices,companies WHERE comp_id = ? group by id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$companyId]);

            $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($devices) {
                return array("status" => true, "message" => "Devices retrieved successfully", "data" => $devices);
            } else {
                return array("status" => false, "message" => "No devices found for the specified company ID", "data" => null);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array("status" => false, "message" => "Failed to retrieve devices. Error: " . $e->getMessage(), "data" => null);
        }
    }

    private function isDeviceRegistered($compId, $serialNumber) {
        $sql = "SELECT COUNT(*) as count FROM devices WHERE comp_id = ? AND serial_number = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$compId, $serialNumber]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    public function addDevice($compId, $deviceName, $serialNumber, $description) {
        try {
            if ($this->isDeviceRegistered($compId, $serialNumber)) {
                $response = array(
                    "status" => false,
                    "message" => "Device with the same serial number is already registered for the company"
                );
                return $response;
            }

            $sql = "INSERT INTO devices (comp_id, device_name, serial_number, description) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$compId, $deviceName, $serialNumber, $description]);
            if ($stmt->rowCount() > 0) {
                $response = array(
                    "status" => true,
                    "message" => "Device added successfully"
                );
            } else {
                $response = array(
                    "status" => false,
                    "message" => "Failed to add device"
                );
            }
        } catch (PDOException $e) {
            $response = array(
                "status" => false,
                "message" => "Error: " . $e->getMessage()
            );
        }
        return $response;
    }

    public function getAvailableDevicesRequestToBorrow($companyId) {
        try {
            // Prepare SQL query to retrieve available devices for the company
            $sql = "SELECT *,d.id as device_id, t.id as transaction_id, d.device_name, d.description FROM devices as d ,transactions as t,users as u WHERE d.id = t.device_id and d.comp_id = ? AND (t.return_date IS NULL OR t.return_date = '') and t.status='Appending' group by t.id";
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
    public function getDevicesBorrowsNotReturned($companyId) {
        try {
            // Prepare SQL query to retrieve available devices for the company
            $sql = "SELECT *,d.id as device_id, t.id as transaction_id, d.device_name, d.description FROM devices as d ,transactions as t,users as u WHERE d.id = t.device_id and d.comp_id = ? and t.status='confirmed' group by t.id";
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

    public function getDevicesBorrowsReturned($companyId) {
        try {
            // Prepare SQL query to retrieve available devices for the company
            $sql = "SELECT *,d.id as device_id, t.id as transaction_id, d.device_name, d.description,t.status as t_status FROM devices as d ,transactions as t,users as u WHERE d.id = t.device_id and d.comp_id = ? and t.status='returned' group by t.id";
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

    public function updateDeviceReturnInfo($deviceId, $returnInfo) {
        try {
            // Prepare SQL query to update the return information of the device
            $sql = "UPDATE transactions SET status = ? WHERE device_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$returnInfo, $deviceId]);

            // Check if any rows were affected
            if ($stmt->rowCount() > 0) {
                return array("status" => true, "message" => "Device return information updated successfully");
            } else {
                return array("status" => false, "message" => "Device return information update failed: Device ID not found");
            }
        } catch (PDOException $e) {
            // Handle database error
            return array("status" => false, "message" => "Failed to update device return information. Error: " . $e->getMessage());
        }
    }

    // Method to confirm borrower's request
    public function confirmBorrowRequest($device_id) {
        try {
            $sql = "UPDATE transactions SET status = 'confirmed' WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$device_id]);
            
            if ($stmt->rowCount() > 0) {
                return ['status' => true, 'message' => 'Borrower\'s request confirmed successfully'];
            } else {
                return ['status' => false, 'message' => 'Failed to confirm borrower\'s request'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    // Method to cancel borrower's request
    public function cancelBorrowRequest($device_id) {
        try {
            $sql = "UPDATE transactions SET status = 'cancelled' WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$device_id]);
            
            if ($stmt->rowCount() > 0) {
                return ['status' => true, 'message' => 'Borrower\'s request cancelled successfully'];
            } else {
                return ['status' => false, 'message' => 'Failed to cancel borrower\'s request'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }


    // Method to confirm the returned borrow request
    public function confirmReturnedBorrowRequest($device_id) {
        try {
            // Prepare SQL statement to update the status of the borrow request
            $sql = "UPDATE transactions SET return_date=current_timestamp(), status = 'returned' WHERE device_id = ?";
            $stmt = $this->pdo->prepare($sql);
            
            // Bind parameters and execute the SQL statement
            $stmt->execute([$device_id]);

            // Check if the update was successful
            if ($stmt->rowCount() > 0) {
                return ['status' => 'success', 'message' => 'Borrower\'s returned request confirmed successfully'];
            } else {
                return ['status' => 'error', 'message' => 'No matching borrow request found or already confirmed'];
            }
        } catch (PDOException $e) {
            // Handle database error
            return ['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    // Method to fetch number of users
    public function getNumUsers($companyId) {
        try {
            $sql = "SELECT COUNT(*) AS num_users FROM users WHERE comp_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$companyId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['num_users'];
        } catch (PDOException $e) {
            // Handle database error
            return 0;
        }
    }

    // Method to fetch number of borrowed books
    public function getNumBorrowedBooks($companyId) {
        try {
            $sql = "SELECT COUNT(*) AS num_borrowed_books FROM transactions WHERE comp_id = ? AND status = 'Borrowed'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$companyId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['num_borrowed_books'];
        } catch (PDOException $e) {
            // Handle database error
            return 0;
        }
    }

    // Method to fetch number of available books
    public function getNumAvailableBooks($companyId) {
        try {
            $sql = "SELECT COUNT(*) AS num_available_books FROM devices WHERE comp_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$companyId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['num_available_books'];
        } catch (PDOException $e) {
            // Handle database error
            return 0;
        }
    }

    // Method to fetch number of returned books
    public function getNumReturnedBooks($companyId) {
        try {
            $sql = "SELECT COUNT(*) AS num_returned_books FROM transactions WHERE comp_id = ? AND status = 'Returned'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$companyId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['num_returned_books'];
        } catch (PDOException $e) {
            // Handle database error
            return 0;
        }
    }

    // Method to fetch number of requests
    public function getNumRequests($companyId) {
        try {
            $sql = "SELECT COUNT(*) AS num_requests FROM transactions WHERE comp_id = ? AND status = 'Pending'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$companyId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['num_requests'];
        } catch (PDOException $e) {
            // Handle database error
            return 0;
        }
    }

    public function getAllUsers($companyId) {
        try {
            // Prepare SQL query to retrieve all users for the company
            $sql = "SELECT * FROM users WHERE comp_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$companyId]);

            // Fetch users as associative array
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array("status" => true, "message" => "Users retrieved successfully", "data" => $users);
        } catch (PDOException $e) {
            // Handle database error
            return array("status" => false, "message" => "Failed to retrieve users. Error: " . $e->getMessage(), "data" => null);
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
