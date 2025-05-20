CREATE TABLE mensagens_suporte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    assunto VARCHAR(255),
    mensagem TEXT,
    respondido BOOLEAN DEFAULT FALSE,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_resposta DATETIME
);