<?php

$name = $_POST["name"];
$message = $_POST["message"];
$priority = filter_input(INPUT_POST, "priority", FILTER_VALIDATE_INT);
$type = filter_input(INPUT_POST, "type", FILTER_VALIDATE_INT);
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOL);

if (! $terms) {
    die("terms must be accepted");
}

var_dump($name, $message, $priority, $type, $terms);

$host = "localhost";
$name = "message_db";
$user = "root";
$password = "";

$conn = mysqli_connect($host, $user, $password, $name);

if (mysqli_connect_errno()) {
    die("conn error" . mysqli_connect_error());
}


$sql = "INSERT INTO message (name, body, priority, type) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
if (! $stmt) {
    die(mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "ssii", $name, $message, $priority, $type);

mysqli_stmt_execute($stmt);
echo("saved");