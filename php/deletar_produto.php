<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $codProd = $input['codProd'];

    include 'connection.php';

    $query = $conn->prepare("DELETE FROM products WHERE cod_prod = ?");
    $query->bind_param("s", $codProd);

    if ($query->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $query->close();
    $conn->close();
}
