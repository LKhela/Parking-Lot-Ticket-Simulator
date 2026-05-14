<?php

$conn = new mysqli('127.0.0.1:4306', 'root', '', 'plts');

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare(
    "SELECT * FROM parking WHERE id = ?"
);

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();

$ticket = $result->fetch_assoc();

$stmt->close();
$conn->close();

if (!$ticket) {
    die("Ticket not found.");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Parking Ticket</title>

<style>

body {
    font-family: Arial;
    background: #f4f4f4;
    padding: 40px;
}

.ticket-container {

    width: 400px;
    margin: auto;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
}

h1 {
    text-align: center;
}

.ticket-info p {

    border-bottom: 1px solid #ddd;
    padding: 10px 0;
}

button {

    width: 100%;
    padding: 10px;
    margin-top: 20px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
}

</style>

</head>

<body>

<div class="ticket-container">

<h1>Parking Ticket</h1>

<div class="ticket-info">

<p>
<strong>Ticket ID:</strong>
<?php echo $ticket['id']; ?>
</p>

<p>
<strong>Customer:</strong>
<?php echo htmlspecialchars($ticket['name']); ?>
</p>

<p>
<strong>Car:</strong>
<?php echo htmlspecialchars($ticket['car']); ?>
</p>

<p>
<strong>Plate:</strong>
<?php echo htmlspecialchars($ticket['plate']); ?>
</p>

<p>
<strong>Hours:</strong>
<?php echo $ticket['time']; ?>
</p>

<p>
<strong>Entry Time:</strong>
<?php echo $ticket['entry_time']; ?>
</p>

<p>
<strong>Fee:</strong>
$<?php echo $ticket['fee']; ?>
</p>

</div>

<button onclick="window.print()">
Print Ticket
</button>

</div>

</body>
</html>