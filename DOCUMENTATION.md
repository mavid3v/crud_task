---
# crud_task – Authentication Module Documentation

This document provides a detailed overview of the functionality and flow of the **PHP-based authentication system** in the `crud_task` project.

---

## File Descriptions

```
| File         | Purpose                                                  |
|--------------|-----------------------------------------------------------|
| `config.php` | Connects to the MySQL database using `mysqli_connect()`   |
| `auth.php`   | The main interface containing all forms (signup, login, forgot, reset) with toggle logic |
| `process.php`| Handles backend logic for signup, login, and forgot password |
| `reset.php`  | Final password reset form after verification              |
| `index.html` | Landing page after login/signup (can be changed to `index.php`) |
```
---

## Signup Flow

```
- **Fields required**: `email`, `password`, `confirm password`, `pet name`
- **Validation:**
  - All fields must be filled
  - Email must end with `@gmail.com`
  - Passwords must match
- **Outcome:**
  - New user added to DB
  - Redirect to `index.html`
```
---

## Login Flow

```
- **Fields**: `email`, `password`
- **Validation:**
  - Checks if email exists
  - Password verified using `password_verify()`
- **Outcome:**
  - On success: session started → `index.html`
  - On failure: error `"Email or password is incorrect"`
```
---

## Forgot Password Flow

```
- User enters registered email + pet name
- If both match:
  - Session is set → redirected to `auth.php` with reset form shown
```
---

## Password Reset Flow

```
- Only accessible if `$_SESSION['reset_email']` is set
- New password must be confirmed
- DB is updated using `UPDATE users SET password=...`
- Session is cleared
```

---

## SQL Schema

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    pet_name VARCHAR(100) NOT NULL
);
```
🔐 Security Details
```
Passwords are hashed using password_hash() (recommended in PHP 7+)

No raw passwords stored

Unified error messages to prevent email enumeration

Session checks protect sensitive flows
```

📦 Deployment Notes
```
Upload to /htdocs/registration in XAMPP

Make sure Apache & MySQL are running

Access via http://localhost/registration/auth.php
```

🛠 Developer Tips
To make index protected, use:
```
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: auth.php");
    exit;
}
?>
```

To logout:
```
<?php
 session_start();
session_destroy();
header("Location: auth.php");
?>
```
---
