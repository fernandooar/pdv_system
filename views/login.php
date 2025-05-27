<?php 
require_once __DIR__ . '/../layout/header.php' ;
require_once __DIR__ . '/../helpers/Sessao.php';
?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow" style="min-width: 400px;">
        <h2 class="mb-4 text-center">Login</h2>
        <form action="../controllers/UsuarioController.php" method="POST">
            <input type="hidden" name="acao" value="login">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
        <p class="mt-3 text-center">Ainda não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php' ?>
