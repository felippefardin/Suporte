<?php
include 'conexao.php';
include 'email.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $resposta = $_POST['resposta'];

    $stmt = $pdo->prepare("SELECT * FROM mensagens_suporte WHERE id = ?");
    $stmt->execute([$id]);
    $msg = $stmt->fetch();

    if ($msg && enviarEmail($msg['email'], 'Resposta ao seu chamado', $resposta)) {
        $update = $pdo->prepare("UPDATE mensagens_suporte SET respondido = 1, data_resposta = NOW() WHERE id = ?");
        $update->execute([$id]);
        echo "Resposta enviada com sucesso!";
    } else {
        echo "Erro ao enviar e-mail.";
    }
}
?>
<a href='painel.php'>Voltar</a>