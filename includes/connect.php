<?php
// Configurações do banco de dados


$host = "";
$usuario = "";
$senha =  "";
$bancoDeDados = "";



// Conexão com o banco de dados
$conexao = new mysqli($host, $usuario, $senha, $bancoDeDados);

// Verifica a conexão
if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}