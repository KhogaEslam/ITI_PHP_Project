<html>
  <title>Display all Users</title>
  <body>
    <table width=100%>
      <tr>
      	<td width=10%></td>
        <td width=10%>ID</td>
        <td width=30%>Full Name</td>
        <td width=30%>User Name</td>
        <td width=30%>Action</td>
<?php
  include("dbinfo.php");
 @ $database=mysqli_connect($DBHost,$DBUser,$DBuserp,$DBName);
  if(mysqli_connect_error()){
    echo "Unable To Connect";
    exit;
  }
  $query="select * from users";
  $result=mysqli_query($database,$query);
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
 	<td><form action="" method="post">
  <input type="checkbox" name="user" value="<?php echo $id ?>">
</td>
   <td width=10%><?=$res['id']?></td>
   <td width=30%><?=$res['full_name']?></td>
   <td width=30%><?=$res['user_name']?></td>
   <td><input type="submit" name="delete" id="delete" value="delete" alt="delete"/></td>
   <td><input type="submit" name="block" id="block" value="block" alt="block"/></td>
 </tr>
 <?php
 }
 echo "</table>";
 mysqli_close($database);
 ?>

 <?php
if (isset($_POST['user'])) {
include("dbinfo.php");
@ $database=mysqli_connect($DBHost,$DBUser,$DBuserp,$DBName);
if(mysqli_connect_error()){
	echo "Unable To connect";
	exit;
}
$sql="delete from users where id=".$_POST['user'];
$result=mysqli_query($database,$sql);
if(! $result){
	echo "can't delete";
	exit;
}

}?>
