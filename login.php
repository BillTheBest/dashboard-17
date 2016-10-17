<?php 

require 'lib/config.php';
require 'lib/base.php';

if (isset($_POST['email']) and isset($_POST['password']) ) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$dbh = new DB_handler();
	$user_data = $dbh->query('SELECT count(*) as rows, tx_nome FROM t_usuarios WHERE tx_email = ' . $email . 
			' AND tx_password = password(' . $password . ')');
	if ($user_data['tx_password']==pa) {
		
	}
	
	
	redirect_page('main.php');
} else {
	$error_msg = 'Senha ou login incorreto';
	redirect_page('index.php');
}

?>