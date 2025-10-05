<?php
header('Content-Type: application/json');
session_start();

include('./db.php');

// Receive fields sent via FormData
$title = trim($_POST['title'] ?? '');
$category = trim($_POST['categoria'] ?? '');
$content = $_POST['content'] ?? ''; // if you also want to save a description
$gid = $_POST['gid'] ?? ''; // if you also want to save an ID

// Basic validation
if (empty($title) || empty($category)) {
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

// Update record (gid=3 as example)
$sql = "UPDATE nasa2025.nasa_agua
        SET titulo=$1, categoria=$2, fk_user=$3, descricao=$4" .
       ($featured_image ? ", imagem_dest=$5" : "") .
       " WHERE gid = '".$gid."';";

// Build parameters dynamically
$params = [$title, $category, $_SESSION['user_id'], $content];
if ($featured_image) $params[] = $featured_image;

$result = pg_query_params($connPg, $sql, $params);

if ($result) {
    echo json_encode(["success" => true, "message" => "Update successful"]);
} else {
    echo json_encode(["success" => false, "message" => "Error updating record"]);
}
?>
