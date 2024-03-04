<?php

include('../includes/db.php');

$product_id = $_GET['id'] ?? null; // Using null coalescing operator to set default value
if ($product_id === null) {
    // Handle case where no product ID is provided
    echo "<p>Product ID not provided.</p>";
    exit; // Stop execution if product ID is not provided
}

// Sanitize the input to prevent SQL injection
$product_id = mysqli_real_escape_string($conn, $product_id);

$sql = "SELECT * FROM products WHERE productId = '$product_id'"; // Enclose $product_id in single quotes
$result = mysqli_query($conn, $sql);

if ($result === false) {
    // Handle database query error
    echo "<p>Error fetching product details: " . mysqli_error($conn) . "</p>";
    exit; // Stop execution if there's a database error
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // Display product details
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CraftHaven - Product Details</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 10px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        main {
            padding: 20px;
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
        .product-details {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .product-details h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .product-details p {
            margin-bottom: 10px;
        }
        .product-details form {
            display: inline-block;
        }
        .product-details input[type="number"] {
            width: 60px;
            padding: 5px;
            margin-right: 10px;
        }
        .product-details button {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .product-details button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../artisans/artisan_profiles.php">Artisan Profiles</a></li>
                <li><a href="../checkout/checkout.php">Checkout</a></li>
                <li><a href="../products/cart.php">Cart</a></li>
                <li><a href="../products/add_to_cart.php">Add to Cart</a></li>

            </ul>
        </nav>
    </header>
    <main>
        <center>
        <div class="product-details">
            <h1><?php echo $row['title']; ?></h1>
            <p><?php echo $row['description']; ?></p>
            <p>Price: $<?php echo $row['price']; ?></p>
            <p><?php echo $row['availability'] ? 'Available' : 'Not Available'; ?></p>
            <!-- Add to Cart button -->
            <form action="add_to_cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $row['productId']; ?>">
                <input type="number" name="quantity" value="1" min="1">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
    </center>
    </main>
    <footer>
        <p>&copy; 2024 CraftHaven</p>
    </footer>
</body>
</html>
<?php
} else {
    // Handle case where no product is found with the provided ID
    echo "<p>Product not found.</p>";
}

mysqli_close($conn);
?>
