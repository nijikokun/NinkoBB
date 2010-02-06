<?php
/**
 * index.php
 * 
 * Base of the forum, shows paginated topics.
 * @author Nijiko Yonskai <me@nijikokun.com>
 * @version 1.2
 * @copyright (c) 2010 ANIGAIKU
 * @package ninko
 */
 
/**
 * Include common.php
 */
require("include/common.php");

// Start point
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
$start = $page * $config['messages_per_page'];

// Sticky topics
$sticky_topics = fetch(0, true);

// Check the numbers to fetch.
if(isset($start))
{
	if(is_numeric($start))
	{
		$topics = fetch(0, false, false, 'updated', 'DESC', intval($start), $config['messages_per_page']);
	}
	else
	{
		$topics = fetch(0, false, false, 'updated', 'DESC', 0, $config['messages_per_page']);
	}
}
else
{
	$topics = fetch(0, false, false, 'updated', 'DESC', 0, $config['messages_per_page']);
}

// Topic count
$topic_count = forum_count('*', false, false, true);

// Messages per page
$pagination = generate_pagination($config['url_path'], $topic_count, $config['messages_per_page'], $start);

/**
 * Include header template
 */
include($config['template_path'] . "header.php");

/**
 * Include navigation template
 */
include($config['template_path'] . "navigation.php");

/**
 * Start index
 */
include($config['template_path'] . "forum/index-open.php");

// Any stickies?
if($sticky_topics)
{
	// Count
	$count = 0;
			
	// Stickies
	foreach($sticky_topics as $row)
	{
		// reset
		$status = "";
		
		// Last post info for this topic
		$last_post = last_post($row['id']);
	
		// Last poster info
		$last_post_udata = user_data($last_post['starter_id']);
		
		// Last post avatar
		$last_post_avatar = get_avatar($last_post_udata['id']);
		
		// Trim subject
		$subject = character_limiter(trim(stripslashes($row['subject'])), $config['max_length']);
		
		// Build topic url
		$topic_url = "{$config['url_path']}/read.php?id={$row['id']}";
		
		// Topic starter data
		$topic_author = user_data($row['starter_id']);
		
		// Last post data
		$last_post_author = user_data($last_post['starter_id']);
		
		// Alt
		if($count%2) { $alt = "dark"; } else { $alt = "light";}
		
		// Topic status
		if($row['closed'])
		{
			$status = '<span class="closed rounded">' . lang('closed') . '</span><br />';
		}
		
		if($row['sticky'])
		{
			$status .= '<span class="sticky rounded">' . lang('sticky') . '</span>';
		}
		
		/**
		 * Include sticky topics template
		 */
		include($config['template_path'] . "forum/topics.php");
		
		// Increase counter
		$count++;
	}
}

// Do we have any topics?
if($topics)
{	
	// Loop through normal posts
	foreach($topics as $row)
	{
		// reset
		$status = "";
		
		// Last post info for this topic
		$last_post = last_post($row['id']);
		
		// Last poster info
		$last_post_udata = user_data($last_post['starter_id']);
		
		// Last post avatar
		$last_post_avatar = get_avatar($last_post_udata['id']);
		
		// Trim subject
		$subject = character_limiter(trim(stripslashes($row['subject'])), $config['max_length']);
		
		// Build topic url
		$topic_url = "{$config['url_path']}/read.php?id={$row['id']}";
		
		// Topic starter data
		$topic_author = user_data($row['starter_id']);
		
		// Last post data
		$last_post_author = user_data($last_post['starter_id']);
		
		// Alt
		if($count%2) { $alt = "dark"; } else { $alt = "light";}
		
		// Topic status
		if($row['closed'])
		{
			$status = '<span class="closed rounded">' . lang('closed') . '</span>';
		}
		
		/**
		 * Include topics template
		 */
		include($config['template_path'] . "forum/topics.php");

		// increase counter
		$count++;
	}
}

if(!$sticky_topics && !$topics)
{ 
	/**
	 * No topics to show, include no-topics template
	 */
	include($config['template_path'] . "forum/no-topics.php"); 
}

/**
 * End index
 */
include($config['template_path'] . "forum/index-close.php");

// The online data for all users
$online_data = users_online();

// Guest Counter Plugin
if(is_loaded('guest_counter'))
{
	// The online data for guests
	$guests_online_data = guests_online();

	// The online data for bots
	$bots_online_data = guests_online(false, true);
}

// The online data for admins
$admin_online_data = users_online(true);

// Total users
$user_count = count_users();

// Forum counts
$topic_count = forum_count('*');
$post_count = forum_count(false, false, true);

/**
 * Include forum details template
 */
include($config['template_path'] . "forum/details.php");

/**
 * Include footer template
 */
include($config['template_path'] . "footer.php"); 
?>