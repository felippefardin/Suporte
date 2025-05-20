<?php
// conexao.php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=suporte", "root", "");
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
