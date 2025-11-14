<?php
session_start();
require 'config.php';

if (!isset($_SESSION['logado']) || $_SESSION['nivel'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$servico = ['titulo' => '', 'descricao' => '', 'preco' => '', 'id' => 0];
$is_edit = $id > 0;

if ($is_edit) {
    $query = $pdo->prepare("SELECT * FROM servico WHERE id = ?");
    $query->execute([$id]);
    $servico = $query->fetch(PDO::FETCH_ASSOC);
    if (!$servico) {
        header('Location: servicos.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    
    
    $caminho_foto = 'images/placeholder.jpg'; 
    
  
    if ($is_edit && isset($servico['foto'])) {
        $caminho_foto = $servico['foto'];
    }

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        
        $foto_temp = $_FILES['foto']['tmp_name'];
        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nome_arquivo = uniqid() . '.' . $extensao; 
        $diretorio_destino = 'images/';
        $caminho_destino = $diretorio_destino . $nome_arquivo;

       
        if (move_uploaded_file($foto_temp, $caminho_destino)) {
            $caminho_foto = $caminho_destino;
        }
    }
   

    if ($is_edit) {
      
        $query = $pdo->prepare("UPDATE servico SET titulo = ?, descricao = ?, preco = ?, foto = ? WHERE id = ?");
        $query->execute([$titulo, $descricao, $preco, $caminho_foto, $id]);
    } else {
      
        $query = $pdo->prepare("INSERT INTO servico (titulo, descricao, preco, foto) VALUES (?, ?, ?, ?)");
        $query->execute([$titulo, $descricao, $preco, $caminho_foto]);
    }

    header('Location: servicos.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?php echo $is_edit ? 'Editar' : 'Novo'; ?> Serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
       <link rel="stylesheet" href="stylepagina.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4"><?php echo $is_edit ? 'Editar' : 'Novo'; ?> Produto</h1>
        
        <form action="<?php echo $is_edit ? '?id=' . $id : ''; ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo htmlspecialchars($servico['titulo']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="3" required><?php echo htmlspecialchars($servico['descricao']); ?></textarea>
            </div>
            <div class="mb-3">>
                        <label for=""  class="form-label">Adicone foto ao seu Produto</label>
                          <input class="form-control" type="file" name="foto" id="">
                        </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço (R$):</label>
                <input type="number" step="0.01" min="0" name="preco" id="preco" class="form-control" value="<?php echo htmlspecialchars($servico['preco']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success"><?php echo $is_edit ? 'Salvar Alterações' : 'Cadastrar'; ?></button>
            <a href="servicos.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>