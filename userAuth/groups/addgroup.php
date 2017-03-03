<?php
session_start();
if(!isset($_SESSION['username'])){
  header('Location: ../login.php');
}
include_once('../index.php');

if (!isset($_POST['group_name']) ) {
 ?>
 <html>
   <head>
      <title> Add Group </title>
      <script>
      </script>
   </head>
   <body>
     <form id="form" method='post' action="addgroup.php">
     	<div class="form-group">
        	<label> Group Name </label>
        	<input class="form-control" type="text" name="group_name" id="group-name" placeholder="add group name">
        </div>
        <div class="form-group">
        	<label> Group Description </label>
        	<textarea class="form-control" name="group_desc" id="group_desc" placeholder="add group description"></textarea>
        </div>
        <div class="form-group">
        	<label> Call Back </label>
        	<input class="form-control" type="text" name="callBack" id="callback" placeholder="add callBack function url">
        </div>
        <div class="form-group">
        	<label> Project Number </label>
        	<input  class="form-control" type="number" name="group_proj_num" id="group-proj-num" placeholder="add project number">
        </div>
        <input id="submit-btn" class="btn btn-primary" type="button" value ="submit">

     </form>
   </body>
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
         }
         else {
              alert("One or more fDEWGields are empty !! " );
         }
       }
         else {
               alert("One or morWEGWE[4JW0Oe fields are empty !! " );
         }
       
  

     });

   </script>
 </html>
 <?php
}
 else {
   extract($_POST);
   include("../dbconnect.php");
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
      include("../logging.php");
      logging("3","Group Added ".$group_name." Successfully","Adding Group");
    }
    mysqli_close($db);
 }
 ?>
