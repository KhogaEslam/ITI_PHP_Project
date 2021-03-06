<?php
include 'head.html';
session_start();
//$_SESSION['username']='ss';
//$_SESSION['groupname']='serverAdmin';
//$_SESSION['projectNum']=2;
if ($_SESSION['groupname'] == 'serverAdmin')
{
//----------------------------------------
include_once "LogsFunctions.php";
$message="";
$infoType="";
//-----------------------------------------
if (! isset($_POST['ServerName'])) {
?>
<body>
    <div class="container">
        <?php include 'header.php'; ?>
        <form action="new.php" method="post">
            <div class="form-group">
                <label for="ServerName">Server Name</label>
                <input class="form-control" type="text" name="ServerName" value="" required>
            </div>
            <div class="form-group">
                <label for="ServerAdmin">Server Admin</label>
                <input class="form-control" type="text" name="ServerAdmin" value="" required>
            </div>
            <div class="form-group">
                <label for="DocumentRoot">Document Root</label>
                <input class="form-control" type="text" name="DocumentRoot" value="" required>
            </div>
            <div class="form-group">
                <label for="ErrorLog">ErrorLog</label>
                <input class="form-control" type="text" name="ErrorLog" value="" required>
            </div>
            <?php if (isset($_GET['err'])) {echo "<div class='alert alert-danger' role='alert'>ErrorLog path is not a directory!</div>";} ?>
            <div class="form-group">
                <label for="CustomLog">CustomLog</label>
                <input class="form-control" type="text" name="CustomLog" value="" required>
            </div>
            <?php if (isset($_GET['cust'])) {echo "<div class='alert alert-danger' role='alert'>CustomLog path is not a directory!</div>";} ?>
            <!-- <div class="form-group">
                <label for="php">Enable PHP Script</label>
                <input type="checkbox" name="php">
            </div> -->
            <div class="checkbox">
                <label for="php">
                    <input type="checkbox"  name='php' checked > Check to enable PHP scripting.
                </label>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Save">
                <input class="btn btn-primary" type="reset">
            </div>
        </form>
    </div>
</body>
<?php
} else {
    $php_flag = extract($_POST);

    $errTmp = explode("/", $ErrorLog);
    $custTmp = explode("/", $CustomLog);
    unset($errTmp[count($errTmp)-1]);
    $errTmp = implode("/", $errTmp);
    unset($custTmp[count($custTmp)-1]);
    $custTmp = implode("/", $custTmp);
    if ((! is_dir($errTmp) && ! is_dir($custTmp)) || (is_dir($ErrorLog) && is_dir($CustomLog))) {
        header("location: edit.php?err&cust&f=$oldfile");
    } elseif (! is_dir($errTmp) || is_dir($ErrorLog)) {
        header("location: edit.php?err&f=$oldfile");
    } elseif (! is_dir($custTmp) || is_dir($CustomLog)) {
        header("location: edit.php?cust&f=$oldfile");
    } else {
        $virtualHostFile = fopen("/etc/apache2/sites-enabled/".$ServerName.'.conf', 'w');
        if ( $virtualHostFile) {
            $part1 = "<VirtualHost *:80\>\nServerName $ServerName\nServerAdmin $ServerAdmin\nDocumentRoot $DocumentRoot\nErrorLog $ErrorLog\nCustomLog $CustomLog combined\nphp_admin_flag engine ";
            $part2 = ($php_flag == 5) ? "off\n</VirtualHost>\n" : "on\n</VirtualHost>\n" ;
            fwrite($virtualHostFile, $part1.$part2);
            fclose($virtualHostFile);
            $message= "VirtualHost ".$ServerName." created successfully";
            $infoType="Success";
            infolog($message,$infoType);
        } else {
            $message="VirtualHost ".$ServerName.'.conf'." couldn't be created";
            errlog($message);
        }
        header('location: index.php');
    }
}
}
?>
