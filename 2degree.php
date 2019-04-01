<?php
	include('common.php');
    $host = '';
    $dbname = '6degrees';
    $username = 'root';
    $password = 'root';
	
	$name=explode(" ",$_POST["name"]);//gets the name the user inputs and splits based on space
	$firstname=$name[0];
	$lastname=$name[1];
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

		 $sql = "SELECT a2.first_name, a2.last_name 
		 FROM actors a1 
		 JOIN roles r on a1.id=r.actor_id JOIN movies on 
		 r.movie_id=movies.id JOIN roles r2 on movies.id=r2.movie_id 
		 JOIN actors a2 on r2.actor_id = a2.id WHERE a1.first_name = 'Kevin'
		 AND a1.last_name='Bacon'
		 GROUP BY first_name,last_name";
				
		$q = $pdo->query($sql);
		$q->setFetchMode(PDO::FETCH_ASSOC);
	
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>



<!DOCTYPE html>
<html>
    <head>
		 <link href="main.css" type="text/css" rel="stylesheet">
        <title>Directors Who Have Also Acted</title>
    </head>
    <body>

        <div id="container">

			 <!--prints if there are results in the query-->
            <h1>Actors who have not been in a movie with Kevin Bacon but in one with something who has.</h1>
            <table>
                <thead>
                    <tr>
						<th>First Name</th>
						<th>Last Name</th>
                    </tr>
                </thead>
                <tbody>		
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td> <?php echo htmlspecialchars($row['first_name']); ?> </td>
							<td> <?php echo htmlspecialchars($row['last_name']); ?> </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		</div>
			
    </body>

</html>