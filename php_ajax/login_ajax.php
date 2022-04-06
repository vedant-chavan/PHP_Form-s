<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <title>Login Page</title>

</head>

<body>
    <?php
    require 'navigation_reg.php';
    session_start();
    ?>
    <div class="card">
        <?php
        if (!empty($success)) {
        ?>
            <div class="alert alert-success" id="success" role="alert">
                <bold>Correction!!</bold> <?= $success ?>
            </div>
        <?php
        } ?>

        <h5 class="card-header info-color text-white text-center py-4 container my-2 col-md-4 bg-primary">
            <strong>Login Form</strong>
        </h5>

        <form class="text-center" style="color: #757575;" action="" method="POST">
            <div class="container my-2 col-md-4 border p-3">

                <div class="md-form">
                    <input type="email" id="email" class="form-control" name="email" placeholder="Email"><br>

                </div>

                <div class="md-form">
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password">

                </div>
                <div class="d-flex justify-content-around">
                </div>

                <div class="form-group">

                    <button class="btn btn-outline-info btn-rounded btn-block my-4 col-md-3 waves-effect z-depth-0 " type="submit" name="submit" value="submit" id="btn">Login</button>
                </div>
        </form>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#btn").on("click", function(e) {
                e.preventDefault();

                var email = $("#email").val();
                var password = $("#password").val();
                var user_type = $("#user_type").val();
                if (email == "") {
                    alert("Please Enter EmailID");
                } else if (password == "") {
                    alert("Please Enter Password");
                } else {
                    $.ajax({
                        url: "login_form.php",
                        type: "POST",
                        data: {
                            email: email,
                            password: password,
                            user_type: user_type
                        },
                        dataType: "json",
                        success: function(response) {

                            var dataResult = JSON.parse(JSON.stringify(response));

                            alert(dataResult);
                            if (dataResult.statusCode == 200) {
                                alert("Succefully Login");
                                window.location = "register_admin_ajax.php";

                            } else if (dataResult.statusCode == 201) {
                                alert("Succefully rejister");
                                window.location = "register_user_list.php";

                            } else if (dataResult.statusCode == 203) {
                                alert("Incorrect Email ID and Password.")
                                window.location.href = "login_ajax.php";

                            }
                        }
                    });
                }

            });

        });
    </script>

</body>

</html>