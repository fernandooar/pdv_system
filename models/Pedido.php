<?php
require_once '../config/Conexao.php';

class Pedido {
  private $con;

  public function __construct() {
    $this->con = Conexao::getInstancia();
  }

  /**
   * Recupera uma lista de todos os pedidos da tabela 'pedidos'.
   *
   * Executa uma consulta SELECT para buscar todos os registros da tabela 'pedidos'.
   *
   * @return array Retorna um array de arrays associativos, cada um representando um pedido.
   */
  public function listar() {
    $sql = "SELECT * FROM pedidos";
    $stmt = $this->con->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
  * Busca um pedido pelo ID na tabela 'pedidos'.
  *
  * @param int $id O ID do pedido a ser buscado.
  * @return array|null Retorna um array associativo com os dados do pedido ou null se não encontrado.
  */
  public function buscarPorId($id) {
   $sql = "SELECT * FROM pedidos WHERE id = :id";
   $stmt = $this->con->prepare($sql);
   $stmt->bindParam(':id', $id);
   $stmt->execute();
   return $stmt->fetch(PDO::FETCH_ASSOC);
  }



/**
 * Cadastra um novo pedido no banco de dados.
 *
 * Este método calcula o valor total do pedido com base nos produtos e quantidades fornecidos,
 * busca o preço de cada produto no banco de dados, soma o total e insere um novo registro na tabela 'pedidos'.
 *
 * @param array $dados Array associativo contendo:
 *   - 'produtos' (array): IDs dos produtos incluídos no pedido.
 *   - 'quantidades' (array): Quantidades correspondentes de cada produto.
 *   - 'id_usuario' (int): ID do usuário que está realizando o pedido.
 *   - 'status' (string): Status inicial do pedido.
 *
 * @return bool Retorna true em caso de sucesso na inserção, ou false em caso de falha.
 */
 public function cadastrar($dados) {
  $produtos = $dados['produtos'];
  $quantidades = $dados['quantidades'];

  $total = 0;
  for ($i = 0; $i < count($produtos); $i++) {
    $id_produto = $produtos[$i];
    $quantidade = $quantidades[$i];

    // Buscar o preço do produto no banco
    $stmt = $this->con->prepare("SELECT preco FROM produtos WHERE id = :id");
    $stmt->bindParam(':id', $id_produto);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
      $preco = $produto['preco'];
      $total += $preco * $quantidade;
    }
  }

  $sql = "INSERT INTO pedidos (id_usuario, status, data) 
          VALUES (:id_usuario, :status, NOW())";
  $stmt = $this->con->prepare($sql);
  $stmt->bindParam(':id_usuario', $dados['id_usuario']);
  //$stmt->bindParam(':total', $total);
  $stmt->bindParam(':status', $dados['status']);

  return $stmt->execute();
}

  /**
   * Edita um pedido existente no banco de dados.
   *
   * Atualiza os campos 'cliente', 'total' e 'status' do pedido identificado pelo ID fornecido.
   *
   * @param int   $id    O ID do pedido a ser editado.
   * @param array $dados Um array associativo contendo os novos valores para os campos:
   *                     - 'cliente': (string) Nome ou identificador do cliente.
   *                     - 'total': (float) Valor total do pedido.
   *                     - 'status': (string) Status atual do pedido.
   *
   * @return bool Retorna true em caso de sucesso ou false em caso de falha na execução da query.
   */
  public function editar($id, $dados) {
    $sql = "UPDATE pedidos SET cliente = :cliente, total = :total, status = :status WHERE id = :id";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':cliente', $dados['cliente']);
    $stmt->bindParam(':total', $dados['total']);
    $stmt->bindParam(':status', $dados['status']);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  /**
   * Exclui um pedido do banco de dados com base no ID fornecido.
   *
   * @param int $id O ID do pedido a ser excluído.
   * @return bool Retorna true em caso de sucesso ou false em caso de falha.
   */
  public function excluir($id) {
    $sql = "DELETE FROM pedidos WHERE id = :id";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  /**
   * Lista todos os pedidos com informações do cliente.
   *
   * Realiza uma consulta SQL que junta as tabelas 'pedidos', 'usuarios', 'itens_pedido' e 'produtos'
   * para obter detalhes dos pedidos, incluindo o nome do cliente e o total do pedido.
   *
   * @return array Retorna um array associativo contendo os pedidos com informações do cliente.
   */
public function listarComCliente() {
    $sql = "SELECT pedidos.id, pedidos.data, pedidos.status, usuarios.nome AS nome_cliente,
            IFNULL(SUM(produtos.preco * itens_pedido.quantidade), 0) AS total
            FROM pedidos
            JOIN usuarios ON pedidos.id_usuario = usuarios.id
            LEFT JOIN itens_pedido ON pedidos.id = itens_pedido.id_pedido
            LEFT JOIN produtos ON itens_pedido.id_produto = produtos.id
            GROUP BY pedidos.id, pedidos.data, pedidos.status, usuarios.nome";

    $stmt = $this->con->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
  /**
   * Busca pedidos por status.
   *
   * Realiza uma consulta SQL para buscar pedidos com base no status fornecido.
   *
   * @param string $status O status dos pedidos a serem buscados.
   * @return array Retorna um array associativo contendo os pedidos filtrados pelo status.
   */
  public function buscarPorStatus($status) {
    $sql = "SELECT * FROM pedidos WHERE status = :status";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':status', $status);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  
}
