<?php
include("../includes/db.php");
$path="../images1/";
$valid_formats=array("jpg","JPEG","png","gif");
$update_message = '';

if($_SERVER['REQUEST_METHOD']=="POST")
{ 
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $contactInfo = $_POST['contactInfo'];

    $time = time();
    $actual_image_name = $_FILES['profilePicture']['name'];
    $reimg = $time.$actual_image_name;
    $size = $_FILES['profilePicture']['size'];
    $tmp = $_FILES['profilePicture']['tmp_name'];
    $ext = explode(".", $actual_image_name);

    if(in_array($ext[1], $valid_formats))
    {
        if(move_uploaded_file($tmp, $path.$reimg))
        {
            $query = "INSERT INTO artisans(name, bio, contactInfo, profilePicture) VALUES('$name', '$bio', '$contactInfo', '$reimg')";
            if(mysqli_query($conn, $query))
            {
                $update_message = 'Artisan profile added successfully.';
            }
            else
            {
                $update_message = 'Error: Unable to add artisan profile.';
            }
        }
        else
        {
            $update_message = 'Error: Unable to upload profile picture.';
        }
    }
    else
    {
        $update_message = 'Error: Invalid image format.';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisan Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
		header {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }
        input[type="submit"]:hover {
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
        .error {
            color: red;
        }

        .success {
            color: green;
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
    <div class="container">
        <h2>Artisan Registration</h2>
        <?php if(!empty($update_message)): ?>
            <p class="<?php echo (strpos($update_message, 'Error') !== false) ? 'error' : 'success'; ?>"><?php echo $update_message; ?></p>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio" required></textarea>
            </div>
            <div class="form-group">
                <label for="contactInfo">Contact Info:</label>
                <input type="text" id="contactInfo" name="contactInfo" required>
            </div>
            <div class="form-group">
                <label for="profilePicture">Profile Picture:</label>
                <input type="file" id="profilePicture" name="profilePicture" accept="image/*" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
	<footer>
	<p>&copy; 2024 CraftHaven</p>
	</footer>
</body>
</html>
