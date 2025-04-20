<?php
include "config.php";

$input = json_decode(file_get_contents("php://input"), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid Input"]);
    exit;
}

$title = $input["title"];

try {
    $stmt = $conn->prepare("INSERT INTO categories (title) VALUES (:title)");
    $stmt->execute([":title" => $title]);

    echo json_encode(["message" => "Category added successfully"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
