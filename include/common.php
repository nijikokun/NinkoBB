<?php session_start();
/**
 * common.php
 * 
 * Controls inclusions, configuration, and common data. The base file.
 * @author Nijiko Yonskai <me@nijikokun.com>
 * @version 1.2
 * @package ninko
 */
 
/**
 * Are we inside of ninko?
 */
define("IN_NK", true);

// System Folder
if (function_exists ( 'realpath' ) and @realpath ( dirname ( __FILE__ ) ) !== FALSE)
{ 
	$system_folder = str_replace ( '', '/', realpath ( dirname ( __FILE__ ) ) ); 
}

// Inclusion variables
define ( 'EXT', 		'.' . pathinfo ( __FILE__, PATHINFO_EXTENSION ) );
define ( 'BASEPATH', 	$system_folder . '/' );
define ( 'FUNCTIONS', 	$system_folder . '/functions/' );
define ( 'DATABASE',	$system_folder . '/database/' );

/**
 * Include configuration
 */
include(BASEPATH . "config" . EXT);


if(file_exists(BASEPATH . "database" . EXT))
{
	/**
	 * Include database configuration
	 */
	include(BASEPATH . "database" . EXT);
}
else
{
	// send to setup.
	header('location: setup/');
}

/**
 * Include connection to database: MySQL
 */
include(BASEPATH . "connect" . EXT);

// Parse Config
$result = $database->query("SELECT * FROM `config`");

// Loop through the results and set the values.
while($row = $database->fetch($result))
{
	if($row['value'] == "" || !$row['value'])
	{
		$config[$row['key']] = false;
	}
	else
	{
		$config[$row['key']] = $row['value'];
	}
}

// Check version
if($config['version'] != '1.2')
{
	// send to upgrade
	header('location: setup/upgrade.php?v=' . $config['version']);
}

/**
 * Include theme functions
 */
include(FUNCTIONS . "theme" . EXT);

// Load the theme
load_theme();

/**
 * Include language functions
 */
include(FUNCTIONS . "language" . EXT);

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
	include(FUNCTIONS . $file . EXT);
}

// Fetch plugins
$plugins = plugins();
	
// Fetch loaded plugins
$result = $database->query( "SELECT * FROM `plugins`" );

// Load plugins
if($database->num($result) >= 1)
{
	while($loading = $database->fetch($result))
	{
		foreach($plugins as $plugin)
		{
			if($load_plugins) { continue; }
			// don't even think of loading error'd plugins
			if($plugin['error']) { continue; }
			if(!isset($plugin['name'])) { continue; }
			
			if($loading['name'] == $plugin['plugin'])
			{
				// Load the plugin
				include(BASEPATH . '../plugins/' . $plugin['file']);
				
				// That plugin has been loaded.
				plugin_loaded($plugin['plugin']);
			}
		}
	}
}


/**
 * Include Sessions
 */
include(BASEPATH . "sessions" . EXT);

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