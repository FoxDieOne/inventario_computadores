<?php
$servidor = 'localhost';
$usuario_db = 'user';
$senha_db = 'password';
$banco_de_dados = 'banco_de_dados';
$conexao = mysqli_connect($servidor, $usuario_db, $senha_db, $banco_de_dados);

// Verifica se a conexão foi bem-sucedida
if (!$conexao) {
    die("Erro de conexão: " . mysqli_connect_error());
}
?>