<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set('Asia/Jakarta');
if(isset($_POST['control_id'])) {
	$control_id = $_POST['control_id'];
	if(trim($_POST['control_action']) == "mode") {
		$mode = $_POST['mode'];
		$mode_status = $_POST['mode_status'];
		$schedule_on = date('H:i:s', strtotime($_POST['schedule_on']));
		$schedule_off = date('H:i:s', strtotime($_POST['schedule_off']));
		$time_now = date('H:i:s');
		
		if($mode == 1)	{
			?>
			<meta http-equiv="refresh" content = "2; url=new.php">
			<?php
			if ($schedule_on > $schedule_off)	{
				if (($time_now >= $schedule_off) && ($time_now <= $schedule_on)) {
					$switch_status = 0;
				} else {
					$switch_status = 1;
				}
			} else {
				if (($time_now >= $schedule_on) && ($time_now <= $schedule_off)){
					$switch_status = 1;
				} else {
					$switch_status = 0;
				}
			}
		} else {
			$switch_status = 1;
		}
		
	} elseif (trim($_POST['control_action']) == "switch"){
		$switch_status = $_POST['switch_status'];
		$updatemode = "UPDATE control SET switch_status='$switch_status' WHERE control_id='$control_id'";
		$querymode = mysql_query ($updatemode, $conn) or die ("Failed to get data!");
		if($querymode)	{
			?>
			<meta http-equiv="refresh" content = "0; url=coba_control.php"
			<?php

		}
	} else {
			?>
			<meta http-equiv="refresh" content = "0; url=coba_control.php"
			<?php
	} 
} else {
?>
<?php include "header.php"?>
<script type="text/javascript">
	function controlDetails(id) {
		if(document.getElementById("det"+id).style.display == "none") {
			document.getElementById("det"+id).style.display = "";
			document.getElementById("txt"+id).innerText = "Hide";
		} else {
			document.getElementById("det"+id).style.display = "none";
			document.getElementById("txt"+id).innerText = "Show";
		}
	}
</script>
<?php include "menu.php" ?>
<hr>
<h1>Controlling Switch Configuration</h1>
<hr/>
<a href="coba_controladd.php">Add New Controlling Switch</a>
	<table width="100%" border="1" cellspacing="0" cellpadding="5">
		<tr>
			<td>Room</td>
			<td>Device Name</td>
			<td>Switch</td>
			<td>Mode</td>
			<td>Details</td>
			<td>Edit</td>
			<td>Delete</td>
		</tr>
		<?php
		$select = "SELECT room.room_name, room.device_name, room.room_description, control.switch,
					control.control_id, control.mode, control.mode_status, control.switch_status,
					control.schedule_on, control.schedule_off FROM control INNER JOIN room ON room.room_id = control.room_id";
		$queryselect = mysql_query($select, $conn) or die("Failed to get data!");
		$data = mysql_fetch_assoc($queryselect);
		do {
		?>
		<tr>
			<td><?php echo $data['room_name']; ?></td>
			<td><?php echo $data['device_name']; ?></td>
			<td><?php echo $data['switch']; ?></td>
			<td><?php switch($data['mode']) {
						case 1: echo "Scheduling"; break;
						case 2: echo "Motion Sensor"; break;
						case 3: echo "Temperature Sensor"; break;
						case 4: echo "Manual"; break;
					} ?></td>
			<form id="status<?php echo $data['control_id']; ?>" action="coba_control.php" method="POST">
			<input type="hidden" name="control_id" value="<?php echo $data['control_id']; ?>">
			<input type="hidden" name="mode" value="<?php echo $data['mode']; ?>">
			<input type="hidden" name="schedule_on" value="<?php echo $data['schedule_on']; ?>">
			<input type="hidden" name="schedule_off" value="<?php echo $data['schedule_off']; ?>">
			<input type="hidden" id="control_action<?php echo $data['control_id']; ?>" name="control_action">
			<input type="hidden" id="control_status<?php echo $data['control_id']; ?>" name="control_status">
			</form>
			<td><a href="javascript: void(0);" onclick="controlDetails('<?php echo $data['control_id']; ?>');" id="txt<?php echo $data['control_id']; ?>">Show</a></td>
			<td><a href="coba_controledit.php?id=<?php echo $data['control_id']; ?>">Edit</a></td>
			<td><a href="coba_controldelete.php?id=<?php echo $data['control_id']; ?>" onclick="return confirm('Are you sure want to delete this switch control?');">Delete</a></td>
		</tr>
		<tr id="det<?php echo $data['control_id']; ?>" style="display: none">
			<td colspan="8" align="center">
			<table border="0" cellspacing="0" cellpadding="10">
				<tr>
					<td><b>Room Name</b></td>
					<td><?php echo $data['room_name']; ?></td>
					<td><b>Controlling Mode</b></td>
					<td><?php switch($data['mode']) {
						case 1: echo "Scheduling"; break;
						case 2: echo "Motion Sensor"; break;
						case 3: echo "Temperature Sensor"; break;
						case 4: echo "Manual"; break;
					} ?></td>
				</tr>
				<tr>
					<td><b>Device Name</b></td>
					<td><?php echo $data['device_name']; ?></td>
					<td><b>Room Description</b></td>
					<td><?php echo $data['room_description']; ?></td>
				</tr>
				<tr>
					<td><b>Mode Status</b></td>
					<td><?php if($data['mode_status'] == 1) { echo "ON"; } else { echo "OFF";}?></td>
					<td><b>Switch Name</b></td>
					<td><?php echo $data['switch']; ?></td>
				</tr>
				<tr>
					<td><b>Switch Status</b></td>
					<td><?php if($data['switch_status'] == 1) { echo "ON"; } else { echo "OFF"; } ?></td>
					<td><b><?php if($data['mode'] == 1) { echo "Scheduling On"; } else { echo ""; } ?></b></td>
					<td><?php if($data['mode'] == 1) { echo $data['schedule_on']." - ".$data['schedule_off']; } else { echo ""; } ?></td>
				</tr>
			</table>
			</td>
		</tr>
		<?php } while ($data = mysql_fetch_assoc($queryselect)); ?>
</table>
</body>
<?php } ?>
</html>
 