<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        /* CSS styles for form */
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
            margin: 0;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
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
                <li><a href="../products/add_product.php">Add Product</a></li>
                <li><a href="../profile/profile.php">Profile</a></li>
                
            </ul>
        </nav>
    </header>
    <center><h2>User Registration</h2></center>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="userName">Username:</label>
        <input type="text" id="userName" name="userName" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <label for="userType">User Type:</label>
        <select id="userType" name="userType" required>
            <option value="Artisan">Artisan</option>
            <option value="Buyer">Buyer</option>
        </select><br>
        
        <input type="submit" value="Register">
    </form>
    <footer>
        <p>&copy; 2024 CraftHaven</p>
    </footer>
    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Establish database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "craft-haven";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO users (userName, email, password, userType) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $userName, $email, $password, $userType);

        // Set parameters and execute
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $userType = $_POST['userType'];

        $stmt->execute();

        echo "<p>New record created successfully</p>";

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
