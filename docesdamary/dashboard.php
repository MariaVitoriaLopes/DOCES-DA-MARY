<?php
session_start();
require 'config.php';

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
 
    header('Location: login.php');
    exit;
}

if ($_SESSION['nivel'] !== 'admin') {
   
    header('Location: index.php'); 
    exit;
}
$nome_admin = $_SESSION['nome'];
$foto_admin = $_SESSION['foto'];
$total_avaliacoes = $pdo->query("SELECT COUNT(*) FROM avaliacao")->fetchColumn();
$total_servicos = $pdo->query("SELECT COUNT(*) FROM servico")->fetchColumn();
$total_usuarios = $pdo->query("SELECT COUNT(*) FROM usuario")->fetchColumn();


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Doces da Mary</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stylepagina.css">
    
    </head>
<body class="bg-doce-creme">

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark custom-navbar-admin shadow-sm">
            <div class="container">
                <a class="navbar-brand logo-doce" href="dashboard.php">Admin: Doces da Mary</a>
                
                <div class="d-flex align-items-center ms-auto">
                    <?php if (!empty($foto_admin)): ?>
                        <img src="<?php echo htmlspecialchars($foto_admin); ?>" 
                             alt="Foto de Admin"
                             style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px; border: 2px solid white;">
                    <?php endif; ?>
                    <span class="navbar-text me-3 text-white">
                        Olá, **<?php echo htmlspecialchars($nome_admin); ?>**
                    </span>
                   <div class="d-flex justify-content-end mb-3">
            <a href="novoservico.php" class="btn btn-primary">Sair da Conta</a>
        </div>

                </div>
            </div>
        </nav>
    </header>

    <div class="container my-5">
        <h1 class="text-center mb-5 custom-heading-admin">Area Admin</h1>

        <div class="row g-4 justify-content-center">
            
            <div class="col-md-6 col-lg-5">
                <div class="card h-100 shadow custom-card-roxo text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                        <h5 class="card-title fs-3 mb-3 text-uppercase fw-bold">Avaliações</h5>
                        <p class="card-text fs-1 fw-bolder mb-3 text-doce-rosa"><?php echo $total_avaliacoes; ?></p>
                        <p class="card-text text-muted">Visualizar e excluir depoimentos.</p>
                        <a href="avaliaadmin.php" class="btn custom-btn-rosa mt-auto w-75">Gerenciar Avaliações</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5">
                <div class="card h-100 shadow custom-card-roxo text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                        <h5 class="card-title fs-3 mb-3 text-uppercase fw-bold"> Produtos</h5>
                        <p class="card-text fs-1 fw-bolder mb-3 text-doce-rosa"><?php echo $total_servicos; ?></p>
                        <p class="card-text text-muted">Cadastrar, editar e excluir itens.</p>
                        <a href="servicos.php" class="btn custom-btn-rosa mt-auto w-75">Gerenciar Produtos</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5">
                <div class="card h-100 shadow custom-card-roxo text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                        <h5 class="card-title fs-3 mb-3 text-uppercase fw-bold"> Mensagens</h5>
                        <p class="card-text fs-1 fw-bolder mb-3 text-doce-rosa">Ver</p>
                        <p class="card-text text-muted">Visualizar e excluir mensagens de clientes.</p>
                        <a href="contato.php" class="btn custom-btn-rosa mt-auto w-75">Acessar Contatos</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5">
                <div class="card h-100 shadow custom-card-roxo text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                        <h5 class="card-title fs-3 mb-3 text-uppercase fw-bold">Usuários</h5>
                        <p class="card-text fs-1 fw-bolder mb-3 text-doce-rosa"><?php echo $total_usuarios; ?></p>
                        <p class="card-text text-muted">Gerenciar clientes e administradores.</p>
                        <a href="users.php" class="btn custom-btn-rosa mt-auto w-75">Gerenciar Usuários</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>