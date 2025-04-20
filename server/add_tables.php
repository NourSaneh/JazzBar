<?php
include "config.php";

$input = json_decode(file_get_contents("php://input"), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid Input"]);
    exit;
}

$table_number = $input["number"];
$status = $input["status"];

try {
    $stmt = $conn->prepare("INSERT INTO tables (number, status) VALUES (:number, :status)");

    $stmt->execute([
        ":number" => $number,
        ":status" => $status
    ]);

    echo json_encode(["message" => "Table added successfully"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
