<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "movie_recommend";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$interest = strtolower($_POST['interest']);
$sql = "SELECT * FROM movies WHERE LOWER(genre) LIKE '%$interest%' OR LOWER(keywords) LIKE '%$interest%' OR LOWER(actors) LIKE '%$interest%' LIMIT 5";
$result = mysqli_query($conn, $sql);

echo "<h2 style='color: white; text-align:center;'>Recommended Movies for '$interest'</h2>";

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<div style='margin:20px auto; max-width:600px; background:#111; color:white; padding:20px; border-radius:10px; box-shadow:0 0 10px #00ffe7;'>
            <h3>" . $row["title"] . "</h3>
            <p><strong>Genre:</strong> " . $row["genre"] . "</p>
            <p><strong>Actors:</strong> " . $row["actors"] . "</p>
            <p>" . $row["description"] . "</p>
          </div>";
  }
} else {
  echo "<p style='text-align:center; color:white;'>No movies found. Try another keyword like 'romance', 'Tom Cruise', or 'sci-fi'.</p>";
}

mysqli_close($conn);
?>
