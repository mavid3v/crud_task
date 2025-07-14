<?php
session_start();
include("config.php");

$action = $_POST['action'] ?? '';

// --------------------------------------
// 🔐 SIGNUP
// --------------------------------------
if ($action === "signup") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $pet = trim($_POST['pet_name']);

    // ✅ Required fields check
    if (empty($email) || empty($password) || empty($confirm) || empty($pet)) {
        die("All fields are required. <a href='auth.php'>Back</a>");
    }

    // ✅ Email must end with @gmail.com
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with(strtolower($email), '@gmail.com')) {
        die("Only Gmail addresses are allowed. <a href='auth.php'>Back</a>");
    }

    // ✅ Password confirmation
    if ($password !== $confirm) {
        die("Passwords do not match. <a href='auth.php'>Back</a>");
    }

    // ✅ Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check)) {
        die("Email already exists. <a href='auth.php'>Try login</a>");
    }

    // ✅ Insert user
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users (email, password, pet_name) VALUES ('$email', '$hashed', '$pet')");
    $_SESSION['email'] = $email;
    header("Location: index.html");
    exit;
}

// --------------------------------------
// 🔓 LOGIN
// --------------------------------------
if ($action === "login") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['email'] = $email;
        header("Location: index.html");
        exit;
    } else {
        // Unified error for both email and password issues
        echo "Email or password is incorrect. <a href='auth.php'>Try again</a>";
        exit;
    }
}

// --------------------------------------
// 🧠 FORGOT PASSWORD
// --------------------------------------
if ($action === "forgot") {
    $email = $_POST['email'];
    $pet = $_POST['pet_name'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND pet_name='$pet'");
    if (mysqli_num_rows($result)) {
        $_SESSION['reset_email'] = $email;
        header("Location: auth.php");
        exit;
    } else {
        die("Verification failed. <a href='auth.php'>Try again</a>");
    }
}
