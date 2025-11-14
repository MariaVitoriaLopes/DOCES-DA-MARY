
<?php
    require 'verifica.php';
    exige_login();
    
    require 'config.php';
    
    $user_id = $_SESSION['id']; 

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $query=$pdo->prepare("INSERT INTO avaliacao (nome, estrelas, comentario, user_id) VALUES (?,?,?,?)");
        $query->execute([$_POST['nome'], (int)$_POST['estrelas'], $_POST ['comentario'], $user_id]);

        header("Location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Avaliação - Doces da Mary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="stylepagina.css">
    
</head>
<body class="bg-doce-creme d-flex align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg p-4 custom-login-card">
                    <h1 class="text-center mb-4 custom-heading">Nova Avaliação</h1>
                    
                    <form action="#" method="post">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do produto:</label>
                            <input type="text" name="nome" id="nome" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="estrelas" class="form-label">Estrelas (1 a 5)</label>
                            <input type="number" name="estrelas" id="estrelas" class="form-control" min="1" max="5" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="comentario" class="form-label">Comentário:</label>
                            <textarea name="comentario" id="comentario" class="form-control" rows="4" required></textarea>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <input type="submit" value="Salvar Avaliação" class="btn btn-primary custom-btn-cta">
                        </div>
                    </form>
                    
                    <p class="text-center mt-3">
                        <a href="avaliacoes.php" class="text-secondary custom-btn-link">Voltar para a Lista de Avaliações</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>