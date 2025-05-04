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
            
            session_start();
            $_SESSION['error_message'] = 'Email is already registered.';
            
            // Redirect back to the registration page
            header("Location: ../auth/register.php");  // Change 'register.php' to your actual registration page URL
            exit();  // Always call exit after header redirection
        }

        // Insert new user into database
        $hashedPassword = $this->hashPassword($password);
        $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);
        if ($stmt->execute()) {
            // Set the success message in the session (optional, for displaying in the login page)
            session_start();
            $_SESSION['success_message'] = 'Registration successful! Please log in.';
            
            // Redirect to the login page
            header("Location: ../auth./login.php");  // Change 'login.php' to your actual login page URL
            exit();  // Always call exit after header redirection to stop further execution
        } else {
            // Set the error message in the session and redirect back to the registration page
            session_start();
            $_SESSION['error_message'] = 'Error during registration. Please try again.';
            
            // Redirect back to the registration page
            header("Location: ../auth/register.php");  // Change 'register.php' to your actual registration page URL
            exit();  // Always call exit after header redirection
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
                session_start();
                $_SESSION['success_message'] = 'Login successful!';
                header("Location: http://localhost/ScholarshipPredictionModel/analyze.php");
                // Redirect to the login page
                exit();  // Always call exit after header redirection to stop further execution
            }
        } else {
            session_start();
            $_SESSION['error_message'] = 'User does not exist!';
            
            // Redirect to the login page
            header("Location: ../auth/login.php");  // Change 'login.php' to your actual login page URL
            exit();  // Always call exit after header redirection to stop further execution
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
