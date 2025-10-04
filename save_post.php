<?php
include '../../../db.php';

$title = $_POST['title'];
$content = $_POST['content'];
$category = $_POST['category'];

$featured_image = null;
if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] == UPLOAD_ERR_OK) {
    $target_dir = "../../../../ArquivosEnviados/Website/MediaBlog/CapasPosts/";
    $file_extension = pathinfo($_FILES["featured_image"]["name"], PATHINFO_EXTENSION);
    $random_file_name = uniqid() . '.' . $file_extension;
    $target_file = $target_dir . $random_file_name;

    if (move_uploaded_file($_FILES["featured_image"]["tmp_name"], $target_file)) {
        $featured_image = $random_file_name; // Salva apenas o nome do arquivo e a extensão
    }
}

$stmt = $ConnPdoPg->prepare("INSERT INTO posts (title, content, category_id, featured_image) VALUES (?, ?, ?, ?)");
$stmt->execute([$title, $content, $category, $featured_image]);

header("Location: index.php");
?>
