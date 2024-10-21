<?php
// Get the selected book and chapter from the URL parameters
$book = isset($_GET['book']) ? $_GET['book'] : 'genesis'; // Default to Genesis
$chapter = isset($_GET['chapter']) ? $_GET['chapter'] : '1'; // Default to chapter 1

// Specify the path to the verses of the selected chapter
$versesPath = "en-kjv/books/" . $book . "/chapters/" . $chapter . ".json";
$nextChapterPath = "en-kjv/books/" . $book . "/chapters/" . ($chapter + 1) . ".json"; // Path for the next chapter
$previousChapterPath = "en-kjv/books/" . $book . "/chapters/" . ($chapter - 1) . ".json"; // Path for the previous chapter

$verses = [];
$error = ""; // Initialize error message
$nextChapterExists = false; // To check if the next chapter exists
$previousChapterExists = false; // To check if the previous chapter exists

// Check if the JSON file for the specified chapter exists
if (file_exists($versesPath)) {
    $jsonData = file_get_contents($versesPath); // Read the JSON file
    $chapterData = json_decode($jsonData, true); // Decode the JSON data

    // Check if the chapter data has verses under 'data'
    if (isset($chapterData['data'])) {
        $verses = $chapterData['data']; // Store the verses array from 'data'
    } else {
        $error = "No verses found in this chapter.";
    }

    // Check if the next chapter exists
    if (file_exists($nextChapterPath)) {
        $nextChapterExists = true;
    }

    // Check if the previous chapter exists (only if chapter > 1)
    if ($chapter > 1 && file_exists($previousChapterPath)) {
        $previousChapterExists = true;
    }
} else {
    $error = "The selected chapter does not exist. Path: " . $versesPath;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($book) . " Chapter " . $chapter; ?> Verses</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo ucfirst($book) . " Chapter " . $chapter; ?></h1>
        <?php if (!empty($verses)): ?>
            <ul class="list-group">
                <?php foreach ($verses as $verseData): ?>
                    <li class="list-group-item">
                        <?php echo $verseData['verse'] . "." . " ". $verseData['text']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php elseif (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php else: ?>
            <div class="alert alert-warning">No verses found for this chapter.</div>
        <?php endif; ?>

        <div class="mt-3">
            <a href="index.php" class="btn btn-primary">Books</a>
            <a href="select_book.php?book=<?php echo $book; ?>" class="btn btn-secondary">Chapters</a>

            <?php if ($previousChapterExists): ?>
                <a href="verse.php?book=<?php echo $book; ?>&chapter=<?php echo $chapter - 1; ?>" class="btn btn-warning">Previous</a>
            <?php else: ?>
                <button class="btn btn-warning" disabled>No Previous Chapter</button>
            <?php endif; ?>

            <?php if ($nextChapterExists): ?>
                <a href="verse.php?book=<?php echo $book; ?>&chapter=<?php echo $chapter + 1; ?>" class="btn btn-success">Next</a>
            <?php else: ?>
                <button class="btn btn-success" disabled>No More Chapters</button>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
