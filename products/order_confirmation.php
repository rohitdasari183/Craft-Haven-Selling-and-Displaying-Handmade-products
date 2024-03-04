
<?php 
include("../includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CraftHaven - Order Confirmation</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
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
        h1, h2, h3 {
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
            margin-right: 10px;
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
        <h1>CraftHaven</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../artisans/artisan_profiles.php">Artisan Profiles</a></li>
                <li><a href="../checkout/checkout.php">Checkout</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <table>
    <tr>
        <th>OrderDetailsId</th>
        <th>Quantity</th>
        <th>Price</th>
        
    </tr>
    <?php
    $result_products = mysqli_query($conn, "SELECT * FROM orderDetails");
    while ($product = mysqli_fetch_assoc($result_products)) {
    ?>
        <tr>
            <td><?php echo $product['orderDetailId']; ?></td>
            <td><?php echo $product['quantity']; ?></td>
            <td><?php echo $product['price']; ?></td>
           
        </tr>
    <?php } ?>
        <a href="order_details.php">Order Details</a>
        <a href="../index.php">Return to Homepage</a>
    </main>
    <footer>
       <p>&copy; 2024 CraftHaven</p>
    </footer>
    <script src="../js/script.js"></script>
</body>
</html>
