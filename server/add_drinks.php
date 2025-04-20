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
$is_alcoholic = $input["is_alcoholic"];
$abv = $input["abv"];
$image = $input["image"];
$prep_time = $input["prep_time"];
$status = $input["status"];

try {
    $stmt = $conn->prepare("INSERT INTO drinks (title, description, price, is_alcoholic, abv, image, prep_time, status, created_at) VALUES (:title, :description, :price, :is_alcoholic, :abv, :image, :prep_time, :status, NOW())");

    $stmt->execute([
        ":title" => $title,
        ":description" => $description,
        ":price" => $price,
        ":is_alcoholic" => $is_alcoholic,
        ":abv" => $abv,
        ":image" => $image,
        ":prep_time" => $prep_time,
        ":status" => $status
    ]);

    echo json_encode(["message" => "Drink added successfully"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>