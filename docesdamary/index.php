<?php
    session_start();
    require 'config.php'; 

    
    $query = $pdo->query("SELECT id, titulo, descricao, foto, preco FROM servico ORDER BY id ASC");
    $servicos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doces da Mary - Sabores que Encantam</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="stylepagina.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top custom-navbar shadow-sm">
            <div class="container">
                <a class="navbar-brand logo-doce" href="#inicio">Doces da Mary</a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="#inicio">Início</a></li>
                        <li class="nav-item"><a class="nav-link" href="#produtos">Produtos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#quemsomos">Quem Somos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#avaliacoes">Depoimentos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
                        <?php 

    if (isset($_SESSION['logado']) && $_SESSION['logado'] === true): 
?>

    <li class="nav-item d-flex align-items-center">

        <?php 
        if (!empty($_SESSION['foto'])): ?>
            <img src="<?php echo htmlspecialchars($_SESSION['foto']); ?>" 
                 alt="Foto de <?php echo htmlspecialchars($_SESSION['nome']); ?>"
                 style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
        <?php endif; ?>

        <span class="navbar-text me-3">
            Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?>
        </span>

        <a href="logout.php" class="btn btn-outline-danger btn-sm rounded-pill">Sair</a>
    </li>

<?php else: ?>

    <li class="nav-item ms-lg-3">
        <a href="login.php" class="btn btn-outline-primary btn-sm rounded-pill custom-btn-login">Login/Cadastro</a>
    </li>

<?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section id="inicio" class="hero text-white d-flex align-items-center justify-content-center text-center py-5">
        <div class="container">
            <div class="p-5 hero-content">
                <h1 class="display-3 fw-bold mb-3">Descubra o Sabor da Felicidade</h1>
                <p class="lead mb-4">Doces frescos e deliciosos, feitos com os melhores ingredientes e muito carinho, como você merece.</p>
                <a href="#produtos" class="btn btn-primary btn-lg custom-btn-cta shadow">Ver Cardápio Completo</a>
            </div>
        </div>
    </section>

    <section id="produtos" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 custom-heading">Nossas Especialidades</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php 
            if ($servicos) {
                foreach ($servicos as $servico) {
            ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <img src="<?php echo htmlspecialchars($servico['foto']); ?>" 
                         class="card-img-top custom-img-placeholder" 
                         alt="<?php echo htmlspecialchars($servico['titulo']); ?>">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?php echo htmlspecialchars($servico['titulo']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($servico['descricao']); ?></p>
                        <p class="card-text"><strong>Preço: R$ <?php echo number_format($servico['preco'], 2, ',', '.'); ?></strong></p>
                        
                        <a href="compra.php?id=<?php echo $servico['id']; ?>" class="btn btn-sm custom-btn-secundario">Comprar</a>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>

    <section id="quemsomos" class="py-5 bg-white">
        <div class="container text-center">
            <h2 class="mb-4 custom-heading">Nossa História Doce</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="lead">Somos apaixonados por confeitaria e acreditamos que um doce tem o poder de transformar um dia. Desde 2024, levamos carinho e ingredientes de alta qualidade para a sua mesa, criando sabores que você não encontra em outro lugar.</p>
                    <p>Nossa missão é adoçar vidas, um pedido de cada vez. Usamos receitas clássicas e inovamos com toques modernos.</p>
                    <a href="https://www.instagram.com/m4riiaxx?igsh=MWUxN2NhczMyMmlxaA%3D%3D&utm_source=qr " class="btn btn-sm mt-3 btn-link text-primary custom-btn-link">Conheça nossa fundadora</a>
                </div>
            </div>
        </div>
    </section>

    <section id="avaliacoes" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 custom-heading">O Que Nossos Clientes Dizem</h2>
            <div class="row justify-content-center">
                
                <div class="col-md-6 mb-4">
                    <div class="card custom-depoimento-card p-3 shadow-sm border-0">
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p class="text-secondary fst-italic">"Os melhores doces que já provei! O bolo de chocolate é divino e o atendimento sempre atencioso."</p>
                                <footer class="blockquote-footer mt-2">Maria.</footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="card custom-depoimento-card p-3 shadow-sm border-0">
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p class="text-secondary fst-italic">"Qualidade e atendimento impecáveis. Recomendo o brigadeiro gourmet para todos os eventos!"</p>
                                <footer class="blockquote-footer mt-2">Mary.</footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 text-center mt-3">
                    <a href="avaliacoes.php" class="btn btn-outline-primary custom-btn-secundario">Ver Todas as Avaliações</a>
                </div>
            </div>
        </div>
    </section>

    <section id="contato" class="py-5 custom-contato-bg">
        <div class="container">
            <h2 class="text-center mb-4 custom-heading">Faça o Seu Pedido</h2>
            <p class="text-center mb-4 lead">Fale conosco para orçamentos personalizados, eventos ou pedidos especiais.</p>
            
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form action="processa_contato.php" method="POST" class="bg-white p-4 rounded shadow">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Seu Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu Nome Completo" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Seu E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="email@exemplo.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensagem" class="form-label">Mensagem/Detalhes do Pedido</label>
                            <textarea class="form-control" id="mensagem" name="mensagem" rows="5" placeholder="Descrição do que você deseja" required></textarea>
                        </div>
                        <div class="d-grid">
                           <a href=" " class="btn btn-primary custom-btn-cta">Enviar Pedido</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4 custom-footer">
        <div class="container text-center">
            <p class="mb-1">&copy; 2025 Doces da Mary. Todos os direitos reservados.</p>
            <p class="mb-0">Endereço: Rua ernesto josé guerra , 315 | Telefone: (13) 99169-0634</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>