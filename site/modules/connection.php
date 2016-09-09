<?php

/*
	Connection class
*/

class PDOConnection
{
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;
	
	private $db_handler;
	private $error;
	
	/*
		Constructer
		PARMETERS: none
		OUTPUTS: none
		POST: establishing connection wtih database
		ERROR: Prints out error message 
	*/
	public function __construct()
	{
		$dbsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		
		$options = array(
			// Checks if there is already a connection so it doesn't have to create a new one
			PDO::ATTR_PERSISTENT => true,
			// Throws exception when an error is found
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);
		
		try
		{
			$this->db_handler = new PDO($dbsn, $this->user, $this->pass, $options);
		}
		catch(PDOException $e)
		{
			$this->error = $e->getMessage();
		}
		
	}

	/*
		All Results
		IN: none
		OUT: Fetches all the results and stores them in a set
		POST: all results are fetched and stored
	*/
	public function allResults()
	{
		$this->execute();
		return $this->fetchAll(PDO::FETCH_ASSOC);
	}
	
	
	/*
		Begin Transaction
		IN: NONE
		OUT: returns the transaction
		POST: Transaction has begun
	*/
	public function beginTransaction()
	{
		return $this->db_handler->beginTransaction();
	}
	
	/*
		Bind
		IN: $param (the parameter you want the value to be bound to) $value (the value you want to be bound)
		OUT: none
		POST: Parameter is bound
	*/
	public function bind($param, $value, $type=null)
	{
		if (is_null($type))
		{
			switch(true)
			{
				case is_int($value):
				  $type = PDO::PARAM_INT;
				  break;
				case is_bool($value):
				  $type = PDO::PARAM_BOOL;
				  break;
				case is_null($value):
				  $type = PDO::PARAM_NULL;
				  break;
				default:
				  $type = PDO::PARAM_STR;
			}
		}
		else
		{
			echo "Error: Type is not null";
		}
		$this->bindValue($param, $value, $type);
	}
	
	/*
		Cancels the transaction
		IN: none
		OUT: returns the cancelled transaction
		POST: Transaction is cancelled
	*/
	public function cancelTransaction()
	{
		return $this->db_handler->rollBack();
	}

	/*
	 not exactly sure how to use this yet 
	*/
	public function debugDumpParams()
	{
		return $this->debugDumpParams();
	}
	
	/*
		Ends the transaction
		IN: none
		OUT: returns the commited transaction
		POST: Transaction is ended
	*/
	public function endTransaction()
	{
		return $this->db_handler->commit();
	}
	
	/*
		Execute
		IN: none
		OUT: Returns if it is executed or not
		POST: Action is executed
	*/
	public function execute()
	{
		return $this->execute();
	}
	
	/*
		Queries the database
		IN: $q (Your query)
		OUT: returns the result of query
		POST: query is send and returned
	*/
	public function query($q)
    {
        return $this->db_handler->query($q);
    }
	
	/*
		Row Count
		IN: none
		OUT: Returns the number of rows in database
		POST: Row number is fetched and returned
	*/
	public function rowCount()
	{
		return $this->rowCount();
	}
	
	/*
		One Results
		IN: none
		OUT: Returns one result
		POST: Result is returned
	*/
	public function oneResult(){
		$this->execute();
		return $this->fetch(PDO::FETCH_ASSOC);
	}
}
?>
