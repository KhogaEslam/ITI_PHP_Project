<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('Location: ../login.php');
	}
	include_once ("../index.php");
   	include_once("../dbconnect.php");
	if (isset($_GET['id']) ) {
		$id = $_GET['id'];
		$sql_statement="select * from groups where id = $id;";
		$result = mysqli_query( $db, $sql_statement);
		if ($result){
			$r = mysqli_fetch_assoc($result);
			if (! isset($_POST['group_name'])) {
			?>
			<div class="row">
				<div class="col-md-8">

				</div>
				<div class="col-md-4" style="text-align: center">
					<div>
						<a href="addgroup.php" class="btn btn-primary"> Add Group </a>
					</div>
					<div>
					<a href="groupsearch.php" class="btn btn-primary"> Search group </a>
					</div>
				</div>
			</div>
	
			<form id="form" method = 'post'>
				<div class="form-group">
					<label>
						Group Name
					</label>
					<input class="form-control" id="group-name" name= 'group_name' type = "text" value = "<?= $r['name'] ?>" >
				</div>
				<div class="form-group">
					<label>
						Group Description
					</label>
					<input class="form-control" name= 'group_desc' type = 'text' value = "<?= $r['group_desc'] ?>" >
				<div class="form-group">
					<label>
						Callback Function
					</label>
					<input class="form-control" id="callback" name= 'callBack' type = 'text' value = "<?= $r['callBack'] ?>" >
				</div>
				<div class="form-group">
					<label>
						Project Number
					</label>
					<input class="form-control" id= "group-proj-num" name= 'group_proj_num' type = 'text' value = "<?= $r['proj_num'] ?>" >
				<input id="submit-btn" class="btn btn-primary" type="button" value ="submit">
			</form>
			<script>
		     document.getElementById('submit-btn').addEventListener("click", function() {
		         var groupName= document.getElementById('group-name');
		         var callBack= document.getElementById('callback');
		         var projNum= document.getElementById('group-proj-num');
		         if ( groupName.value ) {
		           if( callBack.value) {
		             if (projNum.value) {
		                   
		                   document.getElementById('form').submit();
		                }
		             else {
		             	alert("One or more fields are empty !!")
		             }
		         }
		         else {
		              alert("One or more fields are empty !! " );
		         }
		       }
		         else {
		               alert("One or more fields are empty !! " );
		         }
		       
		  

		     });

   </script>
		<?php 
	} else {
			extract($_POST);
			$sql_statement="update groups set name= '$group_name', group_desc='$group_desc' , callBack='$callBack' , proj_num = $group_proj_num where id = $id;";
			//echo $sql_statement;
		     mysqli_query($db, $sql_statement);
		     ?>
		     <script>
		     	location.href="allgroups.php";
		     </script>

		
<?php
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
