<?php
// Get the selected book from the URL parameter
$book = isset($_GET['book']) ? $_GET['book'] : 'genesis'; // Default to Genesis

// Specify the path to the chapters of the selected book
$chaptersPath = "en-kjv/books/" . $book . "/chapters/";
$chapters = [];

// Scan the directory for JSON files in the chapters directory
foreach (glob($chaptersPath . "*.json") as $filename) {
    // Extract the chapter number from the filename
    $chapterNumber = basename($filename, ".json");
    $chapters[] = $chapterNumber; // Add to the chapters array
}

// Sort chapters in ascending order
sort($chapters); // This will sort the array numerically
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($book); ?> Chapters</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>  
        .btn-toggle {
            margin: 10px 0;
        }
        .book-button {
            margin: 5px;
            flex: 1 1 45%; /* Make buttons flexible */
            max-width: 160px; /* Adjust button width */
        }
        .book-section {
            display: none; /* Hide all sections initially */
            flex-wrap: wrap; /* Allow wrapping of buttons */
        }
        .active {
            display: flex; /* Show active section as flex */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo ucfirst($book); ?> Chapters</h1>
        <div class="book-section active">
            <?php foreach ($chapters as $chapter): ?>
                <a href="verse.php?book=<?php echo $book; ?>&chapter=<?php echo $chapter; ?>" class="btn btn-outline-primary book-button">
                   <?php echo $chapter; ?>
                </a>
            <?php endforeach; ?>
        </div>
        <a href="index.php" class="btn btn-primary mt-3">Back to Books</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
