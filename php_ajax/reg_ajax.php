<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="reg_ajax.js"></script> -->
    <title>Registration Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <?php
    require_once 'navigation_reg.php';
    ?>

    <div class="card">
        <h5 class="card-header info-color text-white text-center py-4 container my-2 col-md-4 bg-primary">
            <strong>Registration Form</strong>
        </h5>
        <div class="container my-2 col-md-4 border p-3">
            <form class="text-center" style="color: #757575;" id="myForm">
                <?php
                if (!empty($error_msg)) {

                ?>
                    <div class="alert alert-danger" id="error_Msg" role="alert">
                        <bold>Correction!!</bold> <?= $error_msg ?>
                    </div>
                <?php
                } ?>
                <?php
                if (!empty($success)) {
                ?>
                    <div class="alert alert-success" id="success" role="alert">
                        <bold>Correction!!</bold> <?= $success ?>
                    </div>
                <?php
                } ?>
                <div class="md-form">
                    <input type="name" id="name" onkeypress="return /[a-z]/i.test(event.key)" class="form-control" name="name" placeholder="Name" required><br>
                </div>
                <div class="md-form">
                    <input type="email" id="email" class="form-control" name="email" placeholder="Email" required="required"><br>
                </div>
                <div class="md-form">
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password" required="required"><br>
                </div>
                <div class="md-form">
                    <input type="number" id="number" class="form-control" name="number" placeholder="Mobile No." required="required"><br>
                </div>
                <div>
                    Gender:<br>
                    <select name="gender" id="gender" class="form-control">
                        <option value="">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <br>
                    User:<br>
                    <select name="user_type" id="user_type" class="form-control">
                        <option value="">Select</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>

                    <div class="form-group">
                        <button class="btn btn-outline-info btn-rounded btn-block my-4 col-md-3 waves-effect z-depth-0 " type="submit" name="submit" value="submit" id="submit-btn">Register</button>
                    </div>
            </form>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#myForm').submit(function(e) {
                e.preventDefault();

                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var number = $('#number').val();
                var gender = $('#gender').val();
                var user_type = $('#user_type').val();

                $.ajax({
                    url: "reg.php",
                    type: "POST",
                    data: {
                        name: name,
                        email: email,
                        password: password,
                        number: number,
                        gender: gender,
                        user_type: user_type,

                    },
                    cache: false,

                    success: function(dataResult) {

                        if (dataResult == 200) {

                            alert("User Registered Successfully");
                            window.location = "login_ajax.php";
                        } else if (dataResult == 201) {

                            alert("Error occured !");
                        }

                    }
                })
            });
        });
    </script>

</body>

</html>