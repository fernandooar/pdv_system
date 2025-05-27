<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
require_once __DIR__ . '/../helpers/Sessao.php';
require_once __DIR__ . '/../models/Usuario.php';
Sessao::verificar();
$clientes = new Usuario();
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
      <div class="card-header">
         <h2 class="card-title text-center">Lista de Clientes</h2>
      </div>
    </div>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">           
                <table class="table table-bordered table-striped rounded">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Status</th> <!-- Status do cliente ativo/inativo -->
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes->listarClientes() as $cliente): ?>
                            <tr>
                                <td><?= $cliente['id'] ?></td>
                                <td><?= htmlspecialchars($cliente['nome']) ?></td>
                                <td><?= htmlspecialchars($cliente['email']) ?></td>
                                <td><?= htmlspecialchars($cliente['tipo']) ?></td>
                                <td>
                                    <p>N/A</p>
                                </td>
                                <?php
                                // echo '<pre>';
                                // var_dump($cliente);
                                // echo '</pre>';
                                ?>
                                <td>
                                    <a href="ver_cliente.php?id=<?= $cliente['id'] ?>" class="btn btn-sm btn-primary">Ver</a>
                                    <a href="editar_cliente.php?id=<?= $cliente['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="excluir_cliente.php?id=<?= $cliente['id'] ?>" class="btn btn-sm btn-danger">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>