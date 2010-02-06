<?php if(!defined('IN_NK')) die('Invalid inclusion.');
/**
 * connect.php
 * 
 * Attempts to connect to the database using variables defined in: database.php
 * @author Nijiko Yonskai <me@nijikokun.com>
 * @version 1.2
 * @package ninko
 */
	
mysql_connect($config['host'], $config['user'], $config['pass']) or die (mysql_error());
mysql_select_db($config['db']) or die (mysql_error());
?>