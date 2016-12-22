<?php include "config.php" ?>
<!DOCTYPE html>
<html lang="en">
<?php include "header.php" ?>
<body>
<?php include "menu.php" ?>
<hr/>
<h1>Edit Room</h1>
<hr/>
<?php
if(isset($_POST['room_name'])) {
	$room_id = ucwords(trim(strip_tags($_POST['room_id'])));
	$room_name = ucwords(trim(strip_tags($_POST['room_name'])));
	$device_name = ucwords(trim(strip_tags($_POST['device_name'])));
	$room_description = ucwords(trim(strip_tags($_POST['room_description'])));
	
	if ($room_name == "") {
		?>
		<script type="text/javascript">
		window.alert("Room name must be filled!");
		</script>
		<meta http-equiv="refresh" content="0; url=coba_roomedit.php?id=<?php echo $room_id; ?>">
		<?php
	}else if($device_name == "") {
		?>
		<script type="text/javascript">
		window.alert("Device name must be filled!");
		</script>
		<meta http-equiv="refresh" content="0; url=coba_roomadd.php">
		<?php
	}else{
		$update = "UPDATE room SET room_name='$room_name', room_description='$room_description' WHERE room_id='$room_id'";
		$queryupdate = mysql_query($update, $conn) or die ("Failed to update data!");
		if ($queryupdate) {
			?>
			<script type="text/javascript">
			window.alert("Room has been successfully updated!");
			</script>
			<meta http-equiv="refresh" content="0; url=coba_room.php">
			<?php
		}
	}
} else { 
	$room_id = $_GET['id'];
	$selectid = "SELECT * FROM room WHERE room_id='$room_id'";
	$queryselectid = mysql_query($selectid, $conn) or die("Failed to get data!");
	$rowselectid = mysql_num_rows($queryselectid);
	$dataselectid = mysql_fetch_array($queryselectid);
	if($rowselectid > 0) {
?>
<form action="coba_roomedit.php" method="POST">
<input type="hidden" name="room_id" value="<?php echo $dataselectid['room_id']; ?>">
<p>Room Name</p>
<input type="text" name="room_name" value="<?php echo $dataselectid['room_name']; ?>">
<p>Device Name</p>
<input type="text" name="device_name" value="<?php echo $dataselectid['device_name']; ?>">
<p>Room Description</p>
<input type="text" name="room_description" value="<?php echo $dataselectid['room_description']; ?>">
<p><input type="submit" value="Submit"></p>
</form>
<?php
	} else {
	?>
	<meta http-equiv="refresh" content="0; url=coba_room.php">
	<?php
	}
}
?>
</body>
</html>