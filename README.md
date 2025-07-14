# crud_task

A minimalist yet secure **user authentication system** built using PHP and MySQL (phpMyAdmin), supporting:

-  Signup with email + password + pet name
-  Login with proper credential checks
-  Forgot password (via pet name security question)
-  Password reset
-  Toggleable single-interface UI for signup/login/recovery


## Demo
http://localhost/registration/auth.php
## Folder Structure

```
registration/
├── config.php # Database connection
├── auth.php # Unified UI for login, signup, forgot, reset
├── process.php # Logic for signup, login, forgot
├── reset.php # Password reset logic after pet name check
├── index.html # Landing page after authentication
```


## Notes
 - Only @gmail.com emails are accepted during signup

 - All form fields are mandatory

 - No external CSS or JS libraries used (lightweight setup)

## Security Features
- Passwords hashed using password_hash()

- Secure session management

- Error messages generalized ("Email or password incorrect") 
  to avoid leaking account existence

- Pet name acts as a fallback security question for password recovery

## Future Enhancements (optional)
- Add email verification

- Add logout functionality with session cleanup

- Switch index.html to a protected index.php

- Integrate with Bootstrap for better UI

## Repository
 - https://github.com/mavid3v/crud_task.git
