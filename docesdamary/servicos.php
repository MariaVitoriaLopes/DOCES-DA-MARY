<?php
session_start();
require 'config.php';


if (!isset($_SESSION['logado']) || $_SESSION['nivel'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$query = $pdo->query("SELECT id, titulo, preco FROM servico ORDER BY id ASC");
$servicos = $query->fetchAll(PDO::FETCH_ASSOC);

$nome_admin = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Serviços Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stylepagina.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Produtos</h1>
        <p>Olá, <?php echo htmlspecialchars($nome_admin); ?> | <a href="dashboard.php">Área admin</a> | <a href="logout.php">Sair</a></p>

        <div class="d-flex justify-content-end mb-3">
            <a href="novoservico.php" class="btn btn-primary">+ Novo Serviço</a>
        </div>

        <?php if (empty($servicos)): ?>
            <div class="alert alert-info">Nenhum serviço cadastrado.</div>
        <?php else: ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($servicos as $s): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($s['id']); ?></td>
                            <td><?php echo htmlspecialchars($s['titulo']); ?></td>
                            <td>R$ <?php echo number_format($s['preco'], 2, ',', '.'); ?></td>
                            <td>
                                <a href="novoservico.php?id=<?php echo $s['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="deleteservico.php?tipo=servico&id=<?php echo $s['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Excluir este Serviço?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif; ?>
        
    </div>
</body>
</html>