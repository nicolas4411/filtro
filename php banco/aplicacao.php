<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Feedback - Video Game</title>
    <link rel="stylesheet" href="aplicacao.css"> <!-- Arquivo CSS opcional para estilizar -->
</head>
<body>
    <div class="container">
        <h1>Feedback sobre Preferencia de Jogo</h1>
        
        <form action="process_feedback.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>

            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" placeholder="Digite sua idade" required min="1">

            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" required>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outro">Outro</option>
            </select>

            <label for="genero_jogo">Gênero de Jogo Preferido:</label>
            <select id="genero_jogo" name="genero_jogo" required>
                <option value="Ação">Ação</option>
                <option value="Aventura">Aventura</option>
                <option value="Estratégia">Estratégia</option>
                <option value="Simulação">Simulação</option>
                <option value="RPG">RPG</option>
                <option value="Esportes">Esportes</option>
                <option value="Corrida">Corrida</option>
                <option value="Terror">Terror</option>
                <option value="Outro">Outro</option>
            </select>

            <button type="submit">Enviar Feedback</button>
            <a href="pagina_principal.php" class="btn">inicio</a>
            <a href="preferencia.php" class="btn">filtro</a>
        </form>
    </div>
</body>
</html>
