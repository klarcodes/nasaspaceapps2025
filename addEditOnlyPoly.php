<?php
header('Content-Type: application/json');
session_start();

include('./db.php'); // Aqui deve ter a conexão PDO, por exemplo: $pdo = new PDO(...);

$data = json_decode(file_get_contents("php://input"), true);
$geom = $data['geom'] ?? null;
$gid = $data['gid'] ?? null;

// Basic validation
if (empty($geom) && empty($gid)) {
    echo json_encode([
        "success" => false,
        "message" => "All fields are required",
        'gid' => $gid,
        'geom' => $geom
    ]);
    exit;
}

try {
    // Prepare statement using named parameters
    $sql = "UPDATE nasa2025.nasa_agua
            SET geom = :geom
            WHERE gid = :gid";

    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':geom', $geom, PDO::PARAM_STR);
    $stmt->bindParam(':gid', $gid, PDO::PARAM_INT);

    // Execute
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => "Geometry updated successfully!",
            'gid' => $gid,
            'geom' => $geom
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Error updating record"
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "PDO Error: " . $e->getMessage()
    ]);
}
?>
