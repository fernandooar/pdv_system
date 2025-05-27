<?php
require_once '../controllers/PedidoController.php';

/**
 * Roteamento para operações relacionadas a pedidos.
 *
 * Este script trata requisições POST para cadastrar um novo pedido.
 * 
 * Funcionalidades:
 * - Recebe dados do formulário via POST, incluindo:
 *   - 'id_usuario': ID do usuário que está realizando o pedido.
 *   - 'status': Status do pedido.
 *   - 'produtos': Array contendo os IDs dos produtos selecionados.
 *   - 'quantidades': Array contendo as quantidades de cada produto.
 * - Instancia o PedidoController e chama o método salvar() para persistir o pedido.
 * - Redireciona para a dashboard com parâmetro de sucesso ou erro.
 * @package PedidoRoute
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';
    $pedidoCtrl = new PedidoController();

    if ($acao === 'cadastrar') {
        $dados = [
            'id_usuario' => $_POST['id_usuario'],
            'status' => $_POST['status'],
            'produtos' => $_POST['produtos'],        // Array de IDs dos produtos
            'quantidades' => $_POST['quantidades'],  // Array de quantidades
        ];

        $pedidoCtrl->salvar($dados);

        header('Location: ../views/dashboard.php?sucesso=1');
        exit;
    }

    // Aqui pode expandir para editar/excluir no futuro
}

header('Location: ../views/dashboard.php?erro=1');
exit;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['acao'] === 'excluir') {
    $id = $_POST['id_pedido'];
    $pedidoController = new PedidoController();
    $pedidoController->excluir($id);
    header('Location: ../views/dashboard.php');
    exit;
}
