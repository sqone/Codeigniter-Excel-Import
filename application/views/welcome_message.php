<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>
	<?php
	echo form_open_multipart(site_url('welcome/single_upload'));
	echo form_label('Single Upload File');
	echo form_upload('file');
	echo form_submit(null, 'Upload');
	echo form_close();
	?>
	<hr/>
	<?php
	echo form_open_multipart(site_url('welcome/multiple_upload'));
	echo form_label('Multiple Upload File');
	echo form_upload('file[]', null, 'multiple');
	echo form_submit(null, 'Upload');
	echo form_close();
	?>
</body>
</html>