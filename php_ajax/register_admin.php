<?php
session_start();
require 'database_connection.php';
$result = mysqli_query($conn, "SELECT * FROM user WHERE  email != '" . $_SESSION['email'] . "'");
if (mysqli_num_rows($result) > 0) {

    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <tr style="height:100%" class="table-info">
            <td><?= $i ?></td>
            <td> <img style="height:45px; width:45px;" src="<?php echo $row['image']; ?>"></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["number"]; ?></td>
            <td><?php echo $row["gender"]; ?></td>
            <td><?php echo $row["user_type"]; ?></td>
            <td>
                <button type="button" class="btn btn-outline-dark btn-sm"><a href="update_ajax.php?id=<?= $row['id'] ?>" class="text-warning">Update</a></button>

                <button type="button" class="btn btn-dark btn-sm" id="delete-data" data-delete_id="<?= $row['id'] ?>">Delete</button>
            </td>
        </tr>
    <?php
        $i++;
    }
    ?>

<?php
} else {
    echo "no result found";
}

?>