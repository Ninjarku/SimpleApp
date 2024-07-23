<?php
session_start();

function is_safe_input($input) {
    // Check for XSS by looking for HTML tags
    if (preg_match('/<[^>]*script/i', $input)) {
        return false;
    }
    // Check for SQL injection by looking for common SQL injection patterns
    $sql_patterns = [
        "/'.*--/",
        "/'.*;/",
        "/'.*or.*'/i",
        "/'.*and.*'/i",
        "/=.*=/"
    ];
    foreach ($sql_patterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return false;
        }
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_term = $_POST['search_term'];
    if (is_safe_input($search_term)) {
        $_SESSION['search_term'] = $search_term;
        header("Location: result.php");
        exit();
    } else {
        $error = "Invalid input detected. Please try again.";
        $_SESSION['error'] = $error;
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search App</title>
</head>
<body>
    <h1>Welcome to the Search App</h1>
    <form method="POST" action="index.php">
        <input type="text" name="search_term" placeholder="Enter search term">
        <button type="submit">Search</button>
    </form>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>
</body>
</html>
