<?php
session_start();
include("config.php");

if (!isset($_SESSION['reset_email'])) {
    header("Location: auth.php");
    exit;
}

$new = $_POST['new_password'];
$confirm = $_POST['confirm_password'];

if ($new !== $confirm) {
    die("Passwords do not match.");
}

$hashed = password_hash($new, PASSWORD_DEFAULT);
$email = $_SESSION['reset_email'];

mysqli_query($conn, "UPDATE users SET password='$hashed' WHERE email='$email'");
unset($_SESSION['reset_email']);

echo "Password updated successfully. <a href='auth.php'>Login</a>";
exit;
