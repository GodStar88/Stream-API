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

    foreach($proxies as $item){
        $proxy = explode(':', $item);

        if ($proxy[0] != "") {
            $sql = "INSERT INTO rotating (ip, port, username, password) SELECT '".$proxy[0]."','".$proxy[1]."','".$proxy[2]."','".$proxy[3]."' WHERE NOT EXISTS (SELECT * FROM rotating WHERE ip='".$proxy[0]."' AND port='".$proxy[1]."')";
            $conn->query($sql);
        }
    }
    $conn->close();
    echo($sql);

    
