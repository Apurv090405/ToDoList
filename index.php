<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.jpg">
    <title>Registration Page</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300&display=swap");
        *{
            margin:0;
            padding:0;
            box-sizing: border-box;
            font-family: "Be Vietnam Pro", sans-serif;
            scroll-behavior: smooth;
        }
        /* Add your CSS styles here */
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: url() no-repeat;
            background-size: cover;
        }

        .register-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #191970;
        }

        .register-container h2 {
            float: left;
            font-size: 40px;
            border-bottom: 4px solid #191970;
            margin-bottom: 20px;
            padding: 13px;
        }
        .fa {
            width: px;
            float: left;
            text-align: center;
        }
        .input-group {
            width: 100%;
            overflow: hidden;
            font-size: 20px;
            padding: 8px 0;
            margin: 8px 0;
            border-bottom: 1px solid #191970;
        }

        .input-group label {
            display: flexbox;
            font-weight: bold;
        }

        .input-group input {
            border: none;
            outline: none;
            background: none;
            font-size: 18px;
            float: left;
            margin: 0 10px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            color: #ffffff;
            background: none #191970;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            margin: 12px 0;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="register-container">
        
        <form method="post">
        
            <div class="input-group">
            <h2>Register</h2>
            </div>

            <div class="input-group">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" id="pass" name="pass" placeholder="password" required>
            </div>
            <div class="input-group">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="confirm_password" required>
            </div>
            <button type="submit" class="btn" name="add" value="ADD">Register</button>
            <h4>Already Have an Account..?  
            <a href="LOGIN.php">Loging Here!</a>
            </h4>
        </form>
        <?php
        include("connection.php");
        if (isset($_POST['add'])) {
            // Handle registration logic using SQL here
            $username = $_POST["username"];
            $pass = $_POST["pass"];
            $confirm_password = $_POST["confirm_password"];

            // Check if passwords match
            if ($pass !== $confirm_password) {
                echo '<script>alert("Error Occurs!! Passwords do not match.");</script>';
            } else {
                // Example SQL query for registration (replace with your actual SQL code)
                $sql = "INSERT INTO users (username, pass) VALUES ('$username', '$pass')";
                
                if (mysqli_query($conn, $sql)) {
                    // Registration successful
                    echo '<script>alert("Registration successful");</script>';
                    header("Location: LOGIN.php");
                    exit();
                } else {
                    // Registration failed
                    echo '<script>alert("Error Occurs!! Registration failed. Username may already be taken.");</script>';
                }
            }
        }
        ?>
    </div>
</body>
</html>
