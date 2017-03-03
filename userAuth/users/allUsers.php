<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location: ../login.php');
}
 include ('../index.php');
?>

<div class="row">
	<div class="col-md-8">
	</div>
	<div class="col-md-4" style="text-align: center">
		<div>
			<a class="btn btn-primary" href="addUser.php"> Add user </a>
		</div>
		<div>
			<a class="btn btn-primary" href="usersearch.php"> Search user </a>
		</div>
	</div>
</div>

 <table id="datatable" class="table table-striped table-bordered" width=100%>
	 <tr>
	   
		<td>ID</td>
		<td>Full Name</td>
		<td>User Name</td>
		<td> Edit </td>
		<td>Delete</td>
		<td> Block/unblock </td>
	</tr>
<?php
  include("../dbconnect.php");
  $query="select * from users";
  $result=mysqli_query($db,$query);
  if(!$result){
    echo"Unable To Select";
    exit;
  }
 $num_of_rows=mysqli_num_rows($result);

for($i=0;$i<$num_of_rows;$i++){
  $res=mysqli_fetch_assoc($result);
	$id=$res['id'];
	?>
	 <tr>
	   <td><?=$res['id']?></td>
	   <td><?=$res['full_name']?></td>
	   <td><?=$res['user_name']?></td>
	   <td><a class="btn btn-warning" href="editUser.php?userID=<?= $res['id'] ?> "> Edit </a> </td>
	   <td><a class="btn btn-danger" href="userdelete.php?id=<?= $res['id'] ?> "> delete</td>
	   <?php 
		if($res['is_blocked'] == 0) { ?>
	   <td><a class="btn btn-danger" href="userblock.php?id=<?= $res['id'] ?> " >block</a></td>
	   <?php
		}
		else {?>
		 <td><a class="btn btn-success" href="userunblock.php?id=<?= $res['id'] ?> " > Unblock</a></td>
	 	<?php } ?>
	 </tr>
	 <?php
	 }
	 echo "</table>";
	 mysqli_close($db);
	 ?>

    </div>
        </div>
      </div>




<!-- /page content -->

</div>
</div>
</div>

