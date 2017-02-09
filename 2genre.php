<?php
	include('common.php');
    $host = '';
    $dbname = '6degrees';
    $username = 'root';
    $password = 'root';
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    $genre = $_POST['genre'];
 
    $sql = "SELECT first_name, last_name, genre, count(*) max FROM movies_genres JOIN roles ON movies_genres.movie_id = roles.movie_id 
            JOIN actors ON roles.actor_id = actors.id WHERE genre = '$genre' GROUP BY first_name, last_name ORDER BY max DESC limit 7";
 
    $q = $pdo->prepare($sql);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>2Genre</title>
    </head>
    <body>
        <div id="container">
            <h1>Actors with Max Number of Movies of a User-Given Genre</h1>
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Genre</th>
                        <th>Max</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td> <?php echo htmlspecialchars($row['first_name']); ?> </td>
                            <td> <?php echo htmlspecialchars($row['last_name']); ?> </td>
                            <td> <?php echo htmlspecialchars($row['genre']); ?> </td>
                            <td> <?php echo htmlspecialchars($row['max']); ?> </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
    </div>
</body>
</html>
