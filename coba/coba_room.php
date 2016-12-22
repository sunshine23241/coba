<?php include "config.php" ?>
<!DOCTYPE html>
<html lang="en">
<?php include "header.php" ?>
<body>
<?php include "menu.php" ?>
<hr/>
<h1>Room Management</h1>
<hr/>
<a href="coba_roomadd.php">Add New Room</a>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
	<tr>
		<td>Room Name</td>
		<td>Device Name</td>
		<td>Room Description</td>
		<td>Edit</td>
		<td>Delete</td>
	</tr>
	<?php
	$select = "SELECT * FROM room";
	$queryselect = mysql_query($select, $conn) or die("Failed to get data!");
	$data = mysql_fetch_assoc($queryselect);
	do {
	?>
	<tr>
		<td><?php echo $data['room_name']; ?></td>
		<td><?php echo $data['device_name']; ?></td>
		<td><?php echo $data['room_description']; ?></td>
		<td><a href="coba_roomedit.php?id=<?php echo $data['room_id']; ?>">Edit</a></td>
		<td><a href="coba_roomdelete.php?id=<?php echo $data['room_id']; ?>" onclick="return confirm('Are you sure want to delete this room?');">Delete</a></td>
	</tr>
	<?php } while ($data = mysql_fetch_assoc($queryselect)); ?>
</table>
</body>
</html>