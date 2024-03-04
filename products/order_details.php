<?php
// session_start();
include('../includes/db.php'); // Include the database connection file

$order_id = $_GET['id'];

// Fetch order details for the given order ID from the database
$sql = "SELECT * FROM orders WHERE orderId = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $order = mysqli_fetch_assoc($result);
} else {
    echo "<p>Error in preparing SQL statement: " . mysqli_error($conn) . "</p>";
    exit;
}

if (!$order) {
    echo "<p>No order found with the provided ID.</p>";
    exit;
}

// Fetch order details (products) associated with the order ID

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CraftHaven - Order Details</title>
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
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 5px;
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
        <h1>Order Details</h1>
        <h2>Order ID: <?php echo $order['orderId']; ?></h2>
        <p>Order Date: <?php echo $order['orderDate']; ?></p>
        <p>Total Amount: $<?php echo $order['totalAmount']; ?></p>
        <h3>Products:</h3>
        <ul>
            <?php
            $result_details = mysqli_query($conn, "SELECT * FROM products");
            while($row = mysqli_fetch_assoc($result_details)) {
                echo "<li>" . $row['title'] .  " - Price: $" . $row['price'] . "</li>";
            }
            ?>
        </ul>
        <a href="payment_form.php">Process Payment</a>
        
        <a href="order_history.php">Back to Order History</a>
        
    </main>
    <footer>
        <p>&copy; 2024 CraftHaven</p>
    </footer>
    <script src="../js/script.js"></script>
</body>
</html>
