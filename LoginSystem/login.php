<?php
session_start();
include 'connection.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_username = $_POST['username'];
    $_password = $_POST['password'];

   
    $sql = "SELECT * FROM user WHERE username = '$_username' AND password = '$_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("location: welcome.php"); 
        exit();
    } else {
        $error = "Invalid username or password!";
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
            background-color: lightblue;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        .login-container {
            width: 400px;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
        }

        input {
            width: 100%;
            height: 45px;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        input:focus {
            border-color: #4267B2;
        }

        .login-btn {
            width: 100%;
            height: 50px;
            background: #4267B2;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #365899;
        }

        .error-message {
            color: red;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .register-link {
            margin-top: 20px;
            font-size: 16px;
        }

        .register-link a {
            color: #4267B2;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Please login to your account</h1>

        <?php if (!empty($error)) : ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" class="login-btn">Login</button>
        </form>

        <p class="register-link">Don't have an account? <a href="register.php">Register Now</a></p>
    </div>
</body>
</html>
