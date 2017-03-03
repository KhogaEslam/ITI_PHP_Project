<?php
include("../dbconnect.php");
if (isset($_GET['id']) ) {
	$id = $_GET['id'];
	echo $id;
	$sql_statement="select * from groups where id = $id;";
	$result = mysqli_query( $db, $sql_statement);
	if ($result){
		$sql_statement="delete from groups where id = $id;";
		 mysqli_query( $db, $sql_statement);
		 include("logging.php");
		 logging("3","group deleted successfully","deleted group");
		 header('Location: allgroups.php');
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
