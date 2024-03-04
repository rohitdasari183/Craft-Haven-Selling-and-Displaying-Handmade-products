<?php
session_start();
include('../includes/db.php'); // Include the database connection file

// Check if the cart is empty
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CraftHaven - Checkout</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* style.css */

/* Reset styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

header {
    background: #333;
    color: #fff;
    padding: 10px 0;
}

header nav ul {
    list-style-type: none;
}

header nav ul li {
    display: inline;
    margin-right: 20px;
}

header nav ul li a {
    color: #fff;
    text-decoration: none;
}

main {
    padding: 20px 0;
}

h1, h2 {
    margin-bottom: 20px;
}

form {
    margin-bottom: 20px;
}

form label {
    display: block;
    margin-bottom: 5px;
}

form input[type="text"], form input[type="email"], form input[type="number"], form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form input[type="submit"] {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

footer {
    background: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
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
        <h1>Checkout</h1>
        <h2>Cart Summary</h2>
        <?php
        // Calculate total price and display cart items
        $total_price = 0;
        foreach($_SESSION['cart'] as $product_id => $quantity) {
            $sql = "SELECT * FROM products WHERE productId = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $product_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);

            // Calculate subtotal for each product
            $subtotal = $row['price'] * $quantity;
            $total_price += $subtotal;

            // Display product details in the checkout summary
            echo "<p>Title: " . $row['title'] . ", Quantity: $quantity, Subtotal: $subtotal</p>";
        }
        echo "<p>Total Price: $total_price</p>";
        ?>
        <center>
        <h2>Shipping Information</h2>
        <!-- Shipping information form -->
        <form action="../products/place_order.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter your address" required>
            <label for="city">City:</label>
            <input type="text" id="city" name="city" placeholder="Enter your city" required>
            <label for="zip">ZIP Code:</label>
            <input type="text" id="zip" name="zip" placeholder="Enter your ZIP code" required>
            <!-- Add more input fields for shipping information as needed -->

            <input type="submit" value="Place Order">
        </form>
    </center>
    </main>
    <footer>
        <p>&copy; 2024 CraftHaven</p>
    </footer>
    <script src="../js/script.js"></script>
</body>
</html>

