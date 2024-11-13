<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferências de Jogos</title>
    <style>
        /* Estilos gerais do corpo e fundo */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container principal */
        .container {
            width: 80%;
            max-width: 900px;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        /* Título da página */
        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Subtítulo do total de participantes */
        .total-participantes {
            font-size: 18px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        /* Tabela de dados */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        /* Estilo para cabeçalhos da tabela */
        table th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        /* Estilo para linhas da tabela */
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        /* Mensagem caso não haja resultados */
        .no-results {
            font-size: 18px;
            color: #e74c3c;
            margin-top: 20px;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            table th,
            table td {
                font-size: 14px;
                padding: 10px;
            }

            h2 {
                font-size: 20px;
            }
        }

        /* Estilo para os botões de link */
        .btn,
        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: blue;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <a href="pagina_principal.php" class="btn">inicio</a><br>
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

        // Função para exibir o total de participantes
        function exibirTotalParticipantes($conn)
        {
            // Consulta SQL para contar o total de participantes
            $sql = "SELECT COUNT(*) as total_participantes FROM feedback";
            $result = $conn->query($sql);

            // Verificar se há resultados
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<div class='total-participantes'>Total de Participantes: " . $row['total_participantes'] . "</div>";
            } else {
                echo "<div class='no-results'>Nenhum feedback encontrado.</div>";
            }
        }

        // Função para exibir preferências de jogos
        function exibirPreferenciasPorJogo($conn)
        {
            // Consulta SQL para agrupar as preferências por idade, sexo e tipo de jogo
            $sql = "SELECT idade, sexo, genero_jogo, COUNT(*) as total
                    FROM feedback
                    GROUP BY idade, sexo, genero_jogo
                    ORDER BY idade, sexo, total DESC";

            // Executar a consulta
            $result = $conn->query($sql);

            // Verificar se há resultados
            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Idade</th>
                            <th>Sexo</th>
                            <th>Gênero de Jogo</th>
                            <th>Total</th>
                        </tr>";

                // Exibir os resultados
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['idade'] . "</td>
                            <td>" . $row['sexo'] . "</td>
                            <td>" . $row['genero_jogo'] . "</td>
                            <td>" . $row['total'] . "</td>
                          </tr>";
                }

                echo "</table>";
            } else {
                echo "<div class='no-results'>Nenhum feedback encontrado.</div>";
            }
        }

        // Exibir total de participantes
        exibirTotalParticipantes($conn);

        // Chamar a função para exibir as preferências
        exibirPreferenciasPorJogo($conn);

        // Fechar a conexão
        $conn->close();
        ?>
    </div>

</body>

</html>