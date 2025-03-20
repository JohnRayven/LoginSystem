<?php
include 'connection.php';
$select_sql = "SELECT * FROM user";
$result = $conn->query($select_sql);

// Delete user
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete_sql = "DELETE FROM user WHERE id = $id";
    $conn->query($delete_sql);
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - User List</title>
    <style>
        body {
            background-color:lightblue;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 70%;
            max-width: 750px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #4267B2;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            border: none;
            padding: 8px 15px;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-delete {
            background-color: red;
        }

        .btn-delete:hover {
            background-color: darkred;
        }

        .btn-edit {
            background-color: #4267B2;
        }

        .btn-edit:hover {
            background-color: #365899;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

    
        .login-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }

        .login-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome! You have successfully logged in.</h1>
        <h2>Users Information</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Contact Number</th>
                <th>Username</th>
                <th>Password</th>
                <th>Action</th>
            </tr>

            <?php if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['first_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['contact_number']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['password']}</td>
                            <td class='action-buttons'>
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit' name='delete' class='btn btn-delete'>Delete</button>
                                </form> 
                                <form method='GET' action='edit.php' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit' name='edit' class='btn btn-edit'>Edit</button>
                                </form> 
                            </td>
                        </tr>
                    ";
                }
            } ?>
        </table>

       
        <a href="login.php" class="login-btn">Go to Login</a>
    </div>
</body>
</html>
