<?php
function logging($logType="", $message="", $infoType="Info"){
	include_once "../Logging/LogsFunctions.php";
	switch($logType){
		case 1:
			warnlog($message);
			break;
		case 2:
			errlog($message);
			break;
		case 3:
			infolog($message,$infoType);
			break;
	}
}
?>