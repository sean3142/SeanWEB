<?php
/* Written by STS */

class db_conn
{
	public $conn;
	private $servername; private $user; private $pass; private $db;
	function __construct()
	{
		$this->servername = "localhost"; $this->username = "php"; $this->password = "php"; $this->db = "climatedb";
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);
		if($this->conn->connect_error) {die("Connection to SQL Server Failed Error: $this->conn->connect_error");};
	}
	function __destruct()
	{
		$this->conn->close();
	}
}

class devs
{
	public $dev_id=array();
	private $query;
	public $result;

	function __construct (&$db_conn)
	{
		$this->query = "SELECT dev_id FROM devices;";
		if(!$this->result = $db_conn->conn->query($this->query)) {die("Query to Database failed with error: " . $db_conn->conn->error);}
		while($rec=$this->result->fetch_assoc()){
			$this->dev_id[]=$rec["dev_id"];
		}
	}
}

class trend
{
	public $values = array();
	private $query;
	public $period; 		// Time Period in days
	function __construct($dev_id, &$db_conn, $period)
	{

		/* SELECT COLUMNS	/| dev1.ts | dev1.value | dev2.value |\					*/
		$this->query = 'SELECT `' . $dev_id[0] . '`.ts ';
		foreach($dev_id as $d){			// devi_id is now an array
			$this->query .= ', `' . $d . '`.value AS `' . $d . '` ';   // TODO AS CLAUSE should be changed to description instead of dev_id
		}
		
		/* FROM SUBTABLES (of sample)		FROM subtable1 WHERE dev_id='dev1' JOIN subtable2 ON timestamp			*/
		$this->query .= 'FROM (SELECT ts,value FROM samples WHERE dev_id="' . $dev_id[0] . '") `' . $dev_id[0] . '` ';
		for($index = 1; isset($dev_id[$index]); $index++){
			$this->query .= 'JOIN (SELECT ts, value FROM samples WHERE dev_id="' . $dev_id[$index] . '") `' . $dev_id[$index] . '` ';
			$this->query .= 'ON `' . $dev_id[$index] . '`.ts=`' . $dev_id[0] . "`.ts ";
		}	
		$this->query .= 'WHERE `' . $dev_id[0] . '`.ts > DATE_SUB(NOW(), INTERVAL ' . $period . ' DAY);';
/*
		values(){
			[0] => array(
					[ts] => ts0,
					[dev1] => value,
					[dev2] => value,
					...
					)
			[1] => array(
					[ts] => sample1,
					[dev1] => sample2
					[dev2] => value,
					...
					)
			[2] => array(
					[ts] => sample2,
					[dev1] => sample2
					[dev2] => value,
					...
					)
			}
			
*/
		if(!$this->result = $db_conn->conn->query($this->query)) {die("Query to Database failed with error: " . $db_conn->conn->error);}
		while($record=$this->result->fetch_assoc()){
			$this->values[] = $record;
		}

/*
		$this->query = 'SELECT ts,value FROM samples WHERE dev_id="' . $dev_id . '" ORDER BY ts ASC;';
		if(!$this->result = $db_conn->conn->query($this->query)) {die("Query to Database failed with error: " . $db_conn->conn->error);}
		while($rec=$this->result->fetch_assoc()){
			$this->values[$rec["ts"]]=$rec["value"];
		}
*/
	}
}
?>
