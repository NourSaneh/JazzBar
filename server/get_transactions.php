<?php
include "config.php";

if (isset($_GET['type'])) {
    $type = $_GET['type'];

    if ($type === 'total') {
        $row = $conn->prepare("SELECT SUM(total_amount) AS total FROM transactions");
        $row->execute();
        $data = $row->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);

    } elseif ($type === 'all') {
        $row = $conn->prepare("SELECT * FROM transactions");
        $row->execute();
        $data = $row->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);

    } else {
        $row = $conn->prepare("SELECT type, SUM(total_amount) AS total FROM transactions WHERE type = :type GROUP BY type");
        $row->bindParam(':type', $type);
        $row->execute();
        $data = $row->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

} else {
    echo json_encode(['error' => 'No type parameter provided']);
}

 