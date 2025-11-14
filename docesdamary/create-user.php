
<?php
    require 'config.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK ){
            $extensao = pathinfo($_FILES['foto'] ['name'], PATHINFO_EXTENSION);
            $nome_arquivo = uniqid('user_', true) . '.' . $extensao;
            $caminho_foto = 'images/users/' . $nome_arquivo;

            if(!move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_foto)){
                echo 'Erro ao salvar a foto';
            }
        }else{
            echo ' Erro no upload da foto';
        }

        $senha_hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);


        $query = $pdo->prepare("INSERT INTO usuario(nome, email, senha, foto) VALUES (?, ?, ?, ?)");

        $query->execute([$_POST['nome'], $_POST['email'], $senha_hash, $caminho_foto]);

        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro - Doces da MARY</title>
    
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
                    <h2 class="text-center mb-4 custom-heading">Cadastre-se</h2>

                    <?php if (isset($erro)): ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $erro; ?>
                        </div>
                    <?php endif; ?>

                    <form action="" method="post">
                        
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="nome" name="nome" id="nome" class="form-control" placeholder="Seu nome" required>

                            <label for="email" class="form-label">E-mail:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="seuemail@exemplo.com" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha:</label>
                            <input type="password" name="senha" id="senha" class="form-control" placeholder="Digite sua senha" required>
                        </div>
                        <div class="mb-3">>
                        <label for=""  class="form-label">Adicone foto ao seu perfil</label>
                          <input class="form-control" type="file" name="foto" id="">
                        </div>
                        <div class="d-grid mt-4">
                            <input type="submit" value="Entrar" class="btn btn-primary custom-btn-cta">
                        </div>
                    </form>

                    <p class="text-center mt-3">
                       Já tem conta? <a href="login.php" class="text-doce-rosa-link">Clique aqui</a>
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
