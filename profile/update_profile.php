<?php
session_start();
include('../includes/db.php'); // Include the database connection file

// Check if the user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update user's information in the database
    $sql = "UPDATE users SET userName = ?, email = ? WHERE userId = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $username, $email, $user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        // Update session variables if necessary
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        // Redirect to the profile page with a success message
        header("Location: profile.php?update=success");
        exit;
    } else {
        // Redirect to the profile page with an error message
        header("Location: profile.php?update=error");
        exit;
    }
}

// Close the database connection
mysqli_close($conn);
?>
