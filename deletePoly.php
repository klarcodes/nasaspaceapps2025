<?php
header('Content-Type: application/json');
session_start();
include('./db.php'); // Aqui deve ter a conexão PDO: $pdo = new PDO(...);

$gid = $_POST['gid'] ?? '';

if (empty($gid)) {
    echo json_encode(["success" => false, "message" => "ID não informado"]);
    exit;
}

try {
    // 1️⃣ Consulta para obter o nome da imagem
    $sqlSelect = "SELECT imagem_dest FROM nasa2025.nasa_agua WHERE gid = :gid";
    $stmtSelect = $pdo->prepare($sqlSelect);
    $stmtSelect->bindParam(':gid', $gid, PDO::PARAM_INT);
    $stmtSelect->execute();

    $row = $stmtSelect->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo json_encode(["success" => false, "message" => "Registro não encontrado"]);
        exit;
    }

    $imageName = $row['imagem_dest'];

    // 2️⃣ Remove o arquivo do servidor (se existir)
    if (!empty($imageName)) {
        $imagePath = __DIR__ . '/uploads/' . $imageName; // ajuste o caminho conforme onde salva
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // 3️⃣ Exclui o registro do banco
    $sqlDelete = "DELETE FROM nasa2025.nasa_agua WHERE gid = :gid";
    $stmtDelete = $pdo->prepare($sqlDelete);
    $stmtDelete->bindParam(':gid', $gid, PDO::PARAM_INT);

    if ($stmtDelete->execute()) {
        echo json_encode(["success" => true, "message" => "Registro e imagem removidos com sucesso"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao excluir o registro"]);
    }

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "PDO Error: " . $e->getMessage()]);
}
?>
