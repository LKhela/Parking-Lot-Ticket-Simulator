<?php

$name  = $_POST['name'];
$car   = $_POST['car'];
$plate = $_POST['plate'];
$time  = $_POST['time'];

$command = escapeshellcmd(
    "python app.py \"$name\" \"$car\" \"$plate\" \"$time\""
);

$output = shell_exec($command);

$data = json_decode($output, true);

$conn = new mysqli(
    '127.0.0.1:4306',
    'root',
    '',
    'plts'
);

$stmt = $conn->prepare(
    "INSERT INTO parking
    (name, car, plate, time,
     entry_time, fee, slot_number)
    VALUES (?, ?, ?, ?, ?, ?, ?)"
);

$stmt->bind_param(
    "sssssdi",

    $data['customer_name'],
    $data['car_model'],
    $data['plate'],
    $data['hours'],
    $data['entry_time'],
    $data['fee'],
    $data['slot_number']
);

$stmt->execute();

$id = $conn->insert_id;

header("Location: ticket.php?id=$id");

exit();

?>