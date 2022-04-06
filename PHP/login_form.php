<?php
session_start();
$emailErr = $passwordErr = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <title>Login Page</title>
</head>

<body>
    <?php if (isset($_GET['error'])) { ?>
        <p class='container my-2 col-md-4 bg-danger text-white text-center'><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <?php
    require 'navigation_reg.php';
    require_once "database_connection.php";
    $emailErr = $passwordErr = "";

    if (isset($_POST['email']) && isset($_POST['password'])) {

        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $email = validate($_POST['email']);
        $password = validate($_POST['password']);

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } elseif (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } else {
            $password = hash('sha256', $password);

            $sql =  "SELECT * FROM user WHERE email='$email' AND password='$password'";

            $result = mysqli_query($conn, $sql);

            $num = mysqli_num_rows($result);

            if ($num === 1) {
                $row = mysqli_fetch_assoc($result);

                if ($row['email'] === $email && $row['password'] === $password) {

                    $_SESSION['email'] = $row['email'];
                    $_SESSION['image'] = $row['image'];
                    $_SESSION['user_type'] = $row['user_type'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['name'] = $row['name'];
                    if ($_SESSION['user_type'] == 'admin') {
                        header("Location: register_admin_user.php");
                    } elseif ($_SESSION['user_type'] == 'user') {

                        header("Location: register_user_list.php");
                    }
                } else {
                    echo "Incorrect Email ID and Password.";
                }
            } else {
                echo "Incorrect Email ID and Password.";
            }
        }
    }
    ?>

    <div class="card">

        <h5 class="card-header info-color text-white text-center py-4 container my-2 col-md-4 bg-primary">
            <strong>Login Form</strong>
        </h5>
        <div class="container my-2 col-md-4 border p-3">

            <form class="text-center" style="color: #757575;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                <div class="md-form">
                    <input type="email" id="materialLoginFormEmail" class="form-control" name="email" placeholder="Email"><br>

                    <span class="error"> <?php echo $emailErr; ?> </span>
                </div>

                <div class="md-form">
                    <input type="password" id="materialLoginFormPassword" class="form-control" name="password" placeholder="Password">

                    <span class="error"><?php echo $passwordErr; ?> </span>
                </div>
                <div class="d-flex justify-content-around">
                </div>

                <div class="form-group">

                    <button class="btn btn-outline-info btn-rounded btn-block my-4 col-md-3 waves-effect z-depth-0 " type="submit" name="submit" value="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>