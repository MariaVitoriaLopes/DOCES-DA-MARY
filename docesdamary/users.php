<?php
session_start();
require 'config.php';
if (!isset($_SESSION['logado']) || $_SESSION['nivel'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$query = $pdo->query("SELECT id, nome, email, nivel FROM usuario ORDER BY nivel DESC, nome ASC");
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

$nome_admin = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Usuários Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
       <link rel="stylesheet" href="stylepagina.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Gerenciamento de Usuários</h1>
        <p>Olá, <?php echo htmlspecialchars($nome_admin); ?> | <a href="dashboard.php">Área admin</a> | <a href="logout.php">Sair</a></p>

        <?php if (empty($usuarios)): ?>
            <div class="alert alert-info">Nenhum usuário cadastrado.</div>
        <?php else: ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Nível</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr class="<?php echo ($u['nivel'] == 'admin') ? 'table-warning' : ''; ?>">
                            <td><?php echo htmlspecialchars($u['id']); ?></td>
                            <td><?php echo htmlspecialchars($u['nome']); ?></td>
                            <td><?php echo htmlspecialchars($u['email']); ?></td>
                            <td><?php echo ucfirst($u['nivel']); ?></td>
                            <td>
                                <?php if ($u['id'] != $_SESSION['id']): ?>
                                    <a href="deleteservico.php?tipo=usuario&id=<?php echo $u['id']; ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Excluir este Usuário?');">Excluir</a>
                                <?php else: ?>
                                    <span class="text-muted small">Você</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>