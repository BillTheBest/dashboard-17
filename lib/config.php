<?php

# ---------------------------------------------------------------------------
# config.php - Vers�o 1.0 - Arquivo de configura��o do site.
# 2003 By Adil Calomeno Junior
# ----------------------------------------------------------------------------

#-------------------------- Ambiente de banco de dados
define ("DB_HOST", "localhost");									# Endere�o IP do banco de dados MySQL LOCAL
define ("DB_NAME", "resultados");									# Nome do database a ser utilizado LOCAL
define ("DB_USER", "root");											# Usu�rio para conex�o com banco de dados LOCAL
define ("DB_PASS", "");												# Senha de acesso ao banco LOCAL
#define ("DB_HOST", "mysql.gelare.com.br");							# Endere�o IP do banco de dados MySQL PROD
#define ("DB_NAME", "gelarebr");									# Nome do database a ser utilizado PROD
#define ("DB_USER", "gelarebr");									# Usu�rio para conex�o com banco de dados PROD
#define ("DB_PASS", "01gela12");									# Senha de acesso ao banco PROD

#-------------------------- Dados da aplica��o
define ("APP_NAME", "Dashboard");									# Nome da aplica��o
define ("APP_NAME_ADM", "Dashboard - ADMINISTRATIVO"); 				# Titulo para ADM
define ("APP_COMPANY_NAME", "AYMOR&Eacute; S.A.");
define ("APP_AUTHOR", "e-dea Studio");								# Nome da aplica��o
define ("APP_VERSION", "Vers�o: 0.1");								# Vers�o atual da aplica��o
define ("APP_DATE", "25/09/2015");									# Data da vers�o atual da aplica��o
define ("APP_PATH", "dashboard/");									# Caminho para o aplicativo, se necess�rio
define ("APP_UPLOAD_PATH", "upload");								# Caminho para deixar os arquivo de upload.
define ("APP_IMAGE_PATH", "images/");								# Caminho para as imagens do site
define ("APP_URL", "http://localhost:8083/dashboard/");					# Caminho para as imagens do site LOCAL
#define ("APP_URL", "http://www.gelare.com.br/");					# Caminho para as imagens do site PROD

#-------------------------- Fun��es e objetos.
define ("JS_HBACK", "window.history.back();");						# JavaScript para voltar uma p�gina.

?>
