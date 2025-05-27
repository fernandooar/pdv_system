<?php

class Sessao
{
    // Inicia a sessão se ainda não estiver iniciada
    public static function iniciar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Salva os dados do usuário na sessão
    public static function logar($usuario)
    {
        self::iniciar();
        $_SESSION['usuario'] = [
            'id'    => $usuario['id'],
            'nome'  => $usuario['nome'],
            'email' => $usuario['email'],
            'tipo'  => $usuario['tipo']
        ];
    }

    // Retorna os dados do usuário logado
    public static function getUsuario()
    {
        self::iniciar();
        return $_SESSION['usuario'] ?? null;
    }

    // Verifica se o usuário está logado
    public static function verificar()
    {
        self::iniciar();
        if (!isset($_SESSION['usuario'])) {
            header('Location: login.php'); // redireciona se não estiver logado
            exit;
        }
    }

    // Desloga o usuário
    public static function logout()
    {
        self::iniciar();
        session_unset();
        session_destroy();
    }
}
