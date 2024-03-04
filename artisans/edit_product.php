<?php
session_start();
include('../includes/db.php'); // Include the database connection file

// Check if the product ID is provided
if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch product details from the database based on the product ID
    $sql = "SELECT * FROM products WHERE productId = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);

    // Handle form submission for updating product details
    if(isset($_POST['update_product'])) {
        // Retrieve form data
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $availability = isset($_POST['availability']) ? 1 : 0; // Checkbox handling

        // Update product details in the database
        $sql_update = "UPDATE products SET title = ?, description = ?, price = ?, availability = ? WHERE productId = ?";
        $stmt_update = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "ssdii", $title, $description, $price, $availability, $product_id);

        if(mysqli_stmt_execute($stmt_update)) {
            // Product details updated successfully
            header("Location: artisan_profiles.php?product_updated=success");
            exit;
        } else {
            // Error occurred while updating product details
            header("Location: artisan_profiles.php?product_updated=error");
            exit;
        }
    }
} else {
    // Redirect back with an error message if product ID is missing
    header("Location: artisan_profiles.php?error=missing_product_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Add your CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        
        h2 {
            color: #333;
        }
        
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
        }
        
        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }
        
        input[type="checkbox"] {
            margin-top: 10px;
        }
        
        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
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
        <h1>CraftHaven</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="artisan_profiles.php">Artisan Profiles</a></li>
                <li><a href="../checkout/checkout.php">Checkout</a></li>
            </ul>
        </nav>
    </header>
    <!-- Your HTML content here -->
    <h2>Edit Product</h2>
    <?php if(isset($product)): ?>
        <!-- Display product details and edit form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?product_id=' . $product_id); ?>" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $product['title']; ?>"><br>

            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo $product['description']; ?></textarea><br>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $product['price']; ?>"><br>

            <label for="availability">Availability:</label>
            <input type="checkbox" id="availability" name="availability" <?php echo $product['availability'] ? 'checked' : ''; ?>><br>

            <button type="submit" name="update_product">Update Product</button>
        </form>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
    <footer> 
        <p>&copy; 2024 CraftHaven</p>
    </footer>
</body>
</html>
