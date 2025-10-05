<?php
// === CORS ===
// Permite qualquer origem
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


include('./db.php');

// Consulta para selecionar os dados geoespaciais e convertê-los em GeoJSON
$query = "SELECT *, ST_AsGeoJSON(geom) AS geometry_nasa
FROM nasa2025.nasa_agua";

$result = pg_query($connPg, $query);

if (!$result) {
    die("Erro ao executar a consulta.");
}

// Construção do array de GeoJSON
$features = array();

while ($row = pg_fetch_assoc($result)) {
    $feature = array(
        "type" => "Feature",
        "geometry" => json_decode($row['geometry_nasa']),
        "properties" => array(
            "gid" => $row['gid'],
            "titulo" => $row['titulo'],
            "imagem_dest" => $row['imagem_dest'],
            "descricao" => $row['descricao'],
            "categoria" => $row['categoria']
        )
    );
    array_push($features, $feature);
}

$geojson = array(
    "type" => "FeatureCollection",
    "features" => $features
);

echo json_encode($geojson);

pg_close($connPg);
?>