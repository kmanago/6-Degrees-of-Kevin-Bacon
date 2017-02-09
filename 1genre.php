<?php
	include('common.php');
    $host = '';
    $dbname = '6degrees';
    $username = 'root';
    $password = 'root';
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 
    $sql = 'SELECT genre, count(*) max FROM movies_genres GROUP BY 
            genre ORDER BY max DESC limit 2';
 
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
        <title>1Genre</title>
    </head>
    <body>
        <div id="container">
            <h1>Movie Genres with Max Number of Movies</h1>
            <table>
                <thead>
                    <tr>
                        <th>Genre</th>
                        <th>Max</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td> <?php echo htmlspecialchars($row['genre']); ?> </td>
                            <td> <?php echo htmlspecialchars($row['max']); ?> </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
    </body>
</div>
</html>
