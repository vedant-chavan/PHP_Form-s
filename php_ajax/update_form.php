<?php

session_start();
include "database_connection.php";

// $id = $_GET['id'];

// $sql = "SELECT * FROM user WHERE id=$id";
// $result = mysqli_query($conn, $sql);
// if (mysqli_num_rows($result) > 0) {
//     $row = mysqli_fetch_assoc($result);
// }

// if (isset($_POST['name'])) {
// if ($_SERVER['REQUEST_METHOD'] == "POST") {
// print_r($_POST);
$id = $_POST['id'];
$name = $_POST['name'];
$number = $_POST['number'];
$gender = $_POST['gender'];
$nameErr = $numberErr = $genderErr = "";

//for profile image
$profile = $_FILES['image'];
$profilename = $profile['name'];
// print_r($profilename);
// die();
$profpath = $profile['tmp_name'];
$proferror = $profile['error'];

if ($proferror == 0) {
    $destfile = "upload/" . $profilename;
    move_uploaded_file($profpath, $destfile);
}

if (empty($_POST["name"])) {
    $nameErr = "Name is required";
} elseif (empty($_POST["number"])) {
    $numberErr = "Mobile no is required";
} elseif (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
} else {
    $sql = "UPDATE user SET name='$name', number='$number', gender='$gender' , image = '$destfile' WHERE id=$id ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if ($_SESSION['user_type'] == 'admin') {

            echo 201;
            // header("Location: register_admin_user.php?error=succefully updated..");
        } elseif ($_SESSION['user_type'] == 'user') {

            echo 202;
            // header("Location: register_user_list.php?error=succefully updated..");
        }
    } else {
        echo 3;
        // echo "Unknow error occurred.";
    }
}
// }
