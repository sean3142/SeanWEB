<html><head>
<title>Climate</title>

<?php
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

class form
{
	//foreach (){}

?>


</head>
<body>
<p id="demo">hello</p>

<form action="action_page.php">
  <select name="cars">
    <option value="volvo">Volvo</option>
    <option value="saab">Saab</option>
    <option value="fiat">Fiat</option>
    <option value="audi">Audi</option>
  </select>
  <br><br>
  <input type="submit">
</form>

<table>
<tr>
<?php
	$dbc = new db_conn();
	$devices = new devs($dbc);

	foreach ( $devices->dev_id as $d ){
		echo "<td><a>" . $d . "</a></td>";
	}   
?>
</tr>
</table>

<table>
<tr>
<?php
	$dbc = new db_conn();
	$samples = new trend('28-0414705dcaff', $dbc);
	foreach ( $samples->values as $i=>$value ){
		echo "<tr><td>" . $i . "</td><td>" . $value . "</td></tr>";
	}   
?>
</tr>
</table>
</body>
</html>
