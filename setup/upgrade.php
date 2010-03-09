<?php session_start(); define('IN_NK', true);
/**
 * upgrade.php
 * 
 * Admin control panel allowing users to manage the forum
 * @author Nijiko Yonskai <me@nijikokun.com>
 * @version 1.3RC2
 * @copyright (c) 2010 ANIGAIKU
 * @package ninko
 * @subpackage setup
 */

// Turning certain things in common off.
$connect = true;
$user_login = true;
$load_plugins = true;

// Include common
include('../include/common.php');

// What step are we on?
if (isset($_GET['step'])){ $step = $_GET['step']; } else { $step = 0; }

// Versions
$prior = array(
	1.0,
	1.1,
	1.2
);

$latest = 1.3;

if(isset($_GET['v']) && in_array(intval($_GET['v']), $prior) && is_numeric($_GET['v']))
{
	$current_version = $_GET['v'];
}
else
{
	$current_verison = $config['version'];
}
	
header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>NinkoBB Upgrader &rsaquo; Start</title>
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
<h1>NinkoBB Upgrader</h1>
<?php
// Check if config.php has been created
if (!file_exists('../include/database.php'))
	die("<ul><li>The file 'database.php' doesn't exist.</li></ul> <p>Please go here: <a href='index.php'>install</a></p></body></html>");
		
switch($step)
{
	case 0:

?>
<p>Hello there, this script will upgrade your current version of ninko v<?php echo $current_version; ?> to the latest version (v<?php echo $latest; ?>).</p>

<p><strong>Some things it will do</strong></p>
<ul>
	<li>Update your current database with new information</li>
<?php if($current_version < 1.1){ ?>
	<li>There will be editing of the core user table with this upgrade, please backup your database <u>before</u> continuing.</li>
<?php } else { ?>
	<li>No posts / users will be edited in this upgrade, <em>please</em> backup your database <u>before</u> continuing for safety.</li>
<?php } ?>
</ul>

<p><a href="?step=1<?php echo "&v={$current_version}"; ?>">Continue to upgrade &raquo;</a></p>
<?php break; case 1: ?>
<p>Updating...</p>

<?php
	if (file_exists("../include/database.php"))
	{
		require_once('../include/database.php');
		require_once('../include/connect.php');
		
		$schemas = array();
		
		if(!isset($_GET['v']) || !in_array(intval($_GET['v']), $prior) || !is_numeric($_GET['v']))
		{
?>
<p>Hmm.. Had some trouble selecting what version of NinkoBB you are upgrading from..</p>

<?php if(isset($current_version)){ ?>
<p>
	Your configuration says you are on: <a href="setup.php?step=1&v=<?php echo $current_version; ?>"><b><?php echo $current_version; ?></a></b>.<br /><br />
	If this is incorrect select your version below:
</p>
<?php } ?>

<p>
	Select your version: 
<?php foreach($prior as $version){ ?>
	<a href="setup.php?step=1&v=<?php echo $version; ?>"><?php echo $version; ?></a>, 
<?php } ?>
</p>
<?php
			exit;
		}
		
		// Integer value
		$version = intval($_GET['v']);
		
		// 1.0 updates
		if($_GET['v'] == 1.0)
		{
			$schema['Update <code>`config`</code>'] = "INSERT INTO `config` (`id` ,`key` ,`value`) VALUES (NULL , 'language', 'en'), (NULL , 'theme', 'default');";
			$schema['Create table <code>`plugins`</code>'] = "CREATE TABLE IF NOT EXISTS `plugins` (`name` text NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
			$schema['Install <code>`guest_counter`</code> plugin [default plugin]'] = "CREATE TABLE IF NOT EXISTS `guests` (`ip` text NOT NULL, `visit` text NOT NULL, `type` text NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
			$schema['Update <code>`plugins`</code> install <code>`guest_counter`</code>'] = "INSERT INTO `plugins` (`name`) VALUES ('guest_counter');";
			$schema['Updating Configuration to <code>1.1</code>'] = "UPDATE `config` SET `value` = '1.1' WHERE `key` = 'version';";
		}
		
		// 1.1 updates
		if($_GET['v'] == 1.1)
		{
			$checks['directory'] = array("<code>plugins/captcha/</code> directory of ninko is ", '../plugins/captcha/', '0777');
			$schema['Update <code>`config`</code> for subject length'] = "INSERT INTO `config` (`id` ,`key` ,`value`) VALUES (NULL , 'subject_minimum_length', '3'), (NULL , 'subject_max_length', '32');";
			$schema['Update <code>`users`</code> with <code>`moderator`</code> setting'] = "ALTER TABLE `users` ADD `moderator` INT(1) NOT NULL DEFAULT '0' AFTER `admin`";
			$schema['Update <code>`plugins`</code> install <code>`captcha`</code>'] = "INSERT IGNORE INTO `plugins` (`name`) VALUES ('captcha');";
			$schema['Updating Configuration to <code>1.2</code>'] = "UPDATE `config` SET `value` = '1.2' WHERE `key` = 'version';";
		}
		
		// Code for the LATEST upgrade, injects on all older upgrades.
		if($_GET['v'] < $latest)
		{
			$schema['Update <code>`config`</code> for interests length'] = "INSERT INTO `config` (`id` ,`key` ,`value`) VALUES (NULL , 'interests_min_length', '3'), (NULL , 'interests_max_length', '1000');";
			$schema['Create table <code>`categories`</code>'] = "CREATE TABLE IF NOT EXISTS `categories` (`id` int(255) AUTO_INCREMENT,`name` text,`order` int(255) NOT NULL DEFAULT '0',`aop` int(1) NOT NULL DEFAULT '0',`aot` int(1) NOT NULL DEFAULT '0',`extended` int(1) NOT NULL DEFAULT '0', PRIMARY KEY (`id`));";
			$schema['Update <code>`forums`</code> with <code>`categories`</code>'] = "INSERT IGNORE INTO `categories` (`name`, `order`, `aot`) VALUES ('News', 0, 1),('General', 1, 0),('Other', 2, 0);";
			$schema['Update <code>`plugins`</code> install <code>`BBCBar`</code>'] = "INSERT IGNORE INTO `plugins` (`name`) VALUES ('bbcbar');";
			$schema['Updating Configuration to <code>1.3</code>'] = "UPDATE `config` SET `value` = '1.3' WHERE `key` = 'version';";
		}
		
		if(is_array($checks) && isset($checks))
		{
			echo "<p>Checking directories / files</p>";
			
			echo "<ul>";
			
			foreach($checks as $todo => $data)
			{
				if($todo == "directory")
				{
					if(is_writable($data[1]))
					{
						$return = "<span class='error'>unwritable.</span> Please chmod to " . $data[2];
					}
					else
					{
						$return = "<span class='ok'>writable</span>";
					}
				
					echo "<li>{$data[0]}{$return}</li>";
				}
			}
			
			echo "</ul>";
		}
		
		if(!$errors)
		{
			echo "<p>Updating database</p>";
			
			echo "<ul>";
			
			foreach($schema as $doing => $sql)
			{
				$database->query($sql) or die($database->error('Could not `'.$doing.'`', __FILE__, __LINE__));
				
				echo "<li>{$doing}</li>";
			}
			
			echo "</ul>";
		}
	}
?>

<p>Done.</p>

<p>Please delete the /setup/ folder before continuing.</p>

<p><a href="../">Proceed to your ninko &raquo;</a></p>
<?php break; } ?>
</body>
</html>