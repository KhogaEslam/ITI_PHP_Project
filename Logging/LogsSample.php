<?php
session_start();
$_SESSION['username'] = 'user_name';
$_SESSION['groupname'] = 'name';
$_SESSION['projectNum'] = '1';
echo $_SESSION['username'] ."<br>". $_SESSION['groupname']."<br>".$_SESSION['projectNum'];

if (isset($_SESSION['username']) && isset($_SESSION['groupname']) && isset($_SESSION['projectNum'])){
  include_once "LogsFunctions.php";
  $message="New Logs";
  $infoType="Good";
  warnlog($message);
  errlog($message);
  infolog($message,$infoType);
}
?>
