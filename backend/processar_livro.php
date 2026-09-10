<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../frontend/livros.php');
    exit;
}

$titulo = trim($_POST['titulo']);
$ano_publicacao = trim($_POST['ano_publicacao']);
$isbn = trim($_POST['isbn']);
$quantidade_estoque = trim($_POST['quantidade_estoque']);
$preco = $_POST['preco'];
$id_autor = $_POST['id_autor'] != '' ? $_POST['id_autor'] : null;
$id_categoria = $_POST['id_categoria'] != '' ? $_POST['id_categoria'] : null;

// -- validação dos campos -- 

if($titulo == '') {
    header('Location: ../frontend/livros.php?erro=1');
    exit;
}

if($ano_publicacao != '' && ($ano_publicacao < 1000 || $ano_publicacao > 2100)) {
    header('Location: ../frontend/livros.php?erro=2');
    exit;
}

if($quantidade_estoque < 0) {
    header('Location: ../frontend/livros.php?erro=3');
    exit;
}

if($PRECO < 0) {
    header('Location: ../frontend/livros.php?erro=4');
    exit;
}

if($id_autor !== null && $id_autor < 1) {
    header('Location: ../frontend/livros.php?erro=5');
    exit;
}

if($id_categoria !== null && $id_categoria < 1) {
    header('Location: ../frontend/livros.php?erro=6');
    exit;
}

// -- inserção no BD --

$sql = "insert into livros
        (titulo, ano_publicacao, isbn, quantidade_estoque, preco, id_autor, id_categoria) 
            values 
        (:titulo, :ano_publicacao, :isbn, :quantidade_estoque, :preco, :id_autor, :id_categoria)";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':titulo', $titulo);
$stmt->bindValue(':ano_publicacao', $ano_publicacao != '' ? $ano_publicacao : null);
$stmt->bindValue(':isbn', $isbn != '' ? $isbn : null);
$stmt->bindValue(':quantidade_estoque', $quantidade_estoque);
$stmt->bindValue(':preco', $preco);
$stmt->bindValue(':id_autor', $id_autor);
$stmt->bindValue(':id_categoria', $id_categoria);
$stmt->execute();

header('Location: ../frontend/livros.php?sucesso=1');
exit;
?>