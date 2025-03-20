<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "user_database";
    $conn = "";

    $conn = mysqli_connect(
        $db_server,
        $db_user,
        $db_password,
        $db_name,
    );

    try{
        $conn = mysqli_connect(
            $db_server,
            $db_user,
            $db_password,
            $db_name,
        );
    }
    catch (mysqli_sql_exemption){
        echo "Error connecting to database!";
    }

    if($conn){
        echo "Connected to Database";
    } else {
        echo "Connection failed!"; 
    };

?>