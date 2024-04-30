<?php
include 'db_connection.php';
$conn=getDBConnection();
class DDTMS {
    private $pdo;
    private $conn;
    public function __construct() {
        $this->pdo = getDBConnection();
        $this->conn = getDBConnection();
    }

    public function loginUser($email, $password) {
        // Get database connection
        $conn = $this->pdo;

        // Prepare SQL statement to fetch user by email
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? and password=?");
        $stmt->execute([$email,$password]);
        $user = $stmt->fetch();

        // Check if user exists and password is correct
        if ($user && ($password==$user['password'])) {
            // Login successful
            return ['status' => 'success', 'user' => $user];
        } else {
            // Login failed
            return ['status' => 'error', 'message' => 'Invalid email or password'];
        }
    }

    // Method to register a new user
    public function register($fname, $lname, $email, $address, $phone, $password,$role,$compid) {
        $sql = "INSERT INTO users (fname, lname, email, address, phone, password,comp_id,role) VALUES (?, ?, ?, ?, ?, ?,?,?)";
        $stmt = $this->pdo->prepare($sql);        
        if ($stmt->execute([$fname, $lname, $email, $address, $phone, $password,$compid,$role])) {
            return true;
        } else {
            return false;
        }
    }

     public function getAllDevices() {
        try {
            // Prepare SQL query to retrieve all devices
            $sql = "SELECT * FROM devices";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            
            // Fetch all devices as associative array
            $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $devices;
        } catch (PDOException $e) {
            // Handle database error
            return [];
        }
    }

    public function loginAdmin($email, $password) {
        // Get database connection
        $conn = $this->pdo;

        // Prepare SQL statement to fetch user by email
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ? and password=?");
        $stmt->execute([$email,$password]);
        $user = $stmt->fetch();

        // Check if user exists and password is correct
        if ($user && ($password==$user['password'])) {
            // Login successful
            return ['status' => 'success', 'user' => $user];
        } else {
            // Login failed
            return ['status' => 'error', 'message' => 'Invalid email or password'];
        }
    }

    public function getAllCompanies() {
        try {
            $query = "SELECT * FROM companies";
            $stmt = $this->pdo->query($query);
            $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $companies;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function addCompany($comp_name, $comp_address, $comp_email, $comp_status) {
        $conn = getDBConnection();
        $response = array();
        echo "ho : ".$this->isCompanyExists($comp_email);
        if ($this->isCompanyExists($comp_email)) {
            $response['status'] = 'error';
            $response['message'] = 'Company already exists.';
            return $response;
        }

        $sql = "INSERT INTO companies (comp_name, comp_address, comp_email, comp_status) VALUES (?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);

        $result = $stmt->execute([$comp_name, $comp_address, $comp_email, $comp_status]);

        if($result) {
            $response['status'] = 'success';
            $response['message'] = 'Company added successfully.';
            $response['data'] = array('comp_name' => $comp_name, 'comp_address' => $comp_address, 'comp_email' => $comp_email, 'comp_status' => $comp_status);
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to add the company.';
        }
        return $response;
    }


    private function isCompanyExists($comp_email) {
        $conn = getDBConnection();

        $sql = "SELECT * FROM companies WHERE comp_email = ?";
        
        $stmt = $conn->prepare($sql);

        $stmt->execute([$comp_email]);

        return $stmt->rowCount()> 0;
    }

    // Method to edit a company
    public function editCompany($compid, $comp_name, $comp_address, $comp_email, $comp_status) {
        // Check if the email already exists for another company
        if ($this->isCompanyExistsWithEmail($comp_email, $compid)) {
            return array("status" => false, "message" => "Company with the same email already exists", "data" => null);
        }

        // Update the company information
        $sql = "UPDATE companies SET comp_name=?, comp_address=?, comp_email=?, comp_status=? WHERE compid=?";
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([$comp_name, $comp_address, $comp_email, $comp_status, $compid]);
        $stmt->close();

        if ($result) {
            return array("status" => true, "message" => "Company updated successfully", "data" => null);
        } else {
            return array("status" => false, "message" => "Failed to update company", "data" => null);
        }
    }

    // Method to check if a company with the same email already exists
    private function isCompanyExistsWithEmail($comp_email, $compid) {
        $sql = "SELECT * FROM companies WHERE comp_email = ? AND compid != ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$comp_email, $compid]);
        return $stmt->rowCount() > 0;
    }


    // Method to delete a company
    public function deleteCompany($compid) {
        $sql = "DELETE FROM companies WHERE compid=?";
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([$compid]);
        if ($stmt->rowCount()>0) {
            $message = "Company deleted successfully";
            $status = "success";
        } else {
            $message = "Failed to delete the company please try again!!";
            $status = "error";
        }

        $data = array(
            'message' => $message,
            'status' => $status,
            'data' => null
        );

        return $data;
    }

    public function getAdminUsers() {
        $sql = "SELECT * FROM users,companies WHERE role = 'Administrator' group by users.userid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    public function updateAdmin($adminId, $firstName, $lastName, $email, $address, $phone, $companyId, $password, $role) {
        try {
            if ($this->isEmailExistsForOtherAdmins($email, $adminId)>1) {
                return array("status" => false, "message" => "Email already exists for another administrator", "data" => null);
            }

            $sql = "UPDATE admin SET fname=?, lname=?, email=?, address=?, phone=?, password=?, role=? WHERE userid=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$firstName, $lastName, $email, $address, $phone, $password, $role, $adminId]);


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
    public function getUserById($userId) {
        try {
            $sql = "SELECT * FROM admin WHERE userid = :userId";
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
}
$ddtms = new DDTMS();
?>
