<?php

class Database extends Singleton
{
    private $server = 'localhost';
    private $user = 'playifradio_user';
    private $pass = 'change-me';
    private $database = 'legacy_playifradio';
    private $connection;	
	public $errorhandler;

    function __construct()
    {
        $this->errorhandler = ErrorHandler::get_instance();

        if ($this->database == '') 
            $this->errorhandler->show_error('No database selected', 'Check /app/libraries/database.php');

        $this->connection = mysql_connect($this->server, $this->user, $this->pass);
        if (!$this->connection) 
			$this->errorhandler->show_error('Could not connect to database', 'Check your user credentials!');

        $db = mysql_select_db($this->database, $this->connection);
        if (!$db) 
            $this->errorhandler->show_error("Could not select database, 
			'$this->database'", 'Ensure the database exists and you can access it.');
    }
	
	function db_name()
	{
		return $this->database;
	}
    
    function query($query_string)
    {
        $result = mysql_query($query_string);
		if (!$result)
            $this->errorhandler->show_error("Database query, '$query_string' failed!", mysql_error());
        
        // Only continue if data was returned (from a select)
        if (is_bool($result)) return true;
        
        $table = array();
        if (mysql_num_rows($result) > 0) 
        {
            // Turns mysql result into a two dimensional array
            for ($i=0; $table[$i] = mysql_fetch_assoc($result); $i++);
            unset($table[$i]);                                                                                  
        }
        mysql_free_result($result);
        return $table;
    }
    
    function get($table, $conditions = NULL)
    {
        if ($conditions == NULL)
            return $this->query("SELECT * FROM $table");
        else
            return $this->query("SELECT * FROM $table WHERE $conditions");
    }
    
    function delete($table, $field, $value)
    {
        return $this->query("DELETE FROM $table WHERE $field='$value'");
    }
    
    function update($table, $id, $data)
    {
        $table1 = $table;

		foreach ($data as &$input)
		{
			$input = htmlentities($input);
			$input = mysql_real_escape_string($input);
		}
		
        $fields = array_keys($data);
        
        // Turns associative array into key, value pairs for update syntax:
        foreach ($fields as $key) $data[$key] = "$key = '$data[$key]'";
        $values = implode($data, ',');
        
        $query_string = "UPDATE $table SET $values WHERE ".$table1."_id='$id'";
        $this->query($query_string);
    }
    
    function insert($table, $data)
    {
		foreach ($data as &$input)
		{
			$input = htmlentities($input);
			$input = mysql_real_escape_string($input);
		}
		
        $fields = array_keys($data);
        $table_fields = $this->query("SHOW COLUMNS FROM $table");
		$t_fields = array();
        $count = 0;
        foreach ($table_fields as $field)
        {
        	$t_fields[$count] = $field['Field'];
        	$count++;
        }
        
        $count = 0;
        foreach ($fields as $key) 
        {
        	if (!in_array($key, $t_fields))
        	{
        		unset($data[$key]);
        		unset($fields[$count]);
        		$count++;
        		continue;
        	}
        	$data[$key] = "'$data[$key]'";
        	$count++;
        }
        $fields = implode($fields, ',');
        $values = implode($data, ',');
        $query_string = "INSERT INTO $table ($fields) VALUES ($values)";
        $this->query($query_string);
    }

	function get_last_id()
	{
		return mysql_insert_id();
	}

	function row_exists($table, $condition)
	{
		return $this->query("SELECT * FROM $table WHERE $condition"); 
	}

	function get_one($table, $field, $value)
	{
		$q = $this->query("SELECT * FROM $table WHERE $field='$value'");
		return $q[0];
	}

	function get_column($table, $column, $field, $value)
	{
		$q = $this->query("SELECT $column FROM $table WHERE $field='$value'");
		if ($q)
		{
            $result = array();
            foreach ($q as $r) {
                array_push($result, $r[$column]); 
            }
			return $result;
		}
		return false;
	}
}
