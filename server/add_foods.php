<?php
include "config.php";

$input = json_decode(file_get_contents("php://input"), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid Input"]);
    exit;
}

$title = $input["title"];
$description = $input["description"];
$price = $input["price"];
$category_id = $input["category_id"];
$image = $input["image"];
$prep_time = $input["prep_time"];
$status = $input["status"];

try {
    $stmt = $conn->prepare("INSERT INTO food (title, description, price, category_id, image, prep_time, status, created_at) VALUES (:title, :description, :price, :category_id, :image, :prep_time, :status, NOW())");

    $stmt->execute([
        ":title" => $title,
        ":description" => $description,
        ":price" => $price,
        ":category_id" => $category_id,
        ":image" => $image,
        ":prep_time" => $prep_time,
        ":status" => $status
    ]);

    echo json_encode(["message" => "Food added successfully"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
