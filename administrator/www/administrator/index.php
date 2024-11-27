<?php

session_start();
require_once 'inc/config.php';

if (!empty($_POST)) {

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = md5(mysqli_real_escape_string($conn, $_POST['password']));
	$query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
	$login = mysqli_query($conn, $query);

	if (mysqli_num_rows($login) == 0) {
		header("Location: index.php");
		exit();
	} else {
		$_SESSION['admin'] = 1;
		header("Location: admin.php");
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <style>
        /* Custom CSS */
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Montserrat", sans-serif;
        }

        /* Set background image for the whole page */
        body {
            background: url('https://blog.danasyariah.id/wp-content/uploads/2023/08/131-0-Unsplash.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(253, 252, 252, 0.075); /* Dark overlay */
        }
        .form-wrap {
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            position: relative;
        }

        .form-wrap::before {
            position: absolute;
            content: "";
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .form-wrap > form {
            position: relative;
            background: rgba(255, 255, 255, 0.671); /* transparent form background */
            min-width: 400px;
            min-height: 400px;
            padding: 30px;
            border-radius: 16px;
            text-align: center;
            border: 2px solid rgba(255, 255, 255, 0.603);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
        }

        .form-wrap > form > h1 {
            color: #333;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 0 0 30px;
        }

        .form-wrap .form-group {
            position: relative;
            margin: 0 0 20px;
        }

        .form-wrap .form-group input {
            width: 100%;
            background: transparent;
            min-height: 50px;
            font-size: 14px;
            color: #333;
            padding: 0 20px;
            border-radius: 50px;
            outline: unset;
            border: 2px solid rgba(0, 0, 0, 0.2);
        }

        .form-wrap .form-group input::placeholder {
            color: rgba(0, 0, 0, 0.5);
        }

        .form-wrap .form-group input:focus {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .form-wrap .form-group i {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            color: rgba(82, 82, 82, 0.801);
        }

        .form-wrap .forgot-pass {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .form-wrap .forgot-pass label {
            color: #333;
            cursor: pointer;
        }

        .form-wrap .forgot-pass a {
            color: #007bff;
            font-weight: 500;
            text-decoration: unset;
        }

        .form-wrap .login {
            margin: 20px 0;
        }

        .form-wrap .login button {
            width: 100%;
            background: #007bff;
            color: #fff;
            font-weight: 600;
            min-height: 50px;
            border: 0;
            border-radius: 50px;
            letter-spacing: 1px;
            transition: all 0.3s ease-in-out;
        }

        .form-wrap .login button:hover {
            background: #0056b3;
        }

        .form-wrap .sign-up p {
            color: #333;
        }

        .form-wrap .sign-up a {
            color: #007bff;
            font-weight: 600;
            text-decoration: unset;
        }
    </style>
</head>

<body>
    <div class="form-wrap">
        <form action="" method="post">
            <h1>Login</h1>
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username or Email" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fa-solid fa-eye"></i>
            </div>
            <div class="forgot-pass">
                <label for="rememberMe">
                    <input type="checkbox" name="rememberMe" id="rememberMe">
                    Remember me
                </label>
                <a href="#">Forgot Password?</a>
            </div>
            <div class="login">
                <button type="submit">LOGIN</button>
            </div>
            <div class="sign-up">
                <p>Don't have an account? <a href="#">SIGN UP</a></p>
            </div>
        </form>
    </div>



<!-- Add Bootstrap JS and Popper.js scripts here -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
