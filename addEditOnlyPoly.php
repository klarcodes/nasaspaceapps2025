<?php
header('Content-Type: application/json');
session_start();

include('./db.php');

$data = json_decode(file_get_contents("php://input"), true);
$geom = $data['geom'] ?? null;
$gid = $data['gid'] ?? null;

// file_put_contents('debug.txt', print_r($data, true)); // 👈 debug

// Validação mínima
if (empty($geom) && empty($gid)) {
    echo json_encode(["success" => false, "message" => "Todos os campos são obrigatórios", 'gid' => $gid,
  'geom' => $geom]);
    exit;
}


// Atualiza o registro (gid=3 como exemplo)
$sql = "UPDATE nasa2025.nasa_agua
        SET geom=$1 WHERE gid = '".$gid."';";

// Monta os parâmetros dinamicamente
$params = [$geom];


$result = pg_query_params($connPg, $sql, $params);

if ($result) {
    echo json_encode([
  'success' => true,
  'message' => "Geometria atualizada com sucesso!",
  'gid' => $gid,
  'geom' => $geom
]);
} else {
    echo json_encode(["success" => false, "message" => "Erro ao atualizar o registro"]);
}
?>
