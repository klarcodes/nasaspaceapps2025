<?php
header('Content-Type: application/json');
session_start();
include('./db.php');

// Recebe os campos enviados via FormData
$title = trim($_POST['title'] ?? '');
$categoria = trim($_POST['categoria'] ?? '');
$geom = trim($_POST['geom'] ?? '');
$content = $_POST['content'] ?? '';

// Upload da imagem
$featured_image = '';

if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {

    $target_dir = "./imagens/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);

    $file_extension = strtolower(pathinfo($_FILES["featured_image"]["name"], PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg','jpeg','png','gif'];
    if (!in_array($file_extension, $allowed_extensions)) {
        echo json_encode(["success" => false, "message" => "Formato de arquivo não permitido!"]);
        exit;
    }

    $max_size = 5 * 1024 * 1024;
    if ($_FILES["featured_image"]["size"] > $max_size) {
        echo json_encode(["success" => false, "message" => "Arquivo muito grande! Máx 5MB"]);
        exit;
    }

    $random_file_name = uniqid('', true) . '.' . $file_extension;
    $target_file = $target_dir . $random_file_name;

    if (move_uploaded_file($_FILES["featured_image"]["tmp_name"], $target_file)) {
        $featured_image = $random_file_name;
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao mover o arquivo enviado."]);
        exit;
    }
}

// Inserção no banco
$sql = "INSERT INTO nasa2025.nasa_agua (titulo, categoria, fk_user, geom, descricao, imagem_dest)
        VALUES ($1, $2, $3, $4, $5, $6);";

$result = pg_query_params($connPg, $sql, [$title, $categoria, $_SESSION['user_id'], $geom, $content, $featured_image]);

if ($result) {
    echo json_encode(["success" => true, "message" => "Save successful"]);
} else {
    echo json_encode(["success" => false, "message" => "Erro ao salvar no banco"]);
}
?>
