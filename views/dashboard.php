<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
require_once __DIR__ . '/../helpers/Sessao.php';
require_once __DIR__ . '/../models/Produto.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../controllers/PedidoController.php';
$pedidoCtrl = new PedidoController();
$pedidos = $pedidoCtrl->listarComCliente();
$produtoModel = new Produto();
$totalProdutos = $produtoModel->contar();
Sessao::verificar();

$usuarioCliente = new Usuario();
$clientes = $usuarioCliente->listarClientes();

$usuario = Sessao::getUsuario();
if (!$usuario) {
    header('Location: login.php');
    exit;
}
?>

<div class="container-fluid content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm  bg-light">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h5 class="card-title text-primary">DADOS DO USUÁRIO</h5>
                        <p class="card-text fs-6">
                            <?php if ($usuario = Sessao::getUsuario()) {
                                echo 'Nome: ' . htmlspecialchars($usuario['nome']);
                                echo '<br>';
                                echo 'E-mail: ' . htmlspecialchars($usuario['email']);
                            } ?>
                        </p>

                    </div>
                    <i class="bi bi-people card-icon text-danger"></i>
                </div>
            </div>
        </div>
        <button class="btn btn-outline-secondary"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
    </div>

        <div class="container-fluir">
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h5>TOTAL DE PRODUTOS</h5>
                                <p><?= $totalProdutos ?></p>
                            </div>
                            <i class="bi bi-cart card-icon text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <small>FATURAMENTO TOTAL</small>
                                <h5>R$ 0.00</h5>
                            </div>
                            <i class="bi bi-currency-dollar card-icon text-success"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <small>TOTAL DE PRODUTOS</small>
                                <h5>0</h5>
                            </div>
                            <i class="bi bi-box card-icon text-info"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <small>TOTAL DE CLIENTES</small>
                                <h5>
                                    <?php if ($clientes) {
                                        echo count($clientes);
                                    } else {
                                        echo '0';
                                    } ?>
                                </h5>
                            </div>
                            <i class="bi bi-people card-icon text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabelas -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= $pedido['id'] ?></td>
                            <td><?= htmlspecialchars($pedido['nome_cliente']) ?></td>
                            <td><?= date('d/m/Y', strtotime($pedido['data'])) ?></td>
                            <td>R$ <?= number_format($pedido['total'], 2, ',', '.') ?></td>
                            <td>
                                <span class="badge bg-<?= match ($pedido['status']) {
                                                            'pendente' => 'warning',
                                                            'pago' => 'info',
                                                            'enviado' => 'primary',
                                                            'concluido' => 'success',
                                                            default => 'secondary'
                                                        } ?>">
                                    <?= ucfirst($pedido['status']) ?>
                                </span>
                            </td>
                            <td>
                                <a href="ver_pedido.php?id=<?= $pedido['id'] ?>" class="btn btn-sm btn-primary">Ver</a>
                                <a href="editar_pedido.php?id=<?= $pedido['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="excluir_pedido.php?id=<?= $pedido['id'] ?>" class="btn btn-sm btn-danger">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>


    <?php require_once __DIR__ . '/../layout/footer.php'; ?>