<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Upload</title>
<style>
body,html{color:#fff;}
</style>
</head>
<body>
<div id="table">
<?php
include 'php/getin.php';
$con = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$importpassword = mysqli_real_escape_string($con, $_POST['import_password']);
$con->close();
if($importpassword !== ""){
	$where = "password = '$importpassword'";
}else{
	$where = "public_private = '0'";
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$checkpass = "SELECT * FROM focuses WHERE $where";
$result = $conn->query($checkpass);
//If there's at least 1 result from query
if ($result->num_rows > 0) {
	echo '<p>Click the focuses below to add them to your focus tree</p><button id="clear-table">Clear Focuses</button><table>
<tr>
	<th>Focus Title</th>
	<th>Intended Country</th>
	<th>Reward</th>
</tr>';
	//Run the following code for each result
    while($row = $result->fetch_assoc()) {
		echo '<tr class="import-row" id="'.$row['focus_id'].'">';	
			echo '<td>'.$row['focus_name'].'</td>';
			echo '<td>'.$row['country_affected'].'</td>';
			echo '<td><div class="focus-reward">'.$row['focus_reward'];
			//All info we need
			$xpos = (int)$row['focus_x']*150;
			$ypos = (int)$row['focus_y']*180;
			echo '
			<div id="'.$row['focus_id'].'-import-row" style="display:none;">
		<div password="'.$row['password'].'" id="'.$row['focus_id'].'" class="focus" style="top:'.$ypos.'px;left:'.$xpos.'px;" x-pos="'.$row['focus_x'].'" y-pos="'.$row['focus_y'].'"><div style="position:relative"><div class="mover up">^&nbsp;&nbsp;</div><div class="mover down">&nbsp;&nbsp;v</div><img src="'.$row['focus_gfx'].'" id="'.$row['focus_id'].'_gfx" class="gfx"><div class="name">'.'<p id="'.$row['focus_id'].'-name">'.$row['focus_name'].'</p></div><div class="mover left">&lt;&nbsp;&nbsp;</div><div class="mover right">&nbsp;&nbsp;&gt;</div><div class="tail"></div></div></div><div class="all-info" id="'.$row['focus_id'].'-all-info"><div id="'.$row['focus_id'].'_name">'.$row['focus_name'].'</div><div id="'.$row['focus_id'].'_desc">'.$row['focus_description'].'</div><div id="'.$row['focus_id'].'_tooltip">'.$row['focus_tooltip'].'</div><div id="'.$row['focus_id'].'_available">'.$row['focus_available'].'</div><div id="'.$row['focus_id'].'_reward">'.$row['focus_reward'].'</div><div id="'.$row['focus_id'].'_time">'.$row['focus_ttc'].'</div><div id="'.$row['focus_id'].'_bypass">'.$row['focus_bypass'].'</div><div id="'.$row['focus_id'].'_prefocus">'.$row['focus_prefocus'].'</div><div id="'.$row['focus_id'].'_mutual">'.$row['focus_mutual'].'</div><div id="'.$row['focus_id'].'_ai">'.$row['focus_ai'].'</div><div id="'.$row['focus_id'].'_gfx">'.$row['focus_gfx'].'</div></div>
			</div>
			</div></td>';
		echo '</tr>';	
	}
	echo '</table>';
}else{
	echo "<p>No focuses found.<br>If using a password, ensure the password is correct and try again.</p>";
}
$conn->close();
?>
</div>
</body>
</html>