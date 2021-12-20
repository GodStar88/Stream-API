<?php
    include 'db_config.php';
    $str = $_POST['accounts'];
    $store = $_POST['store'];
    $accounts = preg_split("/(\r\n|\n|\r)/",$str);

    // Create connection
    $conn = new mysqli($db_server, $db_user, $db_password, $db_name);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach($accounts as $item){
       if ($item != "") {
        $account = explode(':', $item);
        $sql = "INSERT INTO account_".$store." (username, password) VALUES "."('".$account[0]."','".$account[1]."')"." ON DUPLICATE KEY UPDATE password='".$account[1]."'";
        $conn->query($sql);
       }
    }
    $conn->close();

    
