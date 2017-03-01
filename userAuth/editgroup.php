<?php
	include("dbconnect.php");
	if (isset($_GET['id']) ) {
		$id = $_GET['id'];
		echo $id;
		$sql_statement="select * from groups where id = $id;";
		$result = mysqli_query( $db, $sql_statement);
		if ($result){
			$r = mysqli_fetch_assoc($result);
			
		if (! isset($_POST['group_name'])) {
			?>
			<form method = 'post'>
				<label>
					Group Name 
				</label>
				<input name= 'group_name' type = "text" value = '<?= $r['name'] ?>' > 
				<label>
					Group Description
				</label>
				<input name= 'group_desc' type = 'text' value = '<?= $r['group_desc'] ?>' >
				<label>
					Project Number 
				</label>
				<input name= 'group_proj_num' type = 'text' value = '<?= $r['proj_num'] ?>' >
				<input type="submit" value ="submit">
			</form>
		<?php } else { 
			extract($_POST);
$sql_statement="update groups set name= '$group_name', group_desc='$group_desc' , proj_num = $group_proj_num where id = $id;"; 
		     mysqli_query( $db, $sql_statement);
		     header('Location: index.php');

		}
	}
	else {
		http_response_code(404);
		exit();
	}
}
	else {
		http_response_code(404);
		exit();
	}
			?>
