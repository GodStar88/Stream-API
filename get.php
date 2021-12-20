<?php
    getFirstData();
    function getFirstData() {   
        include 'db_config.php';  
        $artist = $_POST['artist'];
        $song = $_POST['song'];
        // Create connection
        $conn = new mysqli($db_server, $db_user, $db_password, $db_name);         
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "SELECT * FROM stream WHERE artist='".$artist."' AND song='".$song."' ORDER BY Id DESC LIMIT 30";
        $result = $conn->query($sql);
        
        $arr = array();
        $count = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $tmp = array(
                    $row["date"],
                    $row["deezer"],
                    $row["tidal"], 
                    $row["napster"]);
                array_push($arr, $tmp);
                $count ++;
            }
        }
        $res = new \stdClass();
        $res -> data = $arr;
        $conn->close();
        echo json_encode($res);
    }
?>