<?php
// login.php
header('Content-Type: application/json');
session_start();

include('./db.php');

$urlArquivos = './imagens/';

// Recebe os dados em JSON
$data = json_decode(file_get_contents("php://input"), true);
// $email = trim($data['email'] ?? '');
// $password = trim($data['password'] ?? '');

$title = trim($data['title'] ?? '');
$categoria = trim($data['categoria'] ?? '');
$geom = trim($data['geom'] ?? '');

// Validação inicial
// if (empty($email) || empty($password)) {
//     echo json_encode(["success" => false, "message" => "Please fill in all fields"]);
//     exit;
// }

$sql = "UPDATE nasa2025.nasa_agua
	SET titulo=$1, categoria=$2, fk_user=$3, geom=$4
	WHERE gid = 3;";
$result = pg_query_params($connPg, $sql, [$title, $categoria, $_SESSION['user_id'], $geom]);

if ($result) {
    // Confere senha (armazenada com password_hash)
    // if ($password == $row['senha']) {
    //     $_SESSION['user_id'] = $row['id'];
    //     $_SESSION['cpf'] = $row['cpf'];
    //     $_SESSION['nome'] = $row['nome'];
    //     $_SESSION['email'] = $row['email'];

        echo json_encode(["success" => true, "message" => "Save successful"]);
    // } else {
    //     echo json_encode(["success" => false, "message" => "Invalid password"]);
    // }
} else {
    echo json_encode(["success" => false, "message" => "Row not found"]);
}

// 🔍 Consulta segura
// $sql = "SELECT id, nome, cpf, email, senha FROM nasa2025.usuarios WHERE email = $1 LIMIT 1";
// $result = pg_query_params($connPg, $sql, [$email]);

// if ($row = pg_fetch_assoc($result)) {
//     // Confere senha (armazenada com password_hash)
//     if ($password == $row['senha']) {
//         $_SESSION['user_id'] = $row['id'];
//         $_SESSION['cpf'] = $row['cpf'];
//         $_SESSION['nome'] = $row['nome'];
//         $_SESSION['email'] = $row['email'];

//         echo json_encode(["success" => true, "message" => "Login successful"]);
//     } else {
//         echo json_encode(["success" => false, "message" => "Invalid password"]);
//     }
// } else {
//     echo json_encode(["success" => false, "message" => "User not found"]);
// }



?>