<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "career_recommend";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$interest = strtolower($_POST['interest']);
$sql = "SELECT * FROM careers WHERE field LIKE '%$interest%' OR keywords LIKE '%$interest%' LIMIT 5";
$result = mysqli_query($conn, $sql);

echo "<h2>Recommended Careers for '$interest'</h2>";

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<div style='margin-bottom:20px; padding:15px; background-color: #fff; border-radius:8px;'>
            <h3>" . $row["title"] . "</h3>
            <p><strong>Field:</strong> " . $row["field"] . "</p>
            <p>" . $row["description"] . "</p>
          </div>";
  }
} else {
  echo "<p>No matching career found. Try a broader term like 'science' or 'commerce'.</p>";
}

mysqli_close($conn);
?>
