<?php
// Defina as credenciais de conexão
$servername = "localhost";  // Servidor MySQL, geralmente localhost
$username = "root";         // Usuário do MySQL, no XAMPP é 'root'
$password = "";             // Senha do MySQL (no XAMPP, geralmente é vazia)
$dbname = "feedback_db";    // Nome do banco de dados onde a tabela foi criada

// Criar conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Receber os dados do formulário
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo'];
$genero_jogo = $_POST['genero_jogo'];

// Preparar a consulta SQL
$stmt = $conn->prepare("INSERT INTO feedback (nome, idade, sexo, genero_jogo) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siss", $nome, $idade, $sexo, $genero_jogo);  // "s" para string, "i" para inteiro

// Executar a consulta
if ($stmt->execute()) {
    // Mensagem de sucesso com redirecionamento após 3 segundos
    echo "Feedback enviado com sucesso!";
    echo "<script>
            setTimeout(function() {
                window.location.href = 'aplicacao.php';  // Altere para o nome do arquivo do seu formulário
            }, 3000);  // Redireciona após 3 segundos
          </script>";
} else {
    echo "Erro ao enviar o feedback: " . $stmt->error;
}

// Fechar a conexão
$stmt->close();
$conn->close();
?>


<style>
/* Estilos gerais do corpo e fonte */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container {
    width: 60%;
    max-width: 800px;
    background-color: #fff;
    padding: 30px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h1 {
    text-align: center;
    color: #333;
    font-size: 28px;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

/* Estilo dos rótulos (labels) */
label {
    font-size: 14px;
    margin-bottom: 6px;
    color: #555;
}

/* Estilos para os campos de entrada (input e select) */
input, select {
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

/* Estilo para o botão de envio */
button {
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #45a049;
}

/* Media Queries para telas menores */

/* Para dispositivos com largura de até 768px (tablets e celulares pequenos) */
@media (max-width: 768px) {
    .container {
        width: 90%;
        padding: 20px;
    }

    h1 {
        font-size: 24px;
    }

    label {
        font-size: 12px;
    }

    input, select {
        font-size: 14px;
        padding: 10px;
    }

    button {
        font-size: 14px;
        padding: 10px;
    }
}

/* Para dispositivos com largura de até 480px (celulares muito pequenos) */
@media (max-width: 480px) {
    .container {
        width: 95%;
        margin: 10px auto;
        padding: 15px;
    }

    h1 {
        font-size: 22px;
    }

    label {
        font-size: 12px;
    }

    input, select {
        font-size: 14px;
        padding: 8px;
    }

    button {
        font-size: 14px;
        padding: 10px;
    }
}
</style>

