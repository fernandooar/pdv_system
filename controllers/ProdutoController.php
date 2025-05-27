<?php
require_once '../models/Produto.php';

$produto = new Produto();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'];

    if ($acao === 'cadastrar') {
        $produto->cadastrar($_POST['nome'], $_POST['preco'], $_POST['quantidade']);
        header('Location: ../views/produtos.php');
        exit;
    }

    if ($acao === 'editar') {
        $produto->atualizar($_POST['id'], $_POST['nome'], $_POST['preco'], $_POST['quantidade']);
        header('Location: ../views/produtos.php');
        exit;
    }

    if ($acao === 'excluir') {
        $produto->excluir($_POST['id']);
        header('Location: ../views/produtos.php');
        exit;
    }
}
