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
<h1>Edit Controlling</h1>
<hr/>
<?php
if(isset($_POST['mode'])) {
	date_default_timezone_set('Asia/Jakarta');
	$control_id = $_POST['control_id'];
	$room_id = $_POST['room_id'];
	$switch = $_POST['switch'];
	$mode = $_POST['mode'];
	$schedule_on = date('H:i:s', strtotime($_POST['schedule_on']));
	$schedule_off = date('H:i:s', strtotime($_POST['schedule_off']));
	$time_now = date('H:i:s');
	$device_status = 1;
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
	
	if (($mode == 1) && ($schedule_on == $schedule_off)) {
		?>
		<script type="text/javascript">
		window.alert("Schedule on and off must be different time!");
		</script>
		<meta http-equiv="refresh" content="0; url=coba_controledit.php?id=<?php echo $control_id; ?>">
		<?php
	} else {
		if ($mode == 1) {
			if ($schedule_on > $schedule_off) {
				if (($time_now >= $schedule_off) && ($time_now <= $schedule_on)) {
					$switch_status = 0;
				} else {
					$switch_status = 1;
				}
			} else {
				if (($time_now >= $schedule_on) && ($time_now <= $schedule_off)) {
					$switch_status = 1;
				} else {
					$switch_status = 0;
				}
			}
		} else {
			$switch_status = 1;
		}
		$update = "UPDATE control SET
					room_id='$room_id',
					switch='$switch',
					switch_status='$switch_status',
					mode='$mode',
					mode_status=1,
					schedule_on='$schedule_on',
					schedule_off='$schedule_off' WHERE control_id='$control_id'";
		$queryupdate = mysql_query($update, $conn) or die ("Failed to insert data!");
		if ($queryupdate) {
			?>
			<script type="text/javascript">
			window.alert("Controlling switch has been successfully updated!");
			</script>
			<meta http-equiv="refresh" content="0; url=coba_control.php">
			<?php
		}
	}	
} else { 
	$controlid = $_GET['id'];
	$selectid = "SELECT * FROM control WHERE control_id='$controlid'";
	$queryselectid = mysql_query($selectid, $conn) or die("Failed to get data!");
	$rowselectid = mysql_num_rows($queryselectid);
	$dataselectid = mysql_fetch_array($queryselectid);
	if($rowselectid > 0) {
?>
<form action="coba_controledit.php" method="POST">
<input type="hidden" name="control_id" value="<?php echo $dataselectid['control_id']; ?>">
<p>Room Name</p>
<select name="room_id">
	<?php
	$selectroom = "SELECT room_id, room_name FROM room";
	$queryroom = mysql_query($selectroom, $conn) or die("Failed to get data!");
	$dataroom = mysql_fetch_assoc($queryroom);
	do {
		?>
		<option value="<?php echo $dataroom['room_id']; ?>" <?php if($dataroom['room_id'] == $dataselectid['room_id']) echo "selected" ?>><?php echo $dataroom['room_name']; ?></option>
		<?php
	} while($dataroom = mysql_fetch_assoc($queryroom));?>
</select>
<p>Switch Name</p>
<input type="text" name="switch" value="<?php echo $dataselectid['switch']; ?>">
<p></p>
	<select name="mode" id="mode" onchange="getSensor(this)">
	<option value="1" <?php if($dataselectid['mode'] == 1) echo "selected" ?>>Scheduling</option>
	<option value="2" <?php if($dataselectid['mode'] == 2) echo "selected" ?>>Motion Sensor</option>
	<option value="3" <?php if($dataselectid['mode'] == 3) echo "selected" ?>>Temperature Sensor</option>
	<option value="4" <?php if($dataselectid['mode'] == 4) echo "selected" ?>>Manual</Option>
</select>

<div id="schedule" <?php if($dataselectid['mode'] != 1) { ?> style="display: none" <?php } ?>>
	<p>Schedule On</p>
	<input type="text" name="schedule_on" id="schedule_on" value="<?php if($dataselectid['mode'] == 1) { echo $dataselectid['schedule_on']; } ?>">
	<p>Schedule Off</p>
	<input type="text" name="schedule_off" id="schedule_off" value="<?php if($dataselectid['mode'] == 1) { echo $dataselectid['schedule_off']; } ?>">
</div>
<p><input type="submit" value="Submit"></p>
</form>
<?php
	} else {
	?>
	<meta http-equiv="refresh" content="0; url=coba_control.php">
	<?php
	}
}
?>
</body>
</html>