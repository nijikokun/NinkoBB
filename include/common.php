<?php session_start();
/**
 * common.php
 * 
 * Controls inclusions, configuration, and common data. The base file.
 * @author Nijiko Yonskai <me@nijikokun.com>
 * @version 1.1
 */
 
/**
 * Are we inside of ninko?
 */
define("IN_NK", true);

/**
 * Include configuration
 */
include("include/config.php");


if(file_exists('include/database.php'))
{
	/**
	 * Include database configuration
	 */
	include("include/database.php");
}
else
{
	// send to setup.
	header('location: setup/');
}

/**
 * Include connection to database: MySQL
 */
include("include/connect.php");

// Parse Config
$result = mysql_query("SELECT * FROM `config`");

// Loop through the results and set the values.
while($row = mysql_fetch_array($result))
{
	if($row['value'] == "" || !$row['value'])
	{
		$config[$row['key']] = false;
	}
	else if($row['value'] == '1' || $row['value'] == 1)
	{
		$config[$row['key']] = true;
	}
	else
	{
		$config[$row['key']] = $row['value'];
	}
}

// Check version
if($config['version'] != '1.1')
{
	// send to upgrade
	header('location: setup/upgrade.php?v=' . $config['version']);
}

/**
 * Include theme functions
 */
include("include/functions/theme.php");

// Load the theme
load_theme();

/**
 * Include language functions
 */
include("include/functions/language.php");

// Include language file
if(isset($config['language']) && $config['language'] != "")
{
	$lang = language($config['language']);
	
	if(!is_array($lang))
	{
		// Default language
		$lang = language('en');
	}
}
else
{
	$lang = language('en');
}

// Functions to include
$functions = array(
	'common',
	'validation',
	'hooks',
	'user',
	'forum',
	'admin'
);

// Include the functions
foreach($functions as $file)
{
	include("include/functions/{$file}.php");
}

// Fetch plugins
$plugins = plugins();
	
// Fetch loaded plugins
$result = mysql_query( "SELECT * FROM `plugins`" );

// Load plugins
if(mysql_num_rows($result) >= 1)
{
	while($loading = mysql_fetch_array($result))
	{
		foreach($plugins as $plugin)
		{
			// don't even think of loading error'd plugins
			if($plugin['error']) { continue; }
			if(!isset($plugin['name'])) { continue; }
			
			if($loading['name'] == $plugin['plugin'])
			{
				// Load the plugin
				include('plugins/' . $plugin['file']);
				
				// That plugin has been loaded.
				plugin_loaded($plugin['plugin']);
			}
		}
	}
}


/**
 * Include Sessions
 */
include("include/sessions.php");

// Common hook
load_hook('common');

// Just incase
unset($user_data);

// Logged in?
if($_SESSION['logged_in'])
{
	/**
	 * Set user data
	 * @global array $user_data
	 */
	$user_data = user_data($_SESSION['user_id']);
	
	// Last seen update
	update_user($user_data['id'], false, 'last_seen', time());
}
?>