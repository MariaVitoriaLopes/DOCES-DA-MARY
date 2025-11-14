<?php
session_start();
require 'config.php';


if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || $_SESSION['nivel'] !== 'admin') {
    header('Location: login.php'); 
    exit;
}

if(isset($_GET['id']) && isset($_GET['tipo'])){
    $id = (int)$_GET['id'];
    $tipo = $_GET['tipo'];
    $tabela = '';
    $redirect = 'dashboard.php'; 

    
    switch ($tipo) {
        case 'avaliacao':
            $tabela = 'avaliacao';
            $redirect = 'avaliacoes.php';
            break;
        case 'servico':
            $tabela = 'servico';
            $redirect = 'servicos.php'; 
            break;
        case 'contato':
            $tabela = 'contato';
            $redirect = 'contato.php';
            break;
        case 'usuario':
           
            if ($id == $_SESSION['id']) {
                $redirect = 'users.php';
                header("Location: $redirect");
                exit;
            }
            $tabela = 'usuario';
            $redirect = 'users.php';
            break;
        default:
           
            header("Location: $redirect");
            exit;
    }

    if ($tabela) {
        
        $query = $pdo->prepare("DELETE FROM {$tabela} WHERE id=?");
        $query->execute([$id]);
    }
    
    header("Location: $redirect");
    exit;
} else {
    
    header('Location: dashboard.php');
    exit;
}
?>