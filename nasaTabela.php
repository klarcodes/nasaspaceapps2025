<?php
include('./db.php'); // Aqui deve estar a conexão PDO: $ConnPdoPg = new PDO(...)

try {
    // Consulta para selecionar os dados geoespaciais e convertê-los em GeoJSON
    $query = "SELECT *, ST_AsGeoJSON(geom) AS geometry_nasa
              FROM nasa2025.nasa_agua";

    $stmt = $ConnPdoPg->prepare($query);
    $stmt->execute();

    $features = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $feature = [
            "type" => "Feature",
            "geometry" => json_decode($row['geometry_nasa']),
            "properties" => [
                "gid" => $row['gid'],
                "titulo" => $row['titulo'],
                "imagem_dest" => $row['imagem_dest'],
                "descricao" => $row['descricao'],
                "categoria" => $row['categoria']
            ]
        ];
        $features[] = $feature;
    }

    $geojson = [
        "type" => "FeatureCollection",
        "features" => $features
    ];

    echo json_encode($geojson);

} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "PDO Error: " . $e->getMessage()
    ]);
}
?>
