<?php 
session_start();
if(isset($_SESSION['username'])){
	header('Location: form.html');
}
?>
<html>
	<body>
		<form method="POST" action="auth.php">
			UserName<input type="text" name="username">
			Password<input type="password" name="password">
			<button type="submit">Login</button>
		</form>

	</body>
</html>
