<?php
//include book.php
require_once 'Book.php';

//start session store data
session_start();


if (!isset($_SESSION['books'])) {
    $_SESSION['books'] = [];
}

$message = "";

//check if the formed submitted
if (isset($_POST['submit'])) {
    // Capture the form input
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];

    // Error handling
    try {
        if (empty($title) || empty($author) || empty($year)) {
            throw new Exception("All fields are required.");
        } elseif (!is_numeric($year)) {
            throw new Exception("Year must be a number.");
        }

        // new book object
        $book = new Book($title, $author, $year);

        // Store book object
        $_SESSION['books'][] = $book;

        $message = "Input successful!";
    } catch (Exception $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

// check if the button is click
$displayBooks = false;
if (isset($_POST['check_books'])) {
    $displayBooks = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Collection</title>
</head>
<body>

<h1>Book Entry Form</h1>

<form method="POST" action="index.php">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title"><br><br>

    <label for="author">Author:</label>
    <input type="text" name="author" id="author"><br><br>

    <label for="year">Publication Year:</label>
    <input type="text" name="year" id="year"><br><br>

    <input type="submit" name="submit" value="Submit">
</form>

<?php
// display message after form submitted
if (isset($_POST['submit']) && !empty($message)) {
    echo "<p>" . htmlspecialchars($message) . "</p>";
}
?>

<form method="POST" action="index.php">
    <input type="submit" name="check_books" value="Check All Books">
</form>

<h2>Book List</h2>

<?php
// Function to display the list of books
function displayBooks($books) {
    if (!empty($books)) {
        echo "<table border='1'>";
        echo "<tr><th>Title</th><th>Author</th><th>Year</th></tr>";

        foreach ($books as $book) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($book->getTitle()) . "</td>";
            echo "<td>" . htmlspecialchars($book->getAuthor()) . "</td>";
            echo "<td>" . htmlspecialchars($book->getYear()) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No books added yet.</p>";
    }
}

// Display books when "Check All Books" was clicked
if ($displayBooks) {
    displayBooks($_SESSION['books']);
}
?>

</body>
</html>
