 <?php
session_start();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    header("Location: index.php#produtos");

    exit;
}

$servico_id = (int)$_GET['id'];
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    
    $_SESSION['checkout_servico_id'] = $servico_id;
    header("Location: checkout.php");
    exit;

} else {
    
 
    $_SESSION['redirect_to'] = "checkout.php";
    $_SESSION['checkout_servico_id_temp'] = $servico_id; 
    
    header("Location: login.php");
    exit;
}
?>