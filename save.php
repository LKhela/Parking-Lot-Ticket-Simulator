<?php
session_start(); 

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : null;
    $car = isset($_POST['car']) ? trim($_POST['car']) : null;
    $plate = isset($_POST['plate']) ? trim($_POST['plate']) : null;
    $time = isset($_POST['time']) ? trim($_POST['time']) : null;


    if (!empty($name) && !empty($car) && !empty($plate) && !empty($time)) {
        $conn = new mysqli('127.0.0.1:4306', 'root', '', 'plts');
        if ($conn->connect_error) {
            echo "$conn->connect_error";
            die("Connection Failed : " . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("INSERT INTO parking (name, car, plate, time) VALUES (?, ?, ?, ?)"); 
            $stmt->bind_param("ssss", $name, $car, $plate, $time);
            $execval = $stmt->execute();

            if (!$execval) {
                echo "Error: " . $stmt->error;
            } 

            $stmt->close();
            $conn->close();
        }
    } 
} else {
    echo "Invalid request method.";
}
?>