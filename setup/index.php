<?php session_start(); define('IN_NK', true);
/**
 * index.php
 * 
 * Admin control panel allowing users to manage the forum
 * @author Nijiko Yonskai <me@nijikokun.com>
 * @version 1.2
 * @copyright (c) 2010 ANIGAIKU
 * @package ninko
 * @subpackage setup
 */

if (isset($_GET['step']))
{
	$step = $_GET['step'];
}
else
{
	$step = 0;
}
	
header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>NinkoBB Installer &rsaquo; Setup Configuration File</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style media="screen" type="text/css">
		html 						{ background: #fff; }
		body 						{ background: #fff; color: #000; font-family: Helvetica, sans-serif; font-size: 12px; margin-left: 20%; margin-right: 20%; padding: .2em 2em; }
		h1 							{ color: #000000; font-size: 24px; font-family: Georgia, Helvetica, sans-serif; font-style: italic; }
		h2 							{ font-size: 16px; }

		p, li, dt 					{ line-height: 1.4; padding: 2px; }

		ul 							{ padding: 5px 5px 5px 20px; list-style: none; background: #000; color: #fff; font-size: 11px; }
		ol 							{ padding: 5px 5px 5px 40px; }

		td input 					{ border: 1px solid #ccc; padding: 3px 5px; background: #fff; margin: 0px 5px; }
			td select 				{ border: 1px solid #ccc; padding: 2px 5px; background: #fff; margin: 0px 5px; }
			
		.info 						{ color: #808080; font-style: italic; font-family: Georgia; }

		.step, th 					{ text-align: right; }
		.step a, .step input 		{ font-size: 14px; padding: 3px 5px; }

		code 						{ color: #3E87E3; }

		.error 						{ color: #E28964; }
		.ok 						{ color: #65B042; }
	</style>
</head>
<body>
<h1>NinkoBB Install</h1>
<?php
switch($step)
{
	case 0:
	
	// Check if database.php has been created
	if (file_exists('../include/database.php'))
		die("<ul><li>The file 'database.php' already exists.</li></ul> <p>If you need to reset any of the configuration items in this file, please delete it first.</p></body></html>");

	// Continue is true until false.
	$continue = true;
?>
<p>
	Hello there, to install ninko you will have to know the following information:
</p>
<ol>
	<li>Database name</li>
	<li>Database username</li>
	<li>Database password</li>
	<li>Database host</li>
</ol>

<p><strong>Checking Server stats</strong></p>
<ul>
	<li><code>/</code> root directory of ninko is <?php if (!is_writable('../')) { echo "<span class='error'>unwritable.</span> Please chmod to 777"; $continue = false; } else { echo "<span class='ok'>writable</span>"; } ?>
	<li><code>/include/</code> directory of ninko is <?php if (!is_writable('../include/')) { echo "<span class='error'>unwritable.</span> Please chmod to 777"; $continue = false; } else { echo "<span class='ok'>writable</span>"; } ?>
	<li><code>/avatars/</code> directory of ninko is <?php if (!is_writable('../avatars/')) { echo "<span class='error'>unwritable.</span> Users will not be able to upload avatars"; } else { echo "<span class='ok'>writable</span>"; } ?>
	<li><code>/plugins/captcha/</code> directory of ninko is <?php if (!is_writable('../plugins/captcha/')) { echo "<span class='error'>unwritable.</span> Users will not be able to upload avatars"; $continue = false; } else { echo "<span class='ok'>writable</span>"; } ?>
</ul>

<p><?php if($continue){ ?><a href="?step=1">Continue to step 1 &raquo;</a><?php } else { ?>Please check your server and update any server errors!<?php } ?></p>
<?php break; 
case 1: ?>
</p>
<form method="post" action="?step=2">
  <p>Below you should enter your database connection details. If you're not sure about these, contact your host. </p>
	<table>
		<tr>
			<th scope="row">Database Name</th>
			<td><input name="db" type="text" size="25"/></td>
			<td class="info">The name of the database you want to run your script in. </td>
		</tr>
		<tr>
			<th scope="row">User Name</th>
			<td><input name="user" type="text" size="25"/></td>
			<td class="info">Your MySQL username</td>
		</tr>
		<tr>
			<th scope="row">Password</th>
			<td><input name="pass" type="text" size="25"/></td>
			<td class="info">Your MySQL password.</td>
		</tr>
		<tr>
			<th scope="row">Database Host</th>
			<td><input name="host" type="text" size="25" value="localhost" /></td>
			<td class="info">Usually localhost, don't change if unsure.</td>
		</tr>
	</table>
  <h2 class="step">
    <input name="submit" type="submit" value="Submit" />
  </h2>
</form>
<?php
break;	
case 2:
	$db = trim($_POST['db']);
	$user = trim($_POST['user']);
	$pass = trim($_POST['pass']);
	$host  = trim($_POST['host']);

	// We'll fail here if the values are no good.
	$cid = mysql_connect($host,$user,$pass);
	
	if (!$cid)
	{ 
?>
<p><strong>Error</strong></p>
<ul>
	<li>Connecting to database.</li>
</ul>

<p><a href="?step=1">&laquo; Back to step 1</a></p>
<?php
		die();
	}
	else
	{
		# select database to use
		if(!mysql_select_db($db))
		{
?>
<p><strong>Error</strong></p>
<ul>
	<li>Selecting database <?php echo $dbname; ?></li>
</ul>

<p><a href="javascript:history.back(-1)">&laquo; Back to step 1</a></p>
<?php
			die();
		}
	}
		
	$handle = fopen('../include/database.php', 'w');
	
	if($handle)
	{
		$source = array (
			"<?php if(!defined('IN_NK')) die('Invalid inclusion.');\n",
			"/**\n",
			" * database.php\n",
			" * \n",
			" * Controls the database connection values\n",
			" * @version 1.2\n",
			" * @copyright (c) 2010 ANIGAIKU\n",
			" * @package ninko\n",
			" */\n\n",
			"$","config['db'] = '{db}'; // Database\n",
			"$","config['user'] = '{user}'; // MySQL Username \n",		
			"$","config['pass'] = '{pass}'; // MySQL Password \n",	
			"$","config['host'] = '{host}'; // MySQL Host\n",
			"?>"
		);

		$search = array ('{db}', '{user}', '{pass}', '{host}');
		$replace = array ($db, $user, $pass, $host);
		$source = str_replace ( $search, $replace, $source );
		
		foreach ( $source as $str )
		{
			fwrite($handle, $str);
		}

		fclose($handle);
	}
	else
	{
?>
<p><strong>Error</strong></p>
<ul>
	<li>Creating <code>../include/database.php</code> make sure that the <code>../include/</code> directory is writable.</li>
</ul>
<?php
		die();
	}
?>
<p><strong>Database connection setup... done</strong></p>

<p>
	<a href="?step=3">Step 3 &raquo;</a>
</p>
<?php break; 
case 3: ?>

<?php
	if (file_exists("../include/database.php"))
	{
		// The database's to create
		$db_schema = array();
	 
		$db_schema['config'] = "
CREATE TABLE IF NOT EXISTS `config` (
	`id` int(255) NOT NULL AUTO_INCREMENT,
	`key` text,
	`value` text,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;";

		$db_schema['forum'] = "
CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `sticky` int(255) NOT NULL DEFAULT '0',
  `closed` int(1) NOT NULL DEFAULT '0',
  `subject` text NOT NULL,
  `name` text NOT NULL,
  `message` text NOT NULL,
  `reply` int(255) NOT NULL DEFAULT '0',
  `start_date` text NOT NULL,
  `starter_id` int(255) NOT NULL DEFAULT '0',
  `replies` int(255) NOT NULL DEFAULT '0',
  `host` text NOT NULL,
  `time` text,
  `last_reply` text NOT NULL,
  `last_poster` int(255) NOT NULL DEFAULT '0',
  `updated` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;";

		$db_schema['users'] = "
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `first_name` text,
  `last_name` text,
  `age` text,
  `sex` text,
  `location` text,
  `title` text NOT NULL,
  `msn` text NOT NULL,
  `aim` text NOT NULL,
  `yahoo` text NOT NULL,
  `interests` text NOT NULL,
  `email` text,
  `username` text,
  `password` text,
  `avatar` int(1) NOT NULL DEFAULT '0',
  `updateu` text,
  `join_date` text,
  `last_seen` text NOT NULL,
  `posts` int(255) DEFAULT '0',
  `admin` int(1) DEFAULT '0',
  `moderator` int(1) DEFAULT '0',
  `banned` int(11) NOT NULL DEFAULT '0',
  `active` int(255) NOT NULL DEFAULT '0',
  `key` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;";

		$db_schema['plugins'] = "CREATE TABLE IF NOT EXISTS `plugins` (`name` text NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
		$db_schema['guests'] = "CREATE TABLE IF NOT EXISTS `guests` (`ip` text NOT NULL, `visit` text NOT NULL, `type` text NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

		require_once('../include/database.php');
		$cid = mysql_connect($config['host'], $config['user'], $config['pass']);
		mysql_select_db($config['db']);

		echo "<h2>Creating tables...</h2><ul>";
		  
		foreach($db_schema as $table => $sql)
		{
			mysql_query($sql) or die(mysql_error()); 
			echo "<li>Created table <code>{$table}</code></li>";
		}
		  
		echo "</ul><p>Done!</p>";
		
		// Default data
		$db_schema = array();
		$db_schema['config'] = "INSERT INTO `config` (`id`, `key`, `value`) VALUES (1, 'site_name', 'ninko'),(2, 'admin_email', 'your@email.com'),(3, 'admin_symbol', '!'),(4, 'url_path', 'http://mysite.com/riotpix'),(5, 'path', ''),(6, 'allow_cookies', '1'),(7, 'cookie_domain', '/'),(8, 'cookie_save', '1327713948'),(9, 'min_name_length', '3'),(10, 'max_name_length', '100'),(11, 'email_validation', ''),(12, 'email_sender', 'noreply@email.com'),(13, 'email_subject', 'Action required to activate your account at {site_name}!'),(14, 'email_message', 'Hello {username}!\r\nYou recently signed up at ninko, this email is to validate that the email you used is a real email address. \r\n\r\nClick on the following link to validate your account: {link}\r\n----------------------------------------------------------------------------\r\nThis email was sent automatically. Please do not respond to this for support or help Thank you and have a nice day! From {site_name}'),(15, 'age_validation', ''),(16, 'avatar_max_size', '100'),(17, 'avatar_max_width', '100'),(18, 'avatar_max_height', '100'),(19, 'avatar_upload_path', 'avatars/'),(20, 'avatar_folder_name', 'avatars'),(21, 'avatar_use', 'username'),(22, 'avatar_md5_use', '1'),(23, 'default_avatar', 'default'),(24, 'default_avatar_type', '.jpg'),(25, 'user_online_timeout', '30'),(26, 'messages_per_page', '20'),(27, 'messages_per_topic', '13'),(28, 'subject_minimum_length', '3'),(29, 'subject_max_length', '32')(28, 'message_minimum_length', '3'),(29, 'message_max_length', '500'),(30, 'signature_allow', '1'),(31, 'signature_minimum_length', '3'),(32, 'signature_max_length', '500'),(33, 'post_topic_time_limit', '30'),(34, 'post_reply_time_limit', '10'),(35, 'show_first_post', '1'),(36, 'allow_quick_reply', '1'),(37, 'max_length', '32'),(38, 'slashes', ''),(39, 'date_format', 'F jS, Y, g:i a'),(40, 'timechange', '-5'),(42, 'version', '1.1'),(43, 'bbcode', '1'),(44, 'bbcode_url', '1'),(45, 'bbcode_image', '1'),(46 , 'language', 'en'), (47 , 'theme', 'default');";
		$db_schema['plugins'] = "INSERT INTO `plugins` (`name`) VALUES ('guest_counter'),('captcha');";
		
		echo "<h2>Inserting Data...</h2><ul>";
		  
		foreach($db_schema as $table => $sql)
		{
			mysql_query($sql); 
			echo "<li>Inserted <strong>default</strong> data into <code>{$table}</code></li>";
		}
		  
		echo "</ul><p>Done!</p>";
		
		echo '<p><a href="?step=4">Step 4 &raquo;</a></p>';
	}
?>
<?php break; 
case 4: ?>
<form method="post" action="?step=5">
  <h2>Setup basic forum settings</h2>
	<table>
		<tr>
			<th scope="row">Forum Name</th>
			<td><input name="site_name" type="text" value="NinkoBB" size="25"/></td>
			<td class="info">Your site name</td>
		</tr>
		<tr>
			<th scope="row">Forum Url</th>
			<td><input name="url_path" type="text" size="25" value="http://yoursite.com/ninkobb" /></td>
			<td class="info">Url to your installation of ninko, you must change this! No Trailing Slash</td>
		</tr>
	</table>
  <h2 class="step">
    <input name="submit" type="submit" value="Submit" />
  </h2>
</form>
<?php break; 
case 5: ?>
<?php
	if (file_exists("../include/database.php"))
	{
		require_once('../include/database.php');
		$cid = mysql_connect($config['host'], $config['user'], $config['pass']);
		mysql_select_db($config['db']);
		
		$query = array();
		$query['forum name'] = "UPDATE `config` SET `value` = '{$_POST['site_name']}' WHERE `key`='site_name' LIMIT 1";
		$query['forum url'] = "UPDATE `config` SET `value` = '{$_POST['url_path']}' WHERE `key`='url_path' LIMIT 1";
		
		echo "<h2>Updating configuration...</h2><ul>";
		  
		foreach($query as $item => $sql)
		{
			mysql_query($sql); 
			echo "<li>Updated <code>{$item}</code></li>";
		}
		  
		echo "</ul><p>Done!</p>";
		
		echo '<p><a href="?step=6">Step 6 &raquo;</a></p>';
	}
?>
<?php break; case 6: ?>
<form method="post" action="?step=7">
  <h2>Setup admin account</h2>
 	<table>
		<tr>
			<th scope="row">Username</th>
			<td><input name="username" type="text" size="25"/></td>
			<td class="info">Admin username</td>
		</tr>
		<tr>
			<th scope="row">Password</th>
			<td><input name="password" type="password" size="25" /></td>
			<td class="info">Admin password</td>
		</tr>
		<tr>
			<th scope="row">Password Again</th>
			<td><input name="passworda" type="password" size="25" /></td>
			<td class="info">Admin password again</td>
		</tr>
		<tr>
			<th scope="row">Email</th>
			<td><input name="email" type="text" size="25" /></td>
			<td class="info">Admin email address</td>
		</tr>
		<tr>
			<th scope="row">Birthday</th>
			<td>
				<select name="month" id="month" style="padding: 2px;">
<?php 
$i = 1;

while($i <= 12)
{
	if($i < 10)
	{
		$num = '0'.$i;
	}
	else
	{
		$num = $i;
	}
	
	echo '<option value="'.$num.'">'.$num.'</option>';
	
	$i++;
}
?>
				</select>
					
				<select name="day" id="day">
<?php 
$i = 1;

while($i <= 31)
{
	if($i < 10)
	{
		$num = '0'.$i;
	}
	else
	{
		$num = $i;
	}
	
	echo '<option value="'.$num.'">'.$num.'</option>';
	
	$i++;
}
?>
				</select>
				<input type="text" name="year" style="width:40%;">
			</td>
			<td class="info">birthday mm/dd/yyyy</td>
		</tr>
	</table>
  <h2 class="step">
    <input name="submit" type="submit" value="Submit" />
  </h2>
</form>
<?php break; 
case 7: ?>
<?php
	if (file_exists("../include/database.php"))
	{
		require_once('../include/database.php');
		$cid = mysql_connect($config['host'], $config['user'], $config['pass']);
		mysql_select_db($config['db']);
		
		if($_POST['password'] != $_POST['passworda'])
		{
?>
<p><strong>Error</strong></p>
<ul>
	<li>Passwords did not match! Can't have you setting a password you don't know!</li>
</ul>

<p><a href="javascript:history.back(-1)">&laquo; Back to step 6</a></p>
<?php
			die();
		}
		
		// Update stuff
		$password = md5($_POST['password']);
		$age = "{$_POST['month']}/{$_POST['day']}/{$_POST['year']}";
		
		// Insert user data
		$query = "INSERT INTO `users` (`username`,`email`,`password`,`age`,`admin`,`active`,`join_date`) VALUES ('{$_POST['username']}','{$_POST['email']}','{$password}', '{$age}', 1, 1, '".time()."')";
		mysql_query($query);
?>
<p>User inserted, As soon as you get on the main page of your forums, login and do the following steps:</p>

<ul>
	<li>Please delete /setup/ folder, and enjoy NinkoBB!</li>
</ul>

<p>If you have any questions or concerns please go to: <a href="http://ninkobb.com">http://ninkobb.com</a></p>

<p><a href="../">Proceed to main and login &raquo;</a></p>
<?php
	}
	
	break;
}
?>
</body>
</html>
