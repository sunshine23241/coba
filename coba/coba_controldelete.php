<?php
include "config.php";

$control_id = $_GET['id'];
$select = "SELECT * FROM control WHERE control_id='$control_id'";
$queryselect = mysql_query($select, $conn) or die(mysql_error());
$rowselect = mysql_num_rows($queryselect);
if ($rowselect > 0) {
	$delete = "DELETE FROM control WHERE control_id='$control_id'";
	$querydelete = mysql_query($delete, $conn) or die(mysql_error());
	if($querydelete) {
		?>
		<script type="text/javascript">
		window.alert("Control has been successfully deleted!");
		</script>
		<meta http-equiv="refresh" content="0; url=coba_control.php">
		<?php
	}
} else {
	?>
	<meta http-equiv="refresh" content="0; url=coba_control.php">
	<?php 
}