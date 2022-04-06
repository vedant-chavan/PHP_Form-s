<?php
require 'database_connection.php';

$id = $_POST['id'];

$sql = "DELETE FROM user WHERE id= {$id}";

$result = mysqli_query($conn, $sql);

if ($result) {
    // header("Location: register_admin_ajax.php?error=Profile deleted succefully.");
    echo 200;
    exit;
} else {
    echo 201;
    exit;
}
