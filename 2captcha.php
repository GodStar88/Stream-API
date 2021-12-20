<?php
    include 'db_config.php';
    $apiKey = $_POST['apiKey'];
    $balance = $_POST['balance'];

    // Create connection
    $conn = new mysqli($db_server, $db_user, $db_password, $db_name);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM 2captcha WHERE apiKey='".$apiKey."'";
    if ($result = $conn->query($sql)) {
        $rowcount=mysqli_num_rows($result);
        if ($rowcount != 0) {
            $sql = "UPDATE 2captcha SET balance = '".$balance."' WHERE apiKey='".$apiKey."'";
        } else {
            $sql = "INSERT INTO  2captcha (apiKey, balance) VALUES ('" . $apiKey . "', '" . $balance . "')";
        }
    }

    $conn->query($sql);
    $conn->close();
    echo($sql);