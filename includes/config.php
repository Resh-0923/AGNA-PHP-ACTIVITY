<?php
// Shared helpers: sessions, user storage, validation patterns.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('USERS_FILE', __DIR__ . '/../data/users.json');

// Static demo account
const STATIC_USER = ['username' => 'admin', 'password' => '12345', 'name' => 'admin'];

// Regular expressions used for form validation
const RX_NAME     = "/^[A-Za-z\u{00C0}-\u{024F}][A-Za-z\u{00C0}-\u{024F}\s'.-]{1,59}$/u"; // letters, spaces, ' . -  (2-60 chars)
const RX_EMAIL    = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*\.[A-Za-z]{2,}$/';
const RX_USERNAME = '/^[A-Za-z0-9._@+-]{3,60}$/';                                          // login field: username or email
const RX_PASSWORD = '/^(?=.*[A-Za-z])(?=.*\d).{6,}$/';                                     // 6+ chars, 1 letter, 1 number

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function get_users() {
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    $data = json_decode(file_get_contents(USERS_FILE), true);
    return is_array($data) ? $data : [];
}

function save_users(array $users) {
    file_put_contents(USERS_FILE, json_encode($users, JSON_PRETTY_PRINT), LOCK_EX);
}

function find_user_by_email($email) {
    $email = strtolower(trim($email));
    foreach (get_users() as $u) {
        if ($u['email'] === $email) {
            return $u;
        }
    }
    return null;
}

function is_logged_in() {
    return !empty($_SESSION['cosmos_user']);
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function redirect_if_logged_in() {
    if (is_logged_in()) {
        header('Location: index.php');
        exit;
    }
}
