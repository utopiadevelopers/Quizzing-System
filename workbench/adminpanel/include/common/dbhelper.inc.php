<?php
class dbHelper
{
    // Database Variables

	private $server = 'localhost';
    private $user = 'utopia_user';
    private $pass = "qWCY8uhvuUYKdX3A";
    private $database = 'utopia_quiz';
    
    // Constructor
    public function __construct()
    {
		
    }

    public function ud_connectToDB()
    {
        if (!mysql_connect($this -> server, $this -> user, $this -> pass) || !mysql_select_db($this -> database))
        {
            die('Sorry but not able to connect to database..');
        }
    }

    public function ud_getQuery($query,$print = false)
    {
	    if($print == true)
		{
			echo $query;
		}
        if ($query_run = mysql_query($query))
            return $query_run;
        else
        {
        	if($_SERVER['REMOTE_ADDR'] = '127.0.0.1')
        	{
        		echo '<strong>Function Backtrace</strong> :<br><br> ';
        		$debug = debug_print_backtrace();
        		echo '</br></br><strong>MySQL Error</strong> : ';
        		echo mysql_error();	
        		die();
            }
            else
            {
	            die('Sorry Unable to Connect to database. Contact Administartor');
            }
    	}
    }

    public function ud_whereQuery($db_table_name, $select_array  = NULL, $where_assoc = NULL , $logical = 'AND' , $print = false , $extra = '' )
    {
	    if(empty($db_table_name))
		{
			return 'NULL';
		}
        $query = 'SELECT ';
        if (sizeof($select_array) == 0)
        {
            $query .= '* ';
        }
        else
        {
            $query .= implode(',', $select_array);
        }
        $query .= ' FROM ' . $db_table_name;

        if (sizeof($where_assoc) > 0)
        {
            $query .= ' WHERE ';
            $var = TRUE;
            foreach ($where_assoc as $key => $value)
            {
                if (is_string($value))
                { 
                	$value = mysql_real_escape_string($value);
                    $value = '\'' . $value . '\'';
                }
                if ($var == TRUE)
                {
                    $query .= $key . ' = ' . $value;
                    $var = FALSE;
                }
                else
                {
                    $query .= ' '.$logical.' ' . $key . ' = ' . $value;
                }
            }
        }
        $query = $query .' '. $extra .';';
        if($print == true)
		{
		   echo $query;
        }
		
		//die();
        if ($result = $this->ud_getQuery($query))
            return $result;
        else
        {
            mysql_error();
            die('Sorry Unable to Connect to database. Contact Administartor');
        }
    }

	public function ud_insertQuery($db_table_name,$value_assoc, $print = false)
    {
	    if(empty($db_table_name) || empty($value_assoc))
		{
			return 'NULL';
		}
		// Checking needs to be done...	
        $query = 'INSERT INTO '.$db_table_name.' ( ';
		$var = true;
		foreach ($value_assoc as $key => $value)
		{
		    if($var ==true)
			{
			   $query .= ' `'.$key.'` ';
			   $var = false;
			}
			else
			{
				$query .= ' ,`'.$key.'` ';
			}
		}
		$query .= ') VALUES (\'';
		$query .= implode('\',\'', $value_assoc);
        
		$query = $query . '\');';
		if($print == true)
		{
		   echo $query;
        }
        //die();
        if ($result = $this->ud_getQuery($query))
            return $result;
        else
        {
            mysql_error();
            echo 'Error';
			die();
			
        }
    }
	
	public function ud_updateQuery($db_table_name,$value_assoc,$where_assoc = NULL , $logical = 'AND' , $print = false)
    {
	// UPDATE  `actonate_alhabib`.`ud_employer_login` SET  `employerLanguagePref` =  '1' WHERE  `ud_employer_login`.`employerID` =17;
	    if(empty($db_table_name) || empty($value_assoc))
		{
			return 'NULL';
		}
	
        $query = 'UPDATE '.$db_table_name.' SET ';
		foreach($value_assoc as $key => $value)
		{
			$query .= '`'.$key.'` = ';
			if (is_string($value))
			{ 
				$value = mysql_escape_string($value);
				$value = '\'' . $value . '\'';
			}
			$query .= $value.',';

		}
		$query = substr($query , 0 , strlen($query)-1);
		if (sizeof($where_assoc) > 0)
        {
            $query .= ' WHERE ';
            $var = TRUE;
            foreach ($where_assoc as $key => $value)
            {
                if (is_string($value))
                { 
				    $value = mysql_escape_string($value);
                    $value = '\'' . $value . '\'';
                }
                if ($var == TRUE)
                {
                    $query .= $key . ' = ' . $value;
                    $var = FALSE;
                }
                else
                {
                    $query .= ' '.$logical.' ' . $key . ' = ' . $value;
                }
            }
        }
        $query = $query . ';';
		if($print == true)
		{
		   echo $query;
        }
        //die();
        if ($result = $this->ud_getQuery($query))
            return $result;
        else
        {
            mysql_error();
            echo 'Error';
			die();
			
        }
    }
    
    public function ud_deleteQuery($db_table_name,$where_assoc = NULL , $logical = 'AND' , $print = false)
    {
	    if(empty($db_table_name))
		{
			return 'NULL';
		}
	
        $query = 'DELETE FROM '.$db_table_name;
		if (sizeof($where_assoc) > 0)
        {
            $query .= ' WHERE ';
            $var = TRUE;
            foreach ($where_assoc as $key => $value)
            {
                if (is_string($value))
                { 
				    $value = mysql_escape_string($value);
                    $value = '\'' . $value . '\'';
                }
                if ($var == TRUE)
                {
                    $query .= $key . ' = ' . $value;
                    $var = FALSE;
                }
                else
                {
                    $query .= ' '.$logical.' ' . $key . ' = ' . $value;
                }
            }
        }
        $query = $query . ';';
		if($print == true)
		{
		   echo $query;
        }
        if ($result = $this->ud_getQuery($query))
		{
		}
        else
        {
            mysql_error();
            echo 'Error';
			die();
        }
    }
	
	public function ud_mysql_result($result,$row,$col)
	{
		return mysql_result($result,$row,$col);
	}
	
	public function ud_mysql_fetch_assoc($result,$bool = false)
	{
		$result = mysql_fetch_assoc($result);
		if($bool)
		{
			print_r($result);
			die();
		} 
		return $result;
	}
	
    public function ud_getRowCountResult($result)
    {
        $cnt = mysql_num_rows($result);
        return $cnt;
    }
    
   	public function ud_mysql_fetch_assoc_all($result)
	{
		$array = array();
		$count = 0;
		while(($data = $this->ud_mysql_fetch_assoc($result))!= NULL)
		{
			$array[$count++] = $data;
		}	
		return $array;
	}
	
	public function ud_timestamp()
	{
		$time = time();
		$date = date('Y-m-d H:i:s',$time);
		return $date;
	}

    public function ud_getRowCountQuery($query,$print = false)
    {
    	if($print == true)
    	{
    		echo $query;
    	}
        if ($result = $this->ud_getQuery($query))
        {
            $db_field = mysql_fetch_assoc($result);
            $cnt = mysql_num_rows($result);
            return $cnt;
        }
        else
        {
            die("Sorry Unable to Connect to database. Contact Administartor");
        }

    }

}
?>