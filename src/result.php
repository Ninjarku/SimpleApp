<?php
session_start();
$search_term = $_SESSION['search_term'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Result</title>
</head>
<body>
    <h1>Search Result</h1>
    <p>You searched for: <?php echo htmlspecialchars($search_term, ENT_QUOTES, 'UTF-8'); ?></p>
    <a href="index.php">Go back</a>
</body>
</html>
