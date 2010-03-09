<?php session_start(); define('IN_NK', true);
/**
 * index.php
 * 
 * Admin control panel allowing users to manage the forum
 * @author Nijiko Yonskai <me@nijikokun.com>
 * @version 1.3
 * @lyric Why can't our bodies reset themselves? Won't you please reset me.
 * @copyright (c) 2010 ANIGAIKU
 * @package ninko
 * @subpackage setup
 */
 
// Turning certain things in common off.
$connect = true;
$user_login = true;
$load_plugins = true;
$installing = true;

// Include common
include('../include/common.php');

// What step are we on?
if (isset($_GET['step'])){ $step = $_GET['step']; } else { $step = 0; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo lang('install_title'); ?></title>
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
<h1><?php echo lang('install_title'); ?></h1>
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
	<li><?php echo lang('install_db'); ?></li>
	<li><?php echo lang('install_db_user'); ?></li>
	<li><?php echo lang('install_db_pass'); ?></li>
	<li><?php echo lang('install_db_host'); ?></li>
	<li><?php echo lang('install_db_type'); ?></li>
</ol>

<p><strong>Checking Server Stats</strong></p>
<ul>
	<li><code>/</code> root directory of ninko is <?php if (!is_writable('../')) { echo "<span class='error'>unwritable.</span> Please chmod to 777"; $continue = false; } else { echo "<span class='ok'>writable</span>"; } ?>
	<li><code>/include/</code> directory of ninko is <?php if (!is_writable('../include/')) { echo "<span class='error'>unwritable.</span> Please chmod to 777"; $continue = false; } else { echo "<span class='ok'>writable</span>"; } ?>
	<li><code>/include/database/</code> directory of ninko is <?php if (!is_writable('../include/database/')) { echo "<span class='error'>unwritable.</span> Please chmod to 777"; $continue = false; } else { echo "<span class='ok'>writable</span>"; } ?>
	<li><code>/avatars/</code> directory of ninko is <?php if (!is_writable('../avatars/')) { echo "<span class='error'>unwritable.</span> Users will not be able to upload avatars"; } else { echo "<span class='ok'>writable</span>"; } ?>
	<li><code>/plugins/captcha/</code> directory of ninko is <?php if (!is_writable('../plugins/captcha/')) { echo "<span class='error'>unwritable.</span> Users will not be able to upload avatars"; $continue = false; } else { echo "<span class='ok'>writable</span>"; } ?>
</ul>

<p><?php if($continue){ ?><a href="?step=1">Continue to step 1 &raquo;</a><?php } else { ?>Please check your server and update any server errors!<?php } ?></p>
<?php break; case 1: ?>
<?php
$ext = array();
if (function_exists('mysqli_connect'))
{
	$ext['mysqli'] = 'MySQL Improved';
}
	
if (function_exists('mysql_connect'))
{
	$ext['mysql'] = 'MySQL Standard';
}

if (empty($ext))
{
	die(lang('install_db_support'));
}
?>
</p>
<form method="post" action="?step=2">
  <p>Below you should enter your database connection details. If you're not sure about these, contact your host. </p>
	<table>
		<tr>
			<th scope="row"><?php echo lang('install_db'); ?> *</th>
			<td><input name="db" type="text" size="25"/></td>
			<td class="info"><?php echo lang('install_db_name_msg'); ?></td>
		</tr>
		<tr>
			<th scope="row"><?php echo lang('install_db_user'); ?></th>
			<td><input name="user" type="text" size="25"/></td>
			<td class="info"><?php echo lang('install_db_user_msg'); ?></td>
		</tr>
		<tr>
			<th scope="row"><?php echo lang('install_db_pass'); ?></th>
			<td><input name="pass" type="text" size="25"/></td>
			<td class="info"><?php echo lang('install_db_pass_msg'); ?></td>
		</tr>
		<tr>
			<th scope="row"><?php echo lang('install_db_host'); ?> *</th>
			<td><input name="host" type="text" size="25" value="localhost" /></td>
			<td class="info"><?php echo lang('install_db_host_msg'); ?></td>
		</tr>
		<tr>
			<th scope="row"><?php echo lang('install_db_type'); ?> *</th>
			<td>
				<select name="type">
				<?php foreach($ext as $value => $name) { echo "<option value='{$value}'>{$name}</option>"; } ?>
				</select>
			</td>
			<td class="info">Supported on NinkoBB: MySQL, MySQLi</td>
		</tr>
	</table>
  <h2 class="step">
    <input name="submit" type="submit" value="Submit" />
  </h2>
</form>
<?php break; case 2: ?>
<?php
// Simulate Database File
$database['db'] = trim($_POST['db']);
$database['user'] = trim($_POST['user']);
$database['pass'] = trim($_POST['pass']);
$database['host'] = trim($_POST['host']);
$database['type'] = trim($_POST['type']);

// Setup direct access to variables
foreach($database as $key => $value)
{
	$$key = $value;
}
	
// Include that shit!
include('../include/connect.php');
	
if (!$database)
{ 
?>
<p><strong><?php echo lang('error'); ?></strong></p>
<ul>
	<li><?php echo lang('install_error_db_connect'); ?></li>
</ul>

<p><a href="?step=1"><?php echo lang_parse('install_step_back', array('1')); ?></a></p>
<?php
	die();
}
else
{
	$handle = fopen('../include/database.php', 'w');
	
	if($handle)
	{
		$source = array (
			"<?php if(!defined('IN_NK')) die('Invalid inclusion.');\n",
			"/**\n",
			" * database.php\n",
			" * \n",
			" * Controls the database connection values\n",
			" * @version 1.3\n",
			" * @copyright (c) 2010 ANIGAIKU\n",
			" * @package ninko\n",
			" */\n\n",
			"$","database['db'] = '{db}'; // Database Database lol.\n",
			"$","database['user'] = '{user}'; // Database Username \n",
			"$","database['pass'] = '{pass}'; // Database Password \n",
			"$","database['host'] = '{host}'; // Database Host\n",
			"$","database['type'] = '{type}'; // Database type\n",
			"$","database['persistant'] = false; // Persistant? Supported: MySQL, SQLite\n",
			"?>"
		);

		$search = array ('{db}', '{user}', '{pass}', '{host}', '{type}');
		$replace = array ($db, $user, $pass, $host, $type);
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
<p><strong><?php echo lang('error'); ?></strong></p>
<ul>
	<li><?php echo lang('install_error_mk_db'); ?></li>
</ul>
<?php die();
	}
}
?>
<p><strong><?php echo lang('install_connection'); ?></strong></p>

<p>
	<a href="?step=3"><?php echo lang_parse('install_step', array('3')); ?></a>
</p>
<?php break; case 3: ?>
<?php
	if (file_exists("../include/database.php"))
	{
		// The database's to create
		$db_schema = array();
	 
		$db_schema['config'] = "
		CREATE TABLE IF NOT EXISTS `config` (
			`id` int(255) AUTO_INCREMENT,
			`key` text,
			`value` text,
			PRIMARY KEY (`id`)
		);";

		$db_schema['categories'] = "
		CREATE TABLE IF NOT EXISTS `categories` (
		  `id` int(255) AUTO_INCREMENT,
		  `name` text,
		  `order` int(255) NOT NULL DEFAULT '0',
		  `aop` int(1) NOT NULL DEFAULT '0',
		  `aot` int(1) NOT NULL DEFAULT '0',
		  `expanded` int(1) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`id`)
		);";

		$db_schema['forum'] = "
		CREATE TABLE IF NOT EXISTS `forum` (
		  `id` int(255) AUTO_INCREMENT,
		  `category` int(255) NOT NULL DEFAULT '0',
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
		);";

		$db_schema['users'] = "
		CREATE TABLE IF NOT EXISTS `users` (
		  `id` int(255) AUTO_INCREMENT,
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
		);";

		$db_schema['plugins'] = "CREATE TABLE IF NOT EXISTS `plugins` (`name` text NOT NULL);";
		$db_schema['guests'] = "CREATE TABLE IF NOT EXISTS `guests` (`ip` text NOT NULL, `visit` text NOT NULL, `type` text NOT NULL);";

		require_once('../include/database.php');
		require_once('../include/connect.php');

		echo "<h2>" . lang('install_create_tables') . "</h2><ul>";
		  
		foreach($db_schema as $table => $sql)
		{
			$database->query($sql) or die($database->error($table . " - " . $database->error_message(), __FILE__, __LINE__)); 
			echo "<li>" . lang('install_created_table') . "<code>{$table}</code></li>";
		}
		  
		echo "</ul><p>".lang('install_done')."</p>";
		
		// Default data
		$db_schema = array();
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('site_name', 'NinkoBB');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('admin_email', 'your@email.com');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('admin_symbol', '!');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('url_path', 'http://localhost/ninkobb/ninkobb');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('path', '');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('allow_cookies', '1');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('cookie_domain', 'localhost');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('cookie_save', '1327713948');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('min_name_length', '3');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('max_name_length', '100');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('email_validation', '');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('email_sender', 'noreply@email.com');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('email_subject', 'Action required to activate your account at {site_name}!');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('email_message', 'Hello {username}!\r\nYou recently signed up at ninko, this email is to validate that the email you used is a real email address. \r\n\r\nClick on the following link to validate your account: {link}\r\n----------------------------------------------------------------------------\r\nThis email was sent automatically. Please do not respond to this for support or help Thank you and have a nice day! From {site_name}');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('age_validation', '');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('avatar_max_size', '100');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('avatar_max_width', '100');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('avatar_max_height', '100');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('avatar_upload_path', 'avatars/');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('avatar_folder_name', 'avatars');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('avatar_use', 'username');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('avatar_md5_use', '1');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('default_avatar', 'default');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('default_avatar_type', '.jpg');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('user_online_timeout', '30');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('messages_per_page', '20');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('messages_per_topic', '13');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('subject_minimum_length', '3');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('subject_max_length', '32');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('message_minimum_length', '3');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('message_max_length', '500');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('signature_allow', '1');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('signature_minimum_length', '3');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('signature_max_length', '500');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('post_topic_time_limit', '30');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('post_reply_time_limit', '10');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('show_first_post', '1');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('allow_quick_reply', '1');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('max_length', '32');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('slashes', '');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('date_format', 'F jS, Y, g:i a');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('timechange', '-5');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('version', '1.2');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('bbcode', '1');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('bbcode_url', '1');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('bbcode_image', '1');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('theme', 'default');";
		$db_schema['config'][] = "INSERT INTO `config` (`key`, `value`) VALUES('language', 'en');";
		$db_schema['config'][] = "INSERT INTO `config` (`key` ,`value`) VALUES('interests_min_length', '3');";
		$db_schema['config'][] = "INSERT INTO `config` (`key` ,`value`) VALUES('interests_max_length', '1000');";
		$db_schema['categories'][] = "INSERT INTO `categories` (`name`,`order`,`aot`) VALUES ('News', 0, 1);";
		$db_schema['categories'][] = "INSERT INTO `categories` (`name`,`order`) VALUES ('General', 1);";
		$db_schema['categories'][] = "INSERT INTO `categories` (`name`,`order`) VALUES ('Other', 2);";
		$db_schema['plugins'][] = "INSERT INTO `plugins` (`name`) VALUES ('guest_counter');";
		$db_schema['plugins'][] = "INSERT INTO `plugins` (`name`) VALUES ('captcha');";
		$db_schema['plugins'][] = "INSERT INTO `plugins` (`name`) VALUES ('bbcbar');";
		
		// Install time!
		echo "<h2>".lang('install_data')."</h2><ul>";
		
		// So the inserts don't show a million inserts
		$previous = "";
		
		foreach($db_schema as $table => $data)
		{
			foreach($data as $id => $sql)
			{
				$database->query($sql);
			}
			
			if($previous != $table)
			{
				echo "<li>".lang('install_data_msg')." <code>{$table}</code></li>";
				$previous = $table;
			}
		}
		  
		echo "</ul><p>".lang('install_done')."</p>";
		
		echo '<p><a href="?step=4">' . lang_parse('install_step', array('4')) . '</a></p>';
	}
?>
<?php break; 
case 4: ?>
<form method="post" action="?step=5">
  <h2><?php echo lang('install_conf'); ?></h2>
	<table>
		<tr>
			<th scope="row"><?php echo lang('install_conf_name'); ?></th>
			<td><input name="site_name" type="text" value="NinkoBB" size="25"/></td>
			<td class="info"><?php echo lang('install_conf_name_msg'); ?></td>
		</tr>
		<tr>
			<th scope="row"><?php echo lang('install_conf_url'); ?></th>
			<td><input name="url_path" type="text" size="25" value="http://yoursite.com/ninkobb" /></td>
			<td class="info"><?php echo lang('install_conf_url_msg'); ?></td>
		</tr>
	</table>
  <h2 class="step">
    <input name="submit" type="submit" value="<?php echo lang('install_btn'); ?>" />
  </h2>
</form>
<?php break; 
case 5: ?>
<?php
	if (file_exists("../include/database.php"))
	{
		require_once('../include/database.php');
		require_once('../include/connect.php');
		
		$query = array();
		$query['forum name'] = "UPDATE `config` SET `value` = '{$_POST['site_name']}' WHERE `key`='site_name' LIMIT 1";
		$query['forum url'] = "UPDATE `config` SET `value` = '{$_POST['url_path']}' WHERE `key`='url_path' LIMIT 1";
		
		echo "<h2>". lang('install_update_config') ."</h2><ul>";
		  
		foreach($query as $item => $sql)
		{
			$database->query($sql) or die($database->error("Could not update `{$item}`" . " - " . $database->error_message(), __FILE__, __LINE__)); 
			echo "<li>". lang('install_updated') ." <code>{$item}</code></li>";
		}
		  
		echo "</ul><p>".lang('install_done')."</p>";
		
		echo '<p><a href="?step=6">' . lang_parse('install_step', array('6')) . '</a></p>';
	}
?>
<?php break; case 6: ?>
<form method="post" action="?step=7">
  <h2><?php echo lang('install_usr_msg'); ?></h2>
 	<table>
		<tr>
			<th scope="row"><?php echo lang('username'); ?></th>
			<td><input name="username" type="text" size="25"/></td>
			<td class="info"></td>
		</tr>
		<tr>
			<th scope="row"><?php echo lang('password'); ?></th>
			<td><input name="password" type="password" size="25" /></td>
			<td class="info"></td>
		</tr>
		<tr>
			<th scope="row"><?php echo lang('password_again'); ?></th>
			<td><input name="passworda" type="password" size="25" /></td>
			<td class="info"></td>
		</tr>
		<tr>
			<th scope="row"><?php echo lang('email'); ?></th>
			<td><input name="email" type="text" size="25" /></td>
			<td class="info"></td>
		</tr>
	</table>
  <h2 class="step">
    <input name="submit" type="submit" value="<?php echo lang('install_btn'); ?>" />
  </h2>
</form>
<?php break; 
case 7: ?>
<?php
	if (file_exists("../include/database.php"))
	{
		require_once('../include/database.php');
		require_once('../include/connect.php');
		
		if($_POST['password'] != $_POST['passworda'])
		{
?>
<p><strong><?php echo lang('error'); ?></strong></p>
<ul>
	<li><?php echo lang('install_error_pw_mtch'); ?></li>
</ul>

<p><a href="javascript:history.back(-1)"><?php echo lang_parse('install_step_back', array('6')); ?></a></p>
<?php
			die();
		}
		
		// Update stuff
		$password = md5($_POST['password']);
		
		// Insert user data
		$query = "INSERT INTO `users` (`username`,`email`,`password`,`admin`,`active`,`join_date`) VALUES ('{$_POST['username']}','{$_POST['email']}','{$password}', 1, 1, '".time()."')";
		$database->query($query);
?>
<p><?php echo lang('install_final_msg'); ?></p>

<ul>
	<li><?php echo lang('install_final_ins'); ?></li>
</ul>

<p>If you have any questions or concerns please go to: <a href="http://ninkobb.com">http://ninkobb.com</a></p>

<p><a href="../"><?php echo lang('install_step_final'); ?></a></p>
<?php
	}
	
	break;
}
?>
</body>
</html>