<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function exige_login() {
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header('Location: login.php');
        exit;
    }
}


function exige_admin() {
    exige_login();
    
    if ($_SESSION['nivel'] !== 'admin') {
      
        header('Location: index.php'); 
        exit;
    }
}
?>