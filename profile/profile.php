<?php include("../includes/db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CraftHaven - Profile</title>
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
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        .success {
            color: green;
            margin-bottom: 10px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
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
    <h1>Profile</h1>
        <?php if(isset($update_message) && !empty($update_message)): ?>
            <p class="<?php echo ($_GET['update'] == 'success') ? 'success' : 'error'; ?>"><?php echo htmlspecialchars($update_message); ?></p>
        <?php endif; ?>
        <?php 
        $res = mysqli_query($conn, "SELECT * FROM users");
        if ($res && mysqli_num_rows($res) > 0) {
            $user = mysqli_fetch_assoc($res);
        }
        ?>
        
        <?php if(isset($user)): ?>
        <h2>Personal Information</h2>
        <p>Username: <?php echo htmlspecialchars($user['userName']); ?></p>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <h2>Update Profile</h2>
        <form action="update_profile.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['userName']); ?>">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
            <input type="submit" value="Update Profile">
        </form>
        <?php else: ?>
        <p>No user found.</p>
        <?php endif; ?>
    </main>
    </main>
    <footer>
        <p>&copy; 2024 CraftHaven</p>
    </footer>
    <script src="../js/script.js"></script>
</body>
</html>
