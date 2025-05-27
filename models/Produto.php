<?php
require_once '../config/Conexao.php';

class Produto {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getInstancia();
    }

    // Cadastrar novo produto
    public function cadastrar($nome, $preco, $quantidade) {
        $sql = "INSERT INTO produtos (nome, preco, quantidade) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nome, $preco, $quantidade]);
    }

    // Buscar todos os produtos
    public function buscarTodos() {
        $sql = "SELECT * FROM produtos";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar produto por ID
    public function buscarPorId($id) {
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar produto
    public function atualizar($id, $nome, $preco, $quantidade) {
        $sql = "UPDATE produtos SET nome = ?, preco = ?, quantidade = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nome, $preco, $quantidade, $id]);
    }

    // Excluir produto
    public function excluir($id) {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Contar total de produtos
    public function contar() {
        $sql = "SELECT COUNT(*) as total FROM produtos";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
