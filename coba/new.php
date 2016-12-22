<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php
if(isset($_POST['mode'])) {
date_default_timezone_set('Asia/Jakarta');
$select = "SELECT control.schedule_on, control.schedule_off FROM control INNER JOIN room ON room.room_id = control.room_id";
	$queryselect = mysql_query($select, $conn) or die("Failed to get data!");
	$data = mysql_fetch_assoc($queryselect);
$schedule_on = $_POST['schedule_on'];
$schedule_off = $_POST['schedule_off'];
$time_now = date('H:i:s');
			if ($schedule_on > $schedule_off)	{
				if (($time_now >= $schedule_off) && ($time_now <= $schedule_on)) {
					?>
					<meta http-equiv="refresh" content = "1; url=new.php">
					<?php
					echo "OFF";
				} else {
					?>
					<meta http-equiv="refresh" content = "1; url=new.php">
					<?php
					echo "ON";
				}
			} else {
				if (($time_now >= $schedule_on) && ($time_now <= $schedule_off)){
					?>
					<meta http-equiv="refresh" content = "1; url=new.php">
					<?php
					echo "ON";
				} else {
					?>
					<meta http-equiv="refresh" content = "1; url=new.php">
					<?php
					echo "OFF";
				}
			}
		}  else {
					?>
					<meta http-equiv="refresh" content = "1; url=new.php">
					<?php	
					echo "OFF";
		}
?>

