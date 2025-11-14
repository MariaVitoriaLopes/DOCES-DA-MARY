<?php

session_start();
require 'config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

  
    $query = $pdo->prepare("SELECT id, nome, senha, nivel, foto FROM usuario WHERE email = ?");
    $query->execute([$email]);
    $usuario = $query->fetch();

   
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        
      
        $_SESSION['logado'] = true;
        $_SESSION['id']     = $usuario['id'];
        $_SESSION['nome']   = $usuario['nome'];
        $_SESSION['nivel']  = $usuario['nivel']; 
        $_SESSION['foto']   = $usuario['foto'];

      
        if ($_SESSION['nivel'] === 'admin') {
            header('Location: dashboard.php'); 
        } else {
            header('Location: index.php');
        }
        exit;
        
    } else {
        $erro = "Email ou senha incorretos.";
    }
    
if (isset($_SESSION['redirect_to']) && $_SESSION['redirect_to'] === "checkout.php") {
    

    if (isset($_SESSION['checkout_servico_id_temp'])) {
        $_SESSION['checkout_servico_id'] = $_SESSION['checkout_servico_id_temp'];
        unset($_SESSION['checkout_servico_id_temp']);
    }
    
    $redirect_url = $_SESSION['redirect_to'];
    unset($_SESSION['redirect_to']); 

    header("Location: " . $redirect_url);
    exit;
}
header("Location: index.php");
exit;
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login -dcoes da mary</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="stylepagina.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-doce-creme d-flex align-items-center justify-content-center vh-100">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                
                <div class="card shadow-lg p-4 custom-login-card">
                    <h2 class="text-center mb-4 custom-heading">Faça login</h2>

                    <?php if (isset($erro)): ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $erro; ?>
                        </div>
                    <?php endif; ?>

                    <form action="" method="post">
                     
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="seuemail@exemplo.com" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control" placeholder="Digite sua senha" required>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <input type="submit" value="Entrar" class="btn btn-primary custom-btn-cta">
                        </div>
                    </form>

                    <p class="text-center mt-3">
                        Não tem cadastro? <a href="create-user.php" class="text-doce-rosa-link">Clique aqui</a>
                    </p>
                    
                    <p class="text-center mt-2">
                        <a href="index.php" class="text-secondary custom-btn-link">Voltar para a Página Inicial</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>