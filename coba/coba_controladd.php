<?php include "config.php" ?>
<!DOCTYPE html>
<html lang="en">
<?php include "header.php" ?>
<script type="text/javascript">
function getSensor(sel) {
    var value = sel.value;
	if (value == 1) {
		document.getElementById("schedule").style.display="block";
	} else {
		document.getElementById("schedule").style.display="none";
	}
}
</script>
<body>
<?php include "menu.php" ?>
<hr/>
<h1>Add New Controlling Switch</h1>
<hr/>
<?php
if(isset($_POST['mode'])) {
	date_default_timezone_set('Asia/Jakarta');
	$room_id = $_POST['room_id'];
	$switch = $_POST['switch'];
	$mode = $_POST['mode'];
	$schedule_on = date('H:i:s', strtotime($_POST['schedule_on']));
	$schedule_off = date('H:i:s', strtotime($_POST['schedule_off']));
	$time_now = date('H:i:s');
	
	if (($mode == 1) && ($schedule_on == $schedule_off)) {
		?>
		<script type="text/javascript">
		window.alert("Schedule on and off must be different time!");
		</script>
		<meta http-equiv="refresh" content="0; url=coba_controladd.php">
		<?php
	} else {
		if ($mode == 1) {
			?>
			<meta http-equiv="refresh" content = "0; url=new.php"
			<?php
			if ($schedule_on > $schedule_off) {
				if (($time_now >= $schedule_off) && ($time_now <= $schedule_on)) {
					$switch_status = 0;
					echo "OFF";
				} else {
					$switch_status = 1;
					echo "ON";
				}
			} else {
				if (($time_now >= $schedule_on) && ($time_now <= $schedule_off)) {
					$switch_status = 1;
					echo "ON";
				} else {
					$switch_status = 0;
					echo "OFF";
				}
			}
		} else {
			$switch_status = 1;
			echo "ON";
		}
	}
		$insert = "INSERT INTO control SET
					room_id='$room_id',
					switch='$switch',
					mode='$mode',
					schedule_on='$schedule_on',
					schedule_off='$schedule_off'";
		$queryinsert = mysql_query($insert, $conn) or die ("Failed to insert data!");
		if ($queryinsert) {
			?>
			<script type="text/javascript">
			window.alert("New controlling switch has been successfully added!");
			</script>
			<meta http-equiv="refresh" content="0; url=coba_control.php">
			<?php
		}
	if ($mode ==  4){
		?>
		<script type="text/javascript">
		function confirmation() {
		var answer = confirm("Do you want to turn it on?")
			if (answer){
				window.location = "manual.php";
			} else{
				alert ("New controlling switch has been successfully added!");
				window.location = "coba_control.php";
			}
		}
		</script>
		<?php
		 echo '<script type="text/javascript">confirmation();</script>';
		}	
} else { 
?>
<form action="coba_controladd.php" method="POST">
<p>Room Name</p>
<select name="room_id">
	<?php
	$selectroom = "SELECT room_id, room_name FROM room";
	$queryroom = mysql_query($selectroom, $conn) or die("Failed to get data!");
	$dataroom = mysql_fetch_assoc($queryroom);
	do {
		?>
		<option value="<?php echo $dataroom['room_id']; ?>"><?php echo $dataroom['room_name']; ?></option>
		<?php
	} while($dataroom = mysql_fetch_assoc($queryroom));?>
</select>
<p>Switch Name</p>
<input type="text" name="switch">
<p>Mode</p>
<select name="mode" id="mode" onchange="getSensor(this)">
	<option value="1">Scheduling</option>
	<option value="2">Motion Sensor</option>
	<option value="3">Temperature Sensor</option>
	<option value="4">Manual</option>
</select>
<div id="schedule">
	<p>Schedule On</p>
	<input type="text" name="schedule_on" id="schedule_on">
	<p>Schedule Off</p>
	<input type="text" name="schedule_off" id="schedule_off">
</div>
<p><input type="submit" value="Submit"></p>
</form>
<?php
}
?>
</body>
</html>