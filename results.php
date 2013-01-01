<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Flights Search Panel Demo</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="Flights Search Panel Demo" />
<meta name="description" content="Flights Search Panel Demo for scraping website contents using CURL" />
<meta name="keywords" content="flights, search flights, scraping flights website, curl" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="results-outer-wrapper">
	<?php
	if( ! empty( $_SESSION['html'] ) ){
	?>
	<frame style="height:700px">
		<?php
			echo $_SESSION['html'];
		?>
	</frame>
	<?php
	}
	?>
</div>

</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</html>