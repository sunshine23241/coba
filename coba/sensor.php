<?php include "config.php" ?> 
<!DOCTYPE html>
<html lang="en">
<?php include "header.php" ?>
<body>
<?php include "menu.php" ?>
<hr/>
<h1><center>Sensors Information</center></h1>
<hr/>
<table width="85%" border="1" cellspacing="0" cellpadding="5" align="center">
	<tr>
		<td>Room Name</td>
		<td>Device Name</td>
		<td>Type of Sensor</td>
		<td>Switch</td>
		<td>Mode Status</td>
		<td>Sensor Status</td>
		<td>Switch Status</td>
	</tr>
	<?php 
	$select = "SELECT room.room_name, room.device_name, control.switch, control.mode,
				control.control_id, control.mode_status, control.switch_status, control.sensor_status
				FROM control INNER JOIN room ON room.room_id = control.room_id WHERE control.mode IN(2,3)";
	$queryselect = mysql_query($select, $conn) or die("Failed to get data!");
	$data = mysql_fetch_assoc($queryselect);
	do {
	?>
	<tr>
		<td><?php echo $data['room_name']; ?></td>
		<td><?php echo $data['device_name']; ?></td>
		<td><?php if($data['mode'] == 2){ echo "Motion Sensor";} else { echo "Temperature Sensor";} ?></td>
		<td><?php echo $data['switch']; ?></td>
		<td><?php if($data['mode_status'] == 1) { echo "ON"; } else { echo "OFF";}?></td>
		<td><?php if($data['sensor_status'] == 1) { echo "ON"; } else { echo "OFF";}?></td>
		<td><?php if($data['switch_status'] == 1) { echo "ON"; } else { echo "OFF";}?></td>
	</tr>
<?php } while ($data = mysql_fetch_assoc($queryselect)); ?>
</table>
</body>
</html>