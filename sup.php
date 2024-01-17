<?php 
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    if (!empty($user_name) && !empty($password) && !empty($address) && !empty($phone_number) && !empty($email) && !is_numeric($user_name)) {
        // Save to database
        $user_id = random_num(20);
        $query = "INSERT INTO users (user_id, user_name, password, address, phone_number, email) VALUES ('$user_id', '$user_name', '$password', '$address', '$phone_number', '$email')";

        mysqli_query($con, $query);

        header("Location: lin.php");
        die;
    } else {
        echo "Please enter all valid information!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('sup.jpg'); /* Replace 'your-background-image.jpg' with the path to your image */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #box {
            background-color: rgba(255, 255, 255, 0.9); /* Set alpha for box transparency */
            width: 400px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        input[type="text"],
        input[type="password"] {
            height: 40px;
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #4a90e2;
        }

        #button {
            padding: 14px;
            width: 100%;
            color: white;
            background-color: #4a90e2;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        #button:hover {
            background-color: #3666a1;
        }
    </style>
</head>
<body>
    <div id="box">
        <form method="post" onsubmit="return validateForm()">
            <input type="text" name="user_name" placeholder="Username"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="text" name="address" placeholder="Address"><br>
            <input type="text" name="phone_number" placeholder="Phone Number"><br>
            <input type="text" name="email" placeholder="Email"><br>
            <input id="button" type="submit" value="Signup">
        </form>
    </div>

    <script>
        function validateForm() {
            var userName = document.forms[0]["user_name"].value;
            var password = document.forms[0]["password"].value;
            var address = document.forms[0]["address"].value;
            var phoneNumber = document.forms[0]["phone_number"].value;
            var email = document.forms[0]["email"].value;

            if (userName == "" || password == "" || address == "" || phoneNumber == "" || email == "") {
                alert("Please fill in all fields.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>

