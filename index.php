<?php

// Caminho para a página de login
// Como o index.php está na raiz e login.php está dentro de 'views/',
// o caminho relativo à URL base do seu site será 'views/login.php'.
$login_page_url = 'views/login.php';

// Redireciona o navegador para a página de login
header('Location: ' . $login_page_url);

// Importante: Terminar a execução do script após o redirecionamento
exit();

?>