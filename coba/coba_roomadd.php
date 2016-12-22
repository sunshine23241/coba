<?php include "config.php" ?>
<!DOCTYPE html>
<html lang="en">
<?php include "header.php" ?>
<body>
<?php include "menu.php" ?>
<hr/>
<h1>Add New Room</h1>
<hr/>
<?php
if(isset($_POST['room_name'])) {
	$room_name = ucwords(trim(strip_tags($_POST['room_name'])));
	$device_name = ucwords(trim(strip_tags($_POST['device_name'])));
	$room_description = ucwords(trim(strip_tags($_POST['room_description'])));
	
	if ($room_name == "") {
		?>
		<script type="text/javascript">
		window.alert("Room name must be filled!");
		</script>
		<meta http-equiv="refresh" content="0; url=coba_roomadd.php">
		<?php
	} else if($device_name == "") {
		?>
		<script type="text/javascript">
		window.alert("Device name must be filled!");
		</script>
		<meta http-equiv="refresh" content="0; url=coba_roomadd.php">
		<?php
	}else{
		$insert = "INSERT INTO room SET room_name='$room_name', device_name='$device_name', room_description='$room_description'";
		$queryinsert = mysql_query($insert, $conn) or die ("Failed to insert data!");
		if ($queryinsert) {
			?>
			<script type="text/javascript">
			window.alert("New room has been successfully added!");
			</script>
			<meta http-equiv="refresh" content="0; url=coba_room.php">
			<?php
		}
	}
} else { 
?>
<form action="coba_roomadd.php" method="POST">
<p>Room Name</p>
<input type="text" name="room_name">
<p>Device Name</p>
<input type="text" name="device_name">
<p>Room Description</p>
<input type="text" name="room_description">
<p><input type="submit" value="Submit"></p>
</form>
<?php
}
?>
</body>
</html>