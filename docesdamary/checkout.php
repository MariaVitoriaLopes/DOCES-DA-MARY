<?php
session_start();
require 'config.php'; 


if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    $_SESSION['redirect_to'] = "checkout.php"; 
    header("Location: login.php");
    exit;
}


if (!isset($_SESSION['checkout_servico_id'])) {
    
    header("Location: index.php#produtos");
    exit;
}

$servico_id = $_SESSION['checkout_servico_id'];
$servico = null;


try {
    $stmt = $pdo->prepare("SELECT id, titulo, descricao, foto, preco FROM servico WHERE id = :id");
    $stmt->bindValue(':id', $servico_id, PDO::PARAM_INT);
    $stmt->execute();
    $servico = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$servico) {
        throw new Exception("Produto não encontrado.");
    }

} catch (Exception $e) {
    echo "Erro ao carregar o produto: " . $e->getMessage();
    exit;
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Doces da Mary - Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stylepagina.css"> </head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-5 custom-heading">Finalizar Pedido</h1>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Produto Selecionado</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?php echo htmlspecialchars($servico['foto']); ?>" 
                                     class="img-fluid rounded" 
                                     alt="<?php echo htmlspecialchars($servico['titulo']); ?>">
                            </div>
                            <div class="col-md-8">
                                <h3><?php echo htmlspecialchars($servico['titulo']); ?></h3>
                                <p class="text-muted"><?php echo htmlspecialchars($servico['descricao']); ?></p>
                                <p class="lead fw-bold text-success">
                                    Preço: R$ <?php echo number_format($servico['preco'], 2, ',', '.'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-lg">
                    <div class="card-header">
                        <h5>Detalhes do Cliente </h5>
                    </div>
                    <div class="card-body">
                        <h5>Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?>! Seu pedido está quase finalizado</h5>
                        
                        <form action="processa_pedido.php" method="POST">
                            <input type="hidden" name="servico_id" value="<?php echo $servico['id']; ?>">
                            
                            <div class="mb-3">
                                <label for="quantidade" class="form-label">Quantidade</label>
                                <input type="number" class="form-control" id="quantidade" name="quantidade" value="1" min="1" required>
                            </div>
                            
                            <div class="d-grid mt-4">
                                <a href="avaliacoes.php" type="submit" class="btn btn-primary btn-lg custom-btn-cta">Finalizar Pedido</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>