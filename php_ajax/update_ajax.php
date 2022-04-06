<!DOCTYPE html>
<html>

<head>
    <title>Upadate Form</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <?php
    include "navigation_reg.php";
    // include "update_form.php";
    include "database_connection.php";

    $id = $_GET['id'];

    $sql = "SELECT * FROM user WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
    ?>

    <div class="card">

        <h5 class="card-header info-color text-white text-center py-4 container my-2 col-md-4 bg-primary">
            <strong>Update Form</strong>
        </h5>

        <div class="container my-2 col-md-4 border p-3">

            <form class="text-center" id="updateform" style="color: #757575;" action="" method="POST" enctype="multipart/form-data">

                <div class="md-form">
                    Name:
                    <input type="name" class="form-control" id="name" name="name" value="<?php echo $row['name'] ?>"><br>
                </div>
                <input type="text" id="id" name="id" value="<?php echo $row['id'] ?>">

                <div class="md-form">
                    Mobile No.
                    <input type="number" class="form-control" id="number" name="number" value="<?php echo $row['number'] ?>"><br>
                </div>
                <div class="form-group">
                    Gender:<br>
                    <select name="gender" id="gender" value="<?= $row['gender'] ?>" class="form-control">
                        <option value="">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="file-field large container ">
                    <div class="btn btn-rounded aqua-gradient float-left">
                        <span>Choose file</span>
                        <input type="file" name="image" class="form-control" id="image" value="<img style='height:45px; width:45px;' src='<?php echo $row['image']; ?>'>" /><br><br>
                    </div>
                </div>

                <input type="submit" class="btn btn-primary" value="Update" id="update-btn" name="submit" />

            </form>
        </div>
        <?php

        // } else {
        //     header("Location: login_form.php?error=TO UPDATE ANY DATA... FIRST LOGIN...");
        // }
        ?>

        <script>
            $(document).ready(function() {
                $("#updateform").on("submit", function(e) {

                    e.preventDefault();
                    // var id = $('#id').val();
                    // var name = $('#name').val();
                    // var number = $('#number').val();
                    // var gender = $('#gender').val();
                    // var image = $("#image").val();
                    var form = $('#updateform')[0];

                    // FormData object 
                    var formData = new FormData(form);
                    // var formData = new FormData($(this)[0]);
                    console.log(formData);

                    $.ajax({

                        url: 'update_form.php',
                        type: "POST",
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(dataResult) {
                            //console.log(dataResult);
                            if (dataResult == 201) {

                                alert("Upated Record Successfully");
                                window.location = "register_admin_ajax.php";
                            } else if (dataResult == 202) {

                                alert("Upated Record Successfully");
                                window.location = "register_user_list.php";
                            }
                        }
                    })
                });
            });
        </script>
</body>

</html>