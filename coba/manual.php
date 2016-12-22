<?php include "config.php" ?> 
<!DOCTYPE html>
<html lang="en">
<?php include "header.php" ?>
<body>
<?php include "menu.php" ?>
<hr/>
<h1><center>Manual Control</center></h1>
<hr/>
<table width="60%" border="1" cellspacing="0" cellpadding="5" align="center">
	<tr>
		<td><center>Room Name</center></td>
		<td><center>Device Name</center></td>
		<td width="15%"><center>Switch</center></td>
		<td width="15%"><center>Switch Status</center></td>
	</tr>
	<?php 
	$select = "SELECT room.room_name, room.device_name, control.switch,
				control.control_id, control.switch_status
				FROM control INNER JOIN room ON room.room_id = control.room_id WHERE control.mode='4'";
	$queryselect = mysql_query($select, $conn) or die("Failed to get data!");
	$data = mysql_fetch_assoc($queryselect);
	do {
	?>
	<tr>
		<td><?php echo $data['room_name']; ?></td>
		<td><?php echo $data['device_name']; ?></td>
		<td>
		<form action="switch_on.php" method="POST">
		<input type='hidden' name="control_id" value="<?php echo $data['control_id']; ?>">
		<input type='submit' name="switch_on" value='ON' style="height:30px; width:45px; float:left" onclick="return confirm('Are you sure want to turn this device on?');"></form>
		<form action="switch_off.php" method="POST">
		<input type='hidden' name="control_id" value="<?php echo $data['control_id']; ?>">
		<input type='submit' name="switch_off" value='OFF' style="height:30px; width:45px; float:right" onclick="return confirm('Are you sure want to turn this device off?');"></form>
		</td>
		<td><?php if($data['switch_status'] == 1) { echo "ON"; } else { echo "OFF";}?></td>
	</tr>
<?php } while ($data = mysql_fetch_assoc($queryselect)); ?>
</table>
</body>
</html>