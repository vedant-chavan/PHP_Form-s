<?php
session_start();
include "database_connection.php";

$id = $_GET['id'];

$sql = "SELECT * FROM user WHERE id=$id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['submit'])) {

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

                header("Location: register_admin_user.php?error=succefully updated..");
            } elseif ($_SESSION['user_type'] == 'user') {

                header("Location: register_user_list.php?error=succefully updated..");
            }
        } else {
            echo "Unknow error occurred.";
        }
    }
}



?>

<!DOCTYPE html>
<html>

<head>
    <title>Upadate Form</title>
    <link rel="stylesheet" href="style_userlist.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <?php
    include "navigation_reg.php";
    if (isset($_SESSION['id']) && isset($_SESSION['email'])) { ?>

        <div class="card">

            <h5 class="card-header info-color text-white text-center py-4 container my-2 col-md-4 bg-primary">
                <strong>Update Form</strong>
            </h5>

            <div class="container my-2 col-md-4 border p-3">

                <form class="text-center" style="color: #757575;" action="update_form.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">

                    <div class="md-form">
                        Name:
                        <input type="name" class="form-control" name="name" value="<?php echo $row['name'] ?>"><br>
                    </div>

                    <div class="md-form">
                        Mobile No.
                        <input type="number" class="form-control" name="number" value="<?php echo $row['number'] ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <?php
                        $set_gender = $row['gender'];
                        ?>
                        <input type="radio" id="gender" name="gender" value="male" <?php if ($set_gender != "female") echo "checked"; ?>>Male
                        <input type="radio" id="gender" name="gender" value="female" <?php if ($set_gender == "female") echo "checked"; ?>>Female
                    </div>

                    <div class="file-field large container ">
                        <div class="btn btn-rounded aqua-gradient float-left">
                            <span>Choose file</span>
                            <input type="file" name="image" class="form-control" value="<img style='height:45px; width:45px;' src='<?php echo $row['image']; ?>'>" /><br><br>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary" value="submit" name="submit" />

                </form>
            </div>
        <?php

    } else {
        header("Location: login_form.php?error=TO UPDATE ANY DATA... FIRST LOGIN...");
    }
        ?>

</body>

</html>