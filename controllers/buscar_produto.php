<?php
require_once __DIR__ . '/../config/Conexao.php';

$pdo = Conexao::getInstancia();

$q = $_GET['q'] ?? '';

$sql = "SELECT id, nome, preco FROM produtos WHERE nome LIKE ? LIMIT 5";
$stmt = $pdo->prepare($sql);
$stmt->execute(["%$q%"]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

