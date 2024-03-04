<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CraftHaven - Product Listing</title>
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
        h1 {
            text-align: center;
            margin-top: 30px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
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
        <h1>Product Listing</h1>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Availability</th>
                <th>Artisan</th>
            </tr>
            <?php
            include('../includes/db.php');
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['title']."</td>";
                    echo "<td>".$row['description']."</td>";
                    echo "<td>".$row['price']."</td>";
                    echo "<td>".($row['availability'] ? 'Available' : 'Not Available')."</td>";
                    // Fetch artisan's name for the product
                    $artisan_sql = "SELECT name FROM artisans WHERE artisanId = '".$row['artisanId']."'";
                    $artisan_result = mysqli_query($conn, $artisan_sql);
                    $artisan_name = mysqli_fetch_assoc($artisan_result)['name'];
                    echo "<td>".$artisan_name."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No products found</td></tr>";
            }
            mysqli_close($conn);
            ?>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 CraftHaven</p>
    </footer>
    <script src="../js/script.js"></script>
</body>
</html>
