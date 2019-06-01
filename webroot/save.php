<?php

/*  This file is part of phpSANE.

    phpSANE is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    phpSANE is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with phpSANE.  If not, see <https://www.gnu.org/licenses/>.
    
  */

echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="root">
<meta name="robots" content="noindex">
<link rel="stylesheet" type="text/css" href="./css/style.css">
<title>Save</title>
</head>
<body>';


include("incl/security.php");
include("incl/language.php");

$file_save = $_GET['file_save'];
$file_save_image = $_GET['file_save_image'];
$lang_id = $_GET['lang_id'];


if ($file_save_image) {
	echo "
	<p class='align_center'>
		<img src='".$file_save."' border='2'>";
} else {
	// my_pre my_mono
	echo "\t<p class='my_pre'>\n";
	include($file_save);
	echo "\n\t<hr>\n";
}

echo "
		<br><a href=\"$file_save\" target=\"_blank\">".$file_save."</a>
	</p>

	<p class='align_center'>
		".$lang[$lang_id][35]."
	</p>

	<p class='align_center'>
		<input type='button' name='close' value='".$lang[$lang_id][36]."' onClick='javascript:window.close();'>
	</p>

</body>
</html>\n";

?>
