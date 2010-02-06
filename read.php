<?php
/**
 * read.php
 * 
 * Displays topics and posts based on passed url variables, and allows quick posting if enabled.
 * @author Nijiko Yonskai <me@nijikokun.com>
 * @version 1.2
 * @copyright (c) 2010 ANIGAIKU
 * @package ninko
 */
 
/**
 * include common.php
 */
require("include/common.php");

// Page
@$page = $_GET['page'];

// What page are we on?
if(is_numeric($page)) {
	if (!isset($page) || $page < 0) $page = 0;
}
else
{
	$page = 0;
}
	
// Start point
$start = ($page * $config['messages_per_topic']) + 1;

/**
 * Include header template
 */
include($config['template_path'] . "header.php");

// Can we do admin actions?
if($_SESSION['admin'] || $_SESSION['moderator'])
{
	if(isset($_GET['delete_topic']))
	{
		$result = delete_topic($_GET['delete_topic']);
		
		// User data
		if($result === "ID_INVALID")
		{
			print_out(lang_parse('error_invalid_given', array(lang('id'))), lang('redirecting'));
		}
		else if($result === "DELETING_POSTS")
		{
			print_out(lang('error_deleting_posts'), lang('redirecting'));
		}
		else if($result === "DELETING_TOPIC")
		{
			print_out(lang('error_deleting_topic'), lang('redirecting'));
		}
		
		if(!$error)
		{
			print_out(lang('success_deleted_topic'), lang('redirecting'));
		}
	}
	else if(isset($_GET['delete']))
	{
		$result = delete_post($_GET['delete']);
		
		// User data
		if($result === "ID_INVALID")
		{
			print_out(lang_parse('error_invalid_given', array(lang('id'))), lang('redirecting'));
		}
		else if($result === "DELETING_POST")
		{
			print_out(lang('error_deleting_post'), lang('redirecting'));
		}
		
		if(!$error)
		{
			print_out(lang('success_deleted_post'), lang('redirecting'));
		}
	}
}
else if(isset($_GET['delete_topic']))
{
	if(alpha($_GET['delete_topic'], 'numeric'))
	{
		// Try getting that data!
		$delete_data = topic($_GET['delete_topic']);
		
		// Is it their topic?
		if($delete_data['starter_id'] == $user_data['id'])
		{
			$result = delete_topic($_GET['delete_topic']);

			if($result === "ID_INVALID")
			{
				print_out(lang_parse('error_invalid_given', array(lang('id'))), lang('redirecting'));
			}
			else if($result === "DELETING_POSTS")
			{
				print_out(lang('error_deleting_posts'), lang('redirecting'));
			}
			else if($result === "DELETING_TOPIC")
			{
				print_out(lang('error_deleting_topic'), lang('redirecting'));
			}
				
			if(!$error)
			{
				print_out(lang('success_deleted_topic'), lang('redirecting'));
			}
		}
	}
	else
	{
		print_out(lang_parse('error_invalid_given', array(lang('id'))), lang('redirecting'));
	}
}
else if(isset($_GET['delete']))
{
	if(alpha($_GET['delete'], 'numeric'))
	{
		// Try getting that data!
		$delete_data = topic($_GET['delete']);
		
		// Is it their topic?
		if($delete_data['starter_id'] == $user_data['id'])
		{
			$result = delete_post($_GET['delete']);
			
			// User data
			if($result === "ID_INVALID")
			{
				print_out(lang_parse('error_invalid_given', array(lang('id'))), lang('redirecting'));
			}
			else if($result === "DELETING_POST")
			{
				print_out(lang('error_deleting_post'), lang('redirecting'));
			}
			
			if(!$error)
			{
				print_out(lang('success_deleted_post'), lang('redirecting'));
			}
		}
	}
	else
	{
		print_out(lang_parse('error_invalid_given', array(lang('id'))), lang('redirecting'));
	}
}
	
	
// if no forumid number is present, exit out of page
// is there a topic request?
if(isset($_GET['id']))
{
	// Is it numeric?
	if(is_numeric($_GET['id']))
	{
		$id = $_GET['id'];
		
		// Check it
		$topic = topic(intval($id), '*');
		
		if($topic)
		{
			// Closed & Stickied?
			if($topic['closed']){ $closed = true; }
			if($topic['sticky']){ $stuck = true; }
				
				
			// Quick reply
			if(isset($_POST['post']))
			{
				// We can't do it anyway.
				$sticky = 0;
				$closed = 0;
				
				// Now for the fun part!
				$data = post($_POST['qsubject'], $_POST['qcontent'], $_POST['reply'], $sticky, $closed);
				
				if(is_string($data) && !is_numeric($data))
				{
					$error = $data;
				}
				else
				{
					// Create url
					$redirect = "{$config['url_path']}/read.php?id={$_GET['id']}&page={$data}";
					
					// Redirect back to the topic!
					print_out(lang('success_post'), lang('redirecting_topic'), $redirect);
				}
			}
			
			// This topic url
			$topic_url = "{$config['url_path']}/read.php?id={$_GET['id']}";
			
			// First post
			$first_post = fetch(false, false, intval($_GET['id']), 'time', 'ASC', 0, 1);
			
			// Check the numbers to fetch.
			if(isset($start))
			{
				if(is_numeric($start))
				{
					$posts = fetch(false, false, intval($_GET['id']), 'time', 'ASC', $start, $config['messages_per_topic']);
				}
				else
				{
					$posts = fetch(false, false, intval($_GET['id']), 'reply`, `timestamp', 'ASC', 1, $config['messages_per_topic']);
				}
			}
			else
			{
				$posts = fetch(false, false, intval($_GET['id']), 'reply`, `time', 'ASC', 1, $config['messages_per_topic']);
			}
			
			// Number of pages
			$pagination = generate_pagination($topic_url, forum_count($topic['id']), $config['messages_per_topic'], $start);
			
		}
		else
		{
			print_out(lang('error_topic_missing'), lang('redirecting'));
		}
	}
	else
	{
		if(!is_numeric($id))
		{
			print_out(lang_parse('error_given_not_numeric', array(lang('id_c'))), lang('redirecting'));
		}
	}
}
else
{
	print_out(lang_parse('error_invalid_given', array(lang('id'))), lang('redirecting'));
}

// Lets tell navigation we are viewing a topic
$in_topic = true;

/**
 * Include navigation template
 */
include($config['template_path'] . "navigation.php");

// Show first post
if($config['show_first_post'] || $page == 0)
{
	// First post showing~
	$author = user_data($topic['starter_id']);
	
	// The authors avatar if they have one
	$avatar_url = get_avatar($author['id']);
	
	// Topic status
	if($closed)
	{
		$topic['status'] = '<span class="closed">' . strtolower(lang('closed')) . '</span> ';
	}
	
	if($stuck)
	{
		$topic['status'] .= '<span class="sticky">' . strtolower(lang('sticky')) . '</span>';
	}
	
	// Starter post?
	$starter = true;
	
	// Templating & For quick reply.
	$post = $topic;
	
	// The template
	include($config['template_path'] . 'forum/post.php');

}

// Normal Topics
if($posts)
{
	$count = 0;
	$author = "";
	
	// Loop through the topic
	foreach($posts as $post) 
	{
		
		// First post showing~
		$author = user_data($post['starter_id']);
		
		// The authors avatar if they have one
		$avatar_url = get_avatar($author['id']);
		
		// Not the starter
		$starter = false;
		
		// The template
		include($config['template_path'] . 'forum/post.php');
	}
}

// Are we logged in and can we quick reply?
if($_SESSION['logged_in'] && !$topic['closed'] && $config['allow_quick_reply'])
{ 
	$_POST['qsubject'] = "Re: {$topic['subject']}";
	
	/**
	 * Include quick reply template
	 */
	include($config['template_path'] . 'forum/quick-reply.php');
}

/**
 * Include footer template
 */
include($config['template_path'] . "footer.php"); 
?>