
<?php
require_once '../models/Pedido.php';

/**
 * PedidoController
 *
 * Controlador responsável por gerenciar as operações relacionadas aos pedidos.
 * Utiliza a classe Pedido para realizar as operações de CRUD e consultas.
 *
 * Métodos:
 * - index(): Lista todos os pedidos.
 * - salvar($dados): Cadastra um novo pedido com os dados fornecidos.
 * - atualizar($id, $dados): Atualiza um pedido existente identificado por $id com os novos dados.
 * - deletar($id): Exclui o pedido identificado por $id.
 * - buscar($id): Busca um pedido específico pelo seu ID.
 * - listarComCliente(): Lista todos os pedidos juntamente com as informações do cliente relacionado.
 */
class PedidoController {
  private $pedido;

  public function __construct() {
    $this->pedido = new Pedido();
  }
public function index() {
    $pedidos = $this->pedido->listarComCliente();
    return $pedidos; // provavelmente você quer retornar isso também
}


  public function salvar($dados) {
    return $this->pedido->cadastrar($dados);
  }

  public function atualizar($id, $dados) {
    return $this->pedido->editar($id, $dados);
  }

  public function deletar($id) {
    return $this->pedido->excluir($id);
  }

  public function buscar($id) {
    return $this->pedido->buscarPorId($id);
  }

  public function listarComCliente() {
    return $this->pedido->listarComCliente();
}

public function excluir($id) {
    $this->pedido->excluir($id);
}


}
