<?php
session_start();
include('../includes/db.php'); // Include the database connection file

// Fetch orders placed by the artisan from the database
$sql = "SELECT * FROM orders";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    echo "<p>Error in preparing SQL statement: " . mysqli_error($conn) . "</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CraftHaven - Order History</title>
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
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        a {
            color: #fff;
            background-color: #4CAF50;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
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
                <li><a href="index.php">Home</a></li>
                <li><a href="artisan_profiles.php">Artisan Profiles</a></li>
                <li><a href="checkout.php">Checkout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Order History</h1>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total Amount ($)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($order = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $order['orderId']; ?></td>
                    <td><?php echo $order['orderDate']; ?></td>
                    <td><?php echo $order['totalAmount']; ?></td>
                    <td><a href="order_details.php?id=<?php echo $order['orderId']; ?>">View Details</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 CraftHaven</p>
    </footer>
    <script src="../js/script.js"></script>
</body>
</html>
