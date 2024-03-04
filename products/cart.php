<?php
session_start();
include('../includes/db.php'); // Include the database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CraftHaven - Cart</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        header nav ul li {
            display: inline;
            margin-right: 10px;
        }
        header nav ul li a {
            color: #333;
            text-decoration: none;
        }
        main {
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
            margin-bottom: 10px;
        }
        a {
            color: #fff;
            background-color: #4CAF50;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
        }
        a:hover {
            background-color: #45a049;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="../artisans/artisan_profiles.php">Artisan Profiles</a></li>
                <li><a href="../checkout/checkout.php">Checkout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Your Cart</h1>
        <?php
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $product_id => $quantity) {
                // Fetch product details from the database based on the product ID
                $sql = "SELECT * FROM products WHERE productId = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $product_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);

                // Display product details in the cart
                echo "<p>Product ID: " . $row['productId'] . ", Title: " . $row['title'] . ", Quantity: $quantity</p>";
            }
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
        <a href="../checkout/checkout.php">Proceed to Checkout</a>
    </main>
    <footer>
        <p>&copy; 2024 CraftHaven</p>
    </footer>
</body>
</html>
