<?php
session_start();
if(isset($_SESSION['username'])){
	include("callBack.php");
	$callBack = goCallBack();
}
?>
<html>
	<body>
		<form method="POST" action="auth.php">
			UserName<input type="text" name="username">
			Password<input type="password" name="password">
			<button type="submit">Login</button>
			<p>
				<?php
					if($_GET["msg"]!=""){
						echo $_GET['msg'];
					}
				?>
			</p>
		</form>
	</body>
</html>
