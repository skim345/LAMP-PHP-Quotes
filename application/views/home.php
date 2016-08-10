<html>
<head>
	<title>Quotes Home</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">

</head>
<body>
	<div class="container">
		<div class="nav">
			<h1>Welcome <?=$this->session->userdata('user_info')['first_name']; ?></h1>
			<a href="/Users/logoff">Logoff</a>
		</div> <!-- end of nav -->
				<div class="favorite_quotes">
			<h3>Your Favorites</h3>
<?php 
			foreach($my_quote as $fav)
			{
				echo "<div class='quotes'>
					  <p>".$fav['quoted_by']."</p>
					  <p>".$fav['message']."</p>
					  <p>Posted By: <a href='/Users/show_user/".$fav['id']."'>".$fav['username']."</a></p>
					  <a class='addListLink' href='/Quotes/remove_fave/".$fav['quote_id']."'>Remove from My List</a></div> <!-- end of quotes -->";
			}

?>
		</div> <!-- end of favorite_quotes -->
		<div class="all_quotes">
			<h3>Quotes</h3>	
<?php
			foreach($quote as $quote)
			{
				echo "<div class='quotes'><p>".$quote['quoted_by']."</p>
					  <p>".$quote['message']."</p>
					  <p> Posted By: <a href='/Users/show_user/".$quote['id']."'>".$quote['username']."</a></p>
					  <a class='addListLink' href='/Quotes/add_to_fave/".$quote['quote_id']."'>Add to My List</a></div> <!-- end of quotes -->";
			}
	?>
		</div> <!-- end of all_quotes -->

		<div class="add_quote">
<?php 		
			$this->load->view("partials/flash_message");
?>
			<h3>Contribute a Quote:</h3>
			<form action='/Quotes/add_quote' method='post'>
			<label>Quoted By:</label>	
			<input type='text' name='quoted_by'>
			<label>Message:</label>
			<input type='text' name = "message">
			<input type='submit' value="Submit">
			</form>
		</div> <!-- end of add_quote -->
	</div> <!-- end of container -->
</body>
</html>