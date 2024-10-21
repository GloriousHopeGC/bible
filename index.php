<?php
// List of Bible books in the canonical order
$canonicalBooks = [
    "genesis", "exodus", "leviticus", "numbers", "deuteronomy",
    "joshua", "judges", "ruth", "1samuel", "2samuel",
    "1kings", "2kings", "1chronicles", "2chronicles", "ezra",
    "nehemiah", "esther", "job", "psalms", "proverbs",
    "ecclesiastes", "songsofsolomon", "isaiah", "jeremiah", "lamentations",
    "ezekiel", "daniel", "hosea", "joel", "amos",
    "obadiah", "jonah", "micah", "nahum", "habakkuk",
    "zephaniah", "haggai", "zechariah", "malachi", // Old Testament

    "matthew", "mark", "luke", "john", "acts",
    "romans", "1corinthians", "2corinthians", "galatians", "ephesians",
    "philippians", "colossians", "1thessalonians", "2thessalonians", "1timothy",
    "2timothy", "titus", "philemon", "hebrews", "james",
    "1peter", "2peter", "1john", "2john", "3john",
    "jude", "revelation" // New Testament
];

// Specify the path to the books directory
$booksPath = "en-kjv/books/";
$availableBooks = [];

// Scan the directory for folders (each folder represents a book)
foreach (glob($booksPath . "*", GLOB_ONLYDIR) as $bookDir) {
    $bookName = basename($bookDir);
    $availableBooks[] = strtolower($bookName); // Add the book name to the array in lowercase
}

// Prepare arrays for Old and New Testament books
$oldTestamentBooks = [];
$newTestamentBooks = [];

foreach ($canonicalBooks as $book) {
    if (in_array($book, $availableBooks)) {
        if (array_search($book, $canonicalBooks) < 39) {
            $oldTestamentBooks[] = $book; // Old Testament books
        } else {
            $newTestamentBooks[] = $book; // New Testament books
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select a Book</title>
    <!-- Bootstrap CSS -->
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
        .header-image {
            width: 100px; /* Adjusted width */
            height: auto; /* Maintain aspect ratio */
            margin-right: 10px; /* Space between image and text */
            vertical-align: middle; /* Align with text */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>
            <img src="pictures/AGCOWC TRANSPARENT.png" alt="Bible Icon" class="header-image"> <!-- Replace with your image path -->
            AGCOWC BIBLE
        </h1>
        <div class="btn-group">
            <button class="btn btn-primary btn-toggle" onclick="showBooks('old')">Old Testament</button>
            <button class="btn btn-outline-secondary btn-toggle" onclick="showBooks('new')">New Testament</button>
        </div>

        <div id="oldTestament" class="book-section active">
            <?php foreach ($oldTestamentBooks as $book): ?>
                <a href="select_book.php?book=<?php echo $book; ?>" class="btn btn-outline-primary book-button"><?php echo ucfirst(str_replace('-', ' ', $book)); ?></a>
            <?php endforeach; ?>
        </div>

        <div id="newTestament" class="book-section">
            <?php foreach ($newTestamentBooks as $book): ?>
                <a href="select_book.php?book=<?php echo $book; ?>" class="btn btn-outline-primary book-button"><?php echo ucfirst(str_replace('-', ' ', $book)); ?></a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function showBooks(testament) {
            // Hide all sections
            document.querySelectorAll('.book-section').forEach(function(section) {
                section.classList.remove('active');
            });

            // Show selected testament
            document.getElementById(testament + 'Testament').classList.add('active');

            // Change button styles
            document.querySelectorAll('.btn-toggle').forEach(function(button) {
                button.classList.remove('btn-primary');
                button.classList.add('btn-outline-secondary');
            });

            // Highlight the selected button
            event.target.classList.remove('btn-outline-secondary');
            event.target.classList.add('btn-primary');
        }
    </script>

</body>
</html>
