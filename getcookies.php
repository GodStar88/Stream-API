<?php
    getFirstData();
    function getFirstData() {   
        include 'db_config.php';  
        $store = $_POST['store'];
        $email = $_POST['email'];
        // Create connection
        $conn = new mysqli($db_server, $db_user, $db_password, $db_name);         
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "SELECT * FROM cookies WHERE store='".$store."' AND email='".$email."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $conn->close();
                echo($row["cookies"]);
            }
        } else {
            $conn->close();
            echo("");
        }
    }
?>