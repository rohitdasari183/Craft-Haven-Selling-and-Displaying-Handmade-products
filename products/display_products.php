<?php
// Assuming you have already established a database connection

include('../includes/db.php');
$products = array();

// Query to fetch products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Fetch each row as an associative array and add it to the products array
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    // Free result set
    mysqli_free_result($result);
} else {
    // If the query fails, handle the error (e.g., display an error message)
    echo "Error fetching products: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        .product {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            width: 300px;
            display: inline-block;
        }
        .product h2 {
            margin-top: 0;
        }
        .product p {
            margin-bottom: 0;
        }
        .product img {
            max-width: 100%;
            height: auto;
        }
        .product form {
            margin-top: 10px;
        }
        .product form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .product form button:hover {
            background-color: #0056b3;
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
                <li><a href="../artisans/artisan_profiles.php">Artisan Profiles</a></li>
                <li><a href="../checkout/checkout.php">Checkout</a></li>
                <li><a href="../products/product_details.php">Product Details</a></li>
                <li><a href="../products/product_listing.php">Product Listing</a></li>

            </ul>
        </nav>
    </header>
    <h1>Products</h1>
    <?php foreach ($products as $product) : ?>
        <div class="product">
            <h2><?php echo $product['title']; ?></h2>
            <p>Price: $<?php echo $product['price']; ?></p>
            <img src="../images1/<?php echo $product['image']; ?>" alt="Product Image">
            <form action="payment_form.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['productId']; ?>">
                <input type="hidden" name="amount" value="<?php echo $product['price']; ?>">
                <button type="submit">Buy Now</button>
            </form>
        </div>
    <?php endforeach; ?>
    <footer> 
        <p>&copy; 2024 CraftHaven</p>
    </footer>
</body>
</html>