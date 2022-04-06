<?php
session_start();
require 'database_connection.php';
if ($_SESSION['user_type'] == "admin") {

?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>Register Users</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="update.css"> -->
  </head>

  <body>
    <?php

    require 'navigation.php' ?>

    <?php if (isset($_GET['error'])) { ?>

      <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <h2 align="center" color="black">Register User</h2>

    <table class="table table-bordered border-dark" style="width:50% " align="center">
      <thead>
        <tr class="table-dark">
          <td>Sr.No.</td>
          <td>profile</td>
          <td>Name</td>
          <td>Email</td>
          <td>Mobile No.</td>
          <td>Gender</td>
          <td>User_Type</td>
          <td>Actions</td>
        </tr>
      </thead>
      <tbody id="table">

      </tbody>
    </table>

    <script>
      $(document).ready(function() {
        $.ajax({
          url: "register_admin.php",
          type: "POST",
          cache: false,
          success: function(dataResult) {
            // console.log(dataResult);

            $('#table').html(dataResult);
          }
        });
        $(document).on("click", "#delete-data", function() {


          if (confirm("Are you sure you want to Delete: ")) {

            var stdid = $(this).data("delete_id");
            var element = this;
            $.ajax({
              url: "delete.php",
              type: "POST",
              cache: false,
              data: {
                id: stdid
              },
              success: function(dataResult) {

                if (dataResult == 200) {

                  $(element).closest("tr").fadeOut();
                  // alert("User Deleted Successfully");
                } else {
                  alert("Invalid User ID");
                }
              }
            });
          }
        });
      });
    </script>
  </body>

  </html>
<?php
} else {
  header("Location: login_form.php?error=Unauthorised Access");
}
?>