<?php
    session_start();
    require 'config.php';
    $query = $pdo->query("SELECT * FROM avaliacao");
    $avalicoes = $query->fetchAll(); 
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Avaliações - Doces da Mary</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="stylepagina.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-doce-creme">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <h1 class="text-center mb-4 custom-heading">Nossas Avaliações</h1>
                
               

<div class="card shadow-sm custom-login-card">
<div class="card-body">

<div class="table-responsive">
<table class="table table-striped table-hover align-middle">
<thead class="table-light">
<tr>
<th scope="col">ID</th>
<th scope="col">Nome</th>
<th scope="col">Estrelas</th>
<th scope="col">Comentário</th>
<th scope="col" class="text-center">Ações</th>
</tr>
</thead>
<tbody>
<?php foreach($avalicoes as $a):?>
                                        <tr>
<td><?php echo $a['id']; ?></td>
<td><?php echo htmlspecialchars($a['nome']); ?></td>
<td><?php echo $a['estrelas']; ?> ⭐</td>
<td><?php echo htmlspecialchars($a['comentario']); ?></td>
                                            
                                            <td class="text-center">
                                                <?php
                                                    
if (isset($_SESSION['logado']) && (
$_SESSION['id'] === $a['user_id'] || 
(isset($_SESSION['nivel']) && $_SESSION['nivel'] === 'admin')
)):
?>
                    
<a href="delete.php?id=<?php echo $a['id']; ?>" 
class="btn btn-sm btn-danger" 
onclick="return confirm('Tem certeza que deseja excluir esta avaliação?');">
Excluir
</a>
<?php else: ?>
<span class="text-muted">—</span>
<?php endif; ?>
</td>
</tr>
<?php endforeach ?>
</tbody>
</table>
</div> </div>
</div> <p class="text-center mt-3">
<a href="dashboard.php" class="text-secondary custom-btn-link">Voltar à Página Inicial</a>
</p>

</div>
</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>