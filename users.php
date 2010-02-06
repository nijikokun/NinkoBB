<?php
/**
 * users.php
 * 
 * Allows editing of user settings / accounts, and viewing of other users.
 * @author Nijiko Yonskai <me@nijikokun.com>
 * @version 1.1
 * @copyright (c) 2010 ANIGAIKU
 * @package ninko
 */
 
include("include/common.php");

// Requesting what page?
switch($_GET['a'])
{
	case "home": $action = "home"; break;
	case "account": $action = "account"; break;
	case "avatar": $action = "avatar"; break;
	case "profile": $action = "profile"; break;
	case "view": $action = "view"; break;
	default: $action = "home"; break;
}

// Are they logged in? Are they trying to view a profile?
if(!$_SESSION['logged_in'])
{
	if($action != "view")
	{
		header('Location: index.php');
	}
}

// Include header
include($config['template_path'] . "header.php");

// Include the navigation
include($config['template_path'] . "navigation.php");

if($action == "home")
{
	// Include the navigation
	include($config['template_path'] . "user/navigation.php");
	
	// Include profile template
	include($config['template_path'] . "user/home.php");
}
else if($action == "account")
{
	if(isset($_POST['account']))
	{
		// If no email we just don't update it.
		if($_POST['email'] != "")
		{
			// Make sure we aren't just submitting the same email.
			if($_POST['email'] != $user_data['email'])
			{
				if(is_email($_POST['email']))
				{
					update_user($user_data['id'], false, 'email', $_POST['email']);
				}
				else
				{
					$error = lang_parse('error_invalid_chars', array(lang('email')));
				}
			}
		}
		
		// New password, Log them out, log them in.
		if($_POST['npassword'] != "" && !$error)
		{
			if($_POST['npassword'] == $_POST['npassworda'])
			{
				# Check Password Length
				$length = length($_POST['npassword'], $config['min_name_length'], $config['max_name_length']);
					
				if($length)
				{
					if($length == "TOO_LONG")
					{
						$error = lang('error_password_too_long');
					}
					else
					{
						$error = lang('error_password_too_short');
					}
				}
				
				if(md5($_POST['current']) != $user_data['password'])
				{
					$error = lang('error_current_pass');
				}
				
				// Are there any errors? If not update password.
				if(!$error)
				{
					$password = md5( $_POST['npassword'] );
				
					update_user($user_data['id'], false, 'password', $password);
				}
			}
			else
			{
				$error = lang('error_password_match');
			}
		}
		
		if(!$error)
		{
			$success = lang('success_update_password');
		}
	}
	
	// Include the navigation
	include($config['template_path'] . "user/navigation.php");
	
	// Include profile template
	include($config['template_path'] . "user/account.php");
}
else if($action == "avatar")
{
	// Trying to submit an avatar
	if(isset($_POST['avatar']))
	{
		switch($config['avatar_use'])
		{
			case "username": $status = avatar_upload($user_data['username'], $_FILES); break;
			case "email": $status = avatar_upload($user_data['email'], $_FILES); break;
			case "id": $status = avatar_upload($user_data['id'], $_FILES); break;
			default: $status = avatar_upload($user_data['username'], $_FILES); break;
		}
			
				
		switch($status)
		{
			case "NO_FILE":
				$error = lang('error_no_file');
			break;
					
			case "NOT_IMAGE":
				$error = lang('error_filetype');
			break;
					
			case "TOO_LARGE":
				$error = lang_parse('error_file_size', array($config['avatar_max_size']));
			break;
					
			case "WRONG_DIMENSIONS":
				$error = lang_parse('error_file_wxh', array($config['avatar_max_width'], $config['avatar_max_height']));
			break;
					
			case "done":
				// Update that the user now has an avatar
				update_user($user_data['id'], false, 'avatar', 1);
				
				// Send em back!
				print_out(lang('success_update_avatar'), lang('redirecting_back'), $config['url_path'] . "/users.php?a=avatar");
			break;
		}
	}
	
	// Do they have one?
	if($user_data['avatar'])
	{
		// Set current avatar link
		$current_avatar_link = get_avatar($user_data['id']);
	}
	
	// Include the navigation
	include($config['template_path'] . "user/navigation.php");
	
	// Include profile template
	include($config['template_path'] . "user/avatar.php");
}
else if($action == "profile")
{
	if(isset($_POST['profile']))
	{
		if($_POST['first_name'] != $user_data['first_name'])
		{
			if(alpha($_POST['first_name'], 'alpha-space') || $_POST['first_name'] == "")
			{
				update_user($user_data['id'], false, 'first_name', $_POST['first_name']);
			}
			else
			{
				$error = lang_parse('error_invalid_chars', array(lang('first_name')));
			}
		}
		
		if($_POST['last_name'] != $user_data['last_name'] && !$error)
		{
			if(alpha($_POST['last_name'], 'alpha-space') || $_POST['last_name'] == "")
			{
				update_user($user_data['id'], false, 'last_name', $_POST['last_name']);
			}
			else
			{
				$error = lang_parse('error_invalid_chars', array(lang('last_name')));
			}
		}
		
		if($_POST['location'] != $user_data['location'] && !$error)
		{
			if(alpha($_POST['location'], 'alpha-extra') || $_POST['location'] == "")
			{
				update_user($user_data['id'], false, 'location', $_POST['location']);
			}
			else
			{
				$error = lang_parse('error_invalid_chars', array(lang('location')));
			}
		}
		
		if($_POST['gender'] != $user_data['sex'] && !$error) 
		{
			if(alpha($_POST['gender'], 'alpha'))
			{
		    	update_user($user_data['id'], false, 'sex', $_POST['gender']);
		    }
		    else
		    {
		    	$error = lang_parse('error_invalid_chars', array(lang('sex')));
		    }
		}
		
		if($_POST['aim'] != $user_data['aim'] && !$error)
		{
			if(alpha($_POST['aim'], 'alpha-spacers') || $_POST['aim'] == "")
			{
				update_user($user_data['id'], false, 'aim', $_POST['aim']);
			}
			else
			{
				$error = lang_parse('error_invalid_chars', array(lang('aim')));
			}
		}
		
		if($_POST['msn'] != $user_data['msn'] && !$error)
		{
			if(is_email($_POST['msn']) || $_POST['msn'] == "")
			{
				update_user($user_data['id'], false, 'msn', $_POST['msn']);
			}
			else
			{
				$error = lang('error_msn_handle');
			}
		}
		
		if($_POST['interests'] != $user_data['interests'] && !$error)
		{
			if(alpha($_POST['interests'], 'alpha-extra') || $_POST['interests'] == "")
			{
				update_user($user_data['id'], false, 'interests', $_POST['interests']);
			}
			else
			{
				$error = lang_parse('error_invalid_chars', array(lang('interests')));
			}
		}
		
		if(!$error)
		{
			$success = lang('success_update_profile');
			
			// Get new details
			unset($_POST); $user_data = user_data($_SESSION['user_id']);
		}
	}
	
	// Include the navigation
	include($config['template_path'] . "user/navigation.php");
	
	// Include profile template
	include($config['template_path'] . "user/profile.php");
}
else if($action == "signature")
{

	// Include the navigation
	include($config['template_path'] . "user/navigation.php");
	
	// Include profile template
	include($config['template_path'] . "user/signature.php");
}
else if($action == "view")
{
	if(isset($_GET['id']))
	{
		if(alpha($_GET['id'], 'numeric'))
		{
			$viewing = user_data($_GET['id']);
		}
		else
		{
			print_out(lang_parse('error_invalid_given'), array(lang('id')));
		}
	}
	else
	{
		print_out(lang_parse('error_no_given'), array(lang('id')));
	}
	
	// Include profile template
	include($config['template_path'] . "user/view.php");
}

include($config['template_path'] . "footer.php");
?>