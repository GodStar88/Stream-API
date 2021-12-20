<?php
    include 'db_config.php';
    $store = $_POST['store'];
    $artist = $_POST['artist'];
    $song = $_POST['song'];
    $date = date('Y-m-d');

    // Create connection
    $conn = new mysqli($db_server, $db_user, $db_password, $db_name);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM stream WHERE artist='".$artist."' AND song='".$song."' AND date='".$date."'";
    if ($result = $conn->query($sql)) {
        $rowcount=mysqli_num_rows($result);
        if ($rowcount != 0) {
            $sql = "UPDATE stream SET ".$store." = ".$store." + 1 WHERE artist='".$artist."' AND song='".$song."' AND date='".$date."'";
        } else {
            $sql = "INSERT INTO  stream (artist, song, date, ".$store.") VALUES ('" . $artist . "', '" . $song . "','" . $date . "', '1')";
        }
    }

    $conn->query($sql);
    $conn->close();