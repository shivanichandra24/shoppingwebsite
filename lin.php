<?php

session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Read from the database
        $query = "SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if ($user_data['password'] === $password) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location:1.html");
                die;
            }
        }

        echo "Wrong username or password!";
    } else {
        echo "enter a valid username or password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('log.jpg');
            background-size: cover;
            background-position: center;
        }

        #box {
            width: 300px;
            margin: 100px auto;
            background-color: lightblue;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            text-align: center;
        }

        h2 {
            color: #0074d9;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #button {
            width: 100%;
            padding: 10px;
            background-color: #0074d9;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #button:hover {
            background-color: #0056a4;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #0074d9;
        }

        a:hover {
            color: #0056a4;
        }
    </style>
</head>
<body>
    <div id="box">
        <form method="post" onsubmit="return validateForm()">
            <h2>Login</h2>
            <label><b>Username</b></label>
            <input class="input-field" type="text" name="user_name" id="username" placeholder="Enter username"><br>
            <label><b>Password</b></label>
            <input class="input-field" type="password" name="password" id="password" placeholder="Enter password"><br>

            <input id="button" type="submit" value="Login"><br>

            <a href="sup.php">Click to Signup</a>
        </form>
    </div>

    <script>
        function validateForm() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            if (username.trim() === '' || password.trim() === '') {
                alert('Please enter both username and password.');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
