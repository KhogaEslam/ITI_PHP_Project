<?php
if (!isset($_POST['group_name']) ) {
 ?>
 <html>
   <head>
      <title> Add Group </title>
      <script>

      </script>
   </head>
   <body>
     <form method='post' action="addgroup.php">
        <input class="form-control" type="text" name="group_name" id="group_name" placeholder="add group name">
        <textarea class="form-control" name="group_desc" id="group_desc" placeholder="add group description"></textarea>
        <input class="form-control" type="text" name="callBack" id="callBack" placeholder="add callBack function url">
        <input  class="form-control" type="number" name="group_proj_num" id="group_proj_num" placeholder="add project number">
        <input type="submit" value ="submit">

     </form>
   </body>
 </html>
 <?php
}
 else {
   extract($_POST);
   include("dbconnect.php");
   $sql_statement="insert into groups(name,group_desc,callBack, proj_num) values (\" $group_name \",
    \"$group_desc\", \"$callBack\", \"$group_proj_num\");";
    echo $sql_statement;
    $result = mysqli_query( $db, $sql_statement);
    if (! $result ) {
      echo "can't insert";
      exit;
    }
    else {
      ?>
      <script>
      alert("Done");
      location.href="addgroup.php"
      </script>
      <?php
    }
    mysqli_close($db);
 }

 ?>
