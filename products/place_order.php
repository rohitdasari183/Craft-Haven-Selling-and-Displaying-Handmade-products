<?php
session_start();
include('../includes/db.php'); 

// Check if the cart is not empty
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Calculate the total amount based on the products in the cart
    $total_amount = 0; // Initialize total amount
    foreach($_SESSION['cart'] as $product_id => $quantity) {
        // Fetch product price from the database
        $sql_price = "SELECT price FROM products WHERE productId = ?";
        $stmt_price = mysqli_prepare($conn, $sql_price);
        mysqli_stmt_bind_param($stmt_price, "i", $product_id);
        mysqli_stmt_execute($stmt_price);
        $result_price = mysqli_stmt_get_result($stmt_price);
        $row_price = mysqli_fetch_assoc($result_price);
        $price = $row_price['price'];
        
        // Calculate subtotal for each product
        $subtotal = $price * $quantity;
        // Accumulate subtotal to total amount
        $total_amount += $subtotal;
    }

    // Insert into the orders table
    $sql_order = "INSERT INTO orders (totalAmount) VALUES (?)";
    $stmt_order = mysqli_prepare($conn, $sql_order);
    mysqli_stmt_bind_param($stmt_order, "d", $total_amount);
    mysqli_stmt_execute($stmt_order);

    // Get the ID of the inserted order
    $order_id = mysqli_insert_id($conn);

    // Insert into the orderDetails table for each product in the cart
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Fetch product price from the database
        $sql_price = "SELECT price FROM products WHERE productId = ?";
        $stmt_price = mysqli_prepare($conn, $sql_price);
        mysqli_stmt_bind_param($stmt_price, "i", $product_id);
        mysqli_stmt_execute($stmt_price);
        $result_price = mysqli_stmt_get_result($stmt_price);
        $row_price = mysqli_fetch_assoc($result_price);
        $price = $row_price['price'];
        
        // Insert into orderDetails table
        $sql_order_detail = "INSERT INTO orderDetails (quantity, price) VALUES (?, ?)";
        $stmt_order_detail = mysqli_prepare($conn, $sql_order_detail);
        mysqli_stmt_bind_param($stmt_order_detail, "id", $quantity, $price);
        mysqli_stmt_execute($stmt_order_detail);

        // Check for errors in the orderDetails insertion
        if(mysqli_stmt_errno($stmt_order_detail) !== 0) {
            // Handle error, for example:
            echo "Error inserting order details: " . mysqli_stmt_error($stmt_order_detail);
            exit;
        }
    }

    // Clear the cart after successful insertion
    unset($_SESSION['cart']);

    // Redirect to order confirmation page
    header("Location: order_confirmation.php?order_id=$order_id");
    exit;
} else {
    // Handle case where the cart is empty
    // For example, redirect the user back to the cart page
    header("Location: cart.php");
    exit;
}
?>
