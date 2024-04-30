<?php
session_start();
$error = ''; // Initialize $error variable

// Hardcoded example for login. Use a secure method in production environments.
$admin_user = 'admin';
$admin_pass = 'kethan';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['loggedin'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        /* Add your custom CSS styles here */
        body {
            background: url('../assets/images/login-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Open Sans', sans-serif; /* Replace with your desired font family */
        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.8); /* Adjust the opacity for the desired transparency */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            margin: 100px auto; /* Center the box vertically and horizontally */
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="login-bg"> <!-- Background with full viewport coverage -->
        <div class="login-box"> <!-- Transparent box in the center -->
            <h2>Login</h2> <!-- Title at the top of the box -->
            <?php if ($error) echo "<p class='error'>$error</p>"; ?> <!-- Display error message -->
            <form method="post"> <!-- POST method to handle form submission -->
                <label for="username">Username:</label>
                <input type="text" name="username" required> <!-- Username input -->

                <label for="password">Password:</label>
                <input type="password" name="password" required> <!-- Password input -->

                <button type="submit">Log In</button> <!-- Login button -->
            </form>
        </div>
    </div>
</body>
</html>
