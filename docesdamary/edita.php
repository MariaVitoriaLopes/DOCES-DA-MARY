<?php
session_start(); 


$user_logado_id = $_SESSION['user_logado_id'] ?? 0;
$user_nivel = $_SESSION['user_nivel'] ?? 'guest';
     require 'config.php';
     $id=$_GET['id'];

     if(!$id){
        header("Location: avaliacoes.php");
        exit;

     }
     $query=$pdo->prepare ("SELECT * FROM avaliacao WHERE id=?");

     $query->execute([$id]);

     $avaliacao=$query->fetch();

     if ($avaliacao['user_id'] !== $user_logado_id && $user_nivel == 'usuario') { 
   echo "Acesso Negado. Você não tem permissão para editar esta avaliação.";
   exit;
}
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $query=$pdo->prepare("UPDATE avaliacao SET nome =?, estrelas =?,comentario=? WHERE id=?");
            $query->execute([$_POST['nome'],(int)$_POST['estrelas'], $_POST['comentario'], $id]);
            header("Location: index.php");
            exit;
        }
       
     
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar avaliacoes</h1>
    <form action="#" method="post">
        <label>Nome:</label>
        <input type="text" value=<?php echo $avaliacao ['nome'];?> name="nome" required>
        <label> Estrelas:</label>
        <input type="number" value=<?php echo $avaliacao['estrelas'];?> name="estrelas" required>
        <label>Comentário:</label>
        <textarea name="comentario" rows="4" cols="50" required><?php echo nl2br($avaliacao['comentario']); ?></textarea>
        <input type="submit" value=salvar>
    </form>
</body>
</html>