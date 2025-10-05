<?php
header('Content-Type: application/json');
session_start();
include('./db.php'); // Aqui deve estar a conexão PDO: $pdo = new PDO(...);

// Receive fields sent via FormData
$title = trim($_POST['title'] ?? '');
$category = trim($_POST['categoria'] ?? '');
$geom = trim($_POST['geom'] ?? '');
$content = $_POST['content'] ?? '';

// Image upload
$featured_image = '';

if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {

    $target_dir = "./images/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);

    $file_extension = strtolower(pathinfo($_FILES["featured_image"]["name"], PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($file_extension, $allowed_extensions)) {
        echo json_encode(["success" => false, "message" => "File format not allowed!"]);
        exit;
    }

    $max_size = 5 * 1024 * 1024;
    if ($_FILES["featured_image"]["size"] > $max_size) {
        echo json_encode(["success" => false, "message" => "File too large! Max 5MB"]);
        exit;
    }

    $random_file_name = uniqid('', true) . '.' . $file_extension;
    $target_file = $target_dir . $random_file_name;

    if (move_uploaded_file($_FILES["featured_image"]["tmp_name"], $target_file)) {
        $featured_image = $random_file_name;
    } else {
        echo json_encode(["success" => false, "message" => "Error moving uploaded file."]);
        exit;
    }
}

try {
    $sql = "INSERT INTO nasa2025.nasa_agua (titulo, categoria, fk_user, geom, descricao, imagem_dest)
            VALUES (:titulo, :categoria, :fk_user, :geom, :descricao, :imagem_dest)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':titulo', $title, PDO::PARAM_STR);
    $stmt->bindParam(':categoria', $category, PDO::PARAM_STR);
    $stmt->bindParam(':fk_user', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->bindParam(':geom', $geom, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $content, PDO::PARAM_STR);
    $stmt->bindParam(':imagem_dest', $featured_image, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Save successful"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error saving to database"]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "PDO Error: " . $e->getMessage()]);
}
?>
