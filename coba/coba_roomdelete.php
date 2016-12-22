<?php
include "config.php";

$room_id = $_GET['id'];
$select = "SELECT * FROM room WHERE room_id='$room_id'";
$queryselect = mysql_query($select, $conn) or die(mysql_error());
$rowselect = mysql_num_rows($queryselect);
if ($rowselect > 0) {
	$delete = "DELETE FROM room WHERE room_id='$room_id'";
	$querydelete = mysql_query($delete, $conn) or die(mysql_error());
	if($querydelete) {
		?>
		<script type="text/javascript">
		window.alert("Room has been successfully deleted!");
		</script>
		<meta http-equiv="refresh" content="0; url=coba_room.php">
		<?php
	}
} else {
	?>
	<meta http-equiv="refresh" content="0; url=coba_room.php">
	<?php 
}
?>