<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'conexao.php';

try {
    $sql = "select id_livro, titulo, ano_publicacao, isbn, quantidade_estoque, preco, id_autor, id_categoria from livros order by titulo";
    $stmt = $pdo->query($sql);
    $livros = $stmt->fetchAll();
    
    echo json_encode([
        'sucesso' => true,
        'livros' => $livros,
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Erro para listar os livros: ' . $e->getMessage(),
    ]);
}
?>