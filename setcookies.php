<?php
    include 'db_config.php';
    $store = $_POST['store'];
    $email = $_POST['email'];
    $cookies = $_POST['cookies'];

    // Create connection
    $conn = new mysqli($db_server, $db_user, $db_password, $db_name);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM cookies WHERE store='".$store."' AND email='".$email."'";
    if ($result = $conn->query($sql)) {
        $rowcount=mysqli_num_rows($result);
        if ($rowcount != 0) {
            $sql = "UPDATE cookies SET cookies='".$cookies."' WHERE store='".$store."' AND email='".$email."'";
        } else {
            $sql = "INSERT INTO  cookies (store, email, cookies) VALUES ('" . $store . "', '" . $email . "','" . $cookies . "')";
        }
    }

    $conn->query($sql);
    $conn->close();
    echo($cookies);