<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Authentication</title>
    <style>
        body { font-family: Arial; padding: 30px; background: #f9f9f9; }
        .form-box { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; background: #fff; }
        .hidden { display: none; }
        .toggle { color: blue; cursor: pointer; text-align: center; margin-top: 15px; }
        input, button { width: 100%; padding: 10px; margin: 8px 0; }
    </style>
</head>
<body>

<div class="form-box">
    <h2 id="form-title">Sign Up</h2>

    <!-- Sign Up Form -->
    <form id="signup-form" method="POST" action="process.php">
        <input type="hidden" name="action" value="signup">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm" placeholder="Confirm Password" required>
        <input type="text" name="pet_name" placeholder="Pet Name (for password recovery)" required>
        <button type="submit">Sign Up</button>
    </form>

    <!-- Login Form -->
    <form id="login-form" class="hidden" method="POST" action="process.php">
        <input type="hidden" name="action" value="login">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p style="text-align: center;"><a href="#" onclick="showForm('forgot')">Forgot Password?</a></p>
    </form>

    <!-- Forgot Password Form -->
    <form id="forgot-form" class="hidden" method="POST" action="process.php">
        <input type="hidden" name="action" value="forgot">
        <input type="email" name="email" placeholder="Registered Email" required>
        <input type="text" name="pet_name" placeholder="Pet Name" required>
        <button type="submit">Verify</button>
    </form>

    <!-- Reset Password Form -->
    <?php if (isset($_SESSION['reset_email'])): ?>
    <form id="reset-form" method="POST" action="reset.php">
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Reset Password</button>
    </form>
    <?php endif; ?>

    <div class="toggle" onclick="toggleForms()">Switch to <span id="toggle-text">Login</span></div>
</div>

<script>
    let isSignup = true;

    function toggleForms() {
        isSignup = !isSignup;
        document.getElementById('signup-form').classList.toggle('hidden');
        document.getElementById('login-form').classList.toggle('hidden');
        document.getElementById('form-title').innerText = isSignup ? "Sign Up" : "Login";
        document.getElementById('toggle-text').innerText = isSignup ? "Login" : "Sign Up";
        document.getElementById('forgot-form')?.classList.add('hidden');
    }

    function showForm(type) {
        document.getElementById('signup-form').classList.add('hidden');
        document.getElementById('login-form').classList.add('hidden');
        document.getElementById('form-title').innerText = "Forgot Password";
        document.getElementById('forgot-form').classList.remove('hidden');
    }
</script>

</body>
</html>
