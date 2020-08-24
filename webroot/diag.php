<?php
$scan_cmd = "scanimage -L";
$scan_result = shell_exec($scan_cmd);
echo $scan_result;
?>
