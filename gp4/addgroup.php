<?php
if (!isset($_POST['group_desc']) ) {
 ?>
 <html>
   <head>
      <title> Add goods </title>
      <script>

      </script>
   </head>
   <body>
     <form method='post' action="addgroup.php">
        <input class="form-control" type="text" name="group_name" id="unitprice-id" placeholder="add group name">
        <textarea class="form-control" name="group_desc" id="product-id" placeholder="add group description"></textarea>
        <input  class="form-control" type="number" name="group_proj_num" id="saleQuantity-id" placeholder="add project number">
        <input type="submit" value ="submit">

     </form>
   </body>
 </html>
 <?php
}
 else {
   extract($_POST);
   include("dbconnect.php");
   $sql_statement="insert into groups(name,group_desc, proj_num) values (\" $group_name \",
    \"$group_desc\", \"$group_proj_num\");";
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