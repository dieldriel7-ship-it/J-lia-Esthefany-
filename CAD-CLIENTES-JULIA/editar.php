<?php
require "config/conexao.php";

$id = $_GET["id"] ?? null;
if (!$id) {
    die("Cliente não informado.");
}

$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = :id");
$stmt->execute([":id" => $id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    die("Cliente não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Cliente</h1>
        
        <form method="POST" action="atualizar.php">
            <!-- Campo oculto para enviar o ID do cliente -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($cliente['id']) ?>">
            
            <div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($cliente['nome'] ?? '') ?>" required>
            </div>

            <div>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($cliente['email'] ?? '') ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>