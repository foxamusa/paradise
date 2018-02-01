<?php
@session_start();
ob_start();
require_once('../../../wp-load.php');
global $wpdb,$current_user;

$getUserLogin = $_REQUEST['user_login'];
$getUserEmail = $_REQUEST['user_email'];
$getUserLoginGirls = $_REQUEST['girlsReg']['user_login'];
$getUserEmailGirls = $_REQUEST['girlsReg']['user_email'];
if($_POST['action'] == 'userlogincheck')
{
	if(username_exists($getUserLogin) || email_exists($getUserLogin))
	{
		echo 'false';
	}
	elseif(username_exists($getUserLoginGirls) || email_exists($getUserLoginGirls))
	{
		echo 'false';
	}
	else
	{
		echo 'true';
	}
}
if($_POST['action'] == 'useremailcheck')
{
	if(username_exists($getUserEmail) || email_exists($getUserEmail))
	{
		echo 'false';
	}
	elseif(username_exists($getUserEmailGirls) || email_exists($getUserEmailGirls))
	{
		echo 'false';
	}
	else
	{
		echo 'true';
	}
}
die;
?>