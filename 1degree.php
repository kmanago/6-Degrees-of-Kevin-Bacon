<?php
	include('common.php');
    $host = '';
    $dbname = '6degrees';
    $username = 'root';
    $password = 'root';
	
	$name=explode(" ",$_POST["name"]);//gets the name the user inputs and splits based on space
	$namesize = count($name);
	
		if($namesize==3){
			$firstname=$name[0] . ' '. $name[1];
			$lastname=$name[2];
		}
		else{
			$firstname=$name[0];
			$lastname=$name[1];
		}	
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	
	$query = "SELECT first_name, last_name
				FROM actors WHERE first_name='$firstname'
				AND last_name='$lastname'";
				
	$results=$pdo->query($query);
	
	//continues to search database only if the actor entered is found in the database
	if ($results->rowCount()>0){
		 $sql = "SELECT 
				a1.first_name, a1.last_name, a2.first_name, a2.last_name, name, year 
				FROM movies JOIN roles AS r1 ON movies.id = r1.movie_id JOIN actors a1 ON r1.actor_id = a1.id 
				JOIN roles r2 ON movies.id = r2.movie_id 
				JOIN actors a2 ON r2.actor_id = a2.id WHERE a1.first_name = '$firstname' AND a1.last_name = '$lastname' 
				AND a2.first_name = 'Kevin' AND a2.last_name = 'Bacon'
				ORDER BY year DESC";
				
	
 
		$q = $pdo->query($sql);
		$q->setFetchMode(PDO::FETCH_ASSOC);
	
		$count= $q->rowCount(); //counts the number of rows create
	}
	
	//actor isn't found in database so set count to -1
	else{
		$count=-1;
	}
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>1Degree</title>
    </head>
    <body>

        <div id="container">

			 <!--prints if there are results in the query-->
			<?php if ($count>0) { ?>
            <h1>Movies with <?php echo $firstname . ' ' . $lastname ?> and Kevin Bacon</h1>
            <table>
                <thead>
                    <tr>
						<th>Movie</th>
						<th>Year</th>
                    </tr>
                </thead>
                <tbody>
				
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td> <?php echo htmlspecialchars($row['name']); ?> </td>
							<td> <?php echo htmlspecialchars($row['year']); ?> </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
			
			 <!--prints if the actor isn't found in the database-->
			<?php } else if ($count==-1) { ?>
				<h1>Actor <?php echo $firstname . ' ' . $lastname ?> not found.</h1>	
				
				
			<!--prints if the actor isn't found in a movie with kevin bacon-->
			<?php } else { ?>
				<h1><?php echo $firstname . ' ' . $lastname ?> wasn't in any movies with Kevin Bacon.</h1>
			<?php }?>
		</div>
			
    </body>

</html>
