<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
   
    $select_sql = "SELECT * FROM user WHERE id = $id";
    $result = $conn->query($select_sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found!";
        exit();
    }
} else {
    echo "No user ID provided!";
    exit();
}

$username_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['contact_number'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $check_username_sql = "SELECT * FROM user WHERE username = '$username' AND id != $id";
    $check_result = $conn->query($check_username_sql);

    if ($check_result->num_rows > 0) {
        $username_error = "Username is already taken.";
    } else {
      
        $update_sql = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', contact_number = '$contact_number', username = '$username', password = '$password' WHERE id = $id";

        if ($conn->query($update_sql) === TRUE) {
            echo "User updated successfully!";
            header("Location: welcome.php");
            exit();
        } else {
            echo "Error updating user: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
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
        flex-direction: column;
    }

    div {
        width: 500px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        padding: 40px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }

    label {
        font-size: 18px;
        color: #555;
        margin-bottom: 8px;
        align-self: flex-start;
    }

    input {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0 20px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 16px;
        color: #333;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }

    input:focus {
        border-color: #4267B2;
        outline: none;
    }

    .error {
        color: red;
        font-size: 14px;
        margin-top: 0px;
        margin-bottom: 0px;
    }

    button {
        width: 100%;
        padding: 15px;
        background-color: #4267B2;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #365899;
    }

    button:active {
        background-color: #29487d;
    }
</style>
</head>
<body>

    <div>
        <h1>Edit User Details</h1>
        <form action="edit.php?id=<?php echo $user['id']; ?>" method="POST">
            <label>First Name:</label><br>
            <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required><br>
            
            <label>Last Name:</label><br>
            <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required><br>
            
            <label>Contact Number:</label><br>
            <input type="text" name="contact_number" value="<?php echo $user['contact_number']; ?>" required><br>
            
            <label>Username:</label><br>
            <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br>
            
          
            <?php if ($username_error): ?>
                <div style="color: red; font-size: 14px; margin-top: -15px;"><?php echo $username_error; ?></div>
            <?php endif; ?>
            
            <label>Password:</label><br>
            <input type="password" name="password" placeholder="New Password" required><br>
            
            <button type="submit">Update User</button>
        </form>
        <a href="welcome.php">Back to Dashboard</a>
    </div>
    
</body>
</html>
