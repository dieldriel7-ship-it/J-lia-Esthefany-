<?php
require "config/conexao.php";

// Garante que o acesso foi feito via método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recebe e valida os dados
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? ''); // Ajuste conforme os campos da sua tabela

    // Validação que gerava o erro "dados inválidos" caso estivesse incompleta
    if (!$id || empty($nome)) {
        die("Dados inválidos. O ID e o nome são obrigatórios.");
    }

    try {
        // Prepara a query de atualização
        $sql = "UPDATE clientes SET nome = :nome, email = :email WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            ':nome'  => $nome,
            ':email' => $email,
            ':id'    => $id
        ]);

        // Redireciona para a lista ou exibe sucesso (altere 'index.php' para sua página de listagem)
        header("Location: index.php?sucesso=1");
        exit;

    } catch (PDOException $e) {
        die("Erro ao atualizar os dados: " . $e->getMessage());
    }
} else {
    // Se acessado diretamente via URL, redireciona para a página inicial
    header("Location: index.php");
    exit;
}
?>