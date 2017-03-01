<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header('Location: login.php');
  }
?>
<form class="" action="usersearch.php" method="post">
  <label for="username">User Name</label>
  <input type="text" name="username" value="">
  <button type="submit" name="button">Search</button>
</form>
<?php
if($_POST['username']){
  $userName = $_POST['username'];
  echo $userName;
  $db = mysqli_connect( "localhost" , "root" , "root" , "authdb" );
  if(mysqli_connect_errno($db)){
    echo "error while connecting to db";
    exit;
  }else{
    $query = "SELECT * FROM users WHERE user_name LIKE '%$userName%'";
    $result = mysqli_query($db,$query);
    if(isset($result)){
      $numOfUsers = mysqli_num_rows($result);
      echo "Total Number Of Users Is : ".$numOfUsers;
      echo "<table style='border:1px solid;'>
            <thead>
              <tr>
                <th style='border:1px solid;'>User Name</th>
                <th style='border:1px solid;'>Group Id</th>
              </tr>
            </thead>
            <tbody>";
      for($i = 0 ; $i < $numOfUsers ; $i++){
        $userData = mysqli_fetch_assoc($result);
        echo "<tr>
                <td style='border:1px solid;'>".$userData['user_name']."</td>
                <td style='border:1px solid;'>".$userData['group_id']."</td>
              </tr>";
      }
      echo "</tbody>
          </table>";
    }else{
      echo "No Data";
    }
  }
}

?>
