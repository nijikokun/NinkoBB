<?php
/*
Plugin Name: Titles
Description: Allows you to have titles, with revisions!
Version: 1.0
Author: Nijiko
Author URI: http://ninkobb.com
*/

/**
 * For the hook
 */
if(isset($_GET['a'])){ if($_GET['a'] == "revisions"){ $load_plugins = true; include('../include/common.php'); $action = "revisions"; } else { if(!defined('IN_NK')) die('Invalid inclusion.'); } }

/**
 * Add hooks
 */
add_hook('user_profile_edit', 'profile_input', array());
add_hook('user_profile_post', 'profile_edit', array());
add_hook('user_navigation', 'profile_nav_link', array($action));

/**
 * The page for revisions
 */
if(isset($_GET['a']))
{
	if($_GET['a'] == "revisions")
	{
		$action = "revisions";
		
		if(is_array($user_data))
		{
			// Page setup
			include($config['template_path'] . "header.php");
			include($config['template_path'] . "navigation.php");
			include($config['template_path'] . "user/navigation.php");
?>
	<h3 class="title"><?php echo lang('revisions_to_title'); ?></h3>
	
	<div class="content">
<?php
// Grab revisions
$results = $database->query( "SELECT * FROM `revisions` WHERE `user_id` = '{$user_data['id']}'" );
			
if($database->num( $results ) < 1)
{
?>
		No revisions yet.
<?php
}
else
{
	while($row = $database->fetch($results))
	{
?>
		<div class="plugin">
			<span class="status">
				r<?php echo $row['id']; ?>
			</span>
			
			<h3 class="name"><?php echo $row['text']; ?></h3>
			<span title="<?php echo date($config['date_format'], (($row['date'] + $config['zone']))); ?>"><?php echo ago((($row['date'] + $config['zone']))); ?> ago</span>
		</div>
<?php
	}
}
?>
	</div>
<?php
			add_hook('footer_right', 'copyright', array());
			
			include($config['template_path'] . "footer.php");
		}
		else
		{
			print_out(lang('error_not_logged'), lang('redirecting'));
		}
	}
}

/**
 * Setup user title if no title is present.
 */
function get_title($data)
{
	if(!is_array($data))
	{
		return 'err';
	}

	if(!$data['title'])
	{
		if($data['admin'])
		{
			$data['title'] = "Administrator";
		}
		else if($user_data['moderator'])
		{
			$data['title'] = "Moderator";
		}
		else
		{
			$data['title'] = "Member";
		}
	}

	// Show banned regardless of anything if they are banned.
	if($data['banned'])
	{
		$data['title'] = "Banned";
	}
	
	return $data['title'];
}
 
/**
 * List of banned revisions
 */
$config['banned_titles'] = array(
	'admin', 'banned', 'moderator'
);

/**
 * Installs plugin
 */
function install_titles()
{
	global $database;
	
	$database->query("CREATE TABLE IF NOT EXISTS `revisions` (`id` int(255) NOT NULL auto_increment, `user_id` mediumint(255) NOT NULL, `date` text NOT NULL, `text` text NOT NULL, PRIMARY KEY  (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;") or die(mysql_error());
}

/**
 * Uninstall plugin
 */
function uninstall_titles()
{
	global $database;
	
	$database->query("DROP TABLE IF EXISTS `revisions`") or die(mysql_error());
}

/**
 * Inserts the title input into profile edit page
 * @global array
 * @global array
 */
function profile_input()
{
	global $config, $user_data;
	
	echo '<dl class="input">' . "\n" .
			'<dt>' . lang('title_c') . '</dt>'. "\n" .
			'<dd><input type="text" class="border cp" name="title" value="' . switchs($user_data['title'], $_POST['location']). '"></dd>' ."\n" .
		 '</dl>' . "\n";
}

/**
 * Inserts the title input into profile edit page
 * @global array
 * @global array
 */
function profile_nav_link($action)
{
	global $config, $user_data;
			
	echo '<li><a href="'. $config['url_path']. '/plugins/titles.php?a=revisions" class="'. equals($action, "revisions", "menu-current", "menu") .'">'. lang('revisions_c') .'</a></li>';
}

/**
 * Cleans up the guest array
 * @global array
 * @global array
 */
function profile_edit()
{
	global $config, $user_data, $errors, $key, $data;
	
	// Check the data, output error into errors array if there was an error.
	if($key == "title")
	{
		// Check the data, output error into errors array if there was an error.
		if(alpha($data, 'alpha-spacers') || $data == "")
		{
			if(!in_array($data, $config['banned_titles']))
			{
				$length = length($data, 2, 32);
				
				if($length)
				{
					if($length == "TOO_LONG")
					{
						$errors[$key] = lang('error_title_too_long');
					}
					else
					{
						$errors[$key] = lang('error_title_too_short');
					}
				}
				else
				{
					// update user
					update_user($user_data['id'], false, $key, $data);
					
					// update revisions
					if(insert_revision($user_data['id'], $data))
					{
						$errors[$key] = insert_revision($user_data['id'], $data);
					}
				}
			}
		}
		else
		{
			$errors[$key] = lang_parse('error_invalid_chars', array(lang('title_c')));
		}
	}
}

/**
 * Insert revisions
 * @global array
 * @global resource
 * @param integer $user_id user id
 * @param string $text contains the revision to title
 * @return boolean
 */
function insert_revision($user_id, $text)
{
	global $config, $database;
	
	$result = $database->query( "INSERT INTO `revisions` (`user_id`,`date`,`text`) VALUES ('{$user_id}','".time()."','{$text}'); " );
	
	// is there a result?
	if($result)
	{
		return false;
	}
	else
	{
		return mysql_error;
	}
}

function copyright(){ ?> Titles w/ Revisions Plugin v1.2 | <?php }

?>