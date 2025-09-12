<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "book_recommend";
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$interest = strtolower($_POST['interest']);
$sql = "SELECT * FROM books WHERE genre LIKE '%$interest%' OR keywords LIKE '%$interest%' LIMIT 5";
$result = mysqli_query($conn, $sql);
echo "<h2>Recommended Books for '$interest'</h2>";
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<div>";
    echo "<h3>" . $row["title"] . "</h3>";
    echo "<p>Author: " . $row["author"] . "</p>";
    echo "<p>Genre: " . $row["genre"] . "</p>";
    echo "<p>Description: " . $row["description"] . "</p>";
    echo "</div><hr>";
  }
} else {
  echo "No recommendations found!";
}
mysqli_close($conn);
?>