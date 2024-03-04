<?php
 
 $DBhost="localhost";
 $DBuser="root";
 $DBpass="";
 $DBname="craft-haven";
 
 $conn=new MySQLi($DBhost,$DBuser,$DBpass,$DBname);
 if($conn->connect_errno)
 {
	 die("ERROR:->".$DBcon->connect_error);
 }
?>
