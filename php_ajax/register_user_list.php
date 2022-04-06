  <?php
  session_start();
  require 'database_connection.php';
  if ($_SESSION['user_type'] == "user") {


    $result = mysqli_query($conn, "SELECT * FROM user WHERE user_type = 'user'");


  ?>

    <!DOCTYPE html>
    <html>

    <head>
      <title>Register Users</title>
      <!-- <link rel="stylesheet" href="style_userlist.css"> -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>

    <body>
      <?php require 'navigation.php' ?>


      <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
      <?php }
      if (isset($_SESSION['id']) && isset($_SESSION['email'])) { ?>
        <h2 align="center" color="black">Register User</h2>
        <?php

        if (mysqli_num_rows($result) > 0) {

        ?>
          <table class="  table table-bordered border-dark " style="width:50% " align="center">

            <tr class="table-dark">
              <td>Sr.No.</td>
              <td>profile</td>
              <td>Name</td>
              <td>Email</td>
              <td>Mobile No.</td>
              <td>Gender</td>
              <td>User_Type</td>

            </tr>
            <?php
            $i = 1;
            while ($row = mysqli_fetch_array($result)) {
            ?>
              <tr style="height:100%" class="table-info">
                <td><?= $i ?></td>
                <td> <img style="height:45px; width:45px;" src="<?php echo $row['image']; ?>"></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["number"]; ?></td>
                <td><?php echo $row["gender"]; ?></td>
                <td><?php echo $row["user_type"]; ?></td>

              </tr>
            <?php

              $i++;
            }
            ?>
          </table>
      <?php
        } else {
          echo "no result found";
        }
      } else {
        header("Location: login_form.php?error=TO UPDATE ANY DATA... FIRST LOGIN...");
      }
      ?>
    </body>

    </html>
  <?php
  } else {
    header("Location: login_form.php?error=Unauthorised Access");
  }
  ?>