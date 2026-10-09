<?php
require "config/conexao.php";

$stmt = $pdo->query("SELECT * FROM clientes ORDER BY id DESC");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Clientes</title>
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Folha de Estilos -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container">
        <div class="header-action">
            <h1><i class="fa-solid fa-users"></i> Lista de Clientes</h1>
            <a href="cadastro.php" class="btn btn-primary">
                <i class="fa-solid fa-user-plus"></i> Novo Cliente
            </a>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Cidade</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($clientes)): ?>
                        <tr>
                            <td colspan="4" class="text-center empty-message">Nenhum cliente cadastrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente["nome"]) ?></td>
                            <td><?= htmlspecialchars($cliente["email"]) ?></td>
                            <td><?= htmlspecialchars($cliente["cidade"]) ?></td>
                            <td class="text-center actions">
                                <a href="editar.php?id=<?= $cliente['id'] ?>" class="btn btn-icon btn-edit" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="excluir.php?id=<?= $cliente['id'] ?>" class="btn btn-icon btn-delete btn-excluir" title="Excluir" onclick="return confirm('Deseja realmente excluir este cliente?');">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>