<?php
     require 'config.php';
     if(isset($_GET['id'])){
        $query=$pdo->prepare("DELETE FROM avaliacao WHERE id=?");

        $query->execute([$_GET['id']]);
        header("Location: avaliacoes.php");
     }

?>