<?php if(!defined('IN_NK')) die('Invalid inclusion.');
/**
 * forum.php
 * 
 * Includes functions commonly used througout the entire script
 * @author Nijiko Yonskai <me@nijikokun.com>
 * @version 1.1
 * @copyright (c) 2010 ANIGAIKU
 * @package ninko
 * @subpackage functions
 */

/**
 * Fetches forum data based on input
 * @param boolean|integer $forum data to be scanned for links and replaced
 * @param boolean $sticky true: searches stickies, false: excludes stickies
 * @param boolean|integer $topic data to be scanned for links and replaced
 * @param string $order_by what do we order results by?
 * @param string $order how do we order them?
 * @param integer $current data to be scanned for links and replaced
 * @param integer $limit data to be scanned for links and replaced
 * @return array|boolean
 */
function fetch($forum = false, $sticky = false, $topic = false, $order_by = 'updated', $order = 'DESC', $current = 0, $limit = 15)
{
	// Fetch topics
	if(is_numeric($forum))
	{
		if($sticky)
		{
			$query = "SELECT * FROM `forum` WHERE `reply` = 0 AND `sticky` = 1 ORDER BY `time` {$order} LIMIT {$current},{$limit}";
		}
		else
		{
			// Query
			$query = "SELECT * FROM `forum` WHERE `reply` = 0 AND `sticky` = 0 ORDER BY `{$order_by}` {$order} LIMIT {$current},{$limit}";
		}

		// Return Data
		$return = mysql_query( $query );
		
		// Exists?
		if(mysql_num_rows( $return ) > 0)
		{
			// Finally return Results
			while($topic = mysql_fetch_array( $return ))
			{
				$topics[] = $topic;
			}
			
			return $topics;
		}
		else
		{
			// Guess not~
			return false;
		}
	}
	else if($topic)
	{
		// Query
		$query = "SELECT  * FROM `forum` WHERE (`id` = {$topic}) OR (`reply` = {$topic}) ORDER BY `{$order_by}` {$order} LIMIT {$current},{$limit}";

		// Return Data
		$return = mysql_query( $query );
		
		// Exists?
		if(mysql_num_rows( $return ) > 0)
		{
			// Finally return Results
			while($topic = mysql_fetch_array( $return ))
			{
				$topics[] = $topic;
			}
			
			return $topics;
		}
		else
		{
			// Guess not~
			return false;
		}
	}
}

/**
 * Fetches post data by id and custom select
 * @param integer $topic id used to retrieve topic / post data
 * @param string $data fields to be retrieved from database
 * @return array|boolean
 */
function topic($topic, $data = '*')
{
	// Query
	$query = "SELECT {$data} FROM `forum` WHERE `id` = '{$topic}' LIMIT 1";
	
	// Return Data
	$return = mysql_query( $query );

	// Return the data
	if(mysql_num_rows( $return ) > 0)
	{
		return mysql_fetch_array( $return );
	}
	else
	{
		return false;
	}
}

/**
 * Fetches the last post data in a topic
 * @param integer $topic id used to retrieve reply data
 * @param integer $id user id to retrieve last post from that user
 * @param string $data fields to be retrieved from database
 * @return array|boolean
 */
function last_post($topic, $id = false, $data = '*')
{
	if($id)
	{
		// Query
		$query = "SELECT {$data} FROM `forum` WHERE `starter_id` = '{$id}' ORDER BY `time` DESC LIMIT 1";
		
		// Return Data
		$return = mysql_query( $query );
		
		// Return the data
		if(mysql_num_rows( $return ) > 0)
		{
			return mysql_fetch_array( $return );
		}
		else
		{
			return false;
		}
	}
	else
	{
		// Query
		$query = "SELECT {$data} FROM `forum` WHERE `reply` = '{$topic}' ORDER BY `time` DESC LIMIT 1";
		
		// Return Data
		$return = mysql_query( $query );
		
		// Return the data
		if(mysql_num_rows( $return ) > 0)
		{
			return mysql_fetch_array( $return );
		}
		else
		{
			return topic($topic);
		}
	}
}

/**
 * Return replies in topic. Currently a good way to see if topic exists.
 * @param integer $topic id used to retrieve reply data
 * @return array|boolean
 */
function get_replies($topic)
{
	// Query
	$query = "SELECT replies FROM `forum` WHERE `id` = {$topic}";
	
	// Return Data
	$return = mysql_query( $query );
	
	if($return)
	{
		$topic_data = mysql_fetch_array($return);
		
		// Return that reply data!
		return $topic_data['replies'];
	}
	else
	{
		return false;
	}
}

/**
 * Count replies for the forum or user
 * @param integer $topic id used to retrieve reply data
 * @param integer $user id used to retrieve reply data for user
 * @param boolean $all count all the replies?
 * @param boolean $exclude_stickies include stickies in our count?
 * @param boolean $posts count posts?
 * @param boolean $today show count from past day only?
 * @return int
 */
function forum_count($topic, $user = false, $all = false, $exclude_stickies = false, $posts = false, $today = false)
{
	if($all)
	{
		// Query
		$query = "SELECT id FROM `forum`";
		
		// Return Data
		$return = mysql_query( $query );
		
		// Return the count
		return mysql_num_rows( $return );
	}
	
	if($posts)
	{
		if($today)
		{
			$query = "SELECT `id` FROM `forum` WHERE `reply` != '0' AND `time` >= " . strtotime('-1 day');
		}
		else
		{
			// Query
			$query = "SELECT id FROM `forum` WHERE `reply` != '0'";
		}
		
		// Return Data
		$return = mysql_query( $query );
		
		// Return the count
		return mysql_num_rows( $return );
	}
	
	if($topic === "*")
	{
		if($exclude_stickies)
		{
			if($today)
			{
				$query = "SELECT `id` FROM `forum` WHERE (`reply` = '0' AND `sticky` = '0') AND `time` >= " . strtotime('-1 day');
			}
			else
			{
				// Query
				$query = "SELECT id FROM `forum` WHERE `reply` = '0' AND `sticky` = '0'";
			}
		}
		else
		{
			if($today)
			{
				$query = "SELECT `id` FROM `forum` WHERE `reply` != '0' AND `time` >= " . strtotime('-1 day');
			}
			else
			{
				// Query
				$query = "SELECT id FROM `forum` WHERE `reply` = '0'";
			}
		}
		
		// Return Data
		$return = mysql_query( $query );
		
		// Return the count
		return mysql_num_rows( $return );
	}
	else
	{
		if($topic)
		{
			// Query
			$query = "SELECT id FROM `forum` WHERE `reply` = {$topic}";
			
			// Return Data
			$return = mysql_query( $query );
			
			// Return the count
			return mysql_num_rows( $return );
		}
		else if($user)
		{
			if(is_numeric($user))
			{
				// Query
				$query = "SELECT id FROM `forum` WHERE `starter_id` = '{$user}'";
				
				// Return Data
				$return = mysql_query( $query );
				
				// Return the count
				return mysql_num_rows( $return );
			}
			else
			{
				return intval(0);
			}
		}
	}
}

/**
 * Allows creation of topics, stuck or closed, and posts
 * @global array
 * @global array
 * @param string $topic post subject
 * @param string $content post content
 * @param integer $reply id of topic we are replying to
 * @param boolean $sticky are we sticking it to the top?
 * @param boolean $closed are we closing it?
 * @return string|int
 */
function post($topic, $content, $reply = false, $sticky = false, $closed = false)
{
	global $config, $user_data;
	
	// The time. milliseconds / seconds may change.
	$time = time();
	
	// Its new right now.
	$new = true;
	
	// Pre-Parse
	$topic = clean_input(strip_repeat($topic));
	$content = htmlentities($content);
	$content = field_clean(stripslashes($content), true);
	
	if($_SESSION['logged_in'])
	{
		if(!$reply)
		{
			if($topic == "")
			{
				return lang_parse('error_no_given', array(lang('subject')));
			}
		}
		else
		{
			if($topic == "")
			{
				$topic = "re:";
			}
		}
		
		if(!alpha( $topic, 'alpha-extra' ))
		{
			return lang_parse('error_invalid_chars', array(lang('subject')));
		}
		
		if(is_string(length($content, $config['message_minimum_length'], $config['message_max_length'])))
		{
			return lang_parse('error_subject_length', array($config['subject_max_length'], $config['subject_minimum_length']));
		}
		
		if($content != "")
		{
			if(!is_string(length($content, $config['message_minimum_length'], $config['message_max_length'])))
			{
				// Are we replying or is it new?
				if($reply)
				{
					if(is_numeric($reply))
					{
						if(topic($reply, 'id'))
						{
							$new = false;
							
							// topic data
							$topic_data = topic($reply, '*');
							
							// is it closed?
							if($topic_data['closed'] && !$user_data['admin'])
							{
								return lang('error_topic_closed');
							}
						}
						else
						{
							return lang('error_topic_missing');
						}
					}
					else
					{
						return lang_parse('error_invalid_given', array(lang('topic') . " " . lang('id')));
					}
				}
				
				// Sticky
				$sticky = ($sticky) ? '1' : '0';
				
				// Closed
				$closed = ($closed) ? '1' : '0';
				
				// Parsing
				$content = htmlentities( $content );
				
				// Time Lapse
				if(!$user_data['admin'])
				{
					if(!$new)
					{
						$time_between = time() - $config['post_reply_time_limit'];
					}
					else
					{
						$time_between = time() - $config['post_topic_time_limit'];
					}
					
					
					// Last post by this user?
					$query = "SELECT `time` FROM `forum` WHERE `starter_id` = '{$user_data['id']}' AND `time` > {$time_between}";
					
					// Fetch users last post
					$result = mysql_query( $query );
					
					// is there a result?
					if(mysql_num_rows($result) > 0)
					{
						return lang('error_flood_detection');
					}
				}
				
				// So we don't have leftovers.
				unset($query, $result);
				
				
				// Guess we can go ahead and add you~
				$query = "INSERT INTO `forum` (`subject`,`message`,`reply`,`starter_id`,`host`,`time`,`updated`,`sticky`,`closed`) VALUES ('%s','%s',%d,%d,'%s','%s','%s','%s','%s')";
				$query = sprintf(
					$query,
					mysql_clean($topic),
					mysql_clean($content),
					(($new) ? 0 : $reply),
					$user_data['id'],
					mysql_clean(gethostname()),
					$time,
					$time,
					$sticky,
					$closed
				);
				
				// Insert into mysql and retrieve id.
				$result = mysql_query($query);
				
				echo mysql_error();
				
				if($result)
				{
					// the id from the previous query
					$id = mysql_insert_id();
					
					// users new post count
					$new_post_count = $user_data['posts']+1;
					
					// update user post count
					update_user($user_data['id'], false, 'posts', $new_post_count);
					
					// Start sending back information
					if($new)
					{
						return $id;
					}
					else
					{
						// How many replies?
						$replies = intval(get_replies($reply));
						
						// Lets update it
						$replies = $replies+1;
						
						// Woooo~ Last id for redirecting~
						$page_numbers = (($replies / 20) - 1);
						$n = ceil($page_numbers);
						
						if ($n == -1)
						{
							$n = 0;
						}
						else
						{
							$n = abs($n);
						}
						
						// Update
						$query = "UPDATE `forum` SET `updated`='{$time}', `replies`='{$replies}' WHERE id = '{$reply}'";
						
						// Update
						$result = mysql_query($query);
						
						// Return last page number for redirect!
						return $n;
					}
				}
				else
				{
					return lang('error_unknown');
				}
				
			}
			else
			{
				return lang_parse('error_message_length', array($config['message_max_length'], $config['message_minimum_length']));
			}
		}
		else
		{
			return lang_parse('error_no_given', array(lang('message')));
		}
	}
	else
	{
		return lang('error_not_logged');
	}
}
	
/**
 * Allows updating of topics, stuck or closed, and posts
 * @global array
 * @global array
 * @param integer $id post we are editing
 * @param string $topic post subject
 * @param string $content post content
 * @param integer $reply id of topic we are replying to
 * @param boolean $sticky are we sticking it to the top?
 * @param boolean $closed are we closing it?
 * @return string|int
 */
function update($id, $topic, $content, $sticky = false, $closed = false)
{
	global $config, $user_data;
	
	// The time. milliseconds / seconds may change.
	$time = time();
	
	// Is the id numeric?
	if(!alpha($id, 'numeric'))
	{
		return lang_parse('error_given_not_numeric', array(lang('post') . " " . lang('id')));
	}
	
	// Grab the data for the update.
	$post_data = topic($id);
	
	// Check to see if the post or topic was found.
	if(!$post_data)
	{
		return lang('error_post_missing');
	}
	
	// Pre-Parse
	$topic = clean_input(strip_repeat($topic));
	$content = htmlentities($content);
	$content = clean_input(stripslashes($content));
	
	// Is the user currently logged in? If not we can't update return error.
	if($_SESSION['logged_in'])
	{
		// Editing a topic not post
		if($post_data['reply'] == 0)
		{
			if($topic == "")
			{
				return lang_parse('error_no_given', array(lang('username')));
			}
		}
		else
		{
			if($topic == "")
			{
				$topic = "re:";
			}
		}
		
		// Is the subject valid?
		if(!alpha( $topic, 'alpha-extra' ))
		{
			return lang_parse('error_invalid_chars', array(lang('subject')));
		}
		
		
		// Did they give us any content to work with?
		if($content != "")
		{
			if(!is_string(length($content, $config['message_minimum_length'], $config['message_max_length'])))
			{
				// Check to see if the user is an admin and able to sticky / close the topic
				if($_SESSION['is_admin'] || $_SESSION['moderator'])
				{
					// Sticky
					$sticky = ($sticky) ? '1' : '0';
					
					// Closed
					$closed = ($closed) ? '1' : '0';
					
					// Admin functions
					update_field($id, 'sticky', $sticky);
					update_field($id, 'closed', $closed);
				}
				
				// Parsing
				$content = htmlspecialchars( $content );
				
				// Update the post already inside of the database with the new data
				$result = mysql_query( "UPDATE `forum` SET `subject`='{$topic}', `message`='{$content}', `updated`='{$time}', `replies`='{$replies}' WHERE id = '{$id}'" ) or die(mysql_error());
					
				// Did it work?
				if($result)
				{
					return true;
				}
				else
				{
					return false;
				}
				
			}
			else
			{
				return lang_parse('error_message_length', array($config['message_max_length'], $config['message_minimum_length']));
			}
		}
		else
		{
			return lang_parse('error_no_given', array(lang('message')));
		}
	}
	else
	{
		return lang('error_not_logged');
	}
}
	
/**
 * Update specific field rather than whole post
 * @param integer $id post we are editing
 * @param string $field post field
 * @param string $value new data to enter into post
 * @return string|int
 */
	function update_field($id, $field, $value)
	{
		// Error codes
		//	905		- Invalid id
		
		if(!is_numeric($id))
		{
			return 905;
		}
		else
		{
			// Clean value, fields are clean as WE set them
			$value = mysql_clean($value);
				
			// Update the forum with the new value
			$result = mysql_query( "UPDATE `forum` SET `{$field}` = '{$value}' WHERE `id` = '{$id}' LIMIT 1" );
				
			// Did it work?
			if($result)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
/**
 * Parse post content into readable data, or return default text
 * @global array
 * @param string $text data to be parsed
 * @param boolean $bbcode show bbcode or not?
 * @return mixed
 */
function parse($text, $bbcode = true)
{
	global $config;
	
	// Do they allow bbcode or does this post allow bbcode?
	if($config['bbcode'] && $bbcode)
	{
		$start = array( 
			'/\[url=("|\'|)(.*?)\\1\]/i',
			'/\[url\]/i',
			'/\[\/url\]/i',
			'/\[img\]\s*(.*?)\s*\[\/img\]/is',
			'/\[colou?r=("|\'|)(.*?)\\1\](.*?)\[\/colou?r\]/is',
			'/\[quote=(&quot;|"|\'|)(.*?)\\1\]\s */i',
			'/\[qoute=(&quot;|"|\'|)(.*?)\\1\]\s */i',
			'/\[quote\]\s */i',
			'/\[qoute\]\s */i',
			'/\s*\[\/quote\]\s */i',
			'/\s*\[\/qoute\]/i',
			'/\[code\][\r\n]*(.*?)\[\/code\]/is',
		);
		
		$end = array(	
			'[url=$2]',
			'[url]',
			'[/url]',
			'[img]$1[/img]',
			'[color=$2]$3[/color]',
			'[quote=$1$2$1]',
			'[quote=$1$2$1]',
			'[quote]',
			'[quote]',
			'[/quote]'."\n",
			'[/quote]'."\n",
			'[code]$1[/code]'."\n",
		);
		
		// Replace the non needed characters.
		$text = preg_replace($start, $end, $text);
		
		// Html close tags edited to work for bbcode
		$text = closetags($text);
		
		// Lets make sure the code doesn't get obscured
		if (strpos($text, '[code]') !== false && strpos($text, '[/code]') !== false)
		{
			list($inside, $outside) = split_text($text, '[code]', '[/code]');
			$outside = array_map('ltrim', $outside);
			$text = implode('<">', $outside);
		}
		
		// Quoting
		if (strpos($text, 'quote') !== false)
		{
			$text = str_replace('[quote]', '<blockquote><div class="quotebox">', $text);
			$text = preg_replace('/\[quote=(&quot;|"|\'|)(.*)\\1\]/seU', '"<blockquote><div class=\"quotebox\"><h4>".str_replace(array(\'[\', \'\\"\'), array(\'&#91;\', \'"\'), \'$2\')." wrote:</h4><div class=\"text\">"', $text);
			$text = preg_replace('/\[\/quote\](\s *)?/i', '</div></div></blockquote>', $text);
		}
		
		// Basic BBCodes
		$pattern = array('/\[b\](.*?)\[\/b\]/s', '/\[i\](.*?)\[\/i\]/s', '/\[u\](.*?)\[\/u\]/s');
		$replace = array('<strong>$1</strong>', '<em>$1</em>', '<u>$1</u>');
		
		// This thing takes a while! :)
		$text = preg_replace($pattern, $replace, $text);
		
		// Do we allow urls?
		if($config['bbcode_url'])
		{
			$pattern = array('/\[url\]([^\[]*?)\[\/url\]/e', '/\[url=([^\[]*?)\](.*?)\[\/url\]/e');
			$replace = array('url_tag(\'$1\')','url_tag(\'$1\', \'$2\')');
			
			$text = preg_replace($pattern, $replace, $text);
		}
		
		// Color
		$text = preg_replace("/\[color=([a-zA-Z]*|\#?[0-9a-fA-F]{6})]/s", '<span style="color: \\1">', $text);
		$text = preg_replace("/\[\/color\]/s", '</span>', $text);
		
		// Do we allow images?
		if($config['bbcode_image'])
		{
			$text = preg_replace('/\[img\]((ht|f)tps?:\/\/)([^\s<\"]*?)\.(jpg|jpeg|png|gif)\[\/img\]/s', '<img class="p-image" src="\\1\\3.\\4\" />', $text);
		}
		
		// If we split up the message before we have to concatenate it together again (code tags)
		if (isset($inside))
		{
			$outside = explode('<">', $text);
			$text = '';
			
			$num_tokens = count($outside);
			
			for ($i = 0; $i < $num_tokens; ++$i)
			{
				$text .= $outside[$i];
				
				if (isset($inside[$i]))
				{
					$text .= '<div class="codebox"><h4>Code:</h4><div class="scrollbox"><pre>'.$inside[$i].'</pre></div></div>';
				}
			}
		}
	}
	
	// Return base text!
	if(!$bbcode)
	{
		return $text;
	}
	
	// Return a fully parsed post / other
	return clickable(stripslashes(nl2br(str_replace(array('\r\n', '\r', '\n'), "<br />", html_entity_decode($text)))));
}
		
/**
 * Creates the pagination for the topics
 * @global array
 * @param string $replies the number of replies
 * @param integer $url the root url
 * @return string
 */
function topic_pagination($replies, $url)
{
	global $config;
	
	// Make sure $per_page is a valid value
	$per_page = ($config['messages_per_topic'] <= 0) ? 1 : $config['messages_per_topic'];
	
	if (($replies + 1) > $per_page)
	{
		$total_pages = ceil(($replies + 1) / $per_page);
		$pagination = '';
		
		$times = 1;
		for ($j = 1; $j < $replies + 1; $j += $per_page)
		{
			$pagination .= '<a href="' . $url . '&amp;start=' . $j . '">' . $times . '</a>';
			if ($times == 1 && $total_pages > 5)
			{
				$pagination .= ' ... ';
				
				// Display the last three pages
				$times = $total_pages - 3;
				$j += ($total_pages - 4)  * $per_page;
			}
			else if ($times < $total_pages)
			{
				$pagination .= '<span class="page-sep">,</span>';
			}
			$times++;
		}
	}
	else
	{
		$pagination = '';
	}
	
	return $pagination;
}
?>