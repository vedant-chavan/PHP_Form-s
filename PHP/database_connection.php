<?php
        $hostname="localhost"; 
        $username="root";  
        $password="";       
        
        $conn=mysqli_connect('localhost','root','','registration');
        if(!$conn)
        {
            die('Could not Connect MySql Server:' .mysqli_connect_error());
            
        }
?>

