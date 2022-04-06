<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <title>Registration Page</title>
</head>

<body>
    <?php
    session_start();
    require_once 'navigation_reg.php';
    require_once 'database_connection.php';
    $nameErr = $emailErr = $passwordErr = $numberErr = $genderErr = $user_typeErr = "";
    $name = $email = $password = $number = $gender = $user_type = "";

    if (isset($_POST['submit'])) {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $number = $_POST["number"];
        $gender = $_POST["gender"];
        $user_type = $_POST["user_type"];

        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only alphabets and white space are allowed";
        } elseif (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } elseif (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } elseif (empty($_POST["number"])) {
            $numberErr = "Mobile no is required";
        } elseif (!preg_match("/^[0-9]*$/", $number)) {
            $numberErr = "Only numeric value is allowed.";
        } elseif (strlen($number) != 10) {
            $numberErr = "Mobile no must contain 10 digits.";
        } elseif (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } elseif (empty($_POST["user_type"])) {
            $user_typeErr = "User Type is required";
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
                    echo "<p class='container my-2 col-md-4 bg-success text-white'>Record insrted succefully<p>";
                } else {
                    echo "Could not insert record: " . mysqli_connect_error($conn);
                }
            }
        }
    }
    ?>

    <div class="card">
        <h5 class="card-header info-color text-white text-center py-4 container my-2 col-md-4 bg-primary">
            <strong>Registration Form</strong>
        </h5>
        <div class="container my-2 col-md-4 border p-3">
            <form class="text-center" style="color: #757575;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                <div class="md-form">
                    <input type="name" onkeypress="return allowOnlyLetters(event,this);" id="materialLoginFormName" class="form-control" name="name" placeholder="Name"><br>
                    <span class="error"> <?php echo $nameErr; ?> </span>
                </div>
                <div class="md-form">
                    <input type="email" id="materialLoginFormEmail" class="form-control" name="email" placeholder="Email"><br>
                    <span class="error"> <?php echo $emailErr; ?> </span>
                </div>
                <div class="md-form">
                    <input type="password" id="materialLoginFormPassword" class="form-control" name="password" placeholder="Password"><br>
                    <span class="error"> <?php echo $passwordErr; ?> </span>
                </div>

                <div class="md-form">
                    <input type="number" id="materialLoginFormNumber" class="form-control" name="number" placeholder="Mobile No."><br>
                    <span class="error"> <?php echo $numberErr; ?> </span>
                </div>

                Gender:<br>
                User:<br>
                <select name="gender" id="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <!-- <input type="radio" name="gender" value="male" checked />Male
                <input type="radio" name="gender" value="female" />Female -->
                <br>
                <span class="error"> <?php echo $genderErr; ?> </span>

                User:<br>
                User:<br>
                <select name="user_type" id="user_type" class="form-control">
                    <option value="">Select</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <!-- <input type="radio" name="user_type" value="user" checked />User
                <input type="radio" name="user_type" value="admin" />Admin -->
                <span class="error"> <?php echo $user_typeErr; ?> </span>

                <div class="form-group">
                    <button class="btn btn-outline-info btn-rounded btn-block my-4 col-md-3 waves-effect z-depth-0 " type="submit" name="submit" value="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
    <script language="Javascript" type="text/javascript">
        function allowOnlyLetters(e, t) {
            if (window.event) {
                var charCode = window.event.keyCode;
            } else if (e) {
                var charCode = e.which;
            } else {
                return true;
            }
            if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                return true;
            else {
                alert("Please enter only alphabets");
                return false;
            }
        }
    </script>
</body>

</html>