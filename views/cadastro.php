<?php require_once __DIR__ . '/../layout/header.php' ?>
<?php require_once __DIR__ . '/../helpers/Sessao.php' ?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow" style="min-width: 400px;">
        <h2 class="mb-4 text-center">Cadastro</h2>
        <form action="../controllers/UsuarioController.php" method="POST">
            <input type="hidden" name="acao" value="cadastrar">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de usuário</label>
                <select name="tipo" class="form-select" required>
                    <option value="cliente">Cliente</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100">Cadastrar</button>
        </form>
        <p class="mt-3 text-center">Já tem conta? <a href="login.php">Faça login</a></p>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php' ?>
