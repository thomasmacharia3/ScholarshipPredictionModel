<?php
require_once '../config/database.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    // Hash password
    public function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    // Register new user
    public function register($firstName, $lastName, $email, $password) {
        // Check if the email already exists
        $stmt = $this->conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return "Email is already registered.";
        }

        // Insert new user into database
        $hashedPassword = $this->hashPassword($password);
        $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);
        
        if ($stmt->execute()) {
            return "Registration successful!";
        } else {
            return "Error during registration.";
        }
    }

    // Login user
    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT id, first_name, last_name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $firstName, $lastName, $hashedPassword);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $hashedPassword)) {
                session_start();
                $_SESSION['user_id'] = $id;
                $_SESSION['first_name'] = $firstName;
                $_SESSION['last_name'] = $lastName;
                return true;
            } else {
                return "Invalid password.";
            }
        } else {
            return "No user found with that email.";
        }
    }

    // Check if user is logged in
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Logout user
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }
}
?>
