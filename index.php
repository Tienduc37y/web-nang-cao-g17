<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Visual Studio Code Remote :: PHP</title>
	</head>
	<body>
		<h2>Nhóm 17</h2>
		<?php
		for ($i = 1; $i <= 200; $i++) {
			if ($i % 2 == 0) {
				echo '<span style="color: red; font-weight: bold;">' . $i . '</span> ';
			} else {
				echo '<span style="color: blue; font-style: italic;">' . $i . '</span> ';
			}
		}
		?>
		
	</body>
</html>