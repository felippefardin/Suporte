<?php
include 'conexao.php';

$agora = new DateTime();
$stmt = $pdo->query("SELECT * FROM mensagens_suporte ORDER BY 
    (respondido = 0 AND TIMESTAMPDIFF(DAY, data_envio, NOW()) >= 5) DESC,
    respondido ASC, data_envio DESC");

echo "<h2>Mensagens de Suporte</h2><hr>";

foreach ($stmt as $msg) {
    $dataEnvio = new DateTime($msg['data_envio']);
    $dias = $dataEnvio->diff($agora)->days;
    $estilo = '';

    if (!$msg['respondido'] && $dias >= 5) {
        $estilo = 'style=\"background: #fdd; border: 2px solid red;\"';
    }

    echo "<div $estilo>
            <p><strong>Nome:</strong> {$msg['nome']}</p>
            <p><strong>E-mail:</strong> {$msg['email']}</p>
            <p><strong>Assunto:</strong> {$msg['assunto']}</p>
            <p><strong>Mensagem:</strong> {$msg['mensagem']}</p>
            <p><strong>Data:</strong> {$msg['data_envio']}</p>";

    if ($msg['respondido']) {
        echo "<p style='color: green;'><strong>Status:</strong> Respondido</p>";
    } else {
        echo "
        <form action='responder.php' method='POST'>
            <input type='hidden' name='id' value='{$msg['id']}'>
            <textarea name='resposta' placeholder='Digite a resposta'></textarea><br>
            <button type='submit'>Enviar Resposta</button>
        </form>";
    }

    echo "<hr></div>";
}
?>