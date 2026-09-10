<?php
declare(strict_types=1);

$host = 'localhost';
$porta = '3306';
$usuario = 'root';
$senha = '';

try {
    $pdo = new PDO(
        "mysql:host={$host};port={$porta};dbname{$banco};charset=utf8mb4", $usuario, $senha, 
        [ 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FECT_MODE => PDO::FETCH ASSOC,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Erro para conectar no banco de dados: ' . $e->getMessage(),
    ]);
    exit;
}
?>