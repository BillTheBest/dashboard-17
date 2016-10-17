<?php 
require 'lib/config.php';
require 'lib/base.php';

$error_msg = '';
$email = '';
$password = '';
$resultSet = '';


if ($_SERVER["REQUEST_METHOD"]=="POST") {
	
	$email = validate_input($_POST["email"]);
	$password = validate_input($_POST["password"]);
	$dbh = new DB_handler();
	$sql = 'SELECT count(*) as rows, tx_nome FROM t_usuarios WHERE tx_email = ' . $email;
			//' AND tx_password = password(' . $password . ')';
	$resultSet = $dbh->query($sql);
	
	/*if ($resultSet->rowCount() > 0) {
		foreach ($resultSet as $user_data) {
			if ($user_data['tx_nome'] != '') {
				$_SESSION['nome'] = $user_data['tx_nome'];
				$_SESSION['email'] = $email;
			
				redirect_page('main.php');
			} else {
				$error_msg = 'Usuário ou senha inválidos!';
			}
		}
	} else {
		$error_msg = 'Usuário não encontrado!';
	}*/
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 2 | General Form Elements</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta
		content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
		name="viewport">
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet"
		href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	         folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	<style type="text/css">
		.wrapper {
    		padding-top: 100px;
		}
	</style>
</head>
<body>
	<div class="container">
		<header class="row wrapper">
		<?php echo $email . '<br>' ?>
		<?php echo $password . '<br>' ?>
		<?php echo $resultSet ?>
		</header>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="box box-primary box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Dashboard - Login</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form class="form-horizontal" method="post" 
							action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input name="email" type="email" class="form-control" id="inputEmail3"
										placeholder="Email">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
								<div class="col-sm-10">
									<input name="password" type="password" class="form-control" id="inputPassword3"
										placeholder="Senha">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<div class="checkbox">
										<label> <input type="checkbox"> Lembre-me</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<div class="">
										<label><?php echo $error_msg ?></label>
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-default">Cancelar</button>
							<button type="submit" class="btn btn-info pull-right">Entrar</button>
						</div><!-- /.box-footer -->
					</form>
				</div><!-- /.box -->
			</div>
			<div class="col-md-3"></div>
		</div><!-- /.row -->
		<footer class="row"></footer>
	</div><!-- /.container -->
	<!-- jQuery 2.1.4 -->
	<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.5 -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>