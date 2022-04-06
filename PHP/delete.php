<?php
require 'database_connection.php';

if (isset($_GET['id'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_GET['id']);
    $sql = "DELETE FROM user WHERE id= $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: register_admin_user.php?error=Profile deleted succefully.");
    }
}
