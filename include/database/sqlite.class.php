<?php if(!defined('IN_NK')) die('Invalid inclusion.');
/**
 * sqlite.class.php
 * 
 * Database abstraction layer for SQLite without dependancies on PDO
 * @author Nijiko Yonskai <me@nijikokun.com>
 * @version 1.2
 * @copyright (c) 2010 ANIGAIKU
 * @package ninko
 * @subpackage database
 */


/**
 * Controls the database functions for all layers
 */
class database
{
	/**
	 * The table prefix, used incase we use a joint database
	 * @access private
	 * @var string
	 */
	var $prefix;
	
	/**
	 * The database link
	 * @access private
	 * @var resource
	 */
	var $link;
	
	/**
	 * Saved queries
	 * @access private
	 * @var array
	 */
	var $saved_queries = array();
	
	/**
	 * Number of queries
	 * @access private
	 * @var integer
	 */
	var $num_queries = 0;
	
	/**
	 * Constructor connects to the database and sets up the link {@link $link}
	 */
	function database($params)
	{
		$this->prefix = $params['prefix'];
		
		// Prepend database location to the database name
		$params['db'] = DATABASE . $params['db'];

		// Try and create the database if it doesn't exist
		if (!file_exists($params['db']))
		{
			@touch($params['db']);
			@chmod($params['db'], 0666);
			
			if (!file_exists($params['db']))
			{
				$this->error('Unable to create new database "' . $params['db'] . '". Permission denied.', __FILE__, __LINE__);
			}
		}

		// Can we read the database?
		if (!is_readable($params['db']))
		{
			$this->error('Unable to open database "' . $params['db'] . '" for reading. Permission denied.', __FILE__, __LINE__);
		}

		// Can we write to the database?
		if (!is_writable($params['db']))
		{
			$this->error('Unable to open database "' . $db_name . '" for writing. Permission denied.', __FILE__, __LINE__);
		}

		// Are we making a persistant connection?
		if ($params['persistant'])
		{
			$this->link = @sqlite_popen($params['db'], 0666, $error);
		}
		else
		{
			$this->link = @sqlite_open($params['db'], 0666, $error);
		}
		
		if (!$this->link)
		{
			error('Unable to open database "' . $params['db'] . '". SQLite error: ' . $error, __FILE__, __LINE__);
		}
		else
		{
			return $this->link;
		}
	}
	
	/**
	 * Execute query and return the result or insertion id.
	 * @param string $query The query we are executing.
	 * @param boolean $id Return the insertion id if true.
	 * @return boolean|integer
	 */
	function query($query, $id = false)
	{
		// Execute query
		$this->result = @sqlite_query($this->link, $query);
		
		// Did we get a result?
		if ($this->result)
		{
			// Update saved queries and amount executed
			$this->saved_queries[] = $query;
			$this->num_queries++;
			
			// Return results or the insertion id
			if($id)
			{
				return $this->insert_id();
			}
			else
			{
				return $this->result;
			}
		}
		else
		{
			// Set the query to saved but don't update the number executed
			$this->saved_queries[] = $query;
	
			// Return false
			return false;
		}
	}
	
	/**
	 * Fetch results in different manners
	 * @return boolean|array
	 */
	function fetch($result, $type = 'array')
	{
		switch($type)
		{
			case "array":
				if ($result)
				{
					$results = @sqlite_fetch_array($result);
					
					if ($results)
					{
						$results = $this->clean_name($results);
					}

					return $results;
				}
				else
				{
					return false;
				}
			break;
			
			case "row":
				return ($result) ? @mysqli_fetch_array($result, SQLITE_NUM) : false;
			break;
			
			case "assoc":
				if ($result)
				{
					$results = @sqlite_fetch_array($result, SQLITE_ASSOC);
					
					if ($results)
					{
						$results = $this->clean_name($results);
					}

					return $cur_row;
				}
				else
				{
					return false;
				}
			break;
		}
	}
	
	/**
	 * Return the numbers for a specific type
	 * @return boolean|integer
	 */
	function num($result, $type = 'rows')
	{
		switch($type)
		{
			case "rows":
				return ($result) ? @sqlite_num_rows($result) : false;
			break;
		}
	}
	
	/**
	 * The amount of rows that have been affected
	 * @return boolean|integer
	 */
	function affected_rows()
	{
		return ($this->link) ? @sqlite_changes($this->result) : false;
	}
	
	/**
	 * Find the last insert id and return it
	 * @return boolean|integer
	 */
	function insert_id()
	{
		return ($this->link) ? @sqlite_last_insert_rowid($this->link) : false;
	}
	
	/**
	 * Exit with an error
	 */
	function error($error, $file, $line)
	{
		die("{$error} in file: {$file} on line {$line}");
	}
	
	/**
	 * Escape string
	 */
	function escape($str)
	{
		return is_array($str) ? '' : sqlite_escape_string($str);
	}
	
	/**
	 * SQLite returns horribly named keys with m. tablename. etc, this strips that.
	 */
	function clean_name($array)
	{
		foreach ($array as $key => $value)
		{
			//if you want to keep the old element with its key remove the following line
			unset($array[$key]);

			//now we clean the key from the dot and tablename (alise) and set the new element
			$key = substr($key, strpos($key, '.')+1);
			$array[$key] = $value;
		}
	  
		return $array;
	} 
}
?>