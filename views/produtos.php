<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../models/Produto.php';
require_once __DIR__ . '/../helpers/Sessao.php';

Sessao::verificar();

$produtoModel = new Produto();
$produtos = $produtoModel->buscarTodos();
?>

<div class="container mt-4">
    <h2>Produtos</h2>
    <form action="../controllers/ProdutoController.php" method="post" class="mb-3">
        <input type="hidden" name="acao" value="cadastrar">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="nome" class="form-control" placeholder="Nome do Produto" required>
            </div>
            <div class="col-md-3">
                <input type="number" step="0.01" name="preco" class="form-control" placeholder="Preço" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="quantidade" class="form-control" placeholder="Quantidade" required>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary w-50">Cadastrar</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= $produto['nome'] ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td><?= $produto['quantidade'] ?></td>
                    <td>
                        <!-- Editar -->
                        <form action="../controllers/ProdutoController.php" method="post" style="display:inline-block">
                            <input type="hidden" name="acao" value="editar">
                            <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                            <input type="text" name="nome" value="<?= $produto['nome'] ?>" required>
                            <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required>
                            <input type="number" name="quantidade" value="<?= $produto['quantidade'] ?>" required>
                            <button class="btn btn-sm btn-warning">Salvar</button>
                        </form>

                        <!-- Excluir -->
                        <form action="../controllers/ProdutoController.php" method="post" style="display:inline-block">
                            <input type="hidden" name="acao" value="excluir">
                            <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class="col-md-3">
       <a href="dashboard.php"class="btn btn-outline-success"> Dashboard</a>
    </div>
</div>

<script src="/public/js/autocomplete.js"></script>