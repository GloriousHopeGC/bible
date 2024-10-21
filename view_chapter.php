<?php
// Get the book and chapter number from the URL parameters
$book = isset($_GET['book']) ? $_GET['book'] : 'genesis';
$chapter = isset($_GET['chapter']) ? $_GET['chapter'] : '1';

// Specify the path to the JSON file
$filePath = "en-kjv/books/" . $book . "/chapters/" . $chapter . ".json";
$response = file_get_contents($filePath);

// Check if the response was successfully retrieved
if ($response === FALSE) {
    die("Error retrieving the JSON file.");
}

// Decode the JSON data
$data = json_decode($response, true);

// Check if the decoding was successful
if ($data === null) {
    die("Error decoding JSON data.");
}

// Display the chapter title and text
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($book); ?> Chapter <?php echo $chapter; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo ucfirst($book); ?> Chapter <?php echo $chapter; ?></h1>
        <p><?php echo $data["text"]; ?></p>
        <a href="select_book.php?book=<?php echo $book; ?>" class="btn btn-primary">Back to Chapters</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
