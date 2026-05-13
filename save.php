<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = trim($_POST['name']  ?? '');
    $car   = trim($_POST['car']   ?? '');
    $plate = trim($_POST['plate'] ?? '');
    $time  = trim($_POST['time']  ?? '');

    if (!empty($name) && !empty($car) && !empty($plate) && !empty($time)) {

        $conn = new mysqli('127.0.0.1:4306', 'root', '', 'plts');
        if ($conn->connect_error) {
            die(json_encode(["error" => "DB Connection Failed: " . $conn->connect_error]));
        }

        $stmt = $conn->prepare("INSERT INTO parking (name, car, plate, time) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $car, $plate, $time);
        $stmt->execute();
        $stmt->close();
        $conn->close();

    }
}
?>