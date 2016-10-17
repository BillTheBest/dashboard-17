<?php

# ---------------------------------------------------------------------------
# base.php - Versão 1.0 - Biblioteca de funções gerais e padronização
# 2015 By Adil Calomeno Junior
#
# Histórico:
# 1.0 - 28/09/2015 - Versao inicial
# ----------------------------------------------------------------------------

/**
 * Classe que encapsula todo o acesso ao banco de dados, seu contrutor cria 
 * uma conexão com o banco de acordo com as constantes definidas no config.php.
 * 
 */
class DB_handler {
	
	var $db_conn;
	
	/**
	 * Cria uma conexao com o banco atual
	 * Seleciona o database default tambem
	 */
	function DB_handler() {
	
		try {
			$this->db_conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME .
					';charset=utf8', DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true));
		} catch (Exception $e) {
			$this->db_conn = null;
			echo "Unable to connect: " . $e->getMessage() ."<p>";
		}
	}
	
	/**
	 * Funcao que executa uma query (select) no banco
	 * Retorna o resultado da query passada no argumento $query
	 */
	function query($statement) {
		return $this->db_conn->query($statement);
	}
	
	/**
	 * Verifica a quantidade de itens em uma tabela
	 *
	 * @param string $table_name - nome da tabela
	 */
	function table_count($table_name) {
		$query = "select count(*) as qtde from $table_name ";
		foreach($this->query($query) as $row) {
			return $row["qtde"];
		}
		return 0;
	}
	
}

function evaluate_rating($days) {
	
	$days = round($days);
	if ($days >= 0 and $days <= 7) {
		return 10;
	}
	if ($days <= 15 and $days > 7) {
		return 8;
	}
	if ($days <= 25 and $days > 15) {
		return 4;
	}
	if ($days >= 26) {
		return 0;
	}
	return 'N/A';
}

function get_color($days) {
	
	$color = array ( 0 => 'red', 4 => 'yellow', 8 => 'blue', 10 => 'green' );
	
	if (is_numeric($days)) return $color[evaluate_rating($days)];
	
	return 'gray';
	
}

# -------------------------------------------------------------
# Funcao que cria uma combo com field1 como chave e field2 como 
# descri��o.
#--------------------------------------------------------------
function create_combo ($name, $default, $sql){
	echo "<select name=\"" . $name . "\">\n";
	echo "<option value=\"\">Selecione</option>\n";
	$result = querydb($sql);
	while ($linhadb = fetchdb_array($result)){
		if ($default == $linhadb["id"]){
			echo("<option value=\"" . $linhadb["id"] . "\" selected>" . $linhadb["descricao"] . "</option>\n");
		} else {
			echo("<option value=\"" . $linhadb["id"] . "\">" . $linhadb["descricao"] . "</option>\n");
		}
	}
	echo("</select>\n");
}

# -------------------------------------------------------------
# Funcao que cria uma combo com field1 como chave e field2 como 
# descri��o. Se o atributo $reload for verdadeiro executa um 
# reload da p�gina.
#--------------------------------------------------------------
function create_combo_chg ($name, $default, $sql, $reload){
	echo "<select name=\"" . $name . "\"";
	if ($reload) echo " onChange=\"javascript:form.submit()\" ";
	echo ">\n";
	echo "<option value=\"\">Selecione</option>";
	$result = querydb($sql);
	while ($linhadb = fetchdb_array($result)){
		if ($default == $linhadb["id"]){
			echo "<option value=\"" . $linhadb["id"] . "\" selected>" . $linhadb["descricao"] . "</option>\n";
		} else {
			echo "<option value=\"" . $linhadb["id"] . "\">" . $linhadb["descricao"] . "</option>\n";
		}
	}
	echo "</select>\n";
}

# -------------------------------------------------------------
# Funcao para testar a lib.php
# C�digo que est� aqui nao deve ser levado a serio...
#--------------------------------------------------------------
function do_test(){
	$resultdb = querydb ("select id, descricao from tipo_cd");
	while ($linhadb = fetchdb_array($resultdb)){
		echo ("Id: ".$linhadb["id"]." - Descri��o: ".$linhadb["descricao"]."<br>");
	}
}

# -------------------------------------------------------------
# Fun��o que verifica se o usu�rio pode ou n�o logar na p�gina
# Retorna false se o usu�rio se n�o encontrar o usu�rio 
# ou a senha. True se encontrar.
# Coloca tamb�m o nome, login, tipo na se��o atual.
#--------------------------------------------------------------
function login_user($login, $senha){
	if ($login == ""){
		echo("O login do usuário não pode ser vazio!!!");
	} else if ($senha == "") {
		echo("A senha do usuário não pode ser vazia!!!");
	} else {
		$query = "select usu_id, usu_login, usu_nome from usuario where usu_login = '$login' and usu_password = password('$senha')";
		$result = mysql_query($query, get_dbconnection());
		if ($linha = fetchdb_array($result)){			
			$_SESSION["nome"] = $linha["usu_nome"];
			$_SESSION["login"] = $linha["usu_login"];
			$_SESSION["id"] = $linha["usu_id"];		
			return true;
		}
	}
	return false;
}

/**
 * Fun��o que verifica se a sess�o � valida
 */
function verify_session() {
	if ($_SESSION["login"] == "") return false;
	return true;
}

/**
 * Verifica a quantidade de itens em uma tabela
 * 
 * @param string $table_name - nome da tabela
 */
function table_count($dbh, $table_name) {
	$query = "select count(*) as qtde from $table_name ";
	foreach($dbh->query($query) as $row) {
		return $row["qtde"];
	}
	return 0;
}

/**
 * Redireciona para um pagina qualquer.
 */
function redirect_page($to) {
    header('Location: ' . APP_URL . $to); 
    exit;
}

# -------------------------------------------------------------
# Redireciona para um p�gina de erro, com mensagem e link
# configuraveis.
#--------------------------------------------------------------
function error_page($msgErro, $linkErro, $labelErro){
	$to = APP_URL . "erro.php?msgErro=" . $msgErro . "&linkErro=" . $linkErro . "&labelErro=" . $labelErro;
   header('Location: '. $to);
   exit;
}

# -------------------------------------------------------------
# Transforma a data do mysql 0000-00-00 para 00/00/00000. 
# Se data estiver vazia retorna vazio.
#--------------------------------------------------------------
function parse_mysqldate($mysql_date){
		if ($mysql_date != "") 
			return substr ($mysql_date, 8, 2) . "/" . substr ($mysql_date, 5, 2) . "/" . substr ($mysql_date, 0, 4);
		else return ""; 
}

# -------------------------------------------------------------
# Retorna o tipo do usu�rio.
#--------------------------------------------------------------
function get_usertype(){
	return $_SESSION["user_tipo"];
}

# -------------------------------------------------------------
# Retorna o tipo do usu�rio.
#--------------------------------------------------------------
function get_userid(){
	return $_SESSION["user_id"];
}

# -------------------------------------------------------------
# Retorna o nome da sess�o e seu ID em uma 
# string pronta para envio por GET
#--------------------------------------------------------------
function get_session(){
	return session_name() . "=" . session_id();
}

# -------------------------------------------------------------
# Apaga um arquivo qualquer dado um determinado caminho
# $file_path - caminho + nome do arquivo
#--------------------------------------------------------------
function delete_file($file_path){
	clearstatcache();
	if (file_exists($file_path)) { 
   	$filesys = eregi_replace("/","\\",$file_path); 
      $delete = system("del $filesys_path");
      clearstatcache();
      if (file_exists($file_path)) {
        	$delete = chmod ($file_path, 0777); 
        	$delete = unlink($file_path); 
        	$delete = system("rm -rf $filesys");
      }
   }
	clearstatcache();
	if (file_exists($file_path)) {
		return false;
	} else {
		return true;
	}
}

/**
 * validate and convert special characters to html entities if required. 
 * Useful to avoid Cross-site scripting attacks.
 * 
 * @param string - a data to be validated
 * @return string - a clean and converted data
 */
function validate_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>
