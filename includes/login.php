<?php

session_start();

include("db.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $myuseremail=$_POST['email'];
    $mypassword=$_POST['password'];
    

    $sql="select userId from users where email='$myuseremail' and password='$mypassword'";
    $result=mysqli_query($conn,$sql);
    
    if($result)
    {
        $count=mysqli_num_rows($result);
    
        if($count==1)
        {
            $_SESSION['login_admin']=$myuseremail;
            header("location: ../products/add_product.php");
        }
        else
        {
            echo "Invalid email or password";
        }
    }
    else
    {
        echo "Error: ".mysqli_error($conn);
    }
}
?>
