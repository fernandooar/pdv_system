<?php
/**
 * Classe Conexao
 * Responsável por criar uma conexão única (Singleton) com o banco de dados usando PDO
 */
class Conexao {
    // Instância única da conexão
    private static $instancia;

    // Dados de configuração do banco
    private $host = 'localhost';
    private $dbname = 'pdv_system';
    private $usuario = 'root';
    private $senha = '';

    // Objeto PDO
    private $pdo;

    /**
     * Construtor privado para impedir múltiplas instâncias (padrão Singleton)
     */
    private function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->usuario,
                $this->senha
            );

            // Define que os erros do PDO serão exibidos como exceções (melhor pra debugar)
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            // Exibe erro e finaliza caso não consiga conectar
            die("Erro ao conectar com o banco de dados: " . $e->getMessage());
        }
    }

    /**
     * Retorna a instância única da conexão
     *
     * @return PDO
     */
    public static function getInstancia() {
        // Se ainda não existe conexão, cria uma nova
        if (!isset(self::$instancia)) {
            $conexao = new Conexao();
            self::$instancia = $conexao->pdo;
        }

        return self::$instancia;
    }
}
