

<?php
	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	if($_POST['password'] && $_POST['username'])
	{
		$password = md5($_POST['password']);
		$username=$_POST['username'];
		$DBName="authdb";
		$DBHost="localhost";
		$DBuserName="root";
		$DBPassword="root";

		@ $db=mysqli_connect($DBHost,$DBuserName, $DBPassword,$DBName);
		if (mysqli_connect_error())
		{
			echo "error in connection";
		}	
		else 
		{
			$sql="select * from users where user_name='$username' and password='$password';";
			$result=mysqli_query($db,$sql);
			if($result)
			{

				//var_dump($result);
				$numOfRows = mysqli_num_rows($result);
				$userData=mysqli_fetch_assoc($result);
				$groupIdx = $userData['group_id'];


				$groupQuery = "select * from groups where id =$groupIdx";
				$group_result = mysqli_query($db,$groupQuery);
				$groupData = mysqli_fetch_assoc($group_result);

				session_start();
				$_SESSION['username'] = $userData['user_name'];
				$_SESSION['groupname'] = $groupData['name'];
				echo $_SESSION['username'] ."<br>". $_SESSION['groupname'];

				echo "<a href='logout.php'>logout </a>"; 
			}
			else{
				echo "Either User Name Or Password doesn't Exist";

			}
		}
	}
	else
	{
		echo "enter username and password";
		include("login.php");
	}



	

?>
