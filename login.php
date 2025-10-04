<?php
// login.php
header('Content-Type: application/json');
session_start();

include('./db.php');

// Recebe os dados em JSON
$data = json_decode(file_get_contents("php://input"), true);
$email = trim($data['email'] ?? '');
$password = trim($data['password'] ?? '');

// Validação inicial
if (empty($email) || empty($password)) {
    echo json_encode(["success" => false, "message" => "Please fill in all fields"]);
    exit;
}

// 🔍 Consulta segura
$sql = "SELECT id, nome, cpf, email, senha FROM nasa2025.usuarios WHERE email = $1 LIMIT 1";
$result = pg_query_params($connPg, $sql, [$email]);

if ($row = pg_fetch_assoc($result)) {
    // Confere senha (armazenada com password_hash)
    if ($password == $row['senha']) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['cpf'] = $row['cpf'];
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['email'] = $row['email'];

        echo json_encode(["success" => true, "message" => "Login successful"]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid password"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "User not found"]);
}



?>