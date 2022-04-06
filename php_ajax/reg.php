<?php
session_start();

require_once 'database_connection.php';

$error_msg = $success = "";

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$number = $_POST["number"];
$gender = $_POST["gender"];
$user_type = $_POST["user_type"];

if (empty($_POST["name"])) {
    $error_msg = "Name is required";
} elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
    $error_msg = "Only alphabets and white space are allowed";
} elseif (empty($_POST["email"])) {
    $error_msg = "Email is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_msg = "Invalid email format";
} elseif (empty($_POST["password"])) {
    $error_msg = "Password is required";
} elseif (empty($_POST["number"])) {
    $error_msg = "Mobile no is required";
} elseif (!preg_match("/^[0-9]*$/", $number)) {
    $error_msg = "Only numeric value is allowed.";
} elseif (strlen($number) != 10) {
    $error_msg = "Mobile no must contain 10 digits.";
} elseif (empty($_POST["gender"])) {
    $error_msg = "Gender is required";
} elseif (empty($_POST["user_type"])) {
    $error_msg = "User Type is required";
} else {
    $password = hash('sha256', $password);

    $sql =  "SELECT * FROM user WHERE email='$email' ";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Email already exist";
    } else {
        $sql2 = "INSERT INTO `user`(`name`,`email`,`password`,`number`,`gender`,`user_type`)
                 VALUES('$name','$email','$password',$number,'$gender','$user_type')";

        if (mysqli_query($conn, $sql2)) {

            echo 200;
        } else {

            echo 201;
        }
    }
}
    // }
