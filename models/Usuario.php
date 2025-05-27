<?php
require_once '../config/Conexao.php';

class Usuario {
    private $conexao;

    public function __construct() {
        $this->conexao = Conexao::getInstancia();
    }

    /**
     * Cadastra um novo usuário no banco de dados.
     *
     * @param string $nome  Nome do usuário.
     * @param string $email Email do usuário.
     * @param string $senha Senha do usuário (será armazenada de forma segura usando hash).
     * @param string $tipo  Tipo do usuário (ex: administrador, comum, etc).
     * @return bool Retorna true em caso de sucesso ou false em caso de falha.
     */
    public function cadastrar($nome, $email, $senha, $tipo) {
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)";
        $stmt = $this->conexao->prepare($sql);

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':tipo', $tipo);

        return $stmt->execute();
    }

    /**
     * Tenta autenticar um usuário com o email e senha fornecidos.
     *
     * Este método consulta a tabela 'usuarios' para um usuário com o email especificado.
     * Se um usuário for encontrado, verifica a senha fornecida com a senha hash armazenada
     * no banco de dados usando password_verify().
     *
     * @param string $email Endereço de e-mail do usuário.
     * @param string $senha Senha do usuário (texto puro).
     * @return array|false Retorna os dados do usuário como um array associativo em caso de sucesso, ou false em caso de falha.
     */
    public function login($email, $senha) {
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }

        return false;
    }

    /**
     * Recupera uma lista de todos os usuários com o tipo 'cliente' do banco de dados.
     *
     * @return array Retorna um array de arrays associativos, cada um representando um usuário cliente.
     */
    public function listarClientes() {
        $sql = "SELECT * FROM usuarios WHERE tipo = 'cliente'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
