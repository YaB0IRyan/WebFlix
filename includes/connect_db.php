<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->

<!-- this page is used to allow the site to connect to the database, this is used by nearly all pages -->
<?php 
	$link = mysqli_connect('localhost','HNDSOFTS2A14','GdPZUFCJ6L','HNDSOFTS2A14');
	if (!$link) { 
		die('Could not connect to MySQL: ' . mysqli_error()); 
	} 
?> 