<?php
    include 'db_config.php';
    $str = $_POST['proxies'];
    $proxies = preg_split("/(\r\n|\n|\r)/",$str);

    // Create connection
    $conn = new mysqli($db_server, $db_user, $db_password, $db_name);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $values = "";
    foreach($proxies as $item){
        $proxy = explode(':', $item);
        $sql = "INSERT INTO proxies (ip, port, username, password) VALUES "."('".$proxy[0]."','".$proxy[1]."','".$proxy[2]."','".$proxy[3]."')"." ON DUPLICATE KEY UPDATE username='".$proxy[2]."', password='".$proxy[3]."'";
        $conn->query($sql);
    }
    $conn->close();
    echo($sql);

    
