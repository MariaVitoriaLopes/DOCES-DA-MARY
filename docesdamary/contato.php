<?php
session_start();
require 'config.php';
if (!isset($_SESSION['logado']) || $_SESSION['nivel'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$query = $pdo->query("SELECT id, nome, email, mensagem, data_envio FROM contato ORDER BY data_envio DESC");
$mensagens = $query->fetchAll(PDO::FETCH_ASSOC);

$nome_admin = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contatos Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
       <link rel="stylesheet" href="stylepagina.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Mensagens de Contato</h1>
        <h2>Olá, <?php echo htmlspecialchars($nome_admin); ?> | <a href="dashboard.php">Area admin</a> | <a href="logout.php">Sair</a></h2>

        <?php if (empty($mensagens)): ?>
            <div class="alert alert-info">Nenhuma mensagem recebida.</div>
        <?php else: ?>
            <div class="list-group">
                <?php foreach ($mensagens as $m): ?>
                    <div class="list-group-item list-group-item-action flex-column align-items-start mb-3 border-secondary">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?php echo htmlspecialchars($m['nome']); ?> <small class="text-muted">(<?php echo htmlspecialchars($m['email']); ?>)</small></h5>
                            <small><?php echo date('d/m/Y H:i', strtotime($m['data_envio'])); ?></small>
                        </div>
                        <p class="mb-1 mt-2"><?php echo nl2br(htmlspecialchars($m['mensagem'])); ?></p>
                        <small class="text-end d-block">
                            <a href="delete.php?tipo=contato&id=<?php echo $m['id']; ?>" 
                               class="btn btn-sm btn-danger mt-2" 
                               onclick="return confirm('Excluir esta Mensagem?');">Excluir</a>
                        </small>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>