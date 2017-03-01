<?php
	include_once('dbconnect.php');
	$query= "select * from groups";
	$result = mysqli_query($db, $query);
	if(! $result) {
			 		echo "can't query";
			 		exit;
	}
	$ro = mysqli_num_rows($result);
	echo "You have" . $ro . "record <br>";
	?>
	<table>
	<tr>
		<th>Name</th>
		<th>Group Description</th>
		<th>Project Number</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php
	for ( $i=0; $i < $ro; $i++){
		$r = mysqli_fetch_assoc($result);
	?>
	<tr>
		<td> <?= $r['name']; ?> </td>
		<td> <?= $r['group_desc']; ?> </td>
		<td> <?= $r['proj_num']; ?> </td>
		<td> <a class="btn btn-primary" href="editgroup.php?id=<?= $r['id']; ?>" > Edit </a></td>
		<td> <a class="btn btn-danger" href="deletegroup.php?id=<?= $r['id']; ?>"> Delete </a></td>
	</tr>
	<?php 
		} 
		echo "</table>";
?>