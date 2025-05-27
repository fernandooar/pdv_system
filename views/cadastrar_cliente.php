<?php require_once __DIR__ . '/../layout/header.php' ;
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <h2 class="mb-4 text-center">Cadastrar Novo Cliente</h2>

      <form action="../controllers/UsuarioController.php" method="POST">
        <input type="hidden" name="acao" value="cadastrar">
        <input type="hidden" name="tipo" value="cliente">

        <div class="mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Cadastrar Cliente</button>
      </form>

    </div>
  </div>
</div>


<?php require_once __DIR__ . '/../layout/footer.php' ?>
