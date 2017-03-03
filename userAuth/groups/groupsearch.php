<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header('Location: login.php');
  }
?>
<form class="" action="groupsearch.php" method="post">
  <label for="Group Name">Group Name</label>
  <input type="text" name="groupname" value="">
  <button type="submit" name="button">Search</button>
</form>
<?php
if($_POST['groupname']){
  $groupname = $_POST['groupname'];
  echo $groupname;
  $db = mysqli_connect( "localhost" , "root" , "root" , "authdb" );
  if(mysqli_connect_errno($db)){
    echo "error while connecting to db";
    exit;
  }else{
    $query = "SELECT * FROM groups WHERE name LIKE '%$groupname%'";
    $result = mysqli_query($db,$query);
    if(isset($result)){
      $numOfGroups = mysqli_num_rows($result);
      echo "Total Number Of Groups Is : ".$numOfGroups;
      echo "<table style='border:1px solid;'>
            <thead>
              <tr>
                <th style='border:1px solid;'>Group Name</th>
                <th style='border:1px solid;'>Project No</th>
              </tr>
            </thead>
            <tbody>";
      for($i = 0 ; $i < $numOfGroups ; $i++){
        $groupData = mysqli_fetch_assoc($result);
        echo "<tr>
                <td style='border:1px solid;'>".$groupData['name']."</td>
                <td style='border:1px solid;'>".$groupData['proj_num']."</td>
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
