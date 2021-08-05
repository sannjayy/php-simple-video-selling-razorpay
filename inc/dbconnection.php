<?php
//connect a database
include('config.php');
function Db_Connect()
{
	global $db;
	if(DATABASE_NAME=='')
	{
		return '';
	}
	else
	{
		$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			PDO::ATTR_PERSISTENT => true
		);
		$db = new PDO("mysql:dbname=".DATABASE_NAME."; host=".SERVER_NAME."", USER_NAME, PASSWORD);
		return $db;
	}
}
?>