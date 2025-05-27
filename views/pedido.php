<?php
require_once '../helpers/Sessao.php';
Sessao::verificar();

require_once '../controllers/PedidoController.php';
$pedidoCtrl = new PedidoController();
$pedidos = $pedidoCtrl->index();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .list-group-item:hover {
            cursor: pointer;
            background-color: #f0f0f0;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2>Novo Pedido</h2>
        <form method="POST" action="../routes/pedido_route.php">
            <div class="mb-3">
                <label for="cliente" class="form-label">Cliente</label>
                <input type="text" id="cliente" name="cliente_nome" class="form-control" autocomplete="off" required>
                <input type="hidden" name="id_usuario" id="id_usuario">
                <div id="lista-clientes" class="list-group"></div>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" required>
                    <option value="pendente">Pendente</option>
                    <option value="pago">Pago</option>
                    <option value="enviado">Enviado</option>
                    <option value="concluido">Concluído</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Produtos</label>
                <div id="produtos-wrapper">
                    <!-- Os produtos serão adicionados aqui -->
                </div>
                <button type="button" class="btn btn-secondary mt-2" onclick="addProduto()">+ Adicionar Produto</button>
            </div>

            <div class="mb-3">
                <label>Total</label>
                <input type="text" id="total" name="total" class="form-control" readonly>
            </div>

            <input type="hidden" name="acao" value="cadastrar">
            <button type="submit" class="btn btn-primary">Salvar Pedido</button> <a href="dashboard.php"class="btn btn-outline-success"> Dashboard</a>
           
        </form>
    </div>

    <script src="../public/js/novo_pedido.js"></script>
</body>
</html>
