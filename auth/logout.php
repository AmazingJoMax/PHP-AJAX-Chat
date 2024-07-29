<?php 

session_start();
if (!isset($_SESSION['unique_id'])) {
    header('location: ../pages/login.php');
    exit(); // Ensure the script stops executing after redirect
}

require_once('../requires/db_config.php');
require_once('../requires/queries.php');

if (isset($_POST['logout'])) {
    $stmt = $pdo->prepare($update_status_sql);
    $stmt->execute(['unique_id' => $_SESSION['unique_id'], 'status' => 'offline']);
    
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header('location: ../pages/login.php');
    exit(); // Ensure the script stops executing after redirect
} else {
    header('location: ../pages/users.php');
    exit(); // Ensure the script stops executing after redirect
}
?>
