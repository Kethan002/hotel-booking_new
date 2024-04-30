<?php
// Start the session
session_start();

// Clear session variables
$_SESSION = array();

// If session uses cookies, clear them
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to the desired page (e.g., login page)
header('Location: login.php'); // Adjust as needed
exit;
?>
