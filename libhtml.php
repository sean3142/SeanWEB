<?php
/* HTML Stuffs */
class htmlForm
{
	public $list = array();
	public $name;
	public $string = NULL;
	public $method = 'get';
	public $action;
	public $type;
 
	public 	function startForm(){
		$this->string = '<form name="' . $this->name . '" method="' . $this->method . '" action="' . $this->action . '">';
	}

	public function endForm(){
		$this->string .= '</form>';
	}
	public function submit(){
		$this->type = "submit";
		$this->string .= '<input type="' . $this->type . '" value="Punch it!" action="climate.php">';
	}
}

class htmlCheckbox extends htmlForm
{
	public $type="checkbox";
	public function build()
	{
		htmlForm::startForm();
		foreach($this->list as $value){
			$this->string .= '<input type="checkbox" name="' . $value . '" value="' . $value . '">'. $value . '<br/>';
		}
		htmlForm::submit();
		htmlForm::endForm();
	}
}


class htmlSelect extends htmlForm
{
	public $type = 'submit';
	public function build()
	{
		htmlForm::startForm();
		$this->string .= '<label for="' . $this->name . '">' . $this->name . ':</label>';
		$this->string .= '<select name="' . $this->name . '" id="selDevice">';
		foreach ($this->list as $index=>$value){
			$this->string .= '<option value="' . $value . '">' . $value . '</option>';
		}
		$this->string .= '</select>';
		htmlForm::submit();
		htmlForm::endForm();
	}

}

/*	[
	[new Date(2016,4,9,16,20,05),18.125, 3.5],
	[new Date(2016,4,9,16,30,05),18.125, 4.125],
	]
*/
function jsArray($table){
	if(!isset($table)){die("array error");};
	$jsString = "";
	echo '[';
	foreach($table as $column=>$record){
		$t = preg_split("/[-\s:]/", $record["ts"]);
		$jsString .= '[ new Date(' . $t[0] . ',';
		$jsString .= $t[1]-1 . ',';
		$jsString .= $t[2] . ',';
		$jsString .= $t[3] . ',' . $t[4] . ',';
		$jsString .= $t[5] . ')';
		foreach($record as $device=>$field){
			if($device != "ts"){
				$jsString .= ',' . $field;
			}
		}
		$jsString .= '], ';
	}
	$jsString .= ']';
	return $jsString;
}
			
?>
