<?php
// login.php
header('Content-Type: application/json');
session_start();

include('./db.php'); // Conexão PDO ($pdo)

// Recebe os dados em JSON
$data = json_decode(file_get_contents("php://input"), true);
$email = trim($data['email'] ?? '');
$password = trim($data['password'] ?? '');

// Validação inicial
if (empty($email) || empty($password)) {
    echo json_encode(["success" => false, "message" => "Please fill in all fields"]);
    exit;
}

try {
    // Consulta segura usando PDO
    $sql = "SELECT id, nome, cpf, email, senha FROM nasa2025.usuarios WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Se a senha estiver com hash, use password_verify:
        // if (password_verify($password, $row['senha'])) { ... }
        // Caso esteja em texto puro, apenas compare:
        if ($password === $row['senha']) {
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

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "PDO Error: " . $e->getMessage()]);
}
?>
