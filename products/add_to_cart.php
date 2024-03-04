<?php
session_start();

// Check if product ID and quantity are set
if(isset($_POST['product_id']) && isset($_POST['quantity'])) {
    // Store product ID and quantity in variables
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Initialize or update the cart session variable
    if(isset($_SESSION['cart'][$product_id])) {
        // If the product is already in the cart, update the quantity
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        // If the product is not in the cart, add it
        $_SESSION['cart'][$product_id] = $quantity;
    }

    // Redirect back to the product details page with a success message
    header("Location: product_details.php?id=$product_id&added_to_cart=true");
    exit;
} else {
    // Redirect back to the product details page with an error message if product ID or quantity is not set
    header("Location: product_details.php?error=missing_data");
    exit;
}
?>

