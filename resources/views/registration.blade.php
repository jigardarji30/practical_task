<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="app.css"> -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jQuery.Validate/1.6/jQuery.Validate.min.js"></script>
</head>

<body class="antialiased">
    <div class="container">
        <div class="center">User Registration</div>
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <form method="POST" name="userForm" id="userForm">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control input-validation-error" name="name" id="name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>

                <div class="form-group form-check">
                    <label for="gender">Gender</label>
                    <input type="radio" name="gender" value="male" id="gender">Male
                    <input type="radio" name="gender" value="female" id="gender">Female
                </div>
                <div class="form-check">
                    <label for="hobbies">Hobbies</label>
                    <input type="checkbox" name="hobbies[]" value="cricket" id="hobbies"> cricket
                    <input type="checkbox" name="hobbies[]" value="chess" id="hobbies"> chess
                    <input type="checkbox" name="hobbies[]" value="reading" id="hobbies"> reading
                    <input type="checkbox" name="hobbies[]" value="travel" id="hobbies"> travel
                    <input type="checkbox" name="hobbies[]" value="dance" id="hobbies"> dance
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password_confirm">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirm Password">
                </div>
                <button type="button" name="submit" class="submit btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $("#userForm").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    gender: {
                        required: true,
                    },
                    'hobbies[]': {
                        required: true,
                        minlength: 1,
                        maxlength: 3
                    },
                    password: {
                        required: true,
                        minlength: 3,
                    },
                    password_confirm: {
                        minlength: 3,
                        equalTo: "#password"
                    }
                },
                // Specify the validation error messages
                messages: {
                    name: {
                        required: "Name is required"
                    },
                    email: {
                        required: 'Email is required',
                        email: 'Enter valid email'
                    },
                    gender: {
                        required: 'Gender is required'
                    },
                    'hobbies[]': {
                        required: 'Hobbies is required',
                        minlength: "Check {0} boxes",
                        maxlength: "Check no more than {0} boxes"
                    },
                    password: {
                        required: 'Password is required',
                        minlength: "Enter minimum 3 charactor",

                    },
                    password_confirm: {
                        required: 'confirm password is required',
                        minlength: "Enter minimum 3 charactor",
                        equalTo: 'Password and confirm password should be same'
                    }
                }
            });

            $('.submit').click(function(e) {
                e.preventDefault();

                var _token = $('#_token').val();
                var name = $('#name').val();
                var email = $('#email').val();
                var gender = $('#gender').val();
                var hobbies = $('#hobbies').val();
                var password = $('#password').val();

                $.ajax({
                    url: '/store',
                    type: "POST",
                    dataType: 'JSON',
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        email: email,
                        gender: gender,
                        hobbies: hobbies,
                        password: password
                    },
                    success: function(res, data) {
                        window.location.replace("https://localhost:8000/submit/thankyou");
                    }
                });


            });
        });
    </script>
</body>

</html>