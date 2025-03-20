<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['insert'])) {
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $contact = $_POST['contact'];
        $username = $_POST['username'];
        $password = $_POST['password'];

       
        $check_username_sql = "SELECT * FROM user WHERE username = '$username'";
        $check_result = $conn->query($check_username_sql);

        if ($check_result->num_rows > 0) {
            $username_taken = true;
        } else {
            
            $insert_sql = "INSERT INTO user (first_name, last_name, contact_number, username, password)
                           VALUES ('$firstname', '$lastname', '$contact', '$username', '$password')";
            $conn->query($insert_sql);
            echo "SUCCESSFULLY ADDED!";
            header("location: welcome.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: lightblue;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        div {
            width: 500px;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #4267B2;
            outline: none;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #4267B2;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #365899;
        }

        button:active {
            background-color: #29487d;
        }

        p {
            font-size: 16px;
            margin-top: 20px;
            color: #555;
        }

        a {
            text-decoration: none;
            color: #4267B2;
            font-weight: bold;
        }

        a:hover {
            color: #365899;
        }

        .username-error {
            color: red;
            font-size: 12px; 
            margin-top: -15px; 
        }
    </style>
</head>
<body>
    <div>
        <h1>Registration</h1>
        <form action="" method="POST">
            <input type="text" name="fname" placeholder="First Name" required><br>
            <input type="text" name="lname" placeholder="Last Name" required><br>
            <input type="text" name="contact" placeholder="Contact Number" required><br>
            
            <input type="text" name="username" placeholder="Username" required><br>

            <?php if (isset($username_taken) && $username_taken): ?>
                <div class="username-error">Username is already taken.</div>
            <?php endif; ?>

            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="insert">Submit</button>
            
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
