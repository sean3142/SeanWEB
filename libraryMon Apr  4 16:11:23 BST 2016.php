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
		$i = 0;
		$this->query = "SELECT dev_id FROM devices;";
		if(!$this->result = $db_conn->conn->query($this->query)) {die("Query to Database failed with error: " . $db_conn->conn->error);}
		while($rec=$this->result->fetch_assoc()){
			$this->dev_id[$i++]=$rec["dev_id"];
		}
	}
}

class trend
{
	public $values = array();
	private $query;
	function __construct($dev_id, &$db_conn)
	{
		$this->query = 'SELECT ts,value FROM samples WHERE dev_id="' . $dev_id . '" ORDER BY ts DESC;';
		if(!$this->result = $db_conn->conn->query($this->query)) {die("Query to Database failed with error: " . $db_conn->conn->error);}
		while($rec=$this->result->fetch_assoc()){
			$this->values[$rec["ts"]]=$rec["value"];
		}
	}
}

function dropdown(&$array)
{
	echo '<label for="selDevice">Device:</label>';
	echo '<select name="selDevice" id="selDevice">';
	foreach ($array as $index=>$value){
		echo '<option value="' . $value . '">' . $value . '</option>';
	}
	echo '</select><input type="submit">';

}
?>
