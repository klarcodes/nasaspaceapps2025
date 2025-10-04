<?php
header('Content-Type: application/json');
session_start();
include('./db.php');

$gid = $_POST['gid'] ?? '';

if (empty($gid)) {
    echo json_encode(["success" => false, "message" => "ID não informado"]);
    exit;
}

// 1️⃣ Consulta para obter o nome da imagem
$sqlSelect = "SELECT imagem_dest FROM nasa2025.nasa_agua WHERE gid = $1";
$resultSelect = pg_query_params($connPg, $sqlSelect, [$gid]);

if (!$resultSelect || pg_num_rows($resultSelect) === 0) {
    echo json_encode(["success" => false, "message" => "Registro não encontrado"]);
    exit;
}

$row = pg_fetch_assoc($resultSelect);
$imageName = $row['imagem_dest'];

// 2️⃣ Remove o arquivo do servidor (se existir)
if (!empty($imageName)) {
    $imagePath = __DIR__ . '/uploads/' . $imageName; // ajuste o caminho conforme onde salva
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

// 3️⃣ Exclui o registro do banco
$sqlDelete = "DELETE FROM nasa2025.nasa_agua WHERE gid = $1";
$resultDelete = pg_query_params($connPg, $sqlDelete, [$gid]);

if ($resultDelete) {
    echo json_encode(["success" => true, "message" => "Registro e imagem removidos com sucesso"]);
} else {
    echo json_encode(["success" => false, "message" => "Erro ao excluir o registro"]);
}
?>
