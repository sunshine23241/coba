<?php 
include "config.php";
include 'php_serial.class.php';
$control_id = $_POST['control_id'];
$update = "UPDATE control SET switch_status=0 WHERE control_id = '$control_id'";
$queryupdate = mysql_query($update, $conn) or die ("Failed to insert data!");
	if ($queryupdate) {
		?>
		<script type="text/javascript">
		window.alert("Switch has been turned off!");
		</script>
		<meta http-equiv="refresh" content="0; url=manual.php">
		<?php
		}
// Let's start the class
$serial = new PhpSerial;

// First we must specify the device. This works on both linux and windows (if
// your linux serial device is /dev/ttyS0 for COM1, etc)
$serial->deviceSet("COM3");

// We can change the baud rate, parity, length, stop bits, flow control
$serial->confBaudRate(9600);
$serial->confParity("none");
$serial->confCharacterLength(8);
$serial->confStopBits(1);
$serial->confFlowControl("none");

// Then we need to open it
$serial->deviceOpen();

// To write into
$serial->sendMessage("B");
$serial->deviceClose();
?>