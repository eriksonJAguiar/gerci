<?php
// session_start inicia a sessão
session_start();
// Inclui o arquivo com a classe de login
require_once 'model/usuarios.class.php';
require_once 'model/ldap-server.class.php';

// Pega os dados vindos do formulário
$ra = $_POST['ra'];
$password = $_POST['password'];

$usuario = new Usuario($ra,$password);
$ldapserver = new LdapServer('172.16.100.253','laboratorios.cct.uenp.edu.br');

if($ldapserver->autentica($usuario)){
	// Usuário logado com sucesso, redireciona ele para a página restrita
	$_SESSION['usuario'] = $usuario;
	header("Location: main.php");
} else {
	// Não foi possível logar o usuário, TODO: exibir mensagem de erro
	header("Location: index.php");
}

?>
