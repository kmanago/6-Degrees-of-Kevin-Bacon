<!DOCTYPE html>
<?php 

include('common.php');
?>

<html lang="en">
  <head>

    <title>6 Degrees of Kevin Bacon</title>

   
  </head>

  <body>
	<div class="main">
		<fieldset class="column">
			<legend>6 Degrees of Kevin Bacon</legend>
			
				<h4>1 Degree of Seperation from Kevin Bacon</h4>
				<form action="1degree.php" method="post">
						<input type="text" name="name" placeholder="Enter an actor" />
						<input type="submit" />
				</form>
				
				<h4>2 Degrees of Seperation from Kevin Bacon</h4>
				<form action="2degree.php" method="post">
						<input type="text" name="name" placeholder="Enter an actor" />
						<input type="submit" />
				</form>
				
			
				<h4>Genre 1: Genre(s) with max. number of movies</h4>
					<form action="1genre.php" method="post">
						<input type="submit" value="Click Here">
					</form>
			
			
				<h4>Actors with max. number of movies of a user-given genre</h4>
					<form action="2genre.php" method="post">
						<input type="text" name="genre" placeholder="Enter a genre" />
						<input type="submit" />
				</form>
	
				
				<h4>Actors that have also directed Movies</h4>
					<form action="director.php" method="post">
						<input type="submit" value="Click Here">
				</form>
		</fieldset>
	</div>
  </body>
	
</html>			
