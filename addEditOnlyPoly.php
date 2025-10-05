<?php
header('Content-Type: application/json');
session_start();

include('./db.php');

$data = json_decode(file_get_contents("php://input"), true);
$geom = $data['geom'] ?? null;
$gid = $data['gid'] ?? null;

// file_put_contents('debug.txt', print_r($data, true)); // 👈 debug

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

// Update record
$sql = "UPDATE nasa2025.nasa_agua
        SET geom=$1 WHERE gid = '".$gid."';";

// Build parameters dynamically
$params = [$geom];

$result = pg_query_params($connPg, $sql, $params);

if ($result) {
    echo json_encode([
        'success' => true,
        'message' => "Geometry updated successfully!",
        'gid' => $gid,
        'geom' => $geom
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Error updating record"]);
}
?>
