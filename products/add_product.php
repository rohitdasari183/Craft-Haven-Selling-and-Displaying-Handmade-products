<?php
session_start();
include("../includes/db.php");
$path = "../images1/";
$valid_formats = array("jpg", "jpeg", "png", "gif");
$update_message = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $availability = $_POST['availability'];
    $category = $_POST['category'];
    $artisanId = $_POST['artisanId']; // Assuming you have a form field for artisanId

    $time = time();
    $actual_image_name = $_FILES['image']['name'];
    $reimg = $time . $actual_image_name;
    $tmp = $_FILES['image']['tmp_name'];
    $ext = pathinfo($actual_image_name, PATHINFO_EXTENSION); // Get the file extension

    if (in_array(strtolower($ext), $valid_formats)) {
        if (move_uploaded_file($tmp, $path . $reimg)) {
            $query = "INSERT INTO products (artisanId, title, description, price, availability, image, category) VALUES ('$artisanId', '$title', '$description', '$price', '$availability', '$reimg', '$category')";
            if (mysqli_query($conn, $query)) {
                header("Location: ../artisans/artisan_profiles.php?product_added=success");
                exit; // Add exit after header redirection
            } else {
                header("Location: ../artisans/artisan_profiles.php?product_added=error");
                exit; // Add exit after header redirection
            }
        } else {
            header("Location: ../artisans/artisan_profiles.php?product_added=error");
            exit; // Add exit after header redirection
        }
    } else {
        header("Location: ../artisans/artisan_profiles.php?product_added=error");
        exit; // Add exit after header redirection
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CraftHaven - Add Product</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            font-weight: bold;
        }

        /* Responsive Styles */
        @media screen and (max-width: 600px) {
            nav ul li {
                display: block;
                margin-bottom: 10px;
            }
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
                <li><a href="../products/cart.php">Cart</a></li>
                <li><a href="../products/add_to_cart.php">Add to cart</a></li>

            </ul>
        </nav>
    </header>
    <main>
        <center>
        <h1>Add Product</h1>
        <?php if(isset($update_message)): ?>
            <p class="error"><?php echo $update_message; ?></p>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="id">Artisan Id:</label>
            <input type="text" name="artisanId" required>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
            <label for="price">Price ($):</label>
            <input type="text" id="price" name="price"  required>
            <select id="availability" name="availability" required>
                <option value="Available">Available</option>
                <option value="Not Available">Not Available</option>
            </select>
           
            
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <label for="category">Category:</label>
           
            <select id="category" name="category" required>
                <option value="Pottery">Pottery</option>
                <option value="Sculpture">Sculpture</option>
                <option value="Box">Box</option>
                <option value="Bag">Bag</option>
                <option value="Horse">Horse</option>
                <option value="Flowerpot">Flowerpot</option>
                <option value="Painting">Painting</option>
                <option value="Plates">Plates</option>
                <option value="Teapot">Teapot</option>
                <!-- Add more categories as needed -->
            </select>
            <input type="submit" value="Add Product">
        </form>
        </center>
    </main>
    <footer>
        <p>&copy; 2024 CraftHaven</p>
    </footer>
</body>
</html>
