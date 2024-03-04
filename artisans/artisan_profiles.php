<?php
session_start();
include('../includes/db.php'); // Include the database connection file

// Check if the user is logged in as an artisan
// if (!isset($_SESSION['artisan_id']) || $_SESSION['user_type'] !== 'Artisan') {
//     header("Location: ../login.php");
//     exit;
// }

// Check if the delete button is clicked and a product ID is provided
if (isset($_POST['delete_product']) && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Delete the product from the database
    $sql_delete = "DELETE FROM products WHERE productId = ?";
    $stmt_delete = mysqli_prepare($conn, $sql_delete);
    mysqli_stmt_bind_param($stmt_delete, "i", $product_id);
    
    if (mysqli_stmt_execute($stmt_delete)) {
        // Product deleted successfully, redirect to the same page or another page
        header("Location: artisan_profiles.php?product_deleted=success");
        exit;
    } else {
        // Error occurred while deleting the product
        header("Location: artisan_profiles.php?product_deleted=error");
        exit;
    }
}
?>

<?php 
include("../includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CraftHaven - Artisan Profile</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
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
        h1, h2 {
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
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            max-height: 100px;
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
                <li><a href="../profile/user_reg.php">Add User</a></li>

            </ul>
        </nav>
    </header>
    <main>
        <!-- <h1>Welcome, <?php echo $artisan['name']; ?>!</h1> -->
        <h2>Your Profile</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Bio</th>
                <th>Contact Info</th>
                <th>Profile Picture</th>
            </tr>
            <?php $result_products1=mysqli_query($conn,"Select * from artisans")?>
            <?php  while ($artisan = mysqli_fetch_assoc($result_products1)) { ?>
            <tr>
                <td><?php echo $artisan['name']; ?></td>
                <td><?php echo $artisan['bio']; ?></td>
                <td><?php echo $artisan['contactInfo']; ?></td>
                <td>
            
    <?php
    $profilePicture = $artisan['profilePicture'];
    $imagePath = "../images1/" . $profilePicture; // Update the path accordingly
    if (file_exists($imagePath)) {
        echo '<img src="' . $imagePath . '" alt="Profile Picture">';
    } else {
        // Display a placeholder image or a message
        echo '<img src="../images1/placeholder.jpg" alt="Profile Picture Not Found">';
        // Or, if you want to display a message:
        // echo "Profile Picture Not Found";
    }
    ?>
</td>

                <!-- <?php echo $artisan['profilePicture']; ?> -->

            </tr>
            <?php } ?>
        </table>

        <h2>Your Products</h2>
        <h2>Your Products</h2>
<table>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Price</th>
        <th>Availability</th>
        <th>Action</th> <!-- New column for actions -->
    </tr>
    <?php
    $result_products = mysqli_query($conn, "SELECT * FROM products");
    while ($product = mysqli_fetch_assoc($result_products)) {
    ?>
        <tr>
            <td><?php echo $product['title']; ?></td>
            <td><?php echo $product['description']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo $product['availability'] ? 'Available' : 'Not Available'; ?></td>
            <td>
                <!-- Edit button -->
                <form action="edit_product.php" method="GET">
                    <input type="hidden" name="product_id" value="<?php echo $product['productId']; ?>">
                    <button type="submit" style="background-color: #4CAF50; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;">Edit</button>
                </form>

                <!-- Delete button -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['productId']; ?>">
                    <button type="submit" name="delete_product" style="background-color: #f44336; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>


    </main>
    <footer>
        <p>&copy; 2024 CraftHaven</p>
    </footer>
    <script src="../js/script.js"></script>
</body>
</html>
