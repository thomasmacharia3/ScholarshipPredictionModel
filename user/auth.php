<?php
require_once 'User.php';
require_once 'Session.php';

// Handle Registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $user = new User();
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];
    $confirmPassword = $_POST['confirm-password'];

    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
    } else {
        $message = $user->register($firstName, $lastName, $email, $password);
        echo $message;
    }
}

// Handle Login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $user = new User();
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];
    
    $message = $user->login($email, $password);
    if ($message === true) {
        session_start();
                $_SESSION['success_message'] = 'Login successful!';
                header("Location: http://localhost/ScholarshipPredictionModel/analyze.php");
                // Redirect to the login page
                exit();  // Always call exit after header redirection to stop further execution
    } else {
        session_start();
            $_SESSION['error_message'] = 'User does not exist!';
            
            // Redirect to the login page
            header("Location: ../auth/login.php");  // Change 'login.php' to your actual login page URL
            exit();  // Always call exit after header redirection to stop further execution
    }
}

// Handle Logout
if (isset($_GET['logout'])) {
    $user = new User();
    $user->logout();
    header("Location: ../index.php");
    exit;
}
?>
