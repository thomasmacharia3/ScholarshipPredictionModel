<?php
class Session {
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function destroy() {
        session_unset();
        session_destroy();
    }

    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public static function getUserInfo() {
        return [
            'id' => $_SESSION['user_id'] ?? null,
            'first_name' => $_SESSION['first_name'] ?? null,
            'last_name' => $_SESSION['last_name'] ?? null
        ];
    }

    public static function setUser($id, $first_name, $last_name) {
        $_SESSION['user_id'] = $id;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
    }
}
?>
