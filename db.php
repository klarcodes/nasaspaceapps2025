<?php 
// Configurações para PostgreSQL
$pg_host = "45.232.39.215";
$pg_dbname = "klar_nasa_bv";
$pg_user = "ronnald";
$pg_password = "RR@cads#2024";


// Criar conexão PostgreSQL
// $connPg = pg_connect("host=$pg_host dbname=$pg_dbname user=$pg_user password=$pg_password");

// // Verificar conexão PostgreSQL
// if (!$connPg) {
//     die("Falha na conexão PostgreSQL: " . pg_last_error());
// }


// Exemplo de conexão PDO
try {
    $ConnPdoPg = new PDO("pgsql:host=$pg_host;dbname=$pg_dbname", $pg_user, $pg_password);
    $ConnPdoPg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

?>