<!DOCTYPE html>
<html>
<body>

<form method="post">
<select name="cars" id="cars">
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="opel">Opel</option>
  <option value="audi">Audi</option>
</select>
     <button type="submit" value="execute">Punch it!</button>
</form>

<form action="">
	<input type="checkbox" name="greeting">hello</form>
	<br>
	<input type="checkbox" name="greeting">hi</form>
</form>

<?php 
	echo '<p>' . $_POST['cars'] . '</p>';
?>
</body>
</html>


