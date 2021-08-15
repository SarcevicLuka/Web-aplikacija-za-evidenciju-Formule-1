<?php
    function connectToDB (){
        $conn = mysqli_connect("localhost","root","","formula1");
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
?>