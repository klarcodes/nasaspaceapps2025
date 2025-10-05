<?php
header('Content-Type: application/json');
session_start();

include('./db.php'); // Aqui deve estar a conexão PDO: $pdo = new PDO(...)

// Receive fields sent via FormData
$title = trim($_POST['title'] ?? '');
$category = trim($_POST['categoria'] ?? '');
$content = $_POST['content'] ?? '';
$gid = $_POST['gid'] ?? '';

// Basic validation
if (empty($title) || empty($category) || empty($gid)) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

// Optional image upload
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
        echo json_encode(["success" => false, "message" => "Error moving the uploaded file."]);
        exit;
    }
}

try {
    // Build SQL dynamically
    $sql = "UPDATE nasa2025.nasa_agua
            SET titulo = :titulo, categoria = :categoria, fk_user = :fk_user, descricao = :descricao";

    if ($featured_image) {
        $sql .= ", imagem_dest = :imagem_dest";
    }

    $sql .= " WHERE gid = :gid";

    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':titulo', $title, PDO::PARAM_STR);
    $stmt->bindParam(':categoria', $category, PDO::PARAM_STR);
    $stmt->bindParam(':fk_user', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->bindParam(':descricao', $content, PDO::PARAM_STR);
    if ($featured_image) {
        $stmt->bindParam(':imagem_dest', $featured_image, PDO::PARAM_STR);
    }
    $stmt->bindParam(':gid', $gid, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Update successful"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error updating record"]);
    }

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "PDO Error: " . $e->getMessage()]);
}
?>
