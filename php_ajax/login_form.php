<?php

session_start();
$emailErr = $passwordErr = "";
?>

<?php
require_once "database_connection.php";
$errormsg = false;
if (isset($_GET['error'])) {
?>

    <p class="error"><?php echo $_GET['error']; ?></p><br>
    <p>Authenticate user can only access the page...<br>So first login</p>
    <a href="logout.php">Login here...</a>
<?php } else {

    // if (isset($_POST['email']) && isset($_POST['password'])) {
    // print_r($_POST);
    $email = $_POST['email'];
    $password = $_POST['password'];

    // if (empty($_POST["email"])) {
    // header("Location: login_ajax.php?error=Email is required");
    // } elseif (empty($_POST["password"])) {
    // header("Location: login_ajax.php?error=Password is required");
    // } else {
    $password = hash('sha256', $password);

    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";


    $result = mysqli_query($conn, $sql);


    $num = mysqli_num_rows($result);


    if ($num === 1) {
        $row = mysqli_fetch_assoc($result);
        // print_r($row);

        if ($row['email'] == $email && $row['password'] == $password) {


            $_SESSION['email'] = $row['email'];
            $_SESSION['image'] = $row['image'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            if ($_SESSION['user_type'] == 'admin') {
                // header("Location: register_admin_user.php");
                // echo 1;
                echo json_encode(array("statusCode" => 200));
            } elseif ($_SESSION['user_type'] == 'user') {

                echo json_encode(array("statusCode" => 201));
                // header("Location: register_user_list.php");
                // echo 2;
            }
        }
    } else {
        echo json_encode(array("statusCode" => 203));
    }
}
?>