<?php
require_once '../models/Usuario.php';
require_once '../helpers/Sessao.php';

// Garante que só responde requisições POST (login/cadastro)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verifica qual ação foi enviada pelo formulário
    $acao = $_POST['acao'];
    $usuario = new Usuario();

    // Ação de cadastro de usuário
    if ($acao === 'cadastrar') {
        // Chama o método da model para cadastrar usuário
        $usuario->cadastrar(
            $_POST['nome'],
            $_POST['email'],
            $_POST['senha'],
            $_POST['tipo']
        );

        // Redireciona para o login após cadastro
        header('Location: ../views/login.php');
        exit;
    }

    // Ação de login
    if ($acao === 'login') {
        // Tenta autenticar o usuário
        $usuarioLogado = $usuario->login($_POST['email'], $_POST['senha']);

        if ($usuarioLogado) {
            // Cria sessão e redireciona para a dashboard/pedidos
            Sessao::logar($usuarioLogado);
            header('Location: ../views/dashboard.php'); // ou dashboard.php
        } else {
            // Retorno simples — você pode melhorar isso futuramente com alerta Bootstrap
            echo "Login inválido!";
        }

        exit;
    }
}

// Também pode lidar com logout via GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['acao']) && $_GET['acao'] === 'logout') {
    Sessao::logout();
    header('Location: ../views/login.php');
    exit;
}
