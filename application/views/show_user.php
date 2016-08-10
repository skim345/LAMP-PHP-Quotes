<html>
<head>
	<title>User</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">

</head>
<body>
	<div class="container">
		<div id="nav">
			<h1 id="showH1">Posts by <?=$count['username']; ?></h1>
			<a id="dashboard" href="/Quotes/home">Dashboard</a>
			<a id="logoff" href="/Users/logoff">Logoff</a>
		</div>
		<h2 id="count">Count: <?=$count['count'];?></h2>
	<?php
			foreach($user_quotes as $quotes)
			{
				echo "<div class='quotes'><p class='red'>".$quotes['quoted_by'].":</p>
					  <p>".$quotes['message']."</p></div>";
			}
	?>
	</div>
</body>
</html>