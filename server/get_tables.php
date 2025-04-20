<?php
    include "config.php";

    $row = $conn->prepare("SELECT * FROM tables");
    $row->execute();

    $data = $row->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
?>